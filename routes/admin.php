<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    RoleController,
    UserController,
    NewController,
    EventController,
    TestimonialController,
    SpeakerController,
    BannerController,
    SettingController,
    PageController,
    SliderController,
    RegistrationController,
    ContactController,
    ModularController
};

/*
|--------------------------------------------------------------------------
| Bbackend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register backend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "backend" middleware group. Now create something great!
|
*/

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Roles and Users
Route::resource('role', RoleController::class)->except(['show']);
Route::resource('user', UserController::class);

// Catelog Controller
Route::resource('news', NewController::class);
Route::resource('event', EventController::class);
Route::resource('testimonial', TestimonialController::class);
Route::resource('speaker', SpeakerController::class);

// Route::delete('banner/{banner}/media/{id}',[BannerController::class, 'getMediaImageDestroy'])->name('banner.media.destroy');
Route::resource('banner', BannerController::class);
Route::group(['as' => 'banner.', 'prefix' => 'banner/{id}/'], function () {
    Route::get('banner-list',[BannerController::class, 'addbanner'])->name('banner-list');
    Route::group(['as' => 'item.', 'prefix' => 'item'], function () {
        Route::get('/create-banner', [BannerController::class, 'itemCreate'])->name('create-banner');
        Route::post('/banner-store', [BannerController::class, 'itemStore'])->name('banner-store');
        Route::get('/{itemId}/edit-banner', [BannerController::class, 'itemEdit'])->name('edit-banner');
        Route::put('{itemId}/banner-update', [BannerController::class, 'itemUpdate'])->name('banner-update');
        Route::delete('/{itemId}/destroy-banner', [BannerController::class, 'itemDestroy'])->name('destroy-banner');
    });
});


Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
Route::patch('setting/appearance',[SettingController::class,'appearance'])->name('setting.appearance.update');
Route::patch('setting/social',[SettingController::class,'social'])->name('setting.social.update');
Route::patch('setting/socialite',[SettingController::class,'socialite'])->name('setting.socialite.update');
Route::patch('setting/mail',[SettingController::class,'mail'])->name('setting.mail.update');


Route::resource('slider', SliderController::class);
Route::group(['as' => 'slider.', 'prefix' => 'slider/{id}/'], function () {
    Route::get('slide-list',[SliderController::class, 'addSlide'])->name('slide-list');
    Route::group(['as' => 'item.', 'prefix' => 'item'], function () {
        Route::get('/create-slide', [SliderController::class, 'itemCreate'])->name('create-slide');
        Route::post('/slide-store', [SliderController::class, 'itemStore'])->name('slide-store');
        Route::get('/{itemId}/edit-slide', [SliderController::class, 'itemEdit'])->name('edit-slide');
        Route::put('{itemId}/slide-update', [SliderController::class, 'itemUpdate'])->name('slide-update');
        Route::delete('/{itemId}/destroy-slide', [SliderController::class, 'itemDestroy'])->name('destroy-slide');
    });
});

Route::resource('page', PageController::class);
Route::get('registration', [RegistrationController::class,'index'])->name('registration.index');
Route::delete('registration/destroy', [RegistrationController::class,'destroy'])->name('registration.destroy');


Route::get('contact', [ContactController::class,'index'])->name('contact.index');
Route::get('contact/{contact}/edit', [ContactController::class,'edit'])->name('contact.edit');
Route::put('contact/{contact}/update', [ContactController::class,'update'])->name('contact.update');
Route::delete('contact/{contact}/destroy', [ContactController::class,'destroy'])->name('contact.destroy');



Route::get('module', [ModularController::class, 'index'])->name('module.index');
Route::match(['get','post'],'module/banner', [ModularController::class, 'addBanner']);
