@extends('layouts.admin')

@section('page-title')
    {{ __('Dashboard') }}
@endsection

@php
    $setting = App\Models\Utility::settings();
@endphp

@section('content')
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <!-- Language Dropdown -->
        <div class="col-xxl-12 mb-3">
            <div class="d-flex justify-content-start">
            <form method="GET" action="{{ route('dashboard') }}">
                <div class="input-group">
                <span class="input-group-text" style="background-color:#48494b; color: white;">{{ __('Filter by Language') }}</span>
                <select name="language" onchange="this.form.submit()" class="form-select" aria-label="Language" style="width: 300px;">
                    <option value="all" {{ request('language') == 'all' ? 'selected' : '' }}>All Languages</option>
                    <option value="Tamil" {{ request('language') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                    <option value="Telugu" {{ request('language') == 'Telugu' ? 'selected' : '' }}>Telugu</option>
                    <option value="Hindi" {{ request('language') == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                    <option value="Kannada" {{ request('language') == 'Kannada' ? 'selected' : '' }}>Kannada</option>
                    <option value="Punjabi" {{ request('language') == 'Punjabi' ? 'selected' : '' }}>Punjabi</option>
                    <option value="Malayalam" {{ request('language') == 'Malayalam' ? 'selected' : '' }}>Malayalam</option>
                </select>
                </div>
            </form>
            </div>
        </div>

            <div class="col-xxl-12">

                {{-- start --}}
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Total') }}</small>
                                                <h6 class="m-0">{{ __('Users') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $users_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Today Registration') }}</small>
                                                <h6 class="m-0">{{ __('Count') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $today_registration_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-user"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Today Male') }}</small>
                                                <h6 class="m-0">{{ __('Users Count') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $male_users_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-user"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Today Female') }}</small>
                                                <h6 class="m-0">{{ __('Users Count') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $female_users_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-microphone"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Total Active') }}</small>
                                                <h6 class="m-0">{{ __('Audio Users') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $active_audio_users_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-video"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Total Active') }}</small>
                                                <h6 class="m-0">{{ __('Video Users') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $active_video_users_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-currency-dollar"></i>
                                        </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Today Recharge') }}</small>
                                                <h6 class="m-0">{{ __('Count') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $today_recharge_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-wallet"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Total Pending') }}</small>
                                                <h6 class="m-0">{{ __('Withdrawals') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $pending_withdrawals }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-currency-dollar"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Yesterday Recharge') }}</small>
                                                <h6 class="m-0">{{ __('Count') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $yesterday_recharge_count }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-wallet"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Yesterday Paid') }}</small>
                                                <h6 class="m-0">{{ __('Withdrawals') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $yesterday_paid_withdrawals }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-phone-off"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted">{{ __('Today Not-Connected') }}</small>
                                                <h6 class="m-0">{{ __('Calls') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary">{{ $today_not_connected_calls }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                 
                </div>
            </div>

            {{-- </div> --}}

    </div>
@endsection


