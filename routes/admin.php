<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    DashboardController,
    RoleController,
    UserController,
    Service\CategoryController,
    Service\TagController,
    Service\ServiceController,
    DepartmentController,
    FilterProfileController,
    FilterController
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


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Roles and Users
Route::resource('role', RoleController::class)->except(['show']);
Route::resource('user', UserController::class);

// Department Controller
Route::get('department/checkSlug',[DepartmentController::class, 'chceckSlug'])->name('department.checkSlug');
Route::resource('department', DepartmentController::class);

// Service Controller
Route::get('category/checkSlug',[CategoryController::class, 'chceckSlug'])->name('category.checkSlug');
Route::resource('category', CategoryController::class);

Route::get('tag/checkSlug',[TagController::class, 'chceckSlug'])->name('tag.checkSlug');
Route::resource('tag', TagController::class);

Route::get('service/checkSlug',[ServiceController::class, 'chceckSlug'])->name('service.checkSlug');
Route::get('/service/filter',[ServiceController::class, 'chceckFilter']);
Route::resource('service', ServiceController::class);


// Filter Categories and Products
Route::resource('filterProfile', FilterProfileController::class);
Route::resource('filter', FilterController::class);