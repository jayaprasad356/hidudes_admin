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
        $language = $request->get('language');
        $gender = $request->get('gender');
    
        $notifications = Notifications::when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->when($language, function ($query, $language) {
                return $query->where('language', $language);
            })
            ->when($gender, function ($query, $gender) {
                return $query->where('gender', $gender);
            })
            ->orderBy('datetime', 'desc')
            ->get();
    
        $users = Users::all();
        $languages = Notifications::select('language')->distinct()->pluck('language'); // Get unique languages
        $genders = Notifications::select('gender')->distinct()->pluck('gender'); // Get unique genders
    
        return view('notifications.index', compact('notifications', 'users', 'languages', 'genders'));
    }
    

    // Show the form to create a new notification
    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
            'title' => 'required|string|max:5000',
            'description' => 'required|string|max:5000',
            'gender' => 'required|string|in:all,male,female',
            'language' => 'required|string|in:all,Hindi,Telugu,Malayalam,Kannada,Punjabi,Tamil,English',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Handle file uploads
            if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
            }

            if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
            }

            $notification = Notifications::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'gender' => $validated['gender'],
            'language' => $validated['language'],
            'datetime' => now(),
            'logo' => $validated['logo'] ?? null,
            'image' => $validated['image'] ?? null,
            ]);

            if (!$notification) {
                return redirect()->back()->with('error', 'Failed to save notification.');
            }

            $gender = $notification->gender;
            $language = $notification->language;

           // Define filters using gender_language tag
            $filters = [];
    
            if ($gender !== 'all' && $language !== 'all') {
                $filters[] = ["field" => "tag", "key" => "gender_language", "relation" => "=", "value" => "{$gender}_{$language}"];
            } elseif ($gender !== 'all') {
                $filters[] = ["field" => "tag", "key" => "gender", "relation" => "=", "value" => "{$gender}"];
            } elseif ($language !== 'all') {
                $filters[] = ["field" => "tag", "key" => "language", "relation" => "=", "value" => "{$language}"];
            }
    
            // If both gender and language are 'all', send to everyone (no filters)
            if ($gender === 'all' && $language === 'all') {
                $filters = [];
            }
    
                $payload = [
                    "app_id" => "2878a3a7-8a9a-4902-b255-72e9af65af29",
                    "filters" => $filters,
                    "headings" => ["en" => $notification->title],
                    "contents" => ["en" => $notification->description],
                    "small_icon" => "notification_icon",
                    "large_icon" => isset($validated['logo']) ? "https://hidude.in/storage/app/public/{$validated['logo']}" : "https://hidude.in/storage/uploads/logo/hidude.png",
                    "big_picture" => isset($validated['image']) ? "https://hidude.in/storage/app/public/{$validated['image']}" : null,
                ];

                try {
                    OneSignal::sendNotificationCustom($payload);
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
