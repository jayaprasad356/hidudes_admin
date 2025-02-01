

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Edit user')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('users.index')); ?>"><?php echo e(__('users')); ?></a></li>
<?php $__env->stopSection(); ?>
<style>
    /* Style for Switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .switch label {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }

    .switch label:before {
        content: "";
        position: absolute;
        left: -3px;
        top: 4px;
        width: 26px;
        height: 26px;
        background-color: white;
        border-radius: 50%;
        transition: 0.4s;
    }

    /* When checked, move the slider */
    .switch input:checked + label {
        background-color: #4CAF50;
    }

    .switch input:checked + label:before {
        transform: translateX(26px);
    }

    /* Disabled state */
    .switch input:disabled + label {
        background-color: #e0e0e0;
    }

    .switch input:disabled + label:before {
        background-color: #bdbdbd;
    }

    .form-group .switch-container {
        display: flex;
        align-items: center;
    }

    .form-group .switch-container label {
        margin-left: 10px;
    }
</style>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <!-- Open Modal for Add Coins -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#addCoinsModal" class="btn btn-success ms-auto"><?php echo e(__('Add Coins')); ?></a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#addBalanceModal" class="btn btn-success ms-auto"><?php echo e(__('Add Balance')); ?></a>
            </div>

            <div class="card-body">
                <?php echo e(Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>


                <div class="modal-body">
                    <div class="row">
                        <!-- Avatar Dropdown -->
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required'])); ?>

                        </div>

                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('avatar_id', __('Avatar'), ['class' => 'form-label'])); ?>

                            <select name="avatar_id" class="form-control" required>
                                <option value=""><?php echo e(__('Select Avatar')); ?></option>
                                <?php $__currentLoopData = $avatars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avatar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($avatar->id); ?>" <?php echo e($user->avatar_id == $avatar->id ? 'selected' : ''); ?>>
                                        <?php echo e(__('ID')); ?>: <?php echo e($avatar->id); ?> | <?php echo e(__('Gender')); ?>: <?php echo e(ucfirst($avatar->gender)); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Language Dropdown -->
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('language', __('Language'), ['class' => 'form-label'])); ?>

                            <select name="language" class="form-control" required>
                                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($language); ?>" <?php echo e(old('language', $user->language) == $language ? 'selected' : ''); ?>>
                                        <?php echo e($language); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Mobile Number -->
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('mobile', __('Mobile'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::text('mobile', null, ['class' => 'form-control', 'required'])); ?>

                        </div>

                        <!-- Age -->
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('age', __('Age'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::number('age', null, ['class' => 'form-control', 'required'])); ?>

                        </div>

                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('balance', __('Balance'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::number('balance', null, ['class' => 'form-control', 'required'])); ?>

                        </div>

                     <!-- Audio Status Toggle Switch -->
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('audio_status', __('Audio Status'), ['class' => 'form-label'])); ?>

                            <div class="switch-container">
                                <div class="switch">
                                    <input type="hidden" name="audio_status" value="0">
                                    <input type="checkbox" id="audio_status" name="audio_status" value="1" <?php echo e($user->audio_status == 1 ? 'checked' : ''); ?>>
                                    <label for="audio_status"></label>
                                </div>
                            </div>
                        </div>

                        <!-- Video Status Toggle Switch -->
                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('video_status', __('Video Status'), ['class' => 'form-label'])); ?>

                            <div class="switch-container">
                                <div class="switch">
                                    <input type="hidden" name="video_status" value="0">
                                    <input type="checkbox" id="video_status" name="video_status" value="1" <?php echo e($user->video_status == 1 ? 'checked' : ''); ?>>
                                    <label for="video_status"></label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('attended_calls', __('Attend Calls'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::number('attended_calls', null, ['class' => 'form-control', 'required'])); ?>

                        </div>


                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('missed_calls', __('Missed Calls'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::number('missed_calls', null, ['class' => 'form-control', 'required'])); ?>

                        </div>


                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('avg_call_percentage', __('Avg Call Percentage'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::number('avg_call_percentage', null, ['class' => 'form-control', 'required'])); ?>

                        </div>

                        <div class="form-group col-md-6">
                            <br>
                            <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

                            <div class="btn-group" role="group" aria-label="Status">
                                <input type="radio" class="btn-check" name="status" id="status_pending" value="1" <?php echo e($user->status == 1 ? 'checked' : ''); ?>>
                                <label class="btn btn-outline-warning" for="status_pending"><?php echo e(__('Pending')); ?></label>

                                <input type="radio" class="btn-check" name="status" id="status_verified" value="2" <?php echo e($user->status == 2 ? 'checked' : ''); ?>>
                                <label class="btn btn-outline-success" for="status_verified"><?php echo e(__('Verified')); ?></label>

                                <input type="radio" class="btn-check" name="status" id="status_blocked" value="3" <?php echo e($user->status == 3 ? 'checked' : ''); ?>>
                                <label class="btn btn-outline-danger" for="status_blocked"><?php echo e(__('Cancelled')); ?></label>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <?php echo e(Form::label('blocked', __('Blocked'), ['class' => 'form-label'])); ?>

                            <div class="switch-container">
                                <div class="switch">
                                    <input type="hidden" name="blocked" value="0">
                                    <input type="checkbox" id="blocked" name="blocked" value="1" <?php echo e($user->blocked == 1 ? 'checked' : ''); ?>>
                                    <label for="blocked"></label>
                                </div>
                            </div>
                        </div>

                     
                        <div class="form-group col-md-12">
                            <?php echo e(Form::label('describe_yourself', __('Describe Yourself'), ['class' => 'form-label'])); ?>

                            <?php echo e(Form::textarea('describe_yourself', null, ['class' => 'form-control', 'rows' => 4])); ?>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
                    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
                </div>

                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>

<!-- Modal for Add Coins -->
<div class="modal fade" id="addCoinsModal" tabindex="-1" aria-labelledby="addCoinsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCoinsModalLabel"><?php echo e(__('Add Coins to user')); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('users.addCoins', $user->id)); ?>" method="POST">
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
        </div>
    </div>
</div>
<div class="modal fade" id="addBalanceModal" tabindex="-1" aria-labelledby="addBalanceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBalanceModalLabel"><?php echo e(__('Add Balance to user')); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('users.addBalance', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="coins"><?php echo e(__('Balance to Add')); ?></label>
                        <input type="number" id="balance" name="balance" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Add Balance')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\hima_admin_panel-1\resources\views/users/edit.blade.php ENDPATH**/ ?>