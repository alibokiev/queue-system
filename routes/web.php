<?php

use App\Http\Controllers\Admin\ServicesController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/monitor/', 'Monitor\MonitorController@index')->name('monitor');
Route::get('/monitor/{grad}', 'Monitor\MonitorController@index');
Route::get('/monitor/{grad}/{size}', 'Monitor\MonitorController@index');

Route::middleware(['web'])->group(static function () {
    Route::namespace('Admin\AdminAuth')->group(static function () {
        Route::get('/admin/login', 'LoginController@showLoginForm')->name('brackets/admin-auth::admin/login');
        Route::post('/admin/login', 'LoginController@login');

        Route::any('/admin/logout', 'LoginController@logout')->name('brackets/admin-auth::admin/logout');

        Route::get('/admin/password-reset', 'ForgotPasswordController@showLinkRequestForm')->name('brackets/admin-auth::admin/password/showForgotForm');
        Route::post('/admin/password-reset/send', 'ForgotPasswordController@sendResetLinkEmail');
        Route::get('/admin/password-reset/{token}', 'ResetPasswordController@showResetForm')->name('brackets/admin-auth::admin/password/showResetForm');
        Route::post('/admin/password-reset/reset', 'ResetPasswordController@reset');

        Route::get('/admin/activation/{token}', 'ActivationController@activate')->name('brackets/admin-auth::admin/activation/activate');
    });
});


/* Auto-generated admin routes */
Route::middleware(['web', 'auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/', 'Admin\HomeController@index')->name('admin.index');

});
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/admin-users', 'Admin\AdminUsersController@index');
    Route::get('/admin/admin-users/{user}', 'Admin\AdminUsersController@show')->where('user', '[0-9]+');
    Route::get('/admin/admin-users/create', 'Admin\AdminUsersController@create');
    Route::post('/admin/admin-users', 'Admin\AdminUsersController@store');
    Route::get('/admin/admin-users/{adminUser}/edit', 'Admin\AdminUsersController@edit')->name('admin/admin-users/edit');
    Route::post('/admin/admin-users/{adminUser}', 'Admin\AdminUsersController@update')->name('admin/admin-users/update');
    Route::delete('/admin/admin-users/{adminUser}', 'Admin\AdminUsersController@destroy')->name('admin/admin-users/destroy');
    Route::get('/admin/admin-users/{adminUser}/resend-activation', 'Admin\AdminUsersController@resendActivationEmail')->name('admin/admin-users/resendActivationEmail');
});

/* Auto-generated profile routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/profile', 'Admin\ProfileController@editProfile');
    Route::post('/admin/profile', 'Admin\ProfileController@updateProfile');
    Route::get('/admin/password', 'Admin\ProfileController@editPassword');
    Route::post('/admin/password', 'Admin\ProfileController@updatePassword');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/categories', 'Admin\CategoriesController@index');
    Route::get('/admin/categories/create', 'Admin\CategoriesController@create');
    Route::post('/admin/categories', 'Admin\CategoriesController@store');
    Route::get('/admin/categories/{category}/edit', 'Admin\CategoriesController@edit')->name('admin/categories/edit');
    Route::post('/admin/categories/bulk-destroy', 'Admin\CategoriesController@bulkDestroy')->name('admin/categories/bulk-destroy');
    Route::post('/admin/categories/{category}', 'Admin\CategoriesController@update')->name('admin/categories/update');
    Route::delete('/admin/categories/{category}', 'Admin\CategoriesController@destroy')->name('admin/categories/destroy');
});

Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/reception', 'Admin\ReceptionController@index')->name('admin/reception');
    Route::post('/admin/reception', 'Admin\ReceptionController@store')->name('admin/reception/store');
    Route::post('/admin/reception/skip-all', 'Admin\ReceptionController@skipAll')->name('admin/reception/skip-all');
});

Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/cabinet', 'Admin\CabinetController@index')->name('admin/cabinet');
    Route::get('/admin/cabinet/services', 'Admin\CabinetController@services')->name('admin/services');
    Route::post('/admin/cabinet/accept', 'Admin\CabinetController@accept')->name('admin/cabinet/accept');
    Route::post('/admin/cabinet/done', 'Admin\CabinetController@done')->name('admin/cabinet/done');
    Route::post('/admin/cabinet/save', 'Admin\CabinetController@saveTicket')->name('admin/cabinet/save');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/clients', 'Admin\ClientsController@index')->name('admin/clients');
    Route::get('/admin/clients/create', 'Admin\ClientsController@create')->name('admin/clients/create');
    Route::post('/admin/clients', 'Admin\ClientsController@store')->name('admin/clients/store');
    Route::get('/admin/clients/{client}', 'Admin\ClientsController@show')->name('admin/clients/show');
    Route::get('/admin/clients/{client}/edit', 'Admin\ClientsController@edit')->name('admin/clients/edit');
    Route::post('/admin/clients/bulk-destroy', 'Admin\ClientsController@bulkDestroy')->name('admin/clients/bulk-destroy');
    Route::post('/admin/clients/{client}', 'Admin\ClientsController@update')->name('admin/clients/update');
    Route::delete('/admin/clients/{client}', 'Admin\ClientsController@destroy')->name('admin/clients/destroy');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/services', [ServicesController::class, 'index'])->name('admin/services');
    Route::get('/admin/services/create', [ServicesController::class, 'create'])->name('admin/services/create');
    Route::post('/admin/services', [ServicesController::class, 'store'])->name('admin/services/store');
    Route::get('/admin/services/{service}/edit', [ServicesController::class, 'edit'])->name('admin/services/edit');
    Route::post('/admin/services/bulk-destroy', [ServicesController::class, 'bulkDestroy'])->name('admin/services/bulk-destroy');
    Route::post('/admin/services/{service}', [ServicesController::class, 'update'])->name('admin/services/update');
    Route::delete('/admin/services/{service}', [ServicesController::class, 'destroy'])->name('admin/services/destroy');
});

