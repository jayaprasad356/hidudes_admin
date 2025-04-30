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
        $search = $request->get('search');
        $filterDate = $request->get('filter_date');  // Only apply if provided
        $type = $request->get('type'); 
        $language = $request->get('language'); 
        
        // Get the user calls with relationships
        $usercalls = UserCalls::with(['user', 'callusers'])
            ->when($filterDate, function ($query, $filterDate) {  // Only apply date filter if provided
                return $query->whereDate('datetime', Carbon::parse($filterDate)->format('Y-m-d'));
            })
            ->when($type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($language, function ($query, $language) {
                if (!empty($language) && $language !== 'all') {
                    return $query->whereHas('user', function ($query) use ($language) {
                        return $query->where('language', $language);
                    });
                }
            })
           ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->whereHas('user', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                              ->orWhere('mobile', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('callusers', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                              ->orWhere('mobile', 'like', '%' . $search . '%');
                    });
                });            })

            ->orderBy('datetime', 'desc')
            ->paginate(10);
    

            foreach ($usercalls as $usercall) {
                if ($usercall->started_time && $usercall->ended_time) {
                    // Parse the times using Carbon
                    $started = Carbon::parse($usercall->started_time);
                    $ended = Carbon::parse($usercall->ended_time);
            
                    // Handle case when call crosses midnight
                    if ($ended->lessThan($started)) {
                        $ended->addDay();
                    }
            
                    // Calculate the duration
                    $duration = $started->diff($ended);
            
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
