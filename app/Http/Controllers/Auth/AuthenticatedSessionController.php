<?php

namespace App\Http\Controllers\Auth;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\LoginDetail;
use App\Models\Utility;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use WhichBrowser\Parser;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function __construct()
    {
        if (!file_exists(storage_path() . "/installed")) {
            header('location:install');
            die;
        }
    }

    /*protected function authenticated(Request $request, $admin)
    {
        if($admin->delete_status == 1)
        {
            auth()->logout();
        }

        return redirect('/check');
    }*/

    public function store(LoginRequest $request)
    {
        $settings = Utility::settings();
        if (isset($settings['recaptcha_module']) && $settings['recaptcha_module'] == 'yes') {
            $validation['g-recaptcha-response'] = 'required';
        } else {
            $validation = [];
        }
        $this->validate($request, $validation);
    
        $request->authenticate(); // Authenticate the user
    
        $request->session()->regenerate(); // Regenerate session to prevent session fixation attacks
    
        $admins = Auth::guard('web')->user(); // Get authenticated user (admin)
    
        // Check if user is active, if not, log them out
        if ($admins->is_active == 0) {
            auth()->logout();
            return redirect()->back()->with('error', 'Your account is inactive.');
        }
    
        // Check if user is disabled, if yes, log them out
        if ($admins->is_disable == 0) {
            auth()->logout();
            return redirect()->back()->with('error', 'Your account is disabled.');
        }
    
        // Check the user's plan if the user is of 'company' type
        if ($admins->type == 'company') {
            $plan = Plan::find($admins->plan);
    
            if ($plan) {
                if ($plan->duration != 'Lifetime') {
                    $datetime1 = new \DateTime($admins->plan_expire_date);
                    $datetime2 = new \DateTime(date('Y-m-d'));
    
                    $interval = $datetime2->diff($datetime1);
                    $days = $interval->format('%r%a');
    
                    if ($days <= 0) {
                        $admins->assignplan(1);
                        return redirect()->intended(RouteServiceProvider::HOME)->with('error', __('Your plan is expired.'));
                    }
                }
            }
        }
    
        // Further checks for free plan expiration
        if ($admins->type == 'company') {
            $free_plan = Plan::where('price', '=', '0.0')->first();
            $plan = Plan::find($admins->plan);
    
            if ($admins->plan != $free_plan->id) {
                if (date('Y-m-d') > $admins->plan_expire_date && $plan->duration != 'Lifetime') {
                    $admins->plan = $free_plan->id;
                    $admins->plan_expire_date = null;
                    $admins->save();
    
                    // Reset admin and employee statuses based on the free plan's limits
                    $admins = Admin::where('created_by', '=', \Auth::admin()->creatorId())->get();
                    $employees = Employee::where('created_by', '=', \Auth::admin()->creatorId())->get();
    
                    // Manage the admin count for free plan
                    if ($free_plan->max_admins == -1) {
                        foreach ($admins as $admin) {
                            $admin->is_active = 1;
                            $admin->save();
                        }
                    } else {
                        $adminCount = 0;
                        foreach ($admins as $admin) {
                            $adminCount++;
                            $admin->is_active = $adminCount <= $free_plan->max_admins ? 1 : 0;
                            $admin->save();
                        }
                    }
    
                    // Manage the employee count for free plan
                    if ($free_plan->max_employees == -1) {
                        foreach ($employees as $employee) {
                            $employee->is_active = 1;
                            $employee->save();
                        }
                    } else {
                        $employeeCount = 0;
                        foreach ($employees as $employee) {
                            $employeeCount++;
                            $employee->is_active = $employeeCount <= $free_plan->max_customers ? 1 : 0;
                            $employee->save();
                        }
                    }
    
                    return redirect()->route('dashboard')->with('error', 'Your plan expired limit is over, please upgrade your plan');
                }
            }
        }
    
        // If everything passes, redirect to the dashboard after successful login
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    

    public function showLoginForm($lang = '')
    {
        if ($lang == '') {
            $lang = \App\Models\Utility::getValByName('default_language');
        }
        \App::setLocale($lang);

        return view('auth.login', compact('lang'));
    }

    public function showLinkRequestForm($lang = '')
    {
        if ($lang == '') {
            $lang = \App\Models\Utility::getValByName('default_language');
        }

        \App::setLocale($lang);

        return view('auth.forgot-password', compact('lang'));
    }
    public function storeLinkRequestForm(Request $request)
    {
        $settings = Utility::settings();
        if (isset($settings['recaptcha_module']) && $settings['recaptcha_module'] == 'yes') {
            $validation['g-recaptcha-response'] = 'required';
        } else {
            $validation = [];
        }
        $this->validate($request, $validation);

        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this admin. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the admin. Finally, we'll send out a proper response.
        try {

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        } catch (\Exception $e) {

            return redirect()->back()->withErrors('E-Mail has been not sent due to SMTP configuration');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
