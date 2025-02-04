

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php
    $setting = App\Models\Utility::settings();
?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if(session('status')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        
        <!-- Language Dropdown -->
        <div class="col-xxl-12 mb-3">
            <div class="d-flex justify-content-start">
            <form method="GET" action="<?php echo e(route('dashboard')); ?>">
                <div class="input-group">
                <span class="input-group-text" style="background-color:#48494b; color: white;"><?php echo e(__('Filter by Language')); ?></span>
                <select name="language" onchange="this.form.submit()" class="form-select" aria-label="Language" style="width: 300px;">
                    <option value="all" <?php echo e(request('language') == 'all' ? 'selected' : ''); ?>>All Languages</option>
                    <option value="Tamil" <?php echo e(request('language') == 'Tamil' ? 'selected' : ''); ?>>Tamil</option>
                    <option value="Telugu" <?php echo e(request('language') == 'Telugu' ? 'selected' : ''); ?>>Telugu</option>
                    <option value="Hindi" <?php echo e(request('language') == 'Hindi' ? 'selected' : ''); ?>>Hindi</option>
                    <option value="Kannada" <?php echo e(request('language') == 'Kannada' ? 'selected' : ''); ?>>Kannada</option>
                    <option value="Punjabi" <?php echo e(request('language') == 'Punjabi' ? 'selected' : ''); ?>>Punjabi</option>
                    <option value="Malayalam" <?php echo e(request('language') == 'Malayalam' ? 'selected' : ''); ?>>Malayalam</option>
                </select>
                </div>
            </form>
            </div>
        </div>

            <div class="col-xxl-12">

                
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Users')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($users_count); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-users"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Today Registration')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Count')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($today_registration_count); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-user"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Today Male')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Users Count')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($male_users_count); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-user"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Today Female')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Users Count')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($female_users_count); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-microphone"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total Active')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Audio Users')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($active_audio_users_count); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-video"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total Active')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Video Users')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($active_video_users_count); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-currency-dollar"></i>
                                        </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Today Recharge')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Count')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($today_recharge_count); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-wallet"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Total Pending')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Withdrawals')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($pending_withdrawals); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-currency-dollar"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Yesterday Recharge')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Count')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($yesterday_recharge_count); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-wallet"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Yesterday Paid')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Withdrawals')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($yesterday_paid_withdrawals); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-auto mb-3 mb-sm-0">
                                        <div class="d-flex align-items-center">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-phone-off"></i>
                                            </div>
                                            <div class="ms-3">
                                                <small class="text-muted"><?php echo e(__('Today Not-Connected')); ?></small>
                                                <h6 class="m-0"><?php echo e(__('Calls')); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto text-end">
                                        <h4 class="m-0 text-primary"><?php echo e($today_not_connected_calls); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                 
                </div>
            </div>

            

    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hidudes_admin\resources\views/dashboard/dashboard.blade.php ENDPATH**/ ?>