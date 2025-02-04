<?php

namespace App\Http\Controllers;

use App\Models\AccountList;
use App\Models\Announcement;
use App\Models\AttendanceEmployee;
use App\Models\Employee;
use App\Models\Event;
use App\Models\LandingPageSection;
use App\Models\Meeting;
use App\Models\Job;
use App\Models\Order;
use App\Models\Payees;
use App\Models\Avatars;
use App\Models\Users;
use App\Models\UserCalls;
use App\Models\Withdrawals;
use App\Models\Payer;
use App\Models\Plan;
use App\Models\Ticket;
use App\Models\Admin;
use App\Models\Transactions;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
     public function index(Request $request)
     {
         $language = $request->input('language', 'all'); // Default to 'all' if no language selected
         $today = date('Y-m-d');
         $yesterday = date('Y-m-d', strtotime('-1 day'));
     
         // Start the query to fetch users
         $query = Users::query();
     
         // Apply language filter if not 'all'
         if ($language !== 'all') {
             $query->where('language', $language); 
         }
     
         // Retrieve user IDs for other queries after language filter is applied
         $user_ids = $query->pluck('id');
     
         // Count the total users for the selected language
         $users_count = $query->count();
     
         // Count male users based on language and date
         $male_users_count = (clone $query)->where('gender', 'male')->whereDate('created_at', $today)->count();
     
         // Count female users based on language and date
         $female_users_count = (clone $query)->where('gender', 'female')->whereDate('created_at', $today)->count();
     
         // Count users registered today for the selected language
         $today_registration_count = (clone $query)->whereDate('created_at', $today)->count();
     
         // Count active audio users based on language
         $active_audio_users_count = (clone $query)->where('audio_status', 1)->count();
     
         // Count active video users based on language
         $active_video_users_count = (clone $query)->where('video_status', 1)->count();
     
         // Recharge and withdrawal data for selected language users
         $today_recharge_count = Transactions::where('type', 'add_coins')->whereDate('datetime', $today)->whereIn('user_id', $user_ids)->sum('amount');
         $pending_withdrawals = Withdrawals::where('status', 0)->whereIn('user_id', $user_ids)->sum('amount');
         $yesterday_recharge_count = Transactions::where('type', 'add_coins')->whereDate('datetime', $yesterday)->whereIn('user_id', $user_ids)->sum('amount');
         $yesterday_paid_withdrawals = Withdrawals::where('status', 1)->whereDate('datetime', $yesterday)->whereIn('user_id', $user_ids)->sum('amount');
         $today_not_connected_calls = UserCalls::whereNull('ended_time')->whereDate('datetime', $today)->whereIn('user_id', $user_ids)->count();
     
         return view('dashboard.dashboard', compact(
             'users_count', 
             'male_users_count', 
             'female_users_count', 
             'today_registration_count', 
             'active_audio_users_count', 
             'active_video_users_count', 
             'today_recharge_count', 
             'pending_withdrawals', 
             'yesterday_recharge_count', 
             'yesterday_paid_withdrawals', 
             'today_not_connected_calls'
         ));
     }
     

}

    

