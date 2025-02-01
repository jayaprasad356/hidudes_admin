@extends('layouts.admin')

@section('page-title')
    {{ __('Add Coins') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('coins.index') }}">{{ __('Coins') }}</a></li>
    <li class="breadcrumb-item">{{ __('Add Coins') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Add New Coins') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('coins.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @error('image')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="price">{{ __('Price') }}</label>
                        <input type="number" id="price" name="price" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="coins">{{ __('Coins') }}</label>
                        <input type="number" id="coins" name="coins" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="save">{{ __('Save') }}</label>
                        <input type="number" id="save" name="save" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="popular">{{ __('Popular') }}</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="popular" name="popular">
                            <label class="form-check-label" for="popular"></label>
                        </div>
                    </div>

                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <a href="{{ route('coins.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
