@extends('layouts.admin')

@section('page-title')
    {{ __('Add Avatar') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('avatar.index') }}">{{ __('Avatars') }}</a></li>
    <li class="breadcrumb-item">{{ __('Add Avatar') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Add New Avatar') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('avatar.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @error('image')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="image" class="form-label">{{ __('Image') }}</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="gender" class="form-label">{{ __('Gender') }}</label>
                        <select name="gender" class="form-control" required>
                            <option value="male">{{ __('Male') }}</option>
                            <option value="female">{{ __('Female') }}</option>
                            <option value="other">{{ __('Other') }}</option>
                        </select>
                    </div>

                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <a href="{{ route('avatar.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
