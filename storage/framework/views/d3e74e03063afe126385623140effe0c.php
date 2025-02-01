

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Customer Verification')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Customer Verification')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5><?php echo e(__('Customer Verification List')); ?></h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><input type="checkbox" id="select-all"> <?php echo e(__('Select All')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Mobile')); ?></th>
                                <th><?php echo e(__('Verification Status')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($customer->id); ?></td>
                                    <td>
                                        <input type="checkbox" class="customer-checkbox" value="<?php echo e($customer->id); ?>">
                                    </td>
                                    <td><?php echo e(ucfirst($customer->name)); ?></td>
                                    <td><?php echo e($customer->mobile); ?></td>
                                    <td>
                                        <?php if($customer->status == 1): ?>
                                            <i class="fa fa-clock text-warning"></i> <span class="font-weight-bold"><?php echo e(__('Pending')); ?></span>
                                        <?php elseif($customer->status == 2): ?>
                                            <i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold"><?php echo e(__('Verified')); ?></span>
                                        <?php elseif($customer->status == 3): ?>
                                            <i class="fa fa-times-circle text-danger"></i> <span class="font-weight-bold"><?php echo e(__('Rejected')); ?></span>
                                        <?php else: ?>
                                            <i class="fa fa-question-circle text-secondary"></i> <span class="font-weight-bold"><?php echo e(__('Unknown')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <!-- Buttons for Verify and Reject -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-success" id="verify-btn"><?php echo e(__('Verify')); ?></button>
                        <button type="button" class="btn btn-danger ml-2" id="reject-btn"><?php echo e(__('Reject')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#pc-dt-simple').DataTable();

        // Select All functionality
        $('#select-all').on('click', function() {
            $('.customer-checkbox').prop('checked', this.checked);
        });

        $('.customer-checkbox').on('change', function() {
            if ($('.customer-checkbox:checked').length === $('.customer-checkbox').length) {
                $('#select-all').prop('checked', true);
            } else {
                $('#select-all').prop('checked', false);
            }
        });

        // Verify button click
        $('#verify-btn').on('click', function() {
            var selectedCustomers = getSelectedCustomers();
            if (selectedCustomers.length > 0) {
                changeCustomerStatus(selectedCustomers, 2); // 2 = Verified
            } else {
                alert('<?php echo e(__("Please select at least one customer to verify.")); ?>');
            }
        });

        // Reject button click
        $('#reject-btn').on('click', function() {
            var selectedCustomers = getSelectedCustomers();
            if (selectedCustomers.length > 0) {
                changeCustomerStatus(selectedCustomers, 3); // 3 = Rejected
            } else {
                alert('<?php echo e(__("Please select at least one customer to reject.")); ?>');
            }
        });

        // Function to get selected customer IDs
        function getSelectedCustomers() {
            var selected = [];
            $('.customer-checkbox:checked').each(function() {
                selected.push($(this).val());
            });
            return selected;
        }

        // Function to change the status of selected customers
        function changeCustomerStatus(customerIds, status) {
            $.ajax({
                url: "<?php echo e(route('update-customer-status')); ?>",  // Your route to handle status change
                method: 'POST',
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    customer_ids: customerIds,
                    status: status
                },
                success: function(response) {
                    if (response.success) {
                        // Update the customer status in the table
                        $('.customer-checkbox:checked').each(function() {
                            var row = $(this).closest('tr');
                            if (status == 2) {
                                row.find('td:nth-child(5)').html('<i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold"><?php echo e(__("Verified")); ?></span>');
                            } else if (status == 3) {
                                row.find('td:nth-child(5)').html('<i class="fa fa-times-circle text-danger"></i> <span class="font-weight-bold"><?php echo e(__("Rejected")); ?></span>');
                            }
                        });
                    } else {
                        alert('<?php echo e(__("An error occurred while updating the status.")); ?>');
                    }
                }
            });
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_hi_ma\resources\views/customersverification/index.blade.php ENDPATH**/ ?>