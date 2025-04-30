<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Avatars;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{
    // List all users with optional search functionality
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filterDate = $request->get('filter_date');  
        $gender = $request->get('gender');
        $language = $request->get('language');
    
        $users = Users::query()
            ->when($filterDate, function ($query) use ($filterDate) {
                $query->whereDate('datetime', $filterDate);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                          ->orWhere('mobile', 'like', '%' . $search . '%')
                          ->orWhere('language', 'like', '%' . $search . '%');
                });
            })
            ->when($gender, function ($query) use ($gender) {
                $query->where('gender', $gender);
            })  
            ->when($language, function ($query) use ($language) {
                $query->where('language', $language);
            })
            ->orderBy('created_at', 'desc')    // Keep the sorting
            ->paginate(10);                     // Use cursor to iterate efficiently
    
        return view('users.index', compact('users'));
    }
    
    // Show the form to edit an existing user
    public function edit($id)
    {
        $user = Users::findOrFail($id);
    
        // Fetch all avatars
        $avatars = Avatars::all();
    
        // Available languages
        $languages = ['Hindi', 'Telugu', 'Malayalam', 'Kannada', 'Punjabi', 'Tamil'];
    
        return view('users.edit', compact('user', 'avatars', 'languages'));
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $user = Users::findOrFail($id);

        $user->name = $request->name;
        $user->avatar_id = $request->avatar_id;
        $user->mobile = $request->mobile;
        $user->language = $request->language; 
        $user->age = $request->age;
        $user->status = $request->status;
        $user->interests = $request->interests;
        $user->describe_yourself = $request->describe_yourself;
        $user->voice = $request->voice; 
        $user->audio_status = $request->audio_status;
        $user->video_status = $request->video_status; 
        $user->balance = $request->balance; 
        $user->attended_calls = $request->attended_calls;
        $user->describe_yourself = $request->describe_yourself;
        $user->missed_calls = $request->missed_calls; 
        $user->avg_call_percentage = $request->avg_call_percentage; 
        $user->blocked = $request->blocked; 
        $user->coins = $request->coins; 
        $user->total_coins = $request->total_coins;
        $user->datetime = now();
        $user->save();

        return redirect()->route('users.index')->with('success', 'user successfully updated.');
    }

    // Delete a user
    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'user successfully deleted.');
    }

    // Handle Add Coins form submission
    public function addCoins(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'coins' => 'required|numeric|min:1',
        ]);

        $user = Users::findOrFail($id); // Retrieve the user by ID

        // Update the user's coins
        $user->coins += $request->input('coins');
        $user->total_coins += $request->input('coins');
        $user->save();

        // Create a new transaction record
        Transactions::create([
            'user_id' => $user->id,
            'type' => 'add_coins',
            'coins' => $request->input('coins'),
            'payment_type' => 'Credit',
            'datetime' => now(),
        ]);

        return redirect()->route('users.index')->with('success', 'Coins Added Successfully.');
    }
     // Handle Add Coins form submission
     public function addBalance(Request $request, $id)
     {
         // Validate the input
         $request->validate([
             'balance' => 'required|numeric|min:1',
         ]);
 
         $user = Users::findOrFail($id); // Retrieve the user by ID
 
         // Update the user's coins
         $user->balance += $request->input('balance');
         $user->save();
 
         // Create a new transaction record
         Transactions::create([
             'user_id' => $user->id,
             'type' => 'admin_bonus',
             'amount' => $request->input('balance'),
             'payment_type' => 'Credit',
             'datetime' => now(),
         ]);
 
         return redirect()->route('users.index')->with('success', 'Balance Added Successfully.');
     }
    
      public function usersreports(Request $request)
     {
         $startDate = '2024-12-10'; // Starting date
         $filterDate = $request->input('date'); // Optional filter from user
     
         // Prepare the base query
         $datesQuery = Users::select(DB::raw('DATE(created_at) as date'))
             ->groupBy('date')
             ->orderBy('date', 'desc');
     
         // Apply date filter if selected
         if ($filterDate) {
             try {
                 $formattedDate = Carbon::createFromFormat('Y-m-d', $filterDate)->format('Y-m-d');
                 $datesQuery->whereDate('created_at', $formattedDate);
             } catch (\Exception $e) {
                 return back()->with('error', __('Invalid date format.'));
             }
         } else {
             $datesQuery->whereDate('created_at', '>=', $startDate);
             $formattedDate = null; // fallback if not set
         }
     
         // Get all dates matching criteria
         $dates = $datesQuery->pluck('date');
     
         $reportData = [];
     
         foreach ($dates as $date) {
             $maleCount = Users::whereDate('created_at', $date)->where('gender', 'male')->count();
             $femaleCount = Users::whereDate('created_at', $date)->where('gender', 'female')->count();
     
             // Only get recharges with type = add_coins
             $totalRecharge = transactions::whereDate('created_at', $date)
                 ->where('type', 'add_coins')
                 ->sum('amount');
     
             // Get users who recharged at least once on this date
             $paidUserIds = transactions::whereDate('created_at', $date)
                 ->where('type', 'add_coins')
                 ->distinct('user_id')
                 ->pluck('user_id');
     
             $paidUsersCount = Users::whereIn('id', $paidUserIds)->count();
     
             $reportData[] = [
                 'date' => $date,
                 'totalMale' => $maleCount,
                 'totalFemale' => $femaleCount,
                 'totalRecharge' => $totalRecharge,
                 'totalPaidUsers' => $paidUsersCount,
             ];
         }
     
         return view('usersreports.index', compact('reportData', 'formattedDate'));
     }

     public function femalereports(Request $request)
     {
         // Get the date from the request or use today's date by default
         $date = $request->input('date') 
             ? Carbon::createFromFormat('Y-m-d', $request->input('date')) 
             : Carbon::today();
         
         // Get the reports for female users, making sure to select started_time and ended_time
         $femaleReports = DB::table('user_calls as uc')
             ->join('users as u', 'uc.call_user_id', '=', 'u.id')
             ->where('u.gender', 'female')
             ->whereDate('uc.datetime', $date) // Filter by selected date
             ->select(
                 'uc.call_user_id',
                 'u.name as call_user_name',
                 'uc.started_time',
                 'uc.ended_time',
                 DB::raw('SUM(uc.income) as total_income') // Sum up the income
             )
             ->groupBy('uc.call_user_id', 'u.name', 'uc.started_time', 'uc.ended_time') // Group by necessary fields
             ->orderByDesc('total_income') // Order by total income descending
             ->get();
     
         // Initialize an array to hold the final results with total duration for each user
         $finalReports = [];
     
         // Process the reports to sum up the durations for each user
         foreach ($femaleReports as $report) {
             // Initialize total seconds for each user
             $totalSeconds = 0;
     
             // Only calculate if both started_time and ended_time are available
             if ($report->started_time && $report->ended_time) {
                 // Parse the times using Carbon
                 $started = Carbon::parse($report->started_time);
                 $ended = Carbon::parse($report->ended_time);
     
                 // Handle case when call crosses midnight
                 if ($ended->lessThan($started)) {
                     $ended->addDay(); // Add a day if the call crosses midnight
                 }
     
                 // Calculate the duration in seconds for the current call
                 $totalSeconds += $started->diffInSeconds($ended);
             }
     
             // Only add the report if totalSeconds is greater than zero
             if ($totalSeconds > 0) {
                 // If there's already a report for this user, accumulate the total duration
                 if (isset($finalReports[$report->call_user_id])) {
                     $finalReports[$report->call_user_id]['totalSeconds'] += $totalSeconds;
                     $finalReports[$report->call_user_id]['total_income'] += $report->total_income;
                 } else {
                     // First call for this user, initialize their report
                     $finalReports[$report->call_user_id] = [
                         'call_user_name' => $report->call_user_name,
                         'totalSeconds' => $totalSeconds,
                         'total_income' => $report->total_income
                     ];
                 }
             }
         }
     
         // Now, format the total duration for each user into hours, minutes, and seconds
         foreach ($finalReports as $userId => $userReport) {
             // Calculate hours, minutes, and seconds from total seconds
             $hours = floor($userReport['totalSeconds'] / 3600);
             $minutes = floor(($userReport['totalSeconds'] % 3600) / 60);
             $seconds = $userReport['totalSeconds'] % 60;
     
             // Format the duration as 'X hour(s) Y minute(s) Z second(s)'
             $formattedDuration = '';
             if ($hours > 0) {
                 $formattedDuration .= $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ';
             }
             if ($minutes > 0) {
                 $formattedDuration .= $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ';
             }
             if ($seconds > 0) {
                 $formattedDuration .= $seconds . ' second' . ($seconds > 1 ? 's' : '');
             }
     
             // Save the formatted duration back to the report
             $finalReports[$userId]['total_duration'] = $formattedDuration;
         }
     
         // Sort the reports in descending order by total call duration (totalSeconds)
         usort($finalReports, function($a, $b) {
             return $b['totalSeconds'] <=> $a['totalSeconds'];
         });
     
         // Get current date and time in desired format (21-04-2025 00:00:00)
         $currentDateTime = Carbon::now()->format('d-m-Y H:i:s');
     
         // Return the view with the reports data
         return view('femalereports.index', [
             'reportsData' => $finalReports,
             'formattedDate' => $date->format('Y-m-d'), // Return the selected date
             'currentDateTime' => $currentDateTime // Pass the current date and time
         ]);
     }
     

     
     
}

