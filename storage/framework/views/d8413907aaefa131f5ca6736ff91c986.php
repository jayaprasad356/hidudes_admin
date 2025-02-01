<?php
    $plan = Utility::getChatGPTSettings();
?>

<?php echo e(Form::open(['url' => 'appraisal', 'method' => 'post'])); ?>

<div class="modal-body">

    <?php if($plan->enable_chatgpt == 'on'): ?>
        <div class="card-footer text-end">
            <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
                data-url="<?php echo e(route('generate', ['appraisal'])); ?>" data-bs-toggle="tooltip" data-bs-placement="top"
                title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate Content With AI')); ?>">
                <i class="fas fa-robot"></i><?php echo e(__(' Generate With AI')); ?>

            </a>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('branch', __('Branch*'), ['class' => 'col-form-label'])); ?>

                <select name="brances" id="brances" required class="form-control ">
                    <option selected disabled value="0">Select Category</option>
                    <?php $__currentLoopData = $brances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="col-md-6 mt-2">
            <div class="form-group">
                <?php echo e(Form::label('employee', __('Employee*'), ['class' => 'form-label'])); ?>

                <div class="employee_div">
                    <select name="employee" id="employee" class="form-control " required>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('appraisal_date', __('Select Month*'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::month('appraisal_date', '', ['class' => 'form-control current_date', 'autocomplete' => 'off', 'required' => 'required', 'id' => 'current_month'])); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('remark', __('Remarks'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::textarea('remark', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Enter remark'])); ?>

            </div>
        </div>
    </div>
    <div class="row" id="stares">
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>




<script>
    $('#employee').change(function() {

        var emp_id = $('#employee').val();
        $.ajax({
            url: "<?php echo e(route('empByStar')); ?>",
            type: "post",
            data: {
                "employee": emp_id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            cache: false,
            success: function(data) {
                $('#stares').html(data.html);
            }
        })
    });
</script>

<script>
    $('#brances').on('change', function() {
        var branch_id = this.value;

        $.ajax({
            url: "<?php echo e(route('getemployee')); ?>",
            type: "post",
            data: {
                "branch_id": branch_id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },

            cache: false,
            success: function(data) {

                $('#employee').html('<option value=""><?php echo e(__('Select Employee')); ?></option>');
                $.each(data.employee, function(key, value) {
                    $("#employee").append('<option value="' + value.id + '">' + value.name +
                        '</option>');
                });

            }
        })
    });
</script>

<script>
    document.getElementById('current_month').valueAsDate = new Date();
</script>
<?php /**PATH /home/u743445510/domains/graymatterworks.com/public_html/ems/resources/views/appraisal/create.blade.php ENDPATH**/ ?>