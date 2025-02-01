@extends('layouts.admin')

@section('page-title')
    {{ __('Add Notifications') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('notifications.index') }}">{{ __('Notifications') }}</a></li>
    <li class="breadcrumb-item">{{ __('Add Notifications') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Add New Notifications') }}</h5>
            </div>
            <div class="card-body">
            <form action="{{ route('notifications.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="gender">{{ __('Gender') }}</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="all">{{ __('All') }}</option>
                        <option value="male">{{ __('Male') }}</option>
                        <option value="female">{{ __('Female') }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="language">{{ __('Language') }}</label>
                    <select name="language" id="language" class="form-control">
                        <option value="all">{{ __('All') }}</option>
                        <option value="Hindi">{{ __('Hindi') }}</option>
                        <option value="Telugu">{{ __('Telugu') }}</option>
                        <option value="Malayalam">{{ __('Malayalam') }}</option>
                        <option value="Kannada">{{ __('Kannada') }}</option>
                        <option value="Punjabi">{{ __('Punjabi') }}</option>
                        <option value="Tamil">{{ __('Tamil') }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">{{ __('Title') }}</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>

                <div class="form-group mt-4 text-center">
                    <button type="submit" class="btn btn-primary">{{ __('Send Notification') }}</button>
                    <a href="{{ route('notifications.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>
@endsection

