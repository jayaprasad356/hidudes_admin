@extends('layouts.admin')

@section('page-title')
    {{ __('Transactions List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Transactions List') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Filter by Type Form -->
                <form action="{{ route('transactions.index') }}" method="GET" class="mb-3" id="filterForm">
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label for="type">{{ __('Filter by Type') }}</label>
                            <select name="type" id="type" class="form-control" onchange="document.getElementById('filterForm').submit();">
                                <option value="">{{ __('All') }}</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter_date">{{ __('Filter by Date') }}</label>
                            <input type="date" name="filter_date" id="filter_date" class="form-control" value="{{ request()->get('filter_date') }}" onchange="this.form.submit()">
                        </div>
                    </div>
                </form>

                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Mobile') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Coins') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Payment Type') }}</th>
                                    <th>{{ __('Datetime') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr class="selectable-row">
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ ucfirst($transaction->users->name ?? '') }}</td>
                                        <td>{{ $transaction->users->mobile ?? '' }}</td>
                                        <td>{{ $transaction->type }}</td>
                                        <td>{{ $transaction->coins }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->payment_type }}</td>
                                        <td>{{ $transaction->datetime }}</td>
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
