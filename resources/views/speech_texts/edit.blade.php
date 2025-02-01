{{ Form::model($speechText, ['route' => ['speech_texts.update', $speechText->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        <!-- Text Input -->
    <div class="form-group col-md-12">
            {{ Form::label('text', __('Text'), ['class' => 'form-label']) }}
            {{ Form::textarea('text', null, ['class' => 'form-control', 'rows' => '3', 'required' => 'required']) }}
        </div>

        <!-- Language Dropdown -->
        <div class="form-group col-md-12 mt-3">
            {{ Form::label('language', __('Language'), ['class' => 'form-label']) }}
            {{ Form::select('language', [
                'Hindi' => __('Hindi'),
                'Telugu' => __('Telugu'),
                'Malayalam' => __('Malayalam'),
                'Kannada' => __('Kannada'),
                'Punjabi' => __('Punjabi'),
                'Tamil' => __('Tamil')
            ], null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{ __('Cancel') }}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ __('Update Speech Text') }}" class="btn btn-primary">
</div>
{{ Form::close() }}
