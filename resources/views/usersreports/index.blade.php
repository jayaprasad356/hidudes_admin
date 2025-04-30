@extends('layouts.admin')

@section('page-title')
    {{ __('Users Reports') }}
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
                <form method="GET" action="{{ route('usersreports.index') }}" id="filter-form" class="mb-4">
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
                            <th>Date</th>
                            <th>Total Male Registered</th>
                            <th>Total Female Registered</th>
                            <th>Total Recharge</th>
                            <th>Total Paid Users</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($reportData as $report)
                        <tr>
                            <td>{{ $report['date'] }}</td>
                            <td>{{ $report['totalMale'] }}</td>
                            <td>{{ $report['totalFemale'] }}</td>
                            <td>{{ $report['totalRecharge'] }}</td>
                            <td>{{ $report['totalPaidUsers'] }}</td>
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
