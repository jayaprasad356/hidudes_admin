

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage users')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('users')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
            <form action="<?php echo e(route('users.index')); ?>" method="GET" class="mb-3">
            <div class="row align-items-end">
            <div class="col-md-3">
                            <label for="gender"><?php echo e(__('Filter by Gender')); ?></label>
                            <select name="gender" id="gender" class="form-control gender-filter" onchange="this.form.submit()">
                                <option value=""><?php echo e(__('All')); ?></option>
                                <option value="male" <?php echo e(request()->get('gender') == 'male' ? 'selected' : ''); ?>><?php echo e(__('Male')); ?></option>
                                <option value="female" <?php echo e(request()->get('gender') == 'female' ? 'selected' : ''); ?>><?php echo e(__('Female')); ?></option>
                            </select>
                        </div>
                <div class="col-md-3">
                            <label for="filter_date"><?php echo e(__('Filter by Date')); ?></label>
                            <input type="date" name="filter_date" id="filter_date" class="form-control" value="<?php echo e(request()->get('filter_date')); ?>" onchange="this.form.submit()">
                 </div>
                 </div>
        </form>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                            <th><?php echo e(__('Actions')); ?></th>
                                <th><?php echo e(__('ID')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Mobile')); ?></th>
                                <th><?php echo e(__('Age')); ?></th>
                                <th><?php echo e(__('Gender')); ?></th>
                                <th><?php echo e(__('Coins')); ?></th>
                                <th><?php echo e(__('Total Coins')); ?></th>
                                <th><?php echo e(__('Language')); ?></th>
                                <th><?php echo e(__('Balance')); ?></th>
                                <th><?php echo e(__('DateTime')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Audio Status')); ?></th>
                                <th><?php echo e(__('Video Status')); ?></th>
                                <th><?php echo e(__('Attended Calls')); ?></th>
                                <th><?php echo e(__('Missed Calls')); ?></th>
                                <th><?php echo e(__('Avg Call Percentage')); ?></th>
                                <th><?php echo e(__('Blocked')); ?></th>
                                <th><?php echo e(__('Avatar')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                <td class="Action">
                                <div class="action-btn bg-info ms-2">
                                            <!-- Direct Link to Edit user Page -->
                                            <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                        <div class="action-btn bg-danger ms-2">
                                            <form method="POST" action="<?php echo e(route('users.destroy', $user->id)); ?>">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm align-items-center bs-pass-para" 
                                                        data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                        onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="ti ti-trash text-white"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td><?php echo e($user->id); ?></td>
                                    <td><?php echo e(ucfirst($user->name)); ?></td>
                                    <td><?php echo e($user->mobile); ?></td>
                                    <td><?php echo e($user->age); ?></td>
                                    <td><?php echo e(ucfirst($user->gender)); ?></td>
                                    <td><?php echo e($user->coins); ?></td>
                                    <td><?php echo e($user->total_coins); ?></td>
                                    <td><?php echo e(ucfirst($user->language)); ?></td>
                                    <td><?php echo e($user->balance); ?></td>
                                    <td><?php echo e($user->datetime); ?></td>
                                    <td>
                                        <!-- Display Status with values 1, 2, and 3 -->
                                        <?php if($user->status == 1): ?>
                                            <i class="fa fa-clock text-warning"></i> <span class="font-weight-bold"><?php echo e(__('Pending')); ?></span>
                                        <?php elseif($user->status == 2): ?>
                                            <i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold"><?php echo e(__('Verified')); ?></span>
                                        <?php elseif($user->status == 3): ?>
                                            <i class="fa fa-times-circle text-danger"></i> <span class="font-weight-bold"><?php echo e(__('Blocked')); ?></span>
                                        <?php else: ?>
                                            <i class="fa fa-question-circle text-secondary"></i> <span class="font-weight-bold"><?php echo e(__('Unknown')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Display Audio Status -->
                                        <?php if($user->audio_status == 1): ?>
                                            <i class="fa fa-volume-up text-success"></i> <span class="font-weight-bold"><?php echo e(__('Enabled')); ?></span>
                                        <?php else: ?>
                                            <i class="fa fa-volume-mute text-danger"></i> <span class="font-weight-bold"><?php echo e(__('Disabled')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- Display Video Status -->
                                        <?php if($user->video_status == 1): ?>
                                            <i class="fa fa-video text-success"></i> <span class="font-weight-bold"><?php echo e(__('Enabled')); ?></span>
                                        <?php else: ?>
                                            <i class="fa fa-video-slash text-danger"></i> <span class="font-weight-bold"><?php echo e(__('Disabled')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($user->attended_calls); ?></td>
                                    <td><?php echo e($user->missed_calls); ?></td>
                                    <td><?php echo e($user->avg_call_percentage); ?></td>
                                    <td>
                                        <!-- Display Blocked Status -->
                                        <?php if($user->blocked == 1): ?>
                                            <i class="fa fa-ban text-danger"></i> <span class="font-weight-bold"><?php echo e(__('Blocked')); ?></span>
                                        <?php else: ?>
                                            <i class="fa fa-check text-success"></i> <span class="font-weight-bold"><?php echo e(__('Not Blocked')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <!-- Avatar Image -->
                                    <td>
                                        <?php if($user->avatar && $user->avatar->image): ?>
                                        <a href="<?php echo e(asset('storage/app/public/' . $user->avatar->image)); ?>" data-lightbox="image-<?php echo e($user->avatar->id); ?>">
                                                <img class="user-img img-thumbnail img-fluid" 
                                                    src="<?php echo e(asset('storage/app/public/' . $user->avatar->image)); ?>" 
                                                    alt="Avatar Image" 
                                                    style="max-width: 100px; max-height: 100px;">
                                            </a>

                                        <?php else: ?>
                                            <?php echo e(__('No Avatar')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <!-- Actions -->
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
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
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hima_admin_panel\resources\views/users/index.blade.php ENDPATH**/ ?>