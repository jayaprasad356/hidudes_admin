@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Gifts') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Gifts') }}</li>
@endsection

@section('action-button')
    <a href="{{ route('gifts.create') }}" data-bs-toggle="tooltip" title="{{ __('Create New Gifts') }}" class="btn btn-sm btn-primary">
        <i class="ti ti-plus"></i> {{ __('Add New Gifts') }}
    </a>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Gifts List') }}</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Gift Icon') }}</th>
                                <th>{{ __('Coins') }}</th>
                                <th width="300px">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gifts as $gift)
                                <tr>
                                   <td>{{ ucfirst($gift->id) }}</td>
                                    <td>
                                        <a href="{{ asset('storage/app/public/' . $gift->gift_icon) }}" data-lightbox="image-{{ $gift->id }}">
                                            <img class="customer-img img-thumbnail img-fluid" src="{{ asset('storage/app/public/' . $gift->gift_icon) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                                        </a>
                                    </td>
                                    <td>{{ ucfirst($gift->coins) }}</td>
                                    <td class="Action">
                                        <span>
                                            <!-- Edit Button -->
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-url="{{ route('gifts.edit', $gift->id) }}" data-ajax-popup="true" data-title="{{ __('Edit Gifts') }}"
                                                   class="btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{ __('Edit') }}">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <!-- Delete Button -->
                                            <div class="action-btn bg-danger ms-2">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['gifts.destroy', $gift->id], 'id' => 'delete-form-' . $gift->id]) !!}
                                                <a href="#" class="btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                                onclick="confirmDelete(event, '{{ $gift->id }}')">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                            {!! Form::close() !!}

                                            </div>
                                        </span>
                                    </td>
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
    function confirmDelete(event, giftId) {
        event.preventDefault(); // Prevent the default form submission

        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this gift?")) {
            // If the user clicks "Yes", submit the delete form
            document.getElementById('delete-form-' + giftId).submit();
        }
    }
</script>
@endsection

