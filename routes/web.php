<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\LoginController,
    FrontendController
};
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

Route::get('/',[FrontendController::class,'index']);
Route::get('event',[FrontendController::class,'event']);
Route::get('event/{slug}',[FrontendController::class,'eventSlug']);
Route::get('speaker',[FrontendController::class,'speaker']);
Route::get('news',[FrontendController::class,'news']);
Route::get('about-biid',[FrontendController::class,'about']);
Route::get('news/{slug}',[FrontendController::class,'newsSlug']);
Route::match(['get','post'],'registration-form',[FrontendController::class,'registration'])->name('registration-form');
Route::match(['get','post'],'contact-us',[FrontendController::class,'contact'])->name('contact-us');



// Socialite routes
Route::group(['as' => 'login.', 'prefix' => 'login', 'namespace' => 'Auth'], function () {
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('provider');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('callback');
});


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/{slug}', [FrontendController::class, 'singlePage']);










