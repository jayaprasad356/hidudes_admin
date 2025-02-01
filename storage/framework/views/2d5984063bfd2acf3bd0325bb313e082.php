<?php echo e(Form::model($coins, ['route' => ['coins.update', $coins->id], 'method' => 'PUT'])); ?>

<div class="modal-body">
    <div class="row">
        <!-- Text Input -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('price', __('Price'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('price', null, ['class' => 'form-control', 'required'])); ?>

        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('coins', __('Coins'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('coins', null, ['class' => 'form-control', 'required'])); ?>

        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('save', __('Save'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('save', null, ['class' => 'form-control', 'required'])); ?>

        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('popular', __('Popular'), ['class' => 'form-label'])); ?>

            <div class="form-check form-switch">
                <?php echo e(Form::checkbox('popular', 1, null, ['class' => 'form-check-input'])); ?>

            </div>
        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('best_offer', __('Best Offer'), ['class' => 'form-label'])); ?>

            <div class="form-check form-switch">
                <?php echo e(Form::checkbox('best_offer', 1, null, ['class' => 'form-check-input'])); ?>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update Coins')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\hima_admin_panel\resources\views/coins/edit.blade.php ENDPATH**/ ?>