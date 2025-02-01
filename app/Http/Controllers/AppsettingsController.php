<?php
namespace App\Http\Controllers;

use App\Models\Appsettings;
use Illuminate\Http\Request;

class AppsettingsController extends Controller
{
    public function edit()
    {
        $appsettings = Appsettings::findOrFail(1);
        return view('appsettings.edit', compact('appsettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'link' => 'required|string|max:255',
            'app_version' => 'required|string|max:255',
            'description' => 'required|string',
            'bank' => 'required|string',
            'upi' => 'required|string',
        ]);
    
        $appsettings = Appsettings::findOrFail(1);
        $appsettings->link = $request->input('link');
        $appsettings->app_version = $request->input('app_version');
        $appsettings->description = $request->input('description');
        $appsettings->bank = $request->input('bank');
        $appsettings->upi = $request->input('upi');
    
        if ($appsettings->save()) {
            return redirect()->route('appsettings.edit')->with('success', 'Success, App Settings has been updated.');
        } else {
            return redirect()->route('appsettings.edit')->with('error', 'Sorry, something went wrong while updating the settings.');
        }
    }
}
