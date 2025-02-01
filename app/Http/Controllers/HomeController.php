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
    public function index()
    {

        $avatar_count = Avatars::count();
        $users_count = Users::count();
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));

        $male_users_count = Users::where('gender', 'male')->whereDate('created_at', $today)->count();
        $female_users_count = Users::where('gender', 'female')->whereDate('created_at', $today)->count();
        $active_audio_users_count = Users::where('audio_status', 1)->count();
        $active_video_users_count = Users::where('video_status', 1)->count();
        $today_recharge_count = Transactions::where('type', 'add_coins')->whereDate('datetime', $today)->sum('amount');
        $pending_withdrawals = Withdrawals::where('status', 0)->sum('amount');
        $yesterday_recharge_count = Transactions::where('type', 'add_coins')->whereDate('datetime', $yesterday)->sum('amount');
        $yesterday_paid_withdrawals = Withdrawals::where('status', 1)->whereDate('datetime', $yesterday)->sum('amount');
        $today_registration_count = Users::whereDate('created_at', $today)->count();
        $today_not_connected_calls = UserCalls::whereNull('ended_time')->whereDate('datetime', $today)->count();
             
                return view('dashboard.dashboard', compact('avatar_count','users_count','male_users_count','female_users_count','active_audio_users_count','active_video_users_count','today_recharge_count','pending_withdrawals','today_registration_count','yesterday_recharge_count','yesterday_paid_withdrawals','today_not_connected_calls'));
            }
       
    }

    

