<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Metercontroller;
use App\Http\Controllers\Carouselcontroller;
use App\Http\Controllers\newconnectioncontroller;

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
   

    Route::get('/','FrontendController@index');
    Route::get('logout', '\App\Http\Controllers\Auth\AuthenticatedSessionController@logout');
    Route::get('/user','HomeController@UserDetails');
    Route::post('/update-profile/{id}','HomeController@Update');
    Route::get('/proceed','newconnectionController@RequestConnection');
    Route::get('/request-new-connection','FrontendController@newConnection');
    Route::get('/request-now','newconnectioncontroller@reqNewConnection');
    Route::get('/myrequests','FrontendController@myRequests');
    Route::get('/request-connection','FrontendController@CheckStatus');
    Route::get('/request-a-new-meter','MeterController@Meters');
    Route::post('/submit-form','newconnectionController@store');
   
     
      
      
    
});


Route::group(['prefix'=>'admin','middleware'=>'admin'],function (){
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
});








Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
