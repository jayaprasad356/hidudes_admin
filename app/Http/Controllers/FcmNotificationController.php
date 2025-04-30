<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\fcm_tokens;

class FcmNotificationController extends Controller
{
    
    public function index()
    {
        $fcm_tokens = fcm_tokens::with('users')->get(); // Ensure 'users' relationship is loaded
    
        return view('fcm_token.index', compact('fcm_tokens'));
    }


}
