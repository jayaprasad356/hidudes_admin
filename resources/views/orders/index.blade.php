@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Orders') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Orders') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
            <form action="{{ route('orders.index') }}" method="GET" class="mb-3">
            <div class="row align-items-end">
                <!-- Gender Filter -->
                                <div class="col-md-3">
                            <label for="status">{{ __('Filter by Status') }}</label>
                            <select name="status" id="status" class="form-control status-filter" onchange="this.form.submit()">
                                <option value="">{{ __('All') }}</option>
                                <option value="0" {{ request()->get('status') == '0' ? 'selected' : '' }}>{{ __('Try') }}</option>
                                <option value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>{{ __('Success') }}</option>
                                <option value="2" {{ request()->get('status') == '2' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                            </select>
                        </div>
                <div class="col-md-3">
                            <label for="date">{{ __('Filter by Date') }}</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ request()->get('date') }}" onchange="this.form.submit()">
                        </div>
                <!-- Language Filter -->
                <div class="col-md-3">
                <label for="language">{{ __('Filter by Language') }}</label>
                <select name="language" id="language" class="form-control" onchange="this.form.submit()">
                    <option value="">All Languages</option>
                    @foreach ($languages as $language)
                        <option value="{{ $language }}" {{ request('language') == $language ? 'selected' : '' }}>
                            {{ ucfirst($language) }}
                        </option>
                    @endforeach
                </select>
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
                                <th>{{ __('Order ID') }}</th>
                                <th>{{ __('User ID') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('User Mobile') }}</th>
                                  <th>{{ __('Language') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Message') }}</th>
                                <th>{{ __('Datetime') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->users ? $order->users->name : '' }}</td>
                                    <td>{{ $order->users ? $order->users->mobile : '' }}</td>
                                     <td>{{ $order->users ? $order->users->language : '' }}</td>
                                    <td>
                                            @if($order->status == 0)
                                                <i class="fa fa-clock text-warning"></i> <span class="font-weight-bold">{{ __('Try') }}</span>
                                            @elseif($order->status == 1)
                                                <i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold">{{ __('Success') }}</span>
                                            @elseif($order->status == 2)
                                                <i class="fa fa-times-circle text-danger"></i> <span class="font-weight-bold">{{ __('Cancelled') }}</span>
                                            @else
                                                <i class="fa fa-question-circle text-secondary"></i> <span class="font-weight-bold">{{ __('Unknown') }}</span>
                                            @endif
                                        </td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->message }}</td>
                                    <td>{{ $order->datetime }}</td>
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
