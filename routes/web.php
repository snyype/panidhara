<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Metercontroller;
use App\Http\Controllers\Carouselcontroller;
use App\Http\Controllers\newconnectioncontroller;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\PaymentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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



Route::namespace('App\Http\Controllers')->group(function () 
{
    Route::group(['middleware'=>'auth'],function (){
        Route::get('/request-now/{id}',[newconnectioncontroller::class, 'reqNewConnection']);
        
    });

    Route::group(['middleware'=>'auth'],function (){
        Route::get('/notifications',[FrontendController::class, 'NotificationActions']);
        
    });
    Route::get('/notification-read/{id}','FrontendController@NotificationRead');

    Route::get('/','FrontendController@index')->middleware('verified');
    Route::get('logout', '\App\Http\Controllers\Auth\AuthenticatedSessionController@logout')->middleware('verified');
    Route::get('/user','HomeController@UserDetails')->middleware('verified');
    Route::post('/update-profile/{id}','HomeController@Update')->middleware('verified');
    Route::get('/proceed','newconnectionController@RequestConnection')->middleware('verified');
    Route::get('/request-new-connection','FrontendController@newConnection')->middleware('verified');
    Route::get('/request-now/{id}','newconnectioncontroller@reqNewConnection')->middleware('verified');
    Route::get('/myrequests','FrontendController@myRequests')->middleware('verified');
    Route::get('/request-connection','FrontendController@CheckStatus')->middleware('verified');
    Route::get('/request-a-new-meter','MeterController@Meters')->middleware('verified');
    Route::post('/submit-form','newconnectionController@store')->middleware('verified');
    Route::get('/purchase-meter/{id}','MeterController@purchasemeter')->middleware('verified');
    Route::get('/maintainance','MeterController@maintanance')->middleware('verified');
    Route::get('/mymeter','MeterController@mymeter')->middleware('verified');
    Route::post('/submitmaintainance','MeterController@storemaintainance')->middleware('verified');
    Route::post('/khalti/payment/verify',[PaymentController::class,'verifyPayment'])->name('khalti.verifyPayment')->middleware('verified');
    Route::post('/khalti/payment/verify/cleardue',[PaymentController::class,'verifyPaymentForDue'])->name('khalti.verifyPaymentForDue')->middleware('verified');
    Route::post('/khalti/payment/store',[PaymentController::class,'storePayment'])->name('khalti.storePayment')->middleware('verified');
    Route::get('/request-now/thankyou',[PaymentController::class,'thankyou'])->name('khalti.success')->middleware('verified');

   
     
      
      
    
});


Route::group(['prefix'=>'admin','middleware'=>'admin','middleware'=>'verified'],function (){
    Route::get('/',[FrontendController::class, 'dashboard']);
    Route::group(['prefix'=>'carousel','middleware'=>'auth'],function (){
        
        Route::get('/',[CarouselController::class, 'index']);
        Route::get('/create',[CarouselController::class, 'create']);
        Route::post('/',[CarouselController::class, 'store']);
        Route::get('/{id}/edit',[CarouselController::class, 'edit']);
        Route::post('/{id}',[CarouselController::class, 'update']);
        Route::delete('/{id}',[CarouselController::class, 'destroy']);
    });

    Route::group(['prefix'=>'meter','middleware'=>'auth'],function (){
        Route::get('/',[MeterController::class, 'adminview']);
        Route::get('/create',[MeterController::class, 'create']);
        Route::post('/',[MeterController::class, 'store']);
        Route::get('/{id}/edit',[MeterController::class, 'edit']);
        Route::post('/{id}',[MeterController::class, 'update']);
        Route::delete('/{id}',[MeterController::class, 'destroy']);
    });

    Route::group(['prefix'=>'userstable','middleware'=>'auth'],function (){
        Route::get('/',[UserController::class, 'index']);
        Route::get('/userdetails/{id}',[UserController::class, 'userdetails']);
        Route::get('/create',[UserController::class, 'create']);
        Route::post('/',[UserController::class, 'store']);
        Route::get('/{id}/edit',[UserController::class, 'edit']);
        Route::post('/{id}',[UserController::class, 'update']);
        Route::delete('/{id}',[UserController::class, 'destroy']);
    });


   
    Route::group(['prefix'=>'testimony','middleware'=>'auth'],function (){
        Route::get('/',[TestimonyController::class, 'index']);
        Route::get('/create',[TestimonyController::class, 'create']);
        Route::post('/',[TestimonyController::class, 'store']);
        Route::get('/{id}/edit',[TestimonyController::class, 'edit']);
        Route::post('/{id}',[TestimonyController::class, 'update']);

    });

    

    Route::group(['prefix'=>'connectionrequest','middleware'=>'auth'],function (){
        Route::get('/',[newconnectionController::class, 'ShowNewConn']);
        Route::get('/{id}/{user_id}',[newconnectionController::class, 'UpdatConnStatus']);

    });

    Route::group(['prefix'=>'confirmedconnectionrequest','middleware'=>'auth'],function (){
        Route::get('/',[newconnectionController::class, 'ShowConfirmedConn']);
        Route::get('/changetopending/{id}/{user_id}',[newconnectionController::class, 'ChangeToPending']);
        

    });

    Route::group(['prefix'=>'maintanance','middleware'=>'auth'],function (){
        Route::get('/',[MeterController::class, 'maintananceview']);
        

    });

    Route::group(['prefix'=>'viewmap','middleware'=>'auth'],function (){
        Route::get('/{id}',[MeterController::class, 'ViewMap']);
        

    });

    Route::group(['prefix'=>'viewconnectionmap','middleware'=>'auth'],function (){
        Route::get('/{id}',[MeterController::class, 'ViewConnectionMap']);
        

    });
    
    Route::group(['prefix'=>'search-meter','middleware'=>'auth'],function (){
        Route::post('/',[MeterController::class, 'SearchMeter']);
        

    });

    Route::group(['prefix'=>'transaction','middleware'=>'auth'],function (){
        Route::get('/',[MeterController::class, 'ViewTransaction']);
        Route::get('/export-transaction',[MeterController::class, 'ExportTransaction']);
        Route::get('/view/invoice-details/{id}',[PaymentController::class, 'ViewInvoice']);
        

    });

    Route::group(['prefix'=>'search-transaction','middleware'=>'auth'],function (){
        Route::post('/',[MeterController::class, 'SearchTransaction']);
        

    });



});






Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
