

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('user Verification List')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('user Verification List')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
         
            <div class="card-body">
                <!-- Filter by Status Form -->
                <form action="<?php echo e(route('users-verification.index')); ?>" method="GET" class="mb-3">
                    <label for="status"><?php echo e(__('Filter by Status')); ?></label>
                    <select name="status" id="status" class="form-control status-filter" onchange="this.form.submit()">
                        <option value="1" <?php echo e(request()->get('status') == '1' ? 'selected' : ''); ?>><?php echo e(__('Pending')); ?></option>
                        <option value="2" <?php echo e(request()->get('status') == '2' ? 'selected' : ''); ?>><?php echo e(__('Verified')); ?></option>
                        <option value="3" <?php echo e(request()->get('status') == '3' ? 'selected' : ''); ?>><?php echo e(__('Rejected')); ?></option>
                    </select>

                    <style>
                        .status-filter {
                            width: 200px; /* Default width */
                        }

                        @media (max-width: 768px) {
                            .status-filter {
                                width: 100%; /* Full width on smaller screens */
                            }
                        }
                    </style>

                </form>

                <!-- Table for user verifications -->
                <form action="<?php echo e(route('users-verification.updateStatus')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-success" name="status" value="2"><?php echo e(__('Verified')); ?></button>
                    <button type="submit" class="btn btn-danger" name="status" value="3"><?php echo e(__('Cancelled')); ?></button>

                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table" id="pc-dt-simple">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Check Box')); ?></th>
                                        <th><?php echo e(__('ID')); ?></th>
                                        <th><?php echo e(__('Name')); ?></th>
                                        <th><?php echo e(__('Mobile')); ?></th>
                                        <th><?php echo e(__('Voice')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="selectable-row">
                                            <td><input type="checkbox" class="user-checkbox" name="user_ids[]" value="<?php echo e($user->id); ?>"></td>
                                            <td><?php echo e($user->id); ?></td>
                                            <td><?php echo e(ucfirst($user->name)); ?></td>
                                            <td><?php echo e($user->mobile); ?></td>
                                            <td>
                                                <?php if($user->voice && $user->voice): ?>
                                                    <a href="<?php echo e(asset('storage/app/public/voices/' . $user->voice)); ?>" target="_blank">Play Voice</a>
                                                <?php else: ?>
                                                    <?php echo e(__('No Voice File')); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($user->status == 1): ?>
                                                    <i class="fa fa-clock text-warning"></i> <span class="font-weight-bold"><?php echo e(__('Pending')); ?></span>
                                                <?php elseif($user->status == 2): ?>
                                                    <i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold"><?php echo e(__('Verified')); ?></span>
                                                <?php elseif($user->status == 3): ?>
                                                    <i class="fa fa-times-circle text-danger"></i> <span class="font-weight-bold"><?php echo e(__('Rejected')); ?></span>
                                                <?php else: ?>
                                                    <i class="fa fa-question-circle text-secondary"></i> <span class="font-weight-bold"><?php echo e(__('Unknown')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>

              
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    // Initialize DataTable (Optional, for sorting and pagination)
    $('#pc-dt-simple').DataTable();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hima_admin_panel\resources\views/users-verification/index.blade.php ENDPATH**/ ?>