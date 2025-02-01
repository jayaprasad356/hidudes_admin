<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Berkayk\OneSignal\OneSignalFacade as OneSignal;

class NotificationsController extends Controller
{
    // List all notifications with optional search functionality
    public function index(Request $request)
    {
        $search = $request->get('search');
        $notifications = Notifications::when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        })->orderBy('datetime', 'desc')->get();
    
        $users = Users::all();
    
        return view('notifications.index', compact('notifications', 'users'));
    }

    // Show the form to create a new notification
    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'title' => 'required|string|max:5000',
                'description' => 'required|string|max:5000',
                'gender' => 'required|string|in:all,male,female',
                'language' => 'required|string|in:all,Hindi,Telugu,Malayalam,Kannada,Punjabi,Tamil,English',
            ]);
    
            // Insert the notification into the database
            $notification = Notifications::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'gender' => $validated['gender'],
                'language' => $validated['language'],
                'datetime' => now(),
            ]);
    
            if (!$notification) {
                return redirect()->back()->with('error', 'Failed to save notification.');
            }
    
            // Define tags based on gender
            $tags = [];
            if ($validated['gender'] === 'male') {
                $tags[] = ['field' => 'tag', 'key' => 'gender', 'relation' => '=', 'value' => 'male'];
            } elseif ($validated['gender'] === 'female') {
                $tags[] = ['field' => 'tag', 'key' => 'gender', 'relation' => '=', 'value' => 'female'];
            }
    
             // Format the message with the title and description on separate lines
            $message = $validated['title'] . "\n" . $validated['description'];

            // Send push notification using OneSignal with tags
            try {
                OneSignal::sendNotificationUsingTags(
                    $message,  // Use the formatted message with title and description on separate lines
                    $tags,  // Pass tags for gender
                    $url = null, 
                    $data = null, 
                    $buttons = null, 
                    $schedule = null
                );
    
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error sending notification: ' . $e->getMessage());
            }
    
            return redirect()->route('notifications.index')->with('success', 'Notification created and sent successfully.');
    
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    
    
    // Edit notification
    public function edit($id)
    {
        $notification = Notifications::findOrFail($id);
        return view('notifications.edit', compact('notification'));
    }

    // Update notification
    public function update(Request $request, $id)
    {
        $notification = Notifications::findOrFail($id);

        // Validate input data
        $validated = $request->validate([
            'title' => 'required|string|max:5000',
            'description' => 'required|string|max:5000',
        ]);

        // Update notification details
        $notification->update($validated);

        return redirect()->route('notifications.index')->with('success', 'Notification successfully updated.');
    }

    // Delete notification
    public function destroy($id)
    {
        $notification = Notifications::findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification successfully deleted.');
    }

    // Search users via AJAX
    public function searchUsers(Request $request)
    {
        $search = $request->get('q');

        $users = Users::where('name', 'like', '%' . $search . '%')
                      ->orWhere('mobile', 'like', '%' . $search . '%')
                      ->get(['id', 'name', 'mobile']);

        return response()->json($users);
    }
}
