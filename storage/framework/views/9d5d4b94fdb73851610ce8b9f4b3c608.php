<?php

    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_logo = \App\Models\Utility::GetLogo();
    $companys = \App\Models\Utility::GetLogo();
    $user = \Auth::user();
    $profile = \App\Models\Utility::get_file('uploads/avatar/');
  
    $emailTemplate = App\Models\EmailTemplate::getemailTemplate();
    $lang = Auth::user()->lang;
?>

<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
    <?php else: ?>
        <nav class="dash-sidebar light-sidebar">
<?php endif; ?>



<div class="navbar-wrapper">
    <div class="m-header main-logo">
        <a href="<?php echo e(route('dashboard')); ?>" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <img src="<?php echo e(asset('storage/uploads/logo/hima.png')); ?>" alt="Logo"
                alt="<?php echo e(config('app.name', 'HRMGo')); ?>" class="logo logo-lg" style="height: 50px;">
        </a>
    </div>
    <div class="navbar-content">
        <ul class="dash-navbar">

            <!-- dashboard-->
                <li class="dash-item">
                    <a href="<?php echo e(route('dashboard')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-home"></i></span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span></a>
                </li>
        
            
            <li class="dash-item">
                    <a href="<?php echo e(route('users.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-users"></i></span><span class="dash-mtext"><?php echo e(__('users')); ?></span></a>
                </li>
            <!-- <li class="dash-item">
                    <a href="<?php echo e(route('avatar.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-user"></i></span><span class="dash-mtext"><?php echo e(__('Avatar')); ?></span></a>
                </li> -->
                <li class="dash-item">
                    <a href="<?php echo e(route('speech_texts.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-file"></i></span><span class="dash-mtext"><?php echo e(__('Speech Texts')); ?></span></a>
                </li>
                <li class="dash-item">
                    <a href="<?php echo e(route('news.edit')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-settings"></i></span><span class="dash-mtext"><?php echo e(__('Settings')); ?></span></a>
                </li>
                <li class="dash-item">
                    <a href="<?php echo e(route('appsettings.edit')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-settings"></i></span><span class="dash-mtext"><?php echo e(__('App Settings')); ?></span></a>
                </li>
                <li class="dash-item">
                    <a href="<?php echo e(route('coins.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                class="ti ti-coin"></i></span><span class="dash-mtext"><?php echo e(__('coins')); ?></span></a>
                </li>
                <li class="dash-item">
                <a href="<?php echo e(route('ratings.index')); ?>" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-star"></i> <!-- Icon for ratings -->
                    </span>
                    <span class="dash-mtext"><?php echo e(__('Ratings')); ?></span>
                </a>
                <li class="dash-item">
                <a href="<?php echo e(route('usercalls.index')); ?>" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-phone"></i> <!-- Icon for user calls -->
                    </span>
                    <span class="dash-mtext"><?php echo e(__('UserCalls')); ?></span>
                </a>

                </li>
                <li class="dash-item">
                <a href="<?php echo e(route('users-verification.index')); ?>" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-user-check"></i> <!-- Icon for verifying users -->
                    </span>
                    <span class="dash-mtext"><?php echo e(__('userVerifications')); ?></span>
                </a>
                <li class="dash-item">
                <a href="<?php echo e(route('transactions.index')); ?>" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-credit-card"></i> <!-- Icon for transactions -->
                    </span>
                    <span class="dash-mtext"><?php echo e(__('Transactions')); ?></span>
                </a>
                <li class="dash-item">
                <a href="<?php echo e(route('withdrawals.index')); ?>" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-wallet"></i> <!-- Icon for withdrawals -->
                    </span>
                    <span class="dash-mtext"><?php echo e(__('Withdrawals')); ?></span>
                </a>
                </li>
                <li class="dash-item">
                    <a href="<?php echo e(route('notifications.index')); ?>" class="dash-link">
                        <span class="dash-micon">
                            <i class="ti ti-bell"></i> <!-- Icon for notifications -->
                        </span>
                        <span class="dash-mtext"><?php echo e(__('Notifications')); ?></span>
                    </a>
                </li>
                <li class="dash-item">
                <a href="<?php echo e(route('gifts.index')); ?>" class="dash-link">
                    <span class="dash-micon">
                        <i class="ti ti-gift"></i> <!-- Icon for withdrawals -->
                    </span>
                    <span class="dash-mtext"><?php echo e(__('Gifts')); ?></span>
                </a>
                </li>
            <!--dashboard-->


     
            <!--------------------- Start System Setup ----------------------------------->

       

            <!--------------------- End System Setup ----------------------------------->
</ul>

</div>
</div>
</nav>
<?php /**PATH C:\xampp\htdocs\hima_admin_panel-1\resources\views/partial/Admin/menu.blade.php ENDPATH**/ ?>