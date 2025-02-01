<?php echo Form::open(['route' => 'user.store', 'method' => 'post']); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

            <div class="form-icon-user">
                <?php echo Form::text('name', null, [
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Name',
                ]); ?>

            </div>
        </div>
        <div class="form-group">
            <?php echo e(Form::label('email', __('Email'), ['class' => 'form-label'])); ?>

            <div class="form-icon-user">
                <?php echo Form::text('email', null, [
                    'class' => 'form-control',
                    'required' => 'required',
                    'placeholder' => 'Enter Email',
                ]); ?>

            </div>
        </div>
        
        <?php if(\Auth::user()->type != 'super admin'): ?>
            <div class="form-group">
                <?php echo e(Form::label('role', __('User Role'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo Form::select('role', $roles, null, ['class' => 'form-control select2 ', 'required' => 'required']); ?>

                </div>
                <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-role" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        <?php endif; ?>
        <div class="col-md-5 mb-3">
            <label for="password_switch"><?php echo e(__('Login is enable')); ?></label>
            <div class="form-check form-switch custom-switch-v1 float-end">
                <input type="checkbox" name="password_switch" class="form-check-input input-primary pointer"
                    value="on" id="password_switch">
                <label class="form-check-label" for="password_switch"></label>
            </div>
        </div>
        <div class="col-md-12 ps_div d-none">
            <div class="form-group">
                <?php echo e(Form::label('password', __('Password'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Password'), 'minlength' => '6'])); ?>

                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="invalid-password" role="alert">
                        <strong class="text-danger"><?php echo e($message); ?></strong>
                    </small>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">

</div>
<?php echo Form::close(); ?>

<?php /**PATH C:\xampp\htdocs\payroll\resources\views/user/create.blade.php ENDPATH**/ ?>