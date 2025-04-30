@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Personal Notifications') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Personal Notifications') }}</li>
@endsection



@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <form action="{{ route('personal_notifications.index') }}" method="GET" class="mb-3">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label for="filter_date">{{ __('Filter by Date') }}</label>
                            <input type="date" name="filter_date" id="filter_date" class="form-control" value="{{ request()->get('filter_date') }}" onchange="this.form.submit()">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Datetime') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personal_notifications as $personal_notification)
                                <tr>
                                    <td>{{ $personal_notification->id }}</td>  
                                    <td>{{ ucfirst($personal_notification->users->name ?? '') }}</td>
                                    <td>{{ $personal_notification->title }}</td>
                                    <td>{{ $personal_notification->description}}</td>
                                    <td>{{ $personal_notification->datetime }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable with default search functionality
        $('#pc-dt-simple').DataTable();
    });

    // Confirmation for delete action
    function confirmDelete(event, speechTextId) {
        event.preventDefault(); // Prevent the default form submission

        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this speech text?")) {
            // If the user clicks "Yes", submit the delete form
            document.getElementById('delete-form-' + speechTextId).submit();
        }
    }
</script>
@endsection
