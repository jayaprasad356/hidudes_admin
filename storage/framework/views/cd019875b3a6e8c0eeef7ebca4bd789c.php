

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Edit Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="#"><?php echo e(__('Settings')); ?></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Edit Settings')); ?></h5>
            </div>
            <div class="card-body">
            <form action="<?php echo e(route('news.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <!-- Privacy Policy -->
                    <div class="form-group">
                        <label for="privacy_policy" class="form-label"><?php echo e(__('Privacy Policy')); ?></label>
                        <textarea name="privacy_policy" id="privacy_policy" class="form-control ckeditor-content" rows="10" required><?php echo old('privacy_policy', $news->privacy_policy); ?></textarea>
                    </div>

                    <!-- Support Mail -->
                    <div class="form-group">
                        <label for="support_mail" class="form-label"><?php echo e(__('Support Mail')); ?></label>
                        <input type="email" class="form-control" id="support_mail" name="support_mail" value="<?php echo e(old('support_mail', $news->support_mail)); ?>" required>
                    </div>

                    <!-- Demo Video -->
                    <div class="form-group">
                        <label for="demo_video" class="form-label"><?php echo e(__('Demo Video')); ?></label>
                        <input type="text" class="form-control" id="demo_video" name="demo_video" value="<?php echo e(old('demo_video', $news->demo_video)); ?>" required>
                    </div>

                    <!-- Minimum Withdrawals -->
                    <div class="form-group">
                        <label for="minimum_withdrawals" class="form-label"><?php echo e(__('Minimum Withdrawals')); ?></label>
                        <input type="text" class="form-control" id="minimum_withdrawals" name="minimum_withdrawals" value="<?php echo e(old('minimum_withdrawals', $news->minimum_withdrawals)); ?>" required>
                    </div>

                    <!-- Save Button -->
                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
                        <a href="<?php echo e(route('news.edit')); ?>" class="btn btn-secondary"><?php echo e(__('Cancel')); ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.21.0/full-all/ckeditor.js"></script>
<script>
    // Replace CKEditor for privacy_policy and terms_conditions textareas
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('privacy_policy', {
            extraPlugins: 'colorbutton'
        });
        CKEDITOR.replace('terms_conditions', {
            extraPlugins: 'colorbutton'
        });
        CKEDITOR.replace('refund_policy', {
            extraPlugins: 'colorbutton'
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_hi_ma\resources\views/news/edit.blade.php ENDPATH**/ ?>