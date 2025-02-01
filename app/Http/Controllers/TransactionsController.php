<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(Request $request)
    {
        // Get distinct types for the dropdown
        $types = Transactions::select('type')->distinct()->pluck('type');
        $filterDate = $request->get('filter_date');
    
        // Fetch transactions and apply the filter
        $transactions = Transactions::with('users') // Ensure user relation is loaded
        ->when($filterDate, function ($query) use ($filterDate) {
            return $query->whereDate('datetime', $filterDate); // Make sure column name matches
        })
            ->when($request->input('type'), function ($query, $type) {
                $query->where('type', $type); // Apply the type filter
            })
            ->orderBy('datetime', 'desc') // Order by latest data
            ->get();
    
        return view('transactions.index', compact('transactions', 'types'));
    }
    
}
