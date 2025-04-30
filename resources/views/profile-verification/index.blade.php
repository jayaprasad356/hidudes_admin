@extends('layouts.admin')

@section('page-title')
    {{ __('Profile Verification List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Profile Verification List') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
         
            <div class="card-body">
                <!-- Filter by Status Form -->
              <!-- Filter by Status and Language Form -->
                    <form action="{{ route('profile-verification.index') }}" method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="profile_status">{{ __('Filter by Profile Status') }}</label>
                                <select name="profile_status" id="profile_status" class="form-control status-filter" onchange="this.form.submit()">
                                    <option value="0" {{ request()->get('profile_status') == '0' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                    <option value="2" {{ request()->get('profile_status') == '2' ? 'selected' : '' }}>{{ __('Verified') }}</option>
                                    <option value="3" {{ request()->get('profile_status') == '3' ? 'selected' : '' }}>{{ __('Rejected') }}</option>
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
                <form action="{{ route('profile-verification.updateStatus') }}" method="POST">
                    @csrf
                    <div class="mb-3 d-flex align-items-center">
                    <div class="mr-3">
                            <input type="checkbox" name="select_all" id="select-all">
                            <label for="select-all">{{ __('Select All') }}</label>
                        </div>
                    <button type="submit" class="btn btn-success" name="profile_status" value="2">{{ __('Verified') }}</button>
                    <button type="submit" class="btn btn-danger" name="profile_status" value="3">{{ __('Cancelled') }}</button>
                    </div>
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
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Profile Status') }}</th>
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
                                                @if($user->image)
                                                    <a href="{{ asset('storage/app/public/' . $user->image) }}" data-lightbox="user-{{ $user->id }}" data-title="User Image">
                                                        <img class="user-img img-thumbnail img-fluid" 
                                                            src="{{ asset('storage/app/public/' . $user->image) }}" 
                                                            alt="User Image" 
                                                            style="max-width: 100px; max-height: 100px;">
                                                    </a>
                                                @else
                                                    <span class="text-secondary">{{ __('No Image') }}</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($user->profile_status == 0)
                                                    <i class="fa fa-clock text-warning"></i> <span class="font-weight-bold">{{ __('Pending') }}</span>
                                                @elseif($user->profile_status == 2)
                                                    <i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold">{{ __('Verified') }}</span>
                                                @elseif($user->profile_status == 3)
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
<!-- Lightbox2 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectAllCheckbox = document.getElementById('select-all');

        // Delegated event listener for checkboxes
        document.addEventListener('change', function (event) {
            if (event.target && event.target.matches('#select-all')) {
                // Select all logic
                const checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                });
            }

            // Deselect "Select All" if any individual checkbox is unchecked
            if (event.target && event.target.matches('input[name="user_ids[]"]')) {
                if (!event.target.checked) {
                    selectAllCheckbox.checked = false;
                } else {
                    const allChecked = [...document.querySelectorAll('input[name="user_ids[]"]')]
                        .every(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                }
            }
        });
    });
</script>


