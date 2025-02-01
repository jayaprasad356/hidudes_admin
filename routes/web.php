<?php

use App\Http\Controllers\AamarpayController;
use App\Models\Employee;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\WithdrawalsController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppsettingsController;
use App\Http\Controllers\CoinsController;
use App\Http\Controllers\UserCallsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SpeechTextController;
use App\Http\Controllers\UsersVerificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AvatarsController;
use App\Http\Controllers\GiftsController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\IncomeTypeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\AttendanceEmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\AccountListController;
use App\Http\Controllers\AiTemplateController;
use App\Http\Controllers\TimeSheetController;
use App\Http\Controllers\SetSalaryController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\AwardTypeController;
use App\Http\Controllers\TerminationController;
use App\Http\Controllers\TerminationTypeController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\PaySlipController;
use App\Http\Controllers\ResignationController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\WarningController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PayeesController;
use App\Http\Controllers\PayerController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\TransferBalanceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanRequestController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\DucumentUploadController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\AppraisalController;
use App\Http\Controllers\GoalTypeController;
use App\Http\Controllers\GoalTrackingController;
use App\Http\Controllers\CompanyPolicyController;
use App\Http\Controllers\TrainingTypeController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\JobStageController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\CustomQuestionController;
use App\Http\Controllers\InterviewScheduleController;
use App\Http\Controllers\LandingPageSectionController;
use App\Http\Controllers\PaystackPaymentController;
use App\Http\Controllers\FlutterwavePaymentController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\PaytmPaymentController;
use App\Http\Controllers\MercadoPaymentController;
use App\Http\Controllers\MolliePaymentController;
use App\Http\Controllers\SkrillPaymentController;
use App\Http\Controllers\CoingatePaymentController;
use App\Http\Controllers\PaymentWallPaymentController;
use App\Http\Controllers\CompetenciesController;
use App\Http\Controllers\PerformanceTypeController;
use App\Http\Controllers\ZoomMeetingController;
use App\Http\Controllers\ContractTypeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\OtherPaymentController;
use App\Http\Controllers\SaturationDeductionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DeductionOptionController;
use App\Http\Controllers\LoanOptionController;
use App\Http\Controllers\AllowanceOptionController;
use App\Http\Controllers\BankTransferController;
use App\Http\Controllers\BenefitPaymentController;
use App\Http\Controllers\BiometricAttendanceController;
use App\Http\Controllers\CashfreeController;
use App\Http\Controllers\CinetPayController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\FedapayController;
use App\Http\Controllers\IyziPayController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\NepalstePaymnetController;
use App\Http\Controllers\NotificationTemplatesController;
use App\Http\Controllers\PaiementProController;
use App\Http\Controllers\PayfastController;
use App\Http\Controllers\PayHereController;
use App\Http\Controllers\PayslipTypeController;
use App\Http\Controllers\PaytabController;
use App\Http\Controllers\PaytrController;
use App\Http\Controllers\ReferralProgramController;
use App\Http\Controllers\SspayController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\ToyyibpayPaymentController;
use App\Http\Controllers\XenditPaymentController;
use App\Http\Controllers\YooKassaController;
use Illuminate\Support\Facades\Artisan;

// use App\Http\Controllers\PlanRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard.dashboard');
// })->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';

Route::get('/check', [HomeController::class, 'check'])->middleware(
    [
        'auth',
        'XSS',
    ]
);
// Route::get('/password/resets/{lang?}', 'Auth\LoginController@showLinkRequestForm')->name('change.langPass');

// Redirect from the root to the login page
Route::get('/', function () {
    return redirect()->route('login');
})->name('home')->middleware(['XSS']);

// cookie consent
Route::any('/cookie-consent', [SettingsController::class, 'CookieConsent'])->name('cookie-consent');

Route::group(['middleware' => ['verified']], function () {



    Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'XSS'])->name('dashboard');
    // Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(
    //     [
    //         'auth',
    //         'XSS',
    //     ]
    // );
    Route::get('/home/getlanguvage', [HomeController::class, 'getlanguvage'])->name('home.getlanguvage');

    Route::group(
        [
            'middleware' => [
                'auth',
                'XSS',
            ],
        ],
        function () {

            Route::resource('settings', SettingsController::class);
            Route::post('email-settings', [SettingsController::class, 'saveEmailSettings'])->name('email.settings');
            Route::post('company-settings', [SettingsController::class, 'saveCompanySettings'])->name('company.settings');
            Route::post('payment-settings', [SettingsController::class, 'savePaymentSettings'])->name('payment.settings');
            Route::post('system-settings', [SettingsController::class, 'saveSystemSettings'])->name('system.settings');

            // Google Calendar
            Route::post('setting/google-calender', [SettingsController::class, 'saveGoogleCalenderSettings'])->name('google.calender.settings')->middleware(['auth', 'XSS']);
            Route::any('event/get_event_data', [EventController::class, 'get_event_data'])->name('event.get_event_data')->middleware(['auth', 'XSS']);
            Route::any('event/export-event', [EventController::class, 'export_event'])->name('event.export-event')->middleware(['auth', 'XSS']);

            // SEO Settings
            Route::post('setting/seo-setting', [SettingsController::class, 'SeoSettings'])->name('seo.settings')->middleware(['auth', 'XSS']);

            // cache Settings
            Route::post('setting/cache-setting', [SettingsController::class, 'CacheSettings'])->name('clear.cache')->middleware(['auth', 'XSS']);

            // cookie consent
            Route::post('cookie-setting', [SettingsController::class, 'saveCookieSettings'])->name('cookie.setting')->middleware(['auth', 'XSS']);


            Route::get('company-setting', [SettingsController::class, 'companyIndex'])->name('company.setting');
            Route::post('company-email-setting/{name?}', [EmailTemplateController::class, 'updateStatus'])->name('company.email.setting');
            // Route::post('company-email-setting/{name}', 'EmailTemplateController@updateStatus')->name('status.email.language')->middleware(['auth']);

            Route::post('pusher-settings', [SettingsController::class, 'savePusherSettings'])->name('pusher.settings');
            Route::post('business-setting', [SettingsController::class, 'saveBusinessSettings'])->name('business.setting');

            Route::post('zoom-settings', [SettingsController::class, 'zoomSetting'])->name('zoom.settings');

            // Route::get('test-mail', [SettingsController::class, 'testMail'])->name('test.mail');
            Route::any('test-mail', [SettingsController::class, 'testMail'])->name('test.mail');
            Route::post('test-mail/send', [SettingsController::class, 'testSendMail'])->name('test.send.mail');

            Route::get('create/ip', [SettingsController::class, 'createIp'])->name('create.ip');
            Route::post('create/ip', [SettingsController::class, 'storeIp'])->name('store.ip');
            Route::get('edit/ip/{id}', [SettingsController::class, 'editIp'])->name('edit.ip');
            Route::post('edit/ip/{id}', [SettingsController::class, 'updateIp'])->name('update.ip');
            Route::delete('destroy/ip/{id}', [SettingsController::class, 'destroyIp'])->name('destroy.ip');

            Route::get('create/webhook', [SettingsController::class, 'createWebhook'])->name('create.webhook');
            Route::post('create/webhook', [SettingsController::class, 'storeWebhook'])->name('store.webhook');
            Route::get('edit/webhook/{id}', [SettingsController::class, 'editWebhook'])->name('edit.webhook');
            Route::post('edit/webhook/{id}', [SettingsController::class, 'updateWebhook'])->name('update.webhook');
            Route::delete('destroy/webhook/{id}', [SettingsController::class, 'destroyWebhook'])->name('destroy.webhook');
        }
    );


    // Email Templates
    Route::get('email_template_lang/{id}/{lang?}', [EmailTemplateController::class, 'manageEmailLang'])->name('manage.email.language')->middleware(['auth', 'XSS']);
    Route::post('email_template_store/{pid}', [EmailTemplateController::class, 'storeEmailLang'])->name('store.email.language')->middleware(['auth']);
    Route::post('email_template_status/{id}', [EmailTemplateController::class, 'updateStatus'])->name('status.email.language')->middleware(['auth']);

    Route::resource('email_template', EmailTemplateController::class)->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::resource('email_template_lang', EmailTemplateLangController::class)->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::get(
        '/test',

        [SettingsController::class, 'testEmail']
    )->name('test.email')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    Route::post(
        '/test/send',
        [SettingsController::class, 'testEmailSend']

    )->name('test.email.send')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
    // End

    Route::middleware(['auth'])->group(function () {
        Route::resource('avatars', AvatarsController::class);
    });
    Route::resource('avatar', AvatarsController::class);
    Route::resource('speech_texts', SpeechTextController::class);
    Route::get('news/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('news/update', [NewsController::class, 'update'])->name('news.update');
    Route::get('appsettings/edit', [AppsettingsController::class, 'edit'])->name('appsettings.edit');
    Route::put('appsettings/update', [AppsettingsController::class, 'update'])->name('appsettings.update');
    Route::resource('users', UsersController::class);
    Route::post('/users-verification/update-status', [UsersVerificationController::class, 'updateStatus'])->name('users-verification.updateStatus');
    Route::get('/users-verification', [UsersVerificationController::class, 'index'])->name('users-verification.index');
    Route::post('/coins/update-status', [CoinsController::class, 'updateStatus'])->name('coins.updateStatus');
    // Route::get('/coins', [CoinsController::class, 'index'])->name('coins.index');
    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');
    Route::get('/withdrawals', [WithdrawalsController::class, 'index'])->name('withdrawals.index');
    Route::get('/ratings', [RatingsController::class, 'index'])->name('ratings.index');
    Route::get('/usercalls', [UserCallsController::class, 'index'])->name('usercalls.index');
    Route::patch('/withdrawals/bulk-update-status', [WithdrawalsController::class, 'bulkUpdateStatus'])->name('withdrawals.bulkUpdateStatus');
    Route::patch('/withdrawals/bulk-cancel', [WithdrawalsController::class, 'bulkCancelStatus'])->name('withdrawals.bulkCancelStatus');
    Route::get('withdrawals/export', [WithdrawalsController::class, 'export'])->name('withdrawals.export');
    Route::resource('coins', CoinsController::class);
    Route::resource('withdrawals', WithdrawalsController::class);
    Route::resource('gifts', GiftsController::class);
    // In routes/web.php
Route::put('withdrawals/{id}', [WithdrawalsController::class, 'update'])->name('withdrawals.update');
    Route::resource('notifications', NotificationsController::class);
    Route::resource('withdrawals', WithdrawalsController::class);
    Route::get('users/{id}/add-coins', [UsersController::class, 'showAddCoinsForm'])->name('users.addCoinsForm');
    Route::get('users/{id}/add-balance', [UsersController::class, 'showAddBalanceForm'])->name('users.addBalanceForm');
    Route::post('/usercalls/update-user', [UserCallsController::class, 'updateuser'])->name('usercalls.updateuser');

    // Route to handle the "Add Coins" form submission
    Route::post('users/{id}/add-coins', [UsersController::class, 'addCoins'])->name('users.addCoins');  
    Route::post('users/{id}/add-balance', [UsersController::class, 'addBalance'])->name('users.addBalance');
    Route::get('/search-users', [NotificationsController::class, 'searchUsers'])->name('search.users');
    Route::get('/users/{id}', function ($id) {
        $user = \App\Models\Users::findOrFail($id);
        return response()->json($user);
    });
    
    Route::get('profile', [UserController::class, 'profile'])->name('profile')->middleware(
        [
            'auth',
            'XSS',
        ]
    );

    Route::post('edit-profile', [UserController::class, 'editprofile'])->name('update.account')->middleware(
        [
            'auth',
            'XSS',
        ]
    );
   
 
    // cache
    Route::get('/config-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('optimize:clear');
        return redirect()->back()->with('success', 'Cache Clear Successfully');
    })->name('config.cache');
});
