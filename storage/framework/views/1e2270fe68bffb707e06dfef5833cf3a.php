<?php echo e(Form::model($notification, ['route' => ['notifications.update', $notification->id], 'method' => 'PUT'])); ?>

<div class="modal-body">
    <div class="row">
        <!-- User Select Dropdown -->
      

        <!-- Gender Select Dropdown -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('gender', __('Gender'), ['class' => 'form-label'])); ?>

            <select id="gender" name="gender" class="form-control" required>
                <option value="male" <?php echo e($notification->gender == 'male' ? 'selected' : ''); ?>><?php echo e(__('Male')); ?></option>
                <option value="female" <?php echo e($notification->gender == 'female' ? 'selected' : ''); ?>><?php echo e(__('Female')); ?></option>
            </select>
        </div>

        <!-- Title Input -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('title', __('Title'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('title', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>

        <!-- Description Input -->
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => '3', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <!-- Cancel Button -->
    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary"><?php echo e(__('Update Notification')); ?></button>
</div>
<?php echo e(Form::close()); ?>


<script>
    // Show user details when a user is selected
    document.getElementById('user_id').addEventListener('change', function () {
        const userId = this.value;

        if (userId) {
            fetch(`/users/${userId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('user-details').style.display = 'block';
                    document.getElementById('user-name').textContent = data.name;
                    document.getElementById('user-email').textContent = data.email;
                    document.getElementById('user-mobile').textContent = data.mobile;
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('user-details').style.display = 'none';
                });
        } else {
            document.getElementById('user-details').style.display = 'none';
        }
    });
</script>

<script>
    $(document).ready(function() {
        // Initialize Select2 on the user dropdown
        $('.select2').select2({
            placeholder: "<?php echo e(__('Select User')); ?>",
            allowClear: true
        });
    });
</script>

<script>
    // Setup AJAX search for users using Select2
    $('#user_id').select2({
        placeholder: "<?php echo e(__('Select User')); ?>",
        allowClear: true,
        ajax: {
            url: "<?php echo e(route('search.users')); ?>",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id,
                            text: item.name + ' (' + item.mobile + ')'
                        };
                    })
                };
            },
            cache: true
        }
    });
</script>
<?php /**PATH C:\xampp\htdocs\hima_admin_panel\resources\views/notifications/edit.blade.php ENDPATH**/ ?>