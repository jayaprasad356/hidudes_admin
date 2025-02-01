<?php
namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function edit()
    {
        $news = News::findOrFail(1); // Assuming you're always editing the record with ID 1
        return view('news.edit', compact('news'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'privacy_policy' => 'required|string',
            'support_mail' => 'required|string',
            'demo_video' => 'required|string',
            'minimum_withdrawals' => 'required|string',
        ]);

        $news = News::findOrFail(1); // Editing record with ID 1
        $news->update($request->only(['privacy_policy', 'support_mail', 'demo_video', 'minimum_withdrawals']));

        return redirect()->route('news.edit')->with('success', 'Settings updated successfully.');
    }
}
