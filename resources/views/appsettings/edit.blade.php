@extends('layouts.admin')

@section('page-title')
    {{ __('Edit App Settings') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Edit App Settings') }}</li>
@endsection<style>
    /* Style for Switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .switch label {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }

    .switch label:before {
        content: "";
        position: absolute;
        left: -3px;
        top: 4px;
        width: 26px;
        height: 26px;
        background-color: white;
        border-radius: 50%;
        transition: 0.4s;
    }

    /* When checked, move the slider */
    .switch input:checked + label {
        background-color: #4CAF50;
    }

    .switch input:checked + label:before {
        transform: translateX(26px);
    }

    /* Disabled state */
    .switch input:disabled + label {
        background-color: #e0e0e0;
    }

    .switch input:disabled + label:before {
        background-color: #bdbdbd;
    }

    .form-group .switch-container {
        display: flex;
        align-items: center;
    }

    .form-group .switch-container label {
        margin-left: 10px;
    }
</style>

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Edit App Settings') }}</h5>
            </div>
            <div class="card-body">
        <form action="{{ route('appsettings.update', $appsettings->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link" name="link" value="{{ old('link', $appsettings->link) }}" required>
            </div>

            <div class="form-group">
                <label for="app_version">App Version</label>
                <input type="text" class="form-control" id="app_version" name="app_version" value="{{ old('app_version', $appsettings->app_version) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="10" required>{!! old('description', $appsettings->description) !!}</textarea>
            </div>

            <div class="form-group col-md-6">
                {{ Form::label('bank', __('Bank'), ['class' => 'form-label']) }}
                <div class="switch-container">
                    <div class="switch">
                        <input type="hidden" name="bank" value="0"> <!-- Hidden input for unchecked state -->
                        <input type="checkbox" id="bank" name="bank" value="1" {{ $appsettings->bank == 1 ? 'checked' : '' }}>
                        <label for="bank"></label>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-6">
                {{ Form::label('upi', __('Upi'), ['class' => 'form-label']) }}
                <div class="switch-container">
                    <div class="switch">
                        <input type="hidden" name="upi" value="0"> <!-- Hidden input for unchecked state -->
                        <input type="checkbox" id="upi" name="upi" value="1" {{ $appsettings->upi == 1 ? 'checked' : '' }}>
                        <label for="upi"></label>
                    </div>
                </div>
            </div>


            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.21.0/full-all/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('privacy_policy', {
            extraPlugins: 'colorbutton'
        });
    });
</script>
@endsection
