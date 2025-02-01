@extends('layouts.admin')

@section('page-title')
    {{ __('Ratings List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Ratings List') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Filter by Type Form -->

                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('User Name') }}</th>
                                    <th>{{ __('Call User Name') }}</th>
                                    <th>{{ __('Ratings') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ratings as $rating)
                                    <tr class="selectable-row">
                                        <td>{{ $rating->id }}</td>
                                        <td>{{ ucfirst($rating->users->name ?? '') }}</td>
                                        <td>{{ ucfirst($rating->callusers->name ?? '') }}</td>
                                        <td>{{ $rating->ratings }}</td>
                                        <td>{{ $rating->title }}</td>
                                        <td>{{ $rating->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#pc-dt-simple').DataTable();
});
</script>
@endsection
