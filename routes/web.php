<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\App;
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
// Login Azure
Route::get('/login', [AuthController::class, 'signIn']);
Route::get('/callback', [AuthController::class, 'callback']);
Route::get('/signout', [AuthController::class, 'signOut']);

// Signup
Route::post('/inschrijven', [ParticipantController::class, 'signup']);
Route::get('/inschrijven', function() {
    return redirect('/'); // Fix 405 error
});
Route::get('/', [ParticipantController::class, 'signupIndex']);
Route::get('/inschrijven/verify/{token}',[VerificationController::class,'verify']);

Route::get('/qrcode/{id}', [ParticipantController::class, 'generateQR']);

// Payment
Route::get('/inschrijven/betalen/success/{userId}', [PaymentController::class, 'returnSuccessPage'])->name('payment.success');
Route::get('/inschrijven/betalen/{token}',[ConfirmationController::class, 'confirmSignUpView']);
Route::post('/inschrijven/betalen/{token}',[ConfirmationController::class, 'confirm']);
Route::get('/inschrijven/betalen/paymentFailed', [PaymentController::class, 'returnSuccessPage']);

Route::post('webhooks/mollie',[WebhookController::class, 'handle'])->name('webhooks.mollie');
// Blogs / news
Route::get('/blogs',[BlogController::class, 'showPosts']);
Route::get('/blogs/{postId}',[BlogController::class, 'showPost']);

// AzureAuth group
Route::middleware(['AzureAuth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //Registrations
    Route::get('/registrations', [RegistrationController::class, 'getRegistrationsWithInformation']);
    Route::post('/registrations', [ConfirmationController::class, 'sendConfirmEmailToAllUsers']);

    // Participants
    Route::get('/participants', [ParticipantController::class, 'getParticipantsWithInformation']);
    Route::get('/participants/{userId}/get', [ParticipantController::class, 'getParticipant']);
    Route::get('/participants/{userId}', [ParticipantController::class, 'getParticipantsWithInformation']);
    Route::post('/participants/{userId}/checkIn', [ParticipantController::class, 'checkIn']);
    Route::post('/participants/{userId}/checkOut', [ParticipantController::class, 'checkOut']);
    Route::post('/participants/{userId}/delete', [ParticipantController::class, 'delete']);
    Route::get('/add', [ParticipantController::class, 'viewAdd']);
    Route::post('/add/store', [ParticipantController::class, 'store']);
    Route::get('/participantscheckedin', [ParticipantController::class, 'checkedInView']);
    Route::get('/participantscheckedin/{userId}', [ParticipantController::class, 'checkedInView']);

    // Posts / blogs
    Route::get('/blogsadmin',[BlogController::class, 'showPostsAdmin']);
    Route::get('/blogsadmin/save',[BlogController::class, 'showPostInputs']);
    Route::post('/blogsadmin/save',[BlogController::class, 'savePost']);
        //  Update blogs / posts
    Route::get('/blogsadmin/save/{blogId}',[BlogController::class, 'showPostInputs']);
    Route::post('/blogsadmin/save/{blogId}',[BlogController::class, 'savePost']);
        // Delete blogs
    Route::get('/blogsadmin/delete/{blogId}',[BlogController::class, 'deletePost']);

    // Bus
    Route::get('/bus', [BusController::class, 'index']);
    Route::post('/bus/add', [BusController::class, 'addBusses']);
    Route::post('/bus/reset', [BusController::class, 'resetBusses']);
    Route::post('/bus/addBusNumber', [BusController::class, 'addBusNumber']);
    Route::post('/bus/addPersons', [BusController::class, 'addPersonsToBus']);

    // Excel
    Route::get('/export_excel/excel', [ParticipantController::class, 'excel'])->name('export_excel.excel');

    // Api
    Route::get('/import', [APIController::class, 'GetParticipants']);
});
