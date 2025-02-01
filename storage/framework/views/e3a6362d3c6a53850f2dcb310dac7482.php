<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Add Speech Text')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('speech_texts.index')); ?>"><?php echo e(__('Speech Texts')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Add Speech Text')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Add New Speech Text')); ?></h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('speech_texts.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    <!-- Text Input -->
                    <div class="form-group">
                        <label for="text" class="form-label"><?php echo e(__('Text')); ?></label>
                        <textarea name="text" class="form-control" rows="3" required><?php echo e(old('text')); ?></textarea>
                    </div>

                    <!-- Language Dropdown -->
                    <div class="form-group mt-3">
                        <label for="language" class="form-label"><?php echo e(__('Language')); ?></label>
                        <select name="language" class="form-control" required>
                            <option value='Hindi' <?php echo e(old('language') == 'Hindi' ? 'selected' : ''); ?>>Hindi</option>
                            <option value='Telugu' <?php echo e(old('language') == 'Telugu' ? 'selected' : ''); ?>>Telugu</option>
                            <option value='Malayalam' <?php echo e(old('language') == 'Malayalam' ? 'selected' : ''); ?>>Malayalam</option>
                            <option value='Kannada' <?php echo e(old('language') == 'Kannada' ? 'selected' : ''); ?>>Kannada</option>
                            <option value='Punjabi' <?php echo e(old('language') == 'Punjabi' ? 'selected' : ''); ?>>Punjabi</option>
                            <option value='Tamil' <?php echo e(old('language') == 'Tamil' ? 'selected' : ''); ?>>Tamil</option>
                        </select>
                    </div>

                    <!-- Save Button -->
                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        <a href="<?php echo e(route('speech_texts.index')); ?>" class="btn btn-secondary"><?php echo e(__('Cancel')); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_hi_ma\resources\views/speech_texts/create.blade.php ENDPATH**/ ?>