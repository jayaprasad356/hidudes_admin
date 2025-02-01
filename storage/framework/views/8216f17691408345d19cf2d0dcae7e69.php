
<div class="col-5  text-end" style="margin-left: 51px;">
    <h5><?php echo e(__('Indicator')); ?></h5>
</div>
<div class="col-4  text-end">
    <h5><?php echo e(__('Appraisal')); ?></h5>
</div>
    <?php $__currentLoopData = $performance_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $performance_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-12 mt-3">
            <h6><?php echo e($performance_type->name); ?></h6>
            <hr class="mt-0">
        </div>

        <?php $__currentLoopData = $performance_type->types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $types): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-4">
                <?php echo e($types->name); ?>

            </div>
            <div class="col-4">
                <fieldset id='demo' class="rate">
                    <input class="stars" type="radio" id="technical-5*-<?php echo e($types->id); ?>"
                        name="ratings[<?php echo e($types->id); ?>]" value="5"
                        <?php echo e(isset($ratings[$types->id]) && $ratings[$types->id] == 5 ? 'checked' : ''); ?> disabled>
                    <label class="full" for="technical-5*-<?php echo e($types->id); ?>" title="Awesome - 5 stars"></label>
                    <input class="stars" type="radio" id="technical-4*-<?php echo e($types->id); ?>"
                        name="ratings[<?php echo e($types->id); ?>]" value="4"
                        <?php echo e(isset($ratings[$types->id]) && $ratings[$types->id] == 4 ? 'checked' : ''); ?> disabled>
                    <label class="full" for="technical-4*-<?php echo e($types->id); ?>" title="Pretty good - 4 stars"></label>
                    <input class="stars" type="radio" id="technical-3*-<?php echo e($types->id); ?>"
                        name="ratings[<?php echo e($types->id); ?>]" value="3"
                        <?php echo e(isset($ratings[$types->id]) && $ratings[$types->id] == 3 ? 'checked' : ''); ?> disabled>
                    <label class="full" for="technical-3*-<?php echo e($types->id); ?>" title="Meh - 3 stars"></label>
                    <input class="stars" type="radio" id="technical-2*-<?php echo e($types->id); ?>"
                        name="ratings[<?php echo e($types->id); ?>]" value="2"
                        <?php echo e(isset($ratings[$types->id]) && $ratings[$types->id] == 2 ? 'checked' : ''); ?> disabled>
                    <label class="full" for="technical-2*-<?php echo e($types->id); ?>" title="Kinda bad - 2 stars"></label>
                    <input class="stars" type="radio" id="technical-1*-<?php echo e($types->id); ?>"
                        name="ratings[<?php echo e($types->id); ?>]" value="1"
                        <?php echo e(isset($ratings[$types->id]) && $ratings[$types->id] == 1 ? 'checked' : ''); ?> disabled>
                    <label class="full" for="technical-1*-<?php echo e($types->id); ?>"
                        title="Sucks big time - 1 star"></label>
                </fieldset>
            </div>
            <div class="col-4">
                <fieldset id='demo1' class="rate">
                    <input class="stars" type="radio" id="technical-5-<?php echo e($types->id); ?>"
                        name="rating[<?php echo e($types->id); ?>]" value="5" />
                    <label class="full" for="technical-5-<?php echo e($types->id); ?>" title="Awesome - 5 stars"></label>
                    <input class="stars" type="radio" id="technical-4-<?php echo e($types->id); ?>"
                        name="rating[<?php echo e($types->id); ?>]" value="4" />
                    <label class="full" for="technical-4-<?php echo e($types->id); ?>" title="Pretty good - 4 stars"></label>
                    <input class="stars" type="radio" id="technical-3-<?php echo e($types->id); ?>"
                        name="rating[<?php echo e($types->id); ?>]" value="3" />
                    <label class="full" for="technical-3-<?php echo e($types->id); ?>" title="Meh - 3 stars"></label>
                    <input class="stars" type="radio" id="technical-2-<?php echo e($types->id); ?>"
                        name="rating[<?php echo e($types->id); ?>]" value="2" />
                    <label class="full" for="technical-2-<?php echo e($types->id); ?>" title="Kinda bad - 2 stars"></label>
                    <input class="stars" type="radio" id="technical-1-<?php echo e($types->id); ?>"
                        name="rating[<?php echo e($types->id); ?>]" value="1" />
                    <label class="full" for="technical-1-<?php echo e($types->id); ?>"
                        title="Sucks big time - 1 star"></label>
                </fieldset>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH /home/u743445510/domains/graymatterworks.com/public_html/ems/resources/views/appraisal/star.blade.php ENDPATH**/ ?>