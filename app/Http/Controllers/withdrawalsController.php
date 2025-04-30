<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Withdrawals;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Exports\WithdrawalsExport; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class WithdrawalsController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status'); 
        $transferType = $request->get('transfer_type'); 
        $filterDate = $request->get('filter_date');
        $search = $request->get('search');
    
        // Query to fetch withdrawals with user details
        $withdrawals = Withdrawals::with('users')
            ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($transferType, function ($query) use ($transferType) {
                return $query->where('type', $transferType);
            })
            ->when($filterDate, function ($query) use ($filterDate) {
                return $query->whereDate('datetime', $filterDate);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('transaction_id', 'like', '%' . $search . '%')
                    ->orWhereHas('users', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                              ->orWhere('mobile', 'like', '%' . $search . '%');
                    });
            })
            ->orderBy('datetime', 'desc')
            ->get()
            ->map(function ($withdrawal) {
                // If status is Cancelled (2), use bank details from `withdrawal_bank_details`
                if ($withdrawal->status == 2) {
                    $bankDetails = DB::table('withdrawal_bank_details')
                        ->where('user_id', $withdrawal->user_id)
                        ->first();
    
                    if ($bankDetails) {
                        $withdrawal->bank = $bankDetails->bank;
                        $withdrawal->branch = $bankDetails->branch;
                        $withdrawal->ifsc = $bankDetails->ifsc;
                        $withdrawal->account_num = $bankDetails->account_num;
                        $withdrawal->holder_name = $bankDetails->holder_name;
                    }
                } else {
                    // Use bank details from `users` table for Pending and Paid
                    $withdrawal->bank = $withdrawal->users->bank ?? null;
                    $withdrawal->branch = $withdrawal->users->branch ?? null;
                    $withdrawal->ifsc = $withdrawal->users->ifsc ?? null;
                    $withdrawal->account_num = $withdrawal->users->account_num ?? null;
                    $withdrawal->holder_name = $withdrawal->users->holder_name ?? null;
                }
    
                return $withdrawal;
            });
    
        return view('withdrawals.index', compact('withdrawals'));
    }
    

    public function edit($id)
    {
        $withdrawal = Withdrawals::with('users')->findOrFail($id);
        $user = $withdrawal->users;
    
        // Use withdrawal_bank_details for Cancelled status
        if ($withdrawal->status == 2) {
            $bankDetails = DB::table('withdrawal_bank_details')
                ->where('user_id', $withdrawal->user_id)
                ->first();
    
            // If bank details exist, use them instead of user's details
            if ($bankDetails) {
                $user->bank = $bankDetails->bank;
                $user->branch = $bankDetails->branch;
                $user->ifsc = $bankDetails->ifsc;
                $user->account_num = $bankDetails->account_num;
                $user->holder_name = $bankDetails->holder_name;
            }
        }
    
        return view('withdrawals.edit', compact('withdrawal', 'user'));
    }
    
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'bank' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'ifsc' => 'required|string|max:20',
            'account_num' => 'required|string|max:30',
            'holder_name' => 'required|string|max:255',
        ]);
    
        $withdrawal = Withdrawals::findOrFail($id);
    
        // Check if withdrawal is Cancelled
        if ($withdrawal->status == 2) {
            // Store the new bank details in `withdrawal_bank_details`
            DB::table('withdrawal_bank_details')->updateOrInsert(
                ['user_id' => $withdrawal->user_id],  // Update existing record or create a new one
                [
                    'bank' => $request->bank,
                    'branch' => $request->branch,
                    'ifsc' => $request->ifsc,
                    'account_num' => $request->account_num,
                    'holder_name' => $request->holder_name,
                    'updated_at' => now(),
                ]
            );
    
        } else {
            // Update the bank details in `users` table for non-cancelled withdrawals
            $user = Users::findOrFail($withdrawal->user_id);
            $user->update([
                'bank' => $request->bank,
                'branch' => $request->branch,
                'ifsc' => $request->ifsc,
                'account_num' => $request->account_num,
                'holder_name' => $request->holder_name,
            ]);
        }
    
        return redirect()->route('withdrawals.index')->with('success', 'Bank details updated successfully.');
    }
    
    
        
    public function bulkUpdateStatus(Request $request)
    {
        // Validate the request to ensure withdrawal IDs and status are provided
        $request->validate([
            'withdrawal_ids' => 'required|array',
            'withdrawal_ids.*' => 'exists:withdrawals,id',
            'status' => 'required|integer|in:1,2', // Only allow 1 (Paid) or 2 (Cancelled)
        ]);
        
        $status = (int) $request->input('status');
        $successMessage = '';
        $errorMessage = '';
    
        // Use a database transaction to ensure atomic updates
        DB::transaction(function () use ($request, $status, &$successMessage, &$errorMessage) {
            foreach ($request->withdrawal_ids as $withdrawalId) {
                $withdrawal = Withdrawals::find($withdrawalId);
    
                if ($withdrawal) {
                    // Check if the withdrawal is already cancelled (status 2)
                    if ($withdrawal->status == 2) {
                        // If the withdrawal is already cancelled, and trying to cancel again
                        if ($status === 2) {
                            $errorMessage = "The withdrawal with ID {$withdrawalId} is already cancelled. It cannot be cancelled again.";
                            continue; // Skip processing this withdrawal
                        }
    
                        // If the withdrawal is already cancelled, and trying to mark as paid
                        if ($status === 1) {
                            $errorMessage = "The withdrawal with ID {$withdrawalId} is already cancelled. It cannot be paid again.";
                            continue; // Skip processing this withdrawal
                        }
                    }
    
                    // Handle the case where the status is set to Cancelled (2)
                    if ($status === 2) {
                        $user = Users::find($withdrawal->user_id);

                          // Store the current bank details in withdrawal_bank_details
                          DB::table('withdrawal_bank_details')->updateOrInsert(
                            ['user_id' => $user->id],
                            [
                                'bank' => $user->bank,
                                'branch' => $user->branch,
                                'ifsc' => $user->ifsc,
                                'account_num' => $user->account_num,
                                'holder_name' => $user->holder_name,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]
                        );
    
                        if ($user) {
                            // Refund the amount to the user's balance only if it is not already canceled
                            $user->increment('balance', $withdrawal->amount);
    
                            // Log the cancellation in the transactions table
                            Transactions::create([
                                'user_id' => $user->id,
                                'type' => 'cancelled',
                                'coins' => 0,
                                'amount' => $withdrawal->amount ?? 0,
                                'datetime' => now(),
                            ]);
                        }
    
                        // Update the withdrawal status to Cancelled
                        $withdrawal->update(['status' => 2]);
                        $successMessage = "The withdrawal with ID {$withdrawalId} has been successfully cancelled.";
                    }
    
                    // Handle the case where the status is set to Paid (1)
                    if ($status === 1) {
                        // Update the withdrawal status to Paid
                        $withdrawal->update(['status' => 1]);
                        $successMessage = "The withdrawal with ID {$withdrawalId} has been successfully marked as paid.";
                    }
                }
            }
        });
    
        // Return the response with the appropriate success or error message
        if ($errorMessage) {
            return redirect()->route('withdrawals.index')->with('error', $errorMessage);
        }
    
        if ($successMessage) {
            return redirect()->route('withdrawals.index')->with('success', $successMessage);
        }
    
        return redirect()->route('withdrawals.index')->with('info', 'No withdrawals were updated.');
    }
    
  
    public function export(Request $request)
{
    // Get the status from the request if provided
    $filters = $request->only('status', 'filter_date');

    return Excel::download(new WithdrawalsExport($filters), 'withdrawals.xlsx');
}

  
  public function withdrawalsReport(Request $request)
{
    // Get the date from the request
    $date = $request->input('date');

    // Query builder
    $query = Withdrawals::where('status', 1)
        ->select(DB::raw('DATE(datetime) as date'), DB::raw('SUM(amount) as total'))
        ->groupBy('date')
        ->orderBy('date', 'desc');  // ✅ Order by date descending (latest first)

    // Apply date filter only if a date is selected
    if ($date) {
        try {
            $formattedDate = Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
            $query->whereDate('datetime', $formattedDate);
        } catch (\Exception $e) {
            return back()->with('error', __('Invalid date format.'));
        }
    }

    // Get the filtered or all results
    $withdrawals = $query->get();

    // Calculate the grand total (all data or filtered)
    $grandTotal = $withdrawals->sum('total');

    return view('withdrawalsreports.index', compact('withdrawals', 'grandTotal', 'date'));
}

}