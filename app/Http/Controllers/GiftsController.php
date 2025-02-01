<?php

namespace App\Http\Controllers;

use App\Models\Gifts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GiftsController extends Controller
{
    // List all avatars
    public function index(Request $request)
    {
        $search = $request->get('search'); // Get the search term from the request
        
        // If there's a search term, filter by gender or gift icon name
        if ($search) {
            $gifts = Gifts::where('coins', 'like', '%' . $search . '%')
                             ->orWhere('gift_icon', 'like', '%' . $search . '%')
                             ->orderBy('created_at', 'desc') // Order by latest created
                             ->get();
        } else {
            // Otherwise, fetch all avatars and order by latest created
            $gifts = Gifts::orderBy('created_at', 'desc')->get();
        }

        return view('gifts.index', compact('gifts'));
    }

    // Show the create form
    public function create()
    {
        return view('gifts.create'); // Return create view
    }

    // Store the new avatar
    public function store(Request $request)
    {
        $request->validate([
            'gift_icon' => 'required|image|mimes:jpeg,png,jpg,gif,avif|max:2048', // Added avif to the mimes rule
            'coins' => 'required|numeric',
        ], [
            'gift_icon.required' => 'A gift icon file is required.',
            'gift_icon.image' => 'The uploaded file must be a valid image.',
            'gift_icon.mimes' => 'The gift icon must be in jpeg, png, jpg, gif, or avif format.',
            'gift_icon.max' => 'The gift icon size must be less than 2MB.',
        ]);        
        $giftIconPath = $request->file('gift_icon')->store('gifts', 'public');

        // Create the avatar record
        $gifts = new Gifts();
        $gifts->gift_icon = $giftIconPath;
        $gifts->coins = $request->coins;
        $gifts->save();

        return redirect()->route('gifts.index')->with('success', 'Gifts successfully created.');
    }

    // Show the edit form
    public function edit($id)
    {
        $gifts = Gifts::findOrFail($id);

        // Check if the avatar exists (no user ownership validation)
        return view('gifts.edit', compact('gifts'));
    }

    public function update(Request $request, $id)
    {
        $gifts = Gifts::findOrFail($id);
    
        // Validate input (removed 'gender' field as it's not in your form)
        $request->validate([
            'gift_icon' => 'sometimes|image|mimes:jpeg,png,jpg,gif,avif|max:2048',
            'coins' => 'required|numeric',
        ], [
            'gift_icon.image' => 'The uploaded file must be a valid image.',
            'gift_icon.mimes' => 'The gift icon must be in jpeg, png, jpg, gif, or avif format.',
            'gift_icon.max' => 'The gift icon size must be less than 2MB.',
            'coins.required' => 'The number of coins is required.',
            'coins.numeric' => 'The coins field must be a number.',
        ]);
    
        // Update gift icon if a new one is uploaded
        if ($request->hasFile('gift_icon')) {
            // Delete old image
            if ($gifts->gift_icon && Storage::disk('public')->exists($gifts->gift_icon)) {
                Storage::disk('public')->delete($gifts->gift_icon);
            }
            $gifts->gift_icon = $request->file('gift_icon')->store('gifts', 'public');
        }
    
        // Update coins
        $gifts->coins = $request->coins;
        
        // Save changes
        $gifts->save();
    
        return redirect()->route('gifts.index')->with('success', 'Gift successfully updated.');
    }
    

    // Delete an avatar
    public function destroy($id)
    {
        $gifts = Gifts::findOrFail($id);

        // Delete the gift icon from storage
        if ($gifts->gift_icon && Storage::disk('public')->exists($gifts->gift_icon)) {
            Storage::disk('public')->delete($gifts->gift_icon);
        }

        $gifts->delete();

        return redirect()->route('gifts.index')->with('success', 'Gifts successfully deleted.');
    }
}
