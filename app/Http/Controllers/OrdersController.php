<?php
namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Users;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    
    public function index(Request $request)
    {
        $date = $request->get('date');
        $language = $request->get('language');
        $status = $request->get('status');
    
        // Get distinct languages from Users table for the filter dropdown
        $languages = Users::select('language')->distinct()->whereNotNull('language')->pluck('language');
    
        $orders = Orders::with(['users', 'coins'])
            ->when($date, function ($query) use ($date) {
                return $query->whereDate('datetime', $date);
            })
              ->when($status !== null, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($language, function ($query) use ($language) {
                // Filter based on user's language, not from orders table
                return $query->whereHas('users', function ($q) use ($language) {
                    $q->where('language', $language);
                });
            })
            ->orderBy('datetime', 'desc')
            ->get();
    
        return view('orders.index', compact('orders', 'languages'));
    }
    
    public function destroy($id)
    {
        Orders::findOrFail($id)->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
