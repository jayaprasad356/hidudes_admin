<?php echo e(Form::model($employee, ['route' => ['employee.salary.update', $employee->id], 'method' => 'POST'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('salary_type', __('Payslip Type*'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::select('salary_type', $payslip_type, null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('salary', __('Salary'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::number('salary', null, ['class' => 'form-control ', 'required' => 'required'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('account_type', __('From Account*'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::select('account_type', $accounts, null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <button type="submit" class="btn  btn-primary"><?php echo e(__('Save')); ?></button>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/u743445510/domains/graymatterworks.com/public_html/ems/resources/views/setsalary/basic_salary.blade.php ENDPATH**/ ?>