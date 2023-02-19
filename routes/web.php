<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['GlobalMiddleware'])->group(function () {
    // Login Azure
    Route::get('/login', [AuthController::class, 'signIn']);
    Route::get('/callback', [AuthController::class, 'callback']);
    Route::get('/signout', [AuthController::class, 'signOut']);

    // Signup
    Route::post('/inschrijven', [ParticipantController::class, 'signup']);
    Route::get('/inschrijven', function() {
        return redirect('/'); // Fix 405 error
    });

    Route::get('/', [ParticipantController::class, 'view']);

    Route::get('/inschrijven/verify/{token}',[VerificationController::class,'verify']);

    // Payment
    Route::get('/inschrijven/betalen/success/{userId}', [PaymentController::class, 'returnSuccessPage'])->name('payment.success');
    Route::get('/inschrijven/betalen/{token}',[ConfirmationController::class, 'confirmSignUpView']);
    Route::post('/inschrijven/betalen/{token}',[ConfirmationController::class, 'confirm']);
    Route::get('/inschrijven/betalen/paymentFailed', [PaymentController::class, 'returnSuccessPage']);

    Route::post('webhooks/mollie',[WebhookController::class, 'handle'])->name('webhooks.mollie');

    // Blogs / news
    Route::get('/blogs',[BlogController::class, 'showBlogs']);
    Route::get('/blogs/{blogId}',[BlogController::class, 'showBlog']);

    // Schedule qr pagina
    Route::get('/qr-code', [ScheduleController::class, 'index']);

    // AzureAuth group
    Route::middleware(['AzureAuth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);

        //Registrations
        Route::get('/registrations', [RegistrationController::class, 'getRegistrationsWithInformation']);
        Route::post('/registrations', [ConfirmationController::class, 'sendConfirmEmailToAllUsers']);

        // Participants
        Route::get('/participants/{userId}/get', [ParticipantController::class, 'getParticipant']);
        Route::get('/participants', [ParticipantController::class, 'getParticipantsWithInformation']);
        Route::get('/participants/{userId}', [ParticipantController::class, 'getParticipantsWithInformation']);
        Route::post('/participants/{userId}/checkIn', [ParticipantController::class, 'checkIn']);
        Route::post('/participants/{userId}/checkOut', [ParticipantController::class, 'checkOut']);
        Route::post('/participants/{userId}/delete', [ParticipantController::class, 'delete']);
        Route::post('/participants/{userId}/storeEdit', [ParticipantController::class,'storeEdit']);
        Route::post('/participants/checkOutEveryone', [ParticipantController::class,'checkOutEveryone']);
        Route::post('/participants/resendVerificationEmails', [ParticipantController::class, 'sendEmailsToNonVerified']);
        Route::post('/participants/resendQRcode', [ParticipantController::class, 'resendQRCodeEmails']);
        Route::post('/participants/resendQRcodeNonParticipants', [ParticipantController::class, 'sendQRCodesToNonParticipants']);
        Route::post('/participants/{userId}/sendConfirmationEmail', [ParticipantController::class, 'sendParticipantConfirmationEmail']);
        Route::post('/participants/{userId}/activity/add',[ParticipantController::class,'addActivity']);
        Route::post('/participants/{userId}/activity/{activityId}/del',[ParticipantController::class,'removeActivity']);

        Route::get('/add', [ParticipantController::class, 'viewAdd']);
        Route::post('/add/store', [ParticipantController::class, 'storeSelfAddedParticipant']);
        Route::get('/participantscheckedin', [ParticipantController::class, 'checkedInView']);
        Route::get('/participantscheckedin/{userId}', [ParticipantController::class, 'checkedInView']);

        // QRCode
        Route::get('/qrcode', function () {
            return view('admin/qr');
        });

        // Posts / blogs
        Route::get('/blogsadmin',[BlogController::class, 'showBlogsAdmin']);
        Route::get('/blogsadmin/save',[BlogController::class, 'showBlogInputs']);
        Route::post('/blogsadmin/save',[BlogController::class, 'saveBlog']);

        //  Update blogs / posts
        Route::get('/blogsadmin/save/{blogId}',[BlogController::class, 'showBlogInputs']);
        Route::post('/blogsadmin/save/{blogId}',[BlogController::class, 'saveBlog']);
        // Delete blogs
        Route::get('/blogsadmin/delete/{blogId}',[BlogController::class, 'deleteBlog']);

        // Events
        Route::get('/events', [ScheduleController::class, 'getAllEvents']);
        Route::get('/events/save',[ScheduleController::class, 'showEventInputs']);
        Route::post('/events/save',[ScheduleController::class, 'saveEvent']);
        //  Update events
        Route::get('/events/save/{eventId}',[ScheduleController::class, 'showEventInputs']);
        Route::post('/events/save/{eventId}',[ScheduleController::class, 'store']);
        // Delete events
        Route::get('/events/delete/{eventId}',[ScheduleController::class, 'deleteEvent']);

        // Settings
        Route::get('/settings',[SettingController::class, 'showSettings']);
        Route::post('/settings/{settingId}/store',[SettingController::class, 'storeSetting']);

        // Logs
        Route::get('/logs',[AuditLogController::class,'index']);

        // Activities
        Route::get('/activities',[ActivityController::class,'view']);
        Route::get('/activities/create',[ActivityController::class, 'showCreatePage']);
        Route::post('/activities/create/save',[ActivityController::class, 'store']);
        Route::post('/activities/delete/{activityId}', [ActivityController::class, 'delete']);
        Route::get('/activities/update/{activityId}',[ActivityController::class, 'showCreatePage']);
        Route::post('/activities/update/{activityId}',[ActivityController::class, 'update']);

        // ReserveList
        Route::post('/participants/reserveList/{userId}', [ParticipantController::class, 'changeReserveList']);
    });
});
