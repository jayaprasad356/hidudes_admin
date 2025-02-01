<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UsersVerificationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 1);
        $language = $request->get('language', ''); // Get language filter
    
        $languages = ['Hindi', 'Telugu', 'Malayalam', 'Kannada', 'Punjabi', 'Tamil']; // Available languages
    
        // Search users by name, mobile, language, and filter by status
        $users = Users::with('avatar')
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($language, function ($query, $language) {
                return $query->where('language', $language); // Filter by language
            })
            ->when($request->get('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('mobile', 'like', '%' . $search . '%')
                      ->orWhere('language', 'like', '%' . $search . '%');
            })
            ->orderBy('datetime', 'desc')
            ->get();
    
        return view('users-verification.index', compact('users', 'languages', 'status', 'language'));
    }
    

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'exists:users,id',
            'status' => 'required|in:1,2,3',
        ]);
    
        $status = $request->input('status');
        $userIds = $request->input('user_ids');
    
        // Update the selected users' status
        Users::whereIn('id', $userIds)->update(['status' => $status]);
        
        return redirect()->back()->with('success', 'user status updated successfully!');
    }
}
