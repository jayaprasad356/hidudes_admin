<?php
namespace App\Http\Controllers;

use App\Models\Ratings;
use App\Models\Users;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function index(Request $request)
    {
        // Fetch ratings and apply the filter
        $ratings = Ratings::with(['users', 'callusers']) // Load both user and call_user relationships

    ->orderBy('created_at', 'desc') // Order by latest data
    ->get();
    
        return view('ratings.index', compact('ratings'));
    }
}
