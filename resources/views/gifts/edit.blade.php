{{ Form::model($gifts, ['route' => ['gifts.update', $gifts->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <!-- Avatar Image Upload -->
        <div class="form-group col-md-12">
            {{ Form::label('gift_icon', __('Gift Icon'), ['class' => 'form-label']) }}
            <div class="mb-2">
                <img src="{{ asset('storage/app/public/' . $gifts->gift_icon) }}" class="img-thumbnail" width="100" alt="Gift Icon">
            </div>
            <input type="file" name="gift_icon" class="form-control">
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('coins', __('Coins'), ['class' => 'form-label']) }}
            {{ Form::number('coins', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update Gifts') }}" class="btn btn-primary">
</div>
{{ Form::close() }}
