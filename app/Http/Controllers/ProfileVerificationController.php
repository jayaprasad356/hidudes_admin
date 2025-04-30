<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class ProfileVerificationController extends Controller
{
    public function index(Request $request)
    {
        $profile_status = $request->get('profile_status', 0); // Default to Pending (0)
        $language = $request->get('language', '');  // Get language filter
        
        $languages = ['Hindi', 'Telugu', 'Malayalam', 'Kannada', 'Punjabi', 'Tamil'];  // Available languages
    
       $users = Users::with('avatar')
        ->when($profile_status == 0, function ($query) {
            return $query->where('profile_status', 0)
                         ->whereNotNull('image')
                         ->where('image', '!=', '');
        }, function ($query) use ($profile_status) {
            return $query->where('profile_status', $profile_status);
        })
        ->when($language, function ($query, $language) {
            return $query->where('language', $language);
        })
        ->when($request->get('search'), function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('mobile', 'like', '%' . $search . '%')
                  ->orWhere('language', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('datetime', 'desc')
        ->get();

    
        return view('profile-verification.index', compact('users', 'languages', 'profile_status', 'language'));
    }
    

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
            'profile_status' => 'required|in:1,2,3',
        ]);
    
        $profile_status = $request->input('profile_status');
        $userIds = $request->input('user_ids');
    
        // Update the selected users' status
        Users::whereIn('id', $userIds)->update(['profile_status' => $profile_status]);
        
        return redirect()->back()->with('success', 'Profile status updated successfully!');
    }
}
