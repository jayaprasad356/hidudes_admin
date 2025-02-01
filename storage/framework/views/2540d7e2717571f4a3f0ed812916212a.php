<?php echo e(Form::model($speechText, ['route' => ['speech_texts.update', $speechText->id], 'method' => 'PUT'])); ?>

<div class="modal-body">
    <div class="row">
        <!-- Text Input -->
    <div class="form-group col-md-12">
            <?php echo e(Form::label('text', __('Text'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('text', null, ['class' => 'form-control', 'rows' => '3', 'required' => 'required'])); ?>

        </div>

        <!-- Language Dropdown -->
        <div class="form-group col-md-12 mt-3">
            <?php echo e(Form::label('language', __('Language'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::select('language', [
                'Hindi' => __('Hindi'),
                'Telugu' => __('Telugu'),
                'Malayalam' => __('Malayalam'),
                'Kannada' => __('Kannada'),
                'Punjabi' => __('Punjabi'),
                'Tamil' => __('Tamil')
            ], null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update Speech Text')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\new_hi_ma\resources\views/speech_texts/edit.blade.php ENDPATH**/ ?>