@extends('layouts.admin')

@section('page-title')
    {{ __('Notifications List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Notifications List') }}</li>
@endsection

@section('action-button')
    <a href="{{ route('notifications.create') }}" data-bs-toggle="tooltip" title="{{ __('Create New notifications') }}" class="btn btn-sm btn-primary">
        <i class="ti ti-plus"></i> {{ __('Add New Notifications') }}
    </a>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
            <form action="{{ route('notifications.index') }}" method="GET" class="mb-3">
            <div class="row align-items-end">
                <!-- Gender Filter -->
                <div class="col-md-3">
                    <label for="gender">{{ __('Filter by Gender') }}</label>
                    <select name="gender" id="gender" class="form-control" onchange="this.form.submit()">
                        <option value="">{{ __('All') }}</option>
                        <option value="male" {{ request()->get('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                        <option value="female" {{ request()->get('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                    </select>
                </div>

                <!-- Language Filter -->
                <div class="col-md-3">
                    <label for="language">{{ __('Filter by Language') }}</label>
                    <select name="language" id="language" class="form-control" onchange="this.form.submit()">
                        @foreach ($languages as $language)
                            <option value="{{ $language }}" {{ request()->get('language') == $language ? 'selected' : '' }}>
                                {{ ucfirst($language) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
            </div>

        <div class="card">
            <div class="card-body">
                <!-- Notifications Table -->
                <div class="table-border-style">
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('Actions') }}</th>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Gender') }}</th>
                                    <th>{{ __('Language') }}</th>
                                    <th>{{ __('Datetime') }}</th>
                                    <th>{{ __('Logo') }}</th>
                                    <th>{{ __('Image') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($notifications as $notification)
                                    <tr>
                                        <td class="Action">
                                            <span>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-url="{{ route('notifications.edit', $notification->id) }}" data-ajax-popup="true" data-title="{{ __('Edit notifications') }}"
                                                    class="btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{ __('Edit') }}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['notifications.destroy', $notification->id], 'id' => 'delete-form-' . $notification->id]) !!}
                                                        <button type="button" class="btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                        onclick="confirmDelete(event, '{{ $notification->id }}')">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </span>
                                        </td>
                                        <td>{{ $notification->id }}</td>
                                        <td>{{ $notification->title }}</td>
                                        <td>{{ $notification->description }}</td>
                                        <td>{{ $notification->gender }}</td>
                                        <td>{{ $notification->language }}</td>
                                        <td>{{ $notification->datetime }}</td>
                                        <td>
                                            @if (!empty($notification->logo))
                                                <img src="{{ asset('storage/app/public/' . $notification->logo) }}" class="rounded-circle" width="35" height="35" alt="{{ $notification->title }}">
                                            @else
                                                <img src="{{ asset('assets/img/placeholder.jpg') }}" class="rounded-circle" width="35" height="35" alt="{{ $notification->title }}">
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($notification->image))
                                                <img src="{{ asset('storage/app/public/' . $notification->image) }}" class="rounded-circle" width="35" height="35" alt="{{ $notification->title }}">
                                            @else
                                                <img src="{{ asset('assets/img/placeholder.jpg') }}" class="rounded-circle" width="35" height="35" alt="{{ $notification->title }}">
                                            @endif
                                        </td>
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

    function confirmDelete(event, notificationId) {
        event.preventDefault();
        if (confirm('Are you sure you want to delete this notification?')) {
            document.getElementById('delete-form-' + notificationId).submit();
        }
    }
</script>
@endsection
