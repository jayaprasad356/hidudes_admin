@extends('layouts.admin')

@section('page-title')
    {{ __('Coins List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Coins List') }}</li>
@endsection

@section('action-button')
    <a href="{{ route('coins.create') }}" data-bs-toggle="tooltip" title="{{ __('Create New Coins') }}" class="btn btn-sm btn-primary">
        <i class="ti ti-plus"></i> {{ __('Add New Coins') }}
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Update Status Form -->
                <form action="{{ route('coins.updateStatus') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success" name="status" value="1">{{ __('Update Coins') }}</button>
                </form>

                <!-- Coins Table -->
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th>{{ __('Check Box') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Coins') }}</th>
                                    <th>{{ __('Save') }}</th>
                                    <th>{{ __('Popular') }}</th>
                                    <th>{{ __('Best Offer') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coins as $coin)
                                    <tr class="selectable-row">
                                        <td><input type="checkbox" class="user-checkbox" name="coin_ids[]" value="{{ $coin->id }}"></td>
                                        <td class="Action">
                                            <span>
                                                <!-- Edit Button -->
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" data-url="{{ route('coins.edit', $coin->id) }}" data-ajax-popup="true" data-title="{{ __('Edit Coins') }}"
                                                    class="btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{ __('Edit') }}">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                                <!-- Delete Button -->
                                                <div class="action-btn bg-danger ms-2">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['coins.destroy', $coin->id], 'id' => 'delete-form-' . $coin->id]) !!}
                                                        <button type="button" class="btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                        onclick="confirmDelete(event, '{{ $coin->id }}')">
                                                            <i class="ti ti-trash text-white"></i>
                                                        </button>
                                                    {!! Form::close() !!}
                                                </div>
                                            </span>
                                        </td>
                                        <td>{{ $coin->id }}</td>
                                        <td>{{ $coin->price }}</td>
                                        <td>{{ $coin->coins }}</td>
                                        <td>{{ $coin->save }}</td>
                                        <td>{{ $coin->popular }}</td>
                                        <td>{{ $coin->best_offer }}</td>
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

    function confirmDelete(event, coinId) {
        event.preventDefault();

        if (confirm('Are you sure you want to delete this coin?')) {
            document.getElementById('delete-form-' + coinId).submit();
        }
    }
</script>
@endsection
