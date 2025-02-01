{{ Form::model($avatar, ['route' => ['avatar.update', $avatar->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">
    <div class="row">
        <!-- Avatar Image Upload -->
        <div class="form-group col-md-12">
            {{ Form::label('image', __('Avatar Image'), ['class' => 'form-label']) }}
            <div class="mb-2">
                <img src="{{ asset('storage/app/public/' . $avatar->image) }}" class="img-thumbnail" width="100" alt="Avatar Image">
            </div>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- Gender Selection -->
        <div class="form-group col-md-12">
            {{ Form::label('gender', __('Gender'), ['class' => 'form-label']) }}
            {{ Form::select('gender', ['male' => __('Male'), 'female' => __('Female'), 'other' => __('Other')], null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update Avatar') }}" class="btn btn-primary">
</div>
{{ Form::close() }}
