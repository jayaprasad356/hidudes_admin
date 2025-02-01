@php

    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_logo = \App\Models\Utility::GetLogo();
    $companys = \App\Models\Utility::GetLogo();
    $user = \Auth::user();
    $profile = \App\Models\Utility::get_file('uploads/avatar/');
  
    $emailTemplate = App\Models\EmailTemplate::getemailTemplate();
    $lang = Auth::user()->lang;
@endphp

@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <nav class="dash-sidebar light-sidebar transprent-bg">
    @else
        <nav class="dash-sidebar light-sidebar">
@endif

{{-- <nav class="dash-sidebar light-sidebar {{ isset($cust_theme_bg) && $cust_theme_bg == 'on' ? 'transprent-bg' : '' }}"> --}}

<div class="navbar-wrapper">
    <div class="m-header main-logo">
        <a href="{{ route('dashboard') }}" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="{{ asset('storage/uploads/logo/hima.png') }}" alt="Logo"
                alt="{{ config('app.name', 'HRMGo') }}" class="logo logo-lg" style="height: 50px;">
        </a>
    </div>
    <div class="navbar-content">
        <ul class="dash-navbar">

            <!-- dashboard-->
                <li class="dash-item">
                    <a href="{{ route('dashboard') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-home"></i></span><span class="dash-mtext">{{ __('Dashboard') }}</span></a>
                </li>
        
            
            <li class="dash-item">
                    <a href="{{ route('users.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-users"></i></span><span class="dash-mtext">{{ __('users') }}</span></a>
                </li>
            <!-- <li class="dash-item">
                    <a href="{{ route('avatar.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-user"></i></span><span class="dash-mtext">{{ __('Avatar') }}</span></a>
                </li> -->
                <li class="dash-item">
                    <a href="{{ route('speech_texts.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-file"></i></span><span class="dash-mtext">{{ __('Speech Texts') }}</span></a>
                </li>
                <li class="dash-item">
                    <a href="{{ route('news.edit') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-settings"></i></span><span class="dash-mtext">{{ __('Settings') }}</span></a>
                </li>
                <li class="dash-item">
                    <a href="{{ route('appsettings.edit') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-settings"></i></span><span class="dash-mtext">{{ __('App Settings') }}</span></a>
                </li>
                <li class="dash-item">
                    <a href="{{ route('coins.index') }}" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-coin"></i></span><span class="dash-mtext">{{ __('coins') }}</span></a>
                </li>
                <li class="dash-item">
                <a href="{{ route('ratings.index') }}" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-star"></i> <!-- Icon for ratings -->
                    </span>
                    <span class="dash-mtext">{{ __('Ratings') }}</span>
                </a>
                <li class="dash-item">
                <a href="{{ route('usercalls.index') }}" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-phone"></i> <!-- Icon for user calls -->
                    </span>
                    <span class="dash-mtext">{{ __('UserCalls') }}</span>
                </a>

                </li>
                <li class="dash-item">
                <a href="{{ route('users-verification.index') }}" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-user-check"></i> <!-- Icon for verifying users -->
                    </span>
                    <span class="dash-mtext">{{ __('userVerifications') }}</span>
                </a>
                <li class="dash-item">
                <a href="{{ route('transactions.index') }}" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-credit-card"></i> <!-- Icon for transactions -->
                    </span>
                    <span class="dash-mtext">{{ __('Transactions') }}</span>
                </a>
                <li class="dash-item">
                <a href="{{ route('withdrawals.index') }}" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-wallet"></i> <!-- Icon for withdrawals -->
                    </span>
                    <span class="dash-mtext">{{ __('Withdrawals') }}</span>
                </a>
                </li>
                <li class="dash-item">
                    <a href="{{ route('notifications.index') }}" class="dash-link">
                        <span class="dash-micon">
                            <i class="ti ti-bell"></i> <!-- Icon for notifications -->
                        </span>
                        <span class="dash-mtext">{{ __('Notifications') }}</span>
                    </a>
                </li>
                <li class="dash-item">
                <a href="{{ route('gifts.index') }}" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-gift"></i> <!-- Icon for withdrawals -->
                    </span>
                    <span class="dash-mtext">{{ __('Gifts') }}</span>
                </a>
                </li>
            <!--dashboard-->


     
            <!--------------------- Start System Setup ----------------------------------->

       

            <!--------------------- End System Setup ----------------------------------->
</ul>

</div>
</div>
</nav>
