<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Add Avatar')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('avatar.index')); ?>"><?php echo e(__('Avatars')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Add Avatar')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Add New Avatar')); ?></h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('avatar.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger">
                            <strong><?php echo e($message); ?></strong>
                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="form-group">
                        <label for="image" class="form-label"><?php echo e(__('Image')); ?></label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="gender" class="form-label"><?php echo e(__('Gender')); ?></label>
                        <select name="gender" class="form-control" required>
                            <option value="male"><?php echo e(__('Male')); ?></option>
                            <option value="female"><?php echo e(__('Female')); ?></option>
                            <option value="other"><?php echo e(__('Other')); ?></option>
                        </select>
                    </div>

                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        <a href="<?php echo e(route('avatar.index')); ?>" class="btn btn-secondary"><?php echo e(__('Cancel')); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_hi_ma\resources\views/avatar/create.blade.php ENDPATH**/ ?>