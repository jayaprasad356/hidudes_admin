<div class="col-form-label">
    <div class="row px-3">
        <div class="col-md-4 mb-3">
            <h5 class="emp-title mb-0"><?php echo e(__('Employee')); ?></h5>
            <h5 class="emp-title black-text"><?php echo e(!empty($payslip->employees)? \Auth::user()->employeeIdFormat( $payslip->employees->employee_id):''); ?></h5>
        </div>
        <div class="col-md-4 mb-3">
            <h5 class="emp-title mb-0"><?php echo e(__('Basic Salary')); ?></h5>
            <h5 class="emp-title black-text"><?php echo e(\Auth::user()->priceFormat( $payslip->basic_salary)); ?></h5>
        </div>
        <div class="col-md-4 mb-3">
            <h5 class="emp-title mb-0"><?php echo e(__('Payroll Month')); ?></h5>
            <h5 class="emp-title black-text"><?php echo e(\Auth::user()->dateFormat( $payslip->salary_month)); ?></h5>
        </div>

        <div class="col-lg-12 our-system">
            <?php echo e(Form::open(array('route'=>array('payslip.updateemployee',$payslip->employee_id, $payslip->salary_month),'method'=>'post'))); ?>

            <?php echo Form::hidden('payslip_id', $payslip->id, ['class' => 'form-control']); ?>

            <div class="row">
                
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#allowance" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Allowance')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#commission" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Commission')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#loan" role="tab" aria-controls="pills-contact" aria-selected="false"><?php echo e(__('Loan')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#deduction" role="tab" aria-controls="pills-contact" aria-selected="false"><?php echo e(__('Saturation Deduction')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#payment" role="tab" aria-controls="pills-contact" aria-selected="false"><?php echo e(__('Other Payment')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#overtime" role="tab" aria-controls="pills-contact" aria-selected="false"><?php echo e(__('Overtime')); ?></a>
                    </li>
                </ul>
                <div class="tab-content pt-4">
                    <div id="allowance" class="tab-pane in active">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        <?php
                                            $allowances = json_decode($payslip->allowance);
                                        ?>
                                        <?php $__currentLoopData = $allowances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allownace): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-12 form-group">
                                                <?php echo Form::label('title', $allownace->title,['class'=>'col-form-label']); ?>

                                                <?php echo Form::text('allowance[]', $allownace->amount, ['class' => 'form-control']); ?>

                                                <?php echo Form::hidden('allowance_id[]', $allownace->id, ['class' => 'form-control']); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="commission" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        <?php
                                            $commissions = json_decode($payslip->commission);
                                        ?>
                                        <?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-12 form-group">
                                                <?php echo Form::label('title', $commission->title,['class'=>'col-form-label']); ?>

                                                <?php echo Form::text('commission[]', $commission->amount, ['class' => 'form-control']); ?>

                                                <?php echo Form::hidden('commission_id[]', $commission->id, ['class' => 'form-control']); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="loan" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        <?php
                                            $loans = json_decode($payslip->loan);
                                        ?>
                                        <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-12 form-group">
                                                <?php echo Form::label('title', $loan->title,['class'=>'col-form-label']); ?>

                                                <?php echo Form::text('loan[]', $loan->amount, ['class' => 'form-control']); ?>

                                                <?php echo Form::hidden('loan_id[]', $loan->id, ['class' => 'form-control']); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="deduction" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        <?php
                                            $saturation_deductions = json_decode($payslip->saturation_deduction);
                                        ?>
                                        <?php $__currentLoopData = $saturation_deductions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deduction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-12 form-group">
                                                <?php echo Form::label('title', $deduction->title,['class'=>'col-form-label']); ?>

                                                <?php echo Form::text('saturation_deductions[]', $deduction->amount, ['class' => 'form-control']); ?>

                                                <?php echo Form::hidden('saturation_deductions_id[]', $deduction->id, ['class' => 'form-control']); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="payment" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        <?php
                                            $other_payments = json_decode($payslip->other_payment);
                                        ?>
                                        <?php $__currentLoopData = $other_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-12 form-group">
                                                <?php echo Form::label('title', $payment->title,['class'=>'col-form-label']); ?>

                                                <?php echo Form::text('other_payment[]', $payment->amount, ['class' => 'form-control']); ?>

                                                <?php echo Form::hidden('other_payment_id[]', $payment->id, ['class' => 'form-control']); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="overtime" class="tab-pane">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card bg-none mb-0">
                                    <div class="row px-3">
                                        <?php
                                            $overtimes = json_decode($payslip->overtime);
                                        ?>
                                        <?php $__currentLoopData = $overtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overtime): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6 form-group">
                                                <?php echo Form::label('rate', $overtime->title.' '.__('Rate'),['class'=>'col-form-label']); ?>

                                                <?php echo Form::text('rate[]', $overtime->rate, ['class' => 'form-control']); ?>

                                                <?php echo Form::hidden('rate_id[]', $overtime->id, ['class' => 'form-control']); ?>

                                            </div>
                                            <div class="col-md-6 form-group">
                                                <?php echo Form::label('hours',$overtime->title.' '.__('Hours'),['class'=>'col-form-label']); ?>

                                                <?php echo Form::text('hours[]', $overtime->rate, ['class' => 'form-control']); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-4 text-right">
                
                <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
                <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>
<?php /**PATH /home/u743445510/domains/graymatterworks.com/public_html/ems/resources/views/payslip/salaryEdit.blade.php ENDPATH**/ ?>