<!-- resources/views/customers/add-coins.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="container">
    <h3><?php echo e(__('Add Coins to Customer')); ?></h3>

    <!-- Display Success Message -->
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('customers.addCoins', $customer->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="coins"><?php echo e(__('Coins to Add')); ?></label>
            <input type="number" id="coins" name="coins" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary"><?php echo e(__('Add Coins')); ?></button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_hi_ma\resources\views/customers/add-coins.blade.php ENDPATH**/ ?>