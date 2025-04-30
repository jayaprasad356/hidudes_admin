@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Screen Notifications') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Screen Notifications') }}</li>
@endsection

@section('action-button')
    <a href="{{ route('screen_notifications.create') }}" data-bs-toggle="tooltip" title="{{ __('Create New Screen Notifications') }}" class="btn btn-sm btn-primary">
        <i class="ti ti-plus"></i> {{ __('Add New Screen Notifications') }}
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
            <form action="{{ route('screen_notifications.index') }}" method="GET" class="mb-3">
            <div class="row align-items-end">
                <!-- Day Filter -->
                <div class="col-md-3">
                    <label for="day">{{ __('Filter by Day') }}</label>
                    <select name="day" id="day" class="form-control" onchange="this.form.submit()">
                        <option value="">{{ __('All') }}</option>
                        @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <option value="{{ $day }}" {{ request()->get('day') == $day ? 'selected' : '' }}>
                                {{ __($day) }}
                            </option>
                        @endforeach
                    </select>
                </div>

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
                <div class="col-md-3">
                    <label>{{ __('Enable/Disable All Notifications') }}</label>
                    <div>
                        <button type="button" class="btn btn-success btn-sm enable-all">{{ __('Enable All') }}</button>
                        <button type="button" class="btn btn-danger btn-sm disable-all">{{ __('Disable All') }}</button>
                    </div>
                </div>


            </div>
        </form>
            </div>

        <div class="card">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table" id="pc-dt-simple">
                    <thead>
                        <tr>
                            <th width="300px">{{ __('Actions') }}</th>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Gender') }}</th>
                            <th>{{ __('Language') }}</th>
                            <th>{{ __('Time') }}</th>
                            <th>{{ __('Day') }}</th>
                            <th>{{ __('Logo') }}</th>
                            <th>{{ __('Image') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($screen_notifications as $screen_notification)
                            <tr>
                                <td class="Action">
                                    <span>
                                        <!-- Edit Button -->
                                        <div class="action-btn bg-info ms-2">
                                            <a href="#" data-url="{{ route('screen_notifications.edit', $screen_notification->id) }}"
                                               data-ajax-popup="true" data-title="{{ __('Edit Screen Notification') }}"
                                               class="btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{ __('Edit') }}">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                        <!-- Delete Button -->
                                        <div class="action-btn bg-danger ms-2">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['screen_notifications.destroy', $screen_notification->id], 'id' => 'delete-form-' . $screen_notification->id]) !!}
                                                <a href="#" class="btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                   onclick="confirmDelete(event, '{{ $screen_notification->id }}')">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                            {!! Form::close() !!}
                                        </div>
                                    </span>
                                </td>
                                <td>{{ $screen_notification->id }}</td>  
                                <td>{{ $screen_notification->title }}</td>
                                <td>{{ $screen_notification->description }}</td>
                                <td>{{ ucfirst($screen_notification->gender) }}</td>
                                <td>{{ ucfirst($screen_notification->language) }}</td>
                                <td>{{ $screen_notification->time }}</td>
                                <td>{{ ucfirst($screen_notification->day) }}</td>
                                <td>
                                    @if (!empty($screen_notification->logo))
                                        <img src="{{ asset('storage/app/public/' . $screen_notification->logo) }}" class="img-fluid" width="50px">
                                    @else
                                        {{ __('No Logo') }}
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($screen_notification->image))
                                        <img src="{{ asset('storage/app/public/' . $screen_notification->image) }}" class="img-fluid" width="50px">
                                    @else
                                        {{ __('No Image') }}
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('.enable-all, .disable-all').on('click', function () {
        var status = $(this).hasClass('enable-all') ? 1 : 2; // Ensure 1 or 0 as number

        $.ajax({
            url: '{{ route("screen_notifications.toggle_all") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                notification_enable: status
            },
            success: function (response) {
                alert(response.message); // Or use toast notification
                location.reload(); // Refresh the page to reflect changes
            },
            error: function () {
                alert('Something went wrong!');
            }
        });
    });
});

</script>

@endsection
