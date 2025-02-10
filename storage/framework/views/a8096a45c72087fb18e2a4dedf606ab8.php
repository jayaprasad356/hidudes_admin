

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Withdrawals List')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Withdrawals List')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Filter by Type Form -->
                <form action="<?php echo e(route('withdrawals.index')); ?>" method="GET" class="mb-3">
                    <div class="row align-items-end">
                        <!-- Existing Status Filter -->
                        <div class="col-md-3">
                            <label for="status"><?php echo e(__('Filter by Status')); ?></label>
                            <select name="status" id="status" class="form-control status-filter" onchange="this.form.submit()">
                                <option value=""><?php echo e(__('All')); ?></option>
                                <option value="0" <?php echo e(request()->get('status') == '0' ? 'selected' : ''); ?>><?php echo e(__('Pending')); ?></option>
                                <option value="1" <?php echo e(request()->get('status') == '1' ? 'selected' : ''); ?>><?php echo e(__('Paid')); ?></option>
                                <option value="2" <?php echo e(request()->get('status') == '2' ? 'selected' : ''); ?>><?php echo e(__('Cancelled')); ?></option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="filter_date"><?php echo e(__('Filter by Date')); ?></label>
                            <input type="date" name="filter_date" id="filter_date" class="form-control" value="<?php echo e(request()->get('filter_date')); ?>" onchange="this.form.submit()">
                        </div>

                        <div class="col-md-3 offset-md-3 d-flex justify-content-end">
                            <a href="<?php echo e(route('withdrawals.export', ['status' => request()->get('status', 0), 'filter_date' => request()->get('filter_date')])); ?>" class="btn btn-primary">
                                <?php echo e(__('Export Withdrawals')); ?>

                            </a>
                        </div>

                    </div>
                </form>

                <form action="<?php echo e(route('withdrawals.bulkUpdateStatus')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div class="mb-3 d-flex align-items-center">
                        <!-- Select All Checkbox -->
                        <div class="mr-3">
                            <input type="checkbox" id="select-all">
                            <label for="select-all"><?php echo e(__('Select All')); ?></label>
                        </div>


                        <!-- Paid Button -->
                        <button type="submit" name="new_status" value="1" class="btn btn-success ml-3"
                            
                            onclick="return confirm('<?php echo e(__('Are you sure you want to mark selected as Paid?')); ?>')">
                            <?php echo e(__('Paid')); ?>

                        </button>

                        <!-- Cancel Button -->
                        <button type="submit" name="new_status" value="2" class="btn btn-danger ml-2"
                            onclick="return confirm('<?php echo e(__('Are you sure you want to cancel selected withdrawals?')); ?>')">
                            <?php echo e(__('Cancel')); ?>

                        </button>
                    </div>

                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Select')); ?></th>
                                    <th><?php echo e(__('Actions')); ?></th> 
                                    <th><?php echo e(__('ID')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Mobile')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Bank')); ?></th>
                                    <th><?php echo e(__('Branch')); ?></th>
                                    <th><?php echo e(__('Ifsc Code')); ?></th>
                                    <th><?php echo e(__('Account Number')); ?></th>
                                    <th><?php echo e(__('Holder Name')); ?></th>
                                    <th><?php echo e(__('Upi ID')); ?></th>
                                    <th><?php echo e(__('Datetime')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="withdrawal_ids[]" value="<?php echo e($withdrawal->id); ?>">
                                        </td>
                                        <td>
                                            <a href="#" data-url="<?php echo e(route('withdrawals.edit', $withdrawal->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Bank Details')); ?>"
                                               class="btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-black"></i>
                                            </a>
                                        </td>
                                        <td><?php echo e($withdrawal->id); ?></td>
                                        <td><?php echo e(ucfirst($withdrawal->users->name ?? '')); ?></td>
                                        <td><?php echo e($withdrawal->users->mobile ?? ''); ?></td>
                                        <td><?php echo e($withdrawal->amount); ?></td>
                                        <td><?php echo e($withdrawal->type); ?></td>
                                        <td>
                                            <?php if($withdrawal->status == 0): ?>
                                                <i class="fa fa-clock text-warning"></i> <span class="font-weight-bold"><?php echo e(__('Pending')); ?></span>
                                            <?php elseif($withdrawal->status == 1): ?>
                                                <i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold"><?php echo e(__('Paid')); ?></span>
                                            <?php elseif($withdrawal->status == 2): ?>
                                                <i class="fa fa-times-circle text-danger"></i> <span class="font-weight-bold"><?php echo e(__('Cancelled')); ?></span>
                                            <?php else: ?>
                                                <i class="fa fa-question-circle text-secondary"></i> <span class="font-weight-bold"><?php echo e(__('Unknown')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($withdrawal->users->bank ?? ''); ?></td>
                                        <td><?php echo e($withdrawal->users->branch ?? ''); ?></td>
                                        <td><?php echo e($withdrawal->users->ifsc ?? ''); ?></td>
                                        <td><?php echo e($withdrawal->users->account_num ?? ''); ?></td>
                                        <td><?php echo e($withdrawal->users->holder_name ?? ''); ?></td>
                                        <td><?php echo e($withdrawal->users->upi_id ?? ''); ?></td>
                                        <td><?php echo e($withdrawal->datetime); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
        <script src="<?php echo e(asset('plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
        <script>
         $(document).ready(function () {
    // Handle "Select All" checkbox
    $('#select-all').change(function() {
        // Get the state of the "Select All" checkbox
        var isChecked = $(this).prop('checked');

        // Select or deselect all individual checkboxes
        $('input[name="withdrawal_ids[]"]').prop('checked', isChecked);
    });

    // Handle individual checkboxes
    $('input[name="withdrawal_ids[]"]').change(function() {
        // If any individual checkbox is unchecked, uncheck the "Select All" checkbox
        if ($('input[name="withdrawal_ids[]"]:not(:checked)').length > 0) {
            $('#select-all').prop('checked', false); // Uncheck "Select All" checkbox
        } else {
            $('#select-all').prop('checked', true); // Check "Select All" checkbox if all are selected
        }
    });
});

        </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hidudes_admin\resources\views/withdrawals/index.blade.php ENDPATH**/ ?>