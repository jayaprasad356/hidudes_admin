@extends('layouts.auth')

@section('page-title')
    {{ __('Login') }}
@endsection

@section('content')
    <div class="card-body">
        <!-- Logo Section -->
        <div class="text-center mb-4">
            <img src="{{ asset('storage/uploads/logo/hima.png') }}" alt="Logo" width="100">
        </div>

        <!-- Login Title -->
        <div>
           <center><h2 class="mb-3 f-w-600">{{ __('Hi Ma - Login page') }}</h2></center> 
        </div>

        <!-- Login Form -->
        <div class="custom-login-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" placeholder="{{ __('Enter your email') }}" required autofocus>
                    @error('email')
                        <span class="error invalid-email text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-3 pss-field">
                    <label class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" placeholder="{{ __('Password') }}" required>
                    @error('password')
                        <span class="error invalid-password text-danger" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary mt-2" type="submit">{{ __('Login') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".form_data").submit(function(e) {
                $(".login_button").attr("disabled", true);
                return true;
            });
        });
    </script>
    @if (isset($settings['recaptcha_module']) && $settings['recaptcha_module'] == 'yes')
        {!! NoCaptcha::renderJs() !!}
    @endif
@endpush
