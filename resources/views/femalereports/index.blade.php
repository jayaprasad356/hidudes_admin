@extends('layouts.admin')

@section('page-title')
    {{ __('Female Reports') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Auto-Submit Date Filter Form -->
                <form method="GET" action="{{ route('femalereports.index') }}" id="filter-form" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="date">{{ __('Select Date') }}</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ request('date', $formattedDate) }}">
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>Female Name</th>
                                <th>Total Call Duration</th>
                                <th>Total Income</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($reportsData as $report)
                                <tr>
                                    <td>{{ $report['call_user_name'] }}</td>
                                    <td>{{ $report['total_duration'] }}</td>
                                    <td> ₹ {{ $report['total_income'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Auto-Submit Script -->
<script>
    document.getElementById('date').addEventListener('change', function () {
        document.getElementById('filter-form').submit();
    });
</script>
@endsection
