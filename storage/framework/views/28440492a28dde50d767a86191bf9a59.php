<?php echo e(Form::open(['url' => 'accountlist', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('account_name', __('Account Name'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::text('account_name', null, ['class' => 'form-control', 'placeholder' => __('Enter Account Name')])); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('initial_balance', __('Initial Balance'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::number('initial_balance', null, ['class' => 'form-control', 'placeholder' => __('Enter Initial Balance')])); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('account_number', __('Account Number'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::number('account_number', null, ['class' => 'form-control', 'placeholder' => __('Enter Account Number')])); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('branch_code', __('Branch Code'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::text('branch_code', null, ['class' => 'form-control', 'placeholder' => __('Enter Branch Code')])); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('bank_branch', __('Bank Branch'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::text('bank_branch', null, ['class' => 'form-control', 'placeholder' => __('Enter Bank Branch')])); ?>

            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\payroll\resources\views/accountlist/create.blade.php ENDPATH**/ ?>