@extends('layouts.admin')

@section('page-title')
    {{ __('Fcm Tokens') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Fcm Tokens') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Fcm Tokens List') }}</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('User ID') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('Tokens') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fcm_tokens as $fcm_token)
                                <tr>
                                    <td>{{ $fcm_token->id }}</td>  
                                    <td>{{ $fcm_token->user_id }}</td>
                                    <td>{{ $fcm_token->users->name }}</td>
                                    <td>{{ $fcm_token->token }}</td>
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
