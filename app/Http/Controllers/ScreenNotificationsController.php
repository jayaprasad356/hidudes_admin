<?php

namespace App\Http\Controllers;

use App\Models\ScreenNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ScreenNotificationsController extends Controller
{
    public function index(Request $request)
    {
        $query = ScreenNotifications::query();
    
        // Filter by day if provided
        if ($request->has('day') && !empty($request->day)) {
            $query->where('day', $request->day);
        }
    
        // Filter by language if provided
        if ($request->has('language') && !empty($request->language)) {
            $query->where('language', $request->language);
        }
    
        // Filter by gender if provided
        if ($request->has('gender') && !empty($request->gender)) {
            $query->where('gender', $request->gender);
        }
    
        // Fetch all matching records
        $screen_notifications = $query->latest()->get();
    
        // Define available languages (Modify this based on your actual language data source)
        $languages = ScreenNotifications::select('language')->distinct()->pluck('language')->toArray();
    
        return view('screen_notifications.index', compact('screen_notifications', 'languages'));
    }
    

    // Show the form to create a new speech text
    public function create()
    {
        return view('screen_notifications.create');
    }

    // Store a newly created speech text
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'language' => 'required|string|max:255',
            'gender' => 'required|in:all,male,female',
            'time' => 'required|date_format:H:i', // Ensure time format
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday', // New validation
        ]);

        // Handle file uploads
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        // Create the speech text record
        ScreenNotifications::create($validated);

        return redirect()->route('screen_notifications.index')->with('success', 'Screen Notification successfully created.');
    }

    // Show the form to edit an existing speech text
    public function edit($id)
    {
        $screen_notifications = ScreenNotifications::findOrFail($id);
        return view('screen_notifications.edit', compact('screen_notifications'));
    }

  public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'gender' => 'required|string',
        'language' => 'required|string',
        'time' => 'required',
        'day' => 'required|string',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $screen_notifications = ScreenNotifications::findOrFail($id);

    // Update basic fields
    $screen_notifications->update($request->only(['title', 'description', 'gender', 'language', 'time', 'day']));

    // Handle logo upload
    if ($request->hasFile('logo')) {
        // Delete old logo if it exists
        if ($screen_notifications->logo) {
            Storage::disk('public')->delete($screen_notifications->logo);
        }

        // Store new logo and update the field
        $path = $request->file('logo')->store('logos', 'public');
        $screen_notifications->update(['logo' => $path]); // Save new path
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($screen_notifications->image) {
            Storage::disk('public')->delete($screen_notifications->image);
        }

        // Store new image and update the field
        $path = $request->file('image')->store('images', 'public');
        $screen_notifications->update(['image' => $path]); // Save new path
    }

    return redirect()->route('screen_notifications.index')->with('success', 'Screen Notification successfully updated.');
}

    
    // Delete a speech text
    public function destroy($id)
    {
        $screen_notifications = ScreenNotifications::findOrFail($id);

        // Delete the logo and image if exists
        if ($screen_notifications->logo) {
            Storage::disk('public')->delete($screen_notifications->logo);
        }

        if ($screen_notifications->image) {
            Storage::disk('public')->delete($screen_notifications->image);
        }

        $screen_notifications->delete();

        return redirect()->route('screen_notifications.index')->with('success', 'Screen Notifications successfully deleted.');
    }
       public function toggleAll(Request $request)
{
    $status = (int) $request->notification_enable; // Ensure it's an integer

    ScreenNotifications::query()->update(['notification_enable' => $status]);

    return response()->json([
        'message' => $status === 1 ? 'All notifications enabled successfully!' : 'All notifications disabled successfully!'
    ]);
}

    
}
