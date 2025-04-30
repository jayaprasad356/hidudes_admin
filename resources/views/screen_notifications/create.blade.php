@extends('layouts.admin')

@section('page-title')
    {{ __('Add Screen Notifications') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('screen_notifications.index') }}">{{ __('Screen Notifications') }}</a></li>
    <li class="breadcrumb-item">{{ __('Add Screen Notifications') }}</li>
@endsection

<style>
    #title {
    font-weight: bold;
}
</style>

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Add New Screen Notifications') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('screen_notifications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="gender">{{ __('Gender') }}</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="all">{{ __('All') }}</option>
                            <option value="male">{{ __('Male') }}</option>
                            <option value="female">{{ __('Female') }}</option>
                        </select>
                    </div>

                    <!-- Language Dropdown -->
                    <div class="form-group mt-3">
                        <label for="language" class="form-label">{{ __('Language') }}</label>
                        <select name="language" class="form-control" required>
                            <option value='all' {{ old('language') == 'all' ? 'selected' : '' }}>All</option>
                            <option value='Hindi' {{ old('language') == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                            <option value='Telugu' {{ old('language') == 'Telugu' ? 'selected' : '' }}>Telugu</option>
                            <option value='Malayalam' {{ old('language') == 'Malayalam' ? 'selected' : '' }}>Malayalam</option>
                            <option value='Kannada' {{ old('language') == 'Kannada' ? 'selected' : '' }}>Kannada</option>
                            <option value='Punjabi' {{ old('language') == 'Punjabi' ? 'selected' : '' }}>Punjabi</option>
                            <option value='Tamil' {{ old('language') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                        </select>
                    </div>

                    <!-- Datetime Field -->
                    <div class="form-group mt-3">
                        <label for="time">{{ __('Time') }}</label>
                        <input type="time" id="time" name="time" class="form-control" required>
                    </div>


                    <div class="form-group mt-3">
                        <label for="day" class="form-label">{{ __('Day') }}</label>
                        <select name="day" class="form-control" required>
                        <option value="">{{ __('Select A Day') }}</option>
                           <option value="all">{{ __('all') }}</option>
                            <option value="Monday">{{ __('Monday') }}</option>
                            <option value="Tuesday">{{ __('Tuesday') }}</option>
                            <option value="Wednesday">{{ __('Wednesday') }}</option>
                            <option value="Thursday">{{ __('Thursday') }}</option>
                            <option value="Friday">{{ __('Friday') }}</option>
                            <option value="Saturday">{{ __('Saturday') }}</option>
                            <option value="Sunday">{{ __('Sunday') }}</option>
                        </select>
                    </div>

                    <!-- Logo Field -->
                    <div class="form-group mt-3">
                        <label for="logo">{{ __('Logo (Optional)') }}</label>
                        <input type="file" id="logo" name="logo" class="form-control">
                    </div>

                    <!-- Image Field -->
                    <div class="form-group mt-3">
                        <label for="image">{{ __('Image (Optional)') }}</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <!-- Save Button -->
                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <a href="{{ route('screen_notifications.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection