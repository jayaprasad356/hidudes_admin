<!-- resources/views/users/add-coins.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ __('Add Coins to user') }}</h3>

    <!-- Display Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('users.addCoins', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="coins">{{ __('Coins to Add') }}</label>
            <input type="number" id="coins" name="coins" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">{{ __('Add Coins') }}</button>
        </div>
    </form>
</div>
@endsection
