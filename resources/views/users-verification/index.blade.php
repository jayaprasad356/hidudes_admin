@extends('layouts.admin')

@section('page-title')
    {{ __('user Verification List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('user Verification List') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
         
            <div class="card-body">
                <!-- Filter by Status Form -->
              <!-- Filter by Status and Language Form -->
                    <form action="{{ route('users-verification.index') }}" method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="status">{{ __('Filter by Status') }}</label>
                                <select name="status" id="status" class="form-control status-filter" onchange="this.form.submit()">
                                    <option value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                    <option value="2" {{ request()->get('status') == '2' ? 'selected' : '' }}>{{ __('Verified') }}</option>
                                    <option value="3" {{ request()->get('status') == '3' ? 'selected' : '' }}>{{ __('Rejected') }}</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="language">{{ __('Filter by Language') }}</label>
                                <select name="language" id="language" class="form-control language-filter" onchange="this.form.submit()">
                                    <option value="">{{ __('All Languages') }}</option>
                                    @foreach ($languages as $lang)
                                        <option value="{{ $lang }}" {{ request()->get('language') == $lang ? 'selected' : '' }}>
                                            {{ __($lang) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                    <style>
                        .status-filter, .language-filter {
                            width: 200px;
                        }

                        @media (max-width: 768px) {
                            .status-filter, .language-filter {
                                width: 100%;
                            }
                        }
                    </style>


                <!-- Table for user verifications -->
                <form action="{{ route('users-verification.updateStatus') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success" name="status" value="2">{{ __('Verified') }}</button>
                    <button type="submit" class="btn btn-danger" name="status" value="3">{{ __('Cancelled') }}</button>

                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th>{{ __('Check Box') }}</th>
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Mobile') }}</th>
                                        <th>{{ __('Language') }}</th> <!-- New Column -->
                                        <th>{{ __('Voice') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="selectable-row">
                                            <td><input type="checkbox" class="user-checkbox" name="user_ids[]" value="{{ $user->id }}"></td>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ ucfirst($user->name) }}</td>
                                            <td>{{ $user->mobile }}</td>
                                            <td>{{ $user->language }}</td> <!-- Display Language -->
                                            <td>
                                                @if($user->voice && $user->voice)
                                                    <a href="{{ asset('storage/app/public/voices/' . $user->voice) }}" target="_blank">Play Voice</a>
                                                @else
                                                    {{ __('No Voice File') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->status == 1)
                                                    <i class="fa fa-clock text-warning"></i> <span class="font-weight-bold">{{ __('Pending') }}</span>
                                                @elseif($user->status == 2)
                                                    <i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold">{{ __('Verified') }}</span>
                                                @elseif($user->status == 3)
                                                    <i class="fa fa-times-circle text-danger"></i> <span class="font-weight-bold">{{ __('Rejected') }}</span>
                                                @else
                                                    <i class="fa fa-question-circle text-secondary"></i> <span class="font-weight-bold">{{ __('Unknown') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>

              
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable (Optional, for sorting and pagination)
    $('#pc-dt-simple').DataTable();
});
</script>
@endsection
