<?php

namespace App\Http\Controllers;

use App\Models\PersonalNotifications;
use Illuminate\Http\Request;

class PersonalNotificationsController extends Controller
{
    // List all speech texts with optional search functionality
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filterDate = $request->get('filter_date');

        // Search speech texts by text content or language
        $personal_notifications = PersonalNotifications::when($search, function ($query, $search) {
            $query->where('text', 'like', '%' . $search . '%')
                  ->orWhere('language', 'like', '%' . $search . '%');
        })
        ->when($filterDate, function ($query) use ($filterDate) {
            return $query->whereDate('datetime', $filterDate); // Make sure column name matches
        })
        ->orderBy('datetime', 'desc') // Order by latest data
        ->get();

        return view('personal_notifications.index', compact('personal_notifications'));
    }

}
