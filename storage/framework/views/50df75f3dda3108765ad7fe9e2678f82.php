<?php
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $setting = App\Models\Utility::colorset();
    $color = !empty($setting['theme_color']) ? $setting['theme_color'] : 'theme-3';
    $SITE_RTL = \App\Models\Utility::getValByName('SITE_RTL');
    $company_logo_light = \App\Models\Utility::getValByName('company_logo_light');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    
    $getseo = App\Models\Utility::getSeoSetting();
    $metatitle = isset($getseo['meta_title']) ? $getseo['meta_title'] : '';
    $metadesc = isset($getseo['meta_description']) ? $getseo['meta_description'] : '';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image']) ? $getseo['meta_image'] : '';
    $enable_cookie = \App\Models\Utility::getCookieSetting('enable_cookie');

    if (isset($setting['color_flag']) && $setting['color_flag'] == 'true') {
        $themeColor = 'custom-color';
    } else {
        $themeColor = $color;
    }
    
?>

<!DOCTYPE html>

<html lang="en">
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($SITE_RTL == 'on' ? 'rtl' : ''); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        <?php echo e(!empty($companySettings['title_text']) ? $companySettings['title_text']->value : config('app.name', 'HRMGo SaaS')); ?>

        - <?php echo e(__('Career')); ?></title>

    <!-- SEO META -->
    <meta name="title" content="<?php echo e($metatitle); ?>">
    <meta name="description" content="<?php echo e($metadesc); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:title" content="<?php echo e($metatitle); ?>">
    <meta property="og:description" content="<?php echo e($metadesc); ?>">
    <meta property="og:image"
        content="<?php echo e(isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : 'hrmgo.png'); ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:title" content="<?php echo e($metatitle); ?>">
    <meta property="twitter:description" content="<?php echo e($metadesc); ?>">
    <meta property="twitter:image"
        content="<?php echo e(isset($meta_logo) && !empty(asset('storage/uploads/meta/' . $meta_logo)) ? asset('storage/uploads/meta/' . $meta_logo) : 'hrmgo.png'); ?>">


    <link rel="icon"
        href="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon .'?'.time() : 'favicon.png' .'?'.time())); ?>"
        type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/site.css')); ?>" id="stylesheet">
    <?php if(isset($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-dark.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>"id="main-style-link">
    <?php endif; ?>

    <?php if(isset($setting['cust_darklayout']) && $setting['cust_darklayout'] == 'on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom-dark.css')); ?>">
    <?php endif; ?>

    <style>
        :root {
            --color-customColor: <?=$color ?>;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('css/custom-color.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body class="<?php echo e($themeColor); ?>">
    <div class="job-wrapper">
        <div class="job-content">
            <nav class="navbar">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="<?php echo e($logo . '/' . (isset($company_logo_light) && !empty($company_logo_light) ? $company_logo_light .'?'.time() : 'logo-light.png' .'?'.time())); ?>"
                            alt="logo" style="width: 90px">
                    </a>
                </div>
            </nav>
            <section class="job-banner">
                <div class="job-banner-bg">
                    <img src="<?php echo e(asset('/storage/uploads/job/banner.png')); ?>" alt="">
                </div>
                <div class="container">
                    <div class="job-banner-content text-center text-white">
                        <h1 class="text-white mb-3">
                            <?php echo e(__(' We help')); ?> <br> <?php echo e(__('businesses grow')); ?>

                        </h1>
                        <p><?php echo e(__('Work there. Find the dream job you’ve always wanted..')); ?></p>
                    </div>
                </div>
            </section>
            <section class="placedjob-section">
                <div class="container">
                    <div class="section-title bg-light">
                        <?php
                            $totaljob = \App\Models\Job::where('created_by', '=', $id)->count();
                        ?>

                        <h2 class="h1 mb-3"> <span class="text-primary">+<?php echo e($totaljob); ?>

                            </span><?php echo e(__('Job openings')); ?></h2>
                        <p><?php echo e(__('Always looking for better ways to do things, innovate')); ?> <br>
                            <?php echo e(__('and help people achieve their goals')); ?>.</p>
                    </div>
                    <div class="row g-4">
                        <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 job-card">
                                <div class="job-card-body">
                                    <div class="d-flex mb-3 align-items-center justify-content-between ">
                                        <img src="<?php echo e(asset('/storage/uploads/job/figma.png')); ?>" alt="">
                                        <?php if(!empty($job->branches) ? $job->branches->name : ''): ?>
                                            <span><?php echo e(!empty($job->branches) ? $job->branches->name : ''); ?> <i
                                                    class="ti ti-map-pin ms-1"></i></span>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="mb-3">
                                        <a href="<?php echo e(route('job.requirement', [$job->code, !empty($job) ? (!empty($job->createdBy->lang) ? $job->createdBy->lang : 'en') : 'en'])); ?>"
                                            class="text-dark"><?php echo e($job->title); ?></a>
                                    </h5>
                                    <div
                                        class="d-flex mb-3 align-items-start flex-column flex-xl-row flex-md-row flex-lg-column">
                                        <span class="d-inline-block me-2"> <i class="ti ti-circle-plus "></i>
                                            <?php echo e($job->position); ?> <?php echo e(__('position available')); ?></span>
                                    </div>

                                    <div class="d-flex flex-wrap gap-1 align-items-center">
                                        <?php $__currentLoopData = explode(',', $job->skill); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="badge rounded  p-2 bg-primary"><?php echo e($skill); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>

                                    <a href="<?php echo e(route('job.requirement', [$job->code, !empty($job) ? (!empty($job->createdBy->lang) ? $job->createdBy->lang : 'en') : 'en'])); ?>"
                                        class="btn btn-primary w-100 mt-4"><?php echo e(__('Read more')); ?></a>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </section>
        </div>
    </div>
</body>


<script src="<?php echo e(asset('assets/js/plugins/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/perfect-scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/plugins/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/site.core.js')); ?>"></script>
<script src="<?php echo e(asset('js/site.js')); ?>"></script>
<script src="<?php echo e(asset('js/demo.js')); ?> "></script>

<?php echo $__env->yieldPushContent('custom-scripts'); ?>
    <?php if($enable_cookie['enable_cookie'] == 'on'): ?>
        <?php echo $__env->make('layouts.cookie_consent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\payroll\resources\views/job/career.blade.php ENDPATH**/ ?>