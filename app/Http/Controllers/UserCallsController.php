<?php
namespace App\Http\Controllers;

use App\Models\UserCalls;
use App\Models\Users;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserCallsController extends Controller
{
    public function index(Request $request)
    {
        // Fetch user calls with optional type filter
        $type = $request->get('type'); // Get type from request
        $filterDate = $request->get('filter_date');
        
        // Get the user calls with the relationships
        $usercalls = UserCalls::with(['user', 'callusers'])
        ->when($filterDate, function ($query) use ($filterDate) {
            return $query->whereDate('datetime', $filterDate); // Make sure column name matches
        })
            ->when($type, function ($query, $type) {
                return $query->where('type', $type); // Filter by type if provided
            })
            ->orderBy('datetime', 'desc') // Order by latest data
            ->get();

        // Calculate the duration for each user call
        foreach ($usercalls as $usercall) {
            if ($usercall->started_time && $usercall->ended_time) {
                // Parse the times using Carbon
                $started = Carbon::parse($usercall->started_time);
                $ended = Carbon::parse($usercall->ended_time);
                
                // Calculate the duration difference
                $duration = $started->diff($ended); // Get the difference as a Carbon interval
                // Format the duration as H:i:s
                $usercall->duration = $duration->format('%H:%I:%S');
            } else {
                $usercall->duration = ''; // Handle cases where times are missing
            }
        
          // Get the user's current coins (without before and after calculations)
          $user = $usercall->user;
          if ($user) {
              $usercall->coins = $user->coins; // Display only user's coins
          }
      }

      // Pass the usercalls to the view
      return view('usercalls.index', compact('usercalls'));
  }


    public function updateuser(Request $request)
    {
        // Validate the input
        $request->validate([
            'audio_status' => 'nullable|in:0,1,2,3',
            'video_status' => 'nullable|in:0,1,2,3',
        ]);

        $data = $request->only(['audio_status', 'video_status']);

        // Update the users table based on the provided input
        $updated = Users::query()->update(array_filter($data, fn($value) => $value !== null));

        if ($updated) {
            if ($request->has('audio_status')) {
                return redirect()->back()->with('success', 'Audio status updated successfully!');
            } elseif ($request->has('video_status')) {
                return redirect()->back()->with('success', 'Video status updated successfully!');
            }
        }

        return redirect()->back()->with('error', 'Failed to update status.');
    }

}
