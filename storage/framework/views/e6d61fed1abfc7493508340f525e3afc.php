

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Edit Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Edit Settings')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Edit Settings')); ?></h5>
            </div>
            <div class="card-body">
        <form action="<?php echo e(route('news.update', $news->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-group">
                <label for="privacy_policy">Privacy Policy</label>
                <textarea name="privacy_policy" id="privacy_policy" class="form-control ckeditor-content" rows="10" required><?php echo $news->privacy_policy; ?></textarea>
            </div>

            <div class="form-group">
                <label for="support_mail">Support Mail</label>
                <input type="email" class="form-control" id="support_mail" name="support_mail" value="<?php echo e($news->support_mail); ?>" required>
            </div>

            <div class="form-group">
                <label for="demo_video">Demo Video</label>
                <input type="text" class="form-control" id="demo_video" name="demo_video" value="<?php echo e($news->demo_video); ?>" required>
            </div>

            <div class="form-group">
                <label for="minimum_withdrawals">Minimum Withdrawals</label>
                <input type="text" class="form-control" id="minimum_withdrawals" name="minimum_withdrawals" value="<?php echo e($news->minimum_withdrawals); ?>" required>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.21.0/full-all/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('privacy_policy', {
            extraPlugins: 'colorbutton'
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hima_admin_panel\resources\views/news/edit.blade.php ENDPATH**/ ?>