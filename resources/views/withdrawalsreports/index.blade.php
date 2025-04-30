@extends('layouts.admin')

@section('page-title')
    {{ __('Paid Withdrawals Reports') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Paid Withdrawals Reports') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
          

            <div class="card-body">
                <!-- Auto-Submit Date Filter Form -->
                <form method="GET" action="{{ route('withdrawalsreports.index') }}" id="filter-form" class="mb-4">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="date">{{ __('Select Date') }}</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ request('date', $date) }}">
                        </div>
                    </div>
                </form>

                <div class="alert alert-success">
                    <strong>{{ __('Grand Total: ') }}</strong> 
                    ${{ number_format($grandTotal, 2) }}
                </div>

                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Total Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($withdrawals as $withdrawal)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($withdrawal->date)->format('d-m-Y') }}</td>
                                    <td>${{ number_format($withdrawal->total, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">
                                        {{ __('No withdrawals found for the selected date.') }}
                                    </td>
                                </tr>
                            @endforelse
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
