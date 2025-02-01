@extends('layouts.admin')

@section('page-title')
    {{ __('Add Speech Text') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('speech_texts.index') }}">{{ __('Speech Texts') }}</a></li>
    <li class="breadcrumb-item">{{ __('Add Speech Text') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Add New Speech Text') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('speech_texts.store') }}" method="POST">
                    @csrf

                    <!-- Text Input -->
                    <div class="form-group">
                        <label for="text" class="form-label">{{ __('Text') }}</label>
                        <textarea name="text" class="form-control" rows="3" required>{{ old('text') }}</textarea>
                    </div>

                    <!-- Language Dropdown -->
                    <div class="form-group mt-3">
                        <label for="language" class="form-label">{{ __('Language') }}</label>
                        <select name="language" class="form-control" required>
                            <option value='Hindi' {{ old('language') == 'Hindi' ? 'selected' : '' }}>Hindi</option>
                            <option value='Telugu' {{ old('language') == 'Telugu' ? 'selected' : '' }}>Telugu</option>
                            <option value='Malayalam' {{ old('language') == 'Malayalam' ? 'selected' : '' }}>Malayalam</option>
                            <option value='Kannada' {{ old('language') == 'Kannada' ? 'selected' : '' }}>Kannada</option>
                            <option value='Punjabi' {{ old('language') == 'Punjabi' ? 'selected' : '' }}>Punjabi</option>
                            <option value='Tamil' {{ old('language') == 'Tamil' ? 'selected' : '' }}>Tamil</option>
                        </select>
                    </div>

                    <!-- Save Button -->
                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <a href="{{ route('speech_texts.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection