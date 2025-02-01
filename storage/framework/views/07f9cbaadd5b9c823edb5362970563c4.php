<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Termination')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Termination')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Termination')): ?>
        <a href="#" data-url="<?php echo e(route('termination.create')); ?>" data-ajax-popup="true"
            data-title="<?php echo e(__('Create New Termination')); ?>" data-size="lg" data-bs-toggle="tooltip" title=""
            class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-header card-body table-border-style">
                    
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <thead>
                                <tr>
                                    <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                        <th><?php echo e(__('Employee Name')); ?></th>
                                    <?php endif; ?>
                                    <th><?php echo e(__('Termination Type')); ?></th>
                                    <th><?php echo e(__('Notice Date')); ?></th>
                                    <th><?php echo e(__('Termination Date')); ?></th>
                                    <th><?php echo e(__('Description')); ?></th>
                                    <?php if(Gate::check('Edit Termination') || Gate::check('Delete Termination')): ?>
                                        <th width="200px"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>


                                <?php $__currentLoopData = $terminations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $termination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php if(\Spatie\Permission\PermissionServiceProvider::bladeMethodWrapper('hasRole', 'company')): ?>
                                            <td><?php echo e(!empty($termination->employee_id) ? $termination->employee->name : ''); ?>

                                            </td>
                                        <?php endif; ?>

                                        <td><?php echo e(!empty($termination->termination_type) ? $termination->terminationType->name : ''); ?>

                                        </td>
                                        <td><?php echo e(\Auth::user()->dateFormat($termination->notice_date)); ?></td>
                                        <td><?php echo e(\Auth::user()->dateFormat($termination->termination_date)); ?></td>
                                        <td><a href="#" class="action-item"
                                                data-url="<?php echo e(route('termination.description', $termination->id)); ?>"
                                                data-ajax-popup="true" data-bs-toggle="tooltip"
                                                title="<?php echo e(__('Desciption')); ?>" data-title="<?php echo e(__('Desciption')); ?>"><i
                                                    class="icon_desc fa fa-comment"></i></a>
                                        </td>
                                        <td class="Action">
                                            <?php if(Gate::check('Edit Termination') || Gate::check('Delete Termination')): ?>
                                                <span>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Termination')): ?>
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                                data-size="lg"
                                                                data-url="<?php echo e(URL::to('termination/' . $termination->id . '/edit')); ?>"
                                                                data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                                title="" data-title="<?php echo e(__('Edit Termination')); ?>"
                                                                data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                                <i class="ti ti-pencil text-white"></i>
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Termination')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['termination.destroy', $termination->id],
                                                                'id' => 'delete-form-' . $termination->id,
                                                            ]); ?>

                                                            <a href="#"
                                                                class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                data-bs-toggle="tooltip" title=""
                                                                data-bs-original-title="Delete" aria-label="Delete"><i
                                                                    class="ti ti-trash text-white text-white"></i></a>
                                                            </form>
                                                        </div>
                                                    <?php endif; ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u743445510/domains/graymatterworks.com/public_html/ems/resources/views/termination/index.blade.php ENDPATH**/ ?>