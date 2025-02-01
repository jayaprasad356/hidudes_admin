{{ Form::model($coins, ['route' => ['coins.update', $coins->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        <!-- Text Input -->
        <div class="form-group col-md-12">
            {{ Form::label('price', __('Price'), ['class' => 'form-label']) }}
            {{ Form::number('price', null, ['class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('coins', __('Coins'), ['class' => 'form-label']) }}
            {{ Form::number('coins', null, ['class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('save', __('Save'), ['class' => 'form-label']) }}
            {{ Form::number('save', null, ['class' => 'form-control', 'required']) }}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('popular', __('Popular'), ['class' => 'form-label']) }}
            <div class="form-check form-switch">
                {{ Form::checkbox('popular', 1, null, ['class' => 'form-check-input']) }}
            </div>
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('best_offer', __('Best Offer'), ['class' => 'form-label']) }}
            <div class="form-check form-switch">
                {{ Form::checkbox('best_offer', 1, null, ['class' => 'form-check-input']) }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update Coins') }}" class="btn btn-primary">
</div>
{{ Form::close() }}
