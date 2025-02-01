{{ Form::model($withdrawal, ['route' => ['withdrawals.update', $withdrawal->id], 'method' => 'PUT']) }}

<div class="modal-body">
    <div class="row">
        <!-- Bank -->
        <div class="form-group col-md-12">
            {{ Form::label('Bank', __('Bank'), ['class' => 'form-label']) }}
            {{ Form::text('bank', $user->bank, ['class' => 'form-control', 'required' => 'required']) }}
        </div>

        <!-- Branch -->
        <div class="form-group col-md-12">
            {{ Form::label('Branch', __('Branch'), ['class' => 'form-label']) }}
            {{ Form::text('branch', $user->branch, ['class' => 'form-control', 'required' => 'required']) }}
        </div>

        <!-- IFSC -->
        <div class="form-group col-md-12">
            {{ Form::label('Ifsc', __('Ifsc'), ['class' => 'form-label']) }}
            {{ Form::text('ifsc', $user->ifsc, ['class' => 'form-control', 'required' => 'required']) }}
        </div>

        <!-- Account Number -->
        <div class="form-group col-md-12">
            {{ Form::label('account_num', __('Account Number'), ['class' => 'form-label']) }}
            {{ Form::text('account_num', $user->account_num, ['class' => 'form-control', 'required' => 'required']) }}
        </div>

        <!-- Holder Name -->
        <div class="form-group col-md-12">
            {{ Form::label('holder_name', __('Holder Name'), ['class' => 'form-label']) }}
            {{ Form::text('holder_name', $user->holder_name, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update Bank Details') }}" class="btn btn-primary">
</div>

{{ Form::close() }}
