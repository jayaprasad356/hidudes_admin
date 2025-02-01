@extends('layouts.admin')

@section('page-title')
    {{ __('Add Gifts') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('gifts.index') }}">{{ __('Gifts') }}</a></li>
    <li class="breadcrumb-item">{{ __('Add Gifts') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Add New Gifts') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('gifts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @error('gift_icon')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="image" class="form-label">{{ __('Gift Icon') }}</label>
                        <input type="file" name="gift_icon" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="coins">{{ __('Coins') }}</label>
                        <input type="number" id="coins" name="coins" class="form-control" required>
                    </div>

                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <a href="{{ route('gifts.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
