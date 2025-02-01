<?php

namespace App\Http\Controllers;

use App\Models\Avatars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarsController extends Controller
{
    // List all avatars
    public function index(Request $request)
    {
        $search = $request->get('search'); // Get the search term from the request
        
        // If there's a search term, filter by gender or image name
        if ($search) {
            $avatars = Avatars::where('gender', 'like', '%' . $search . '%')
                             ->orWhere('image', 'like', '%' . $search . '%')
                             ->orderBy('created_at', 'desc') // Order by latest created
                             ->get();
        } else {
            // Otherwise, fetch all avatars and order by latest created
            $avatars = Avatars::orderBy('created_at', 'desc')->get();
        }

        return view('avatars.index', compact('avatars'));
    }

    // Show the create form
    public function create()
    {
        return view('avatars.create'); // Return create view
    }

    // Store the new avatar
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,avif|max:2048', // Added avif to the mimes rule
            'gender' => 'required|in:male,female,other',
        ], [
            'image.required' => 'An image file is required.',
            'image.image' => 'The uploaded file must be a valid image.',
            'image.mimes' => 'The image must be in jpeg, png, jpg, gif, or avif format.',
            'image.max' => 'The image size must be less than 2MB.',
        ]);        
        $imagePath = $request->file('image')->store('avatars', 'public');

        // Create the avatar record
        $avatar = new Avatars();
        $avatar->image = $imagePath;
        $avatar->gender = $request->gender;
        $avatar->save();

        return redirect()->route('avatars.index')->with('success', 'Avatar successfully created.');
    }

    // Show the edit form
    public function edit($id)
    {
        $avatar = Avatars::findOrFail($id);

        // Check if the avatar exists (no user ownership validation)
        return view('avatars.edit', compact('avatar'));
    }

    // Update the avatar
    public function update(Request $request, $id)
    {
        $avatar = Avatars::findOrFail($id);

        $request->validate([
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,avif|max:2048', // Added avif to the mimes rule
            'gender' => 'required|in:male,female,other',
        ], [
            'image.required' => 'An image file is required.',
            'image.image' => 'The uploaded file must be a valid image.',
            'image.mimes' => 'The image must be in jpeg, png, jpg, gif, or avif format.',
            'image.max' => 'The image size must be less than 2MB.',
        ]);
        

        // Update the image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($avatar->image && Storage::disk('public')->exists($avatar->image)) {
                Storage::disk('public')->delete($avatar->image);
            }
            $avatar->image = $request->file('image')->store('avatars', 'public');
        }

        // Update gender
        $avatar->gender = $request->gender;
        $avatar->save();

        return redirect()->route('avatar.index')->with('success', 'Avatar successfully updated.');
    }

    // Delete an avatar
    public function destroy($id)
    {
        $avatar = Avatars::findOrFail($id);

        // Delete the image from storage
        if ($avatar->image && Storage::disk('public')->exists($avatar->image)) {
            Storage::disk('public')->delete($avatar->image);
        }

        $avatar->delete();

        return redirect()->route('avatar.index')->with('success', 'Avatar successfully deleted.');
    }
}
