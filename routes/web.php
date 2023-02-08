<?php

use App\Http\Controllers\Admin\{AdminAuth\ActivationController,
    AdminAuth\ForgotPasswordController,
    AdminAuth\LoginController,
    AdminAuth\ResetPasswordController,
    AdminUsersController,
    CategoriesController,
    ClientsController,
    HomeController,
    ProfileController,
    ReceptionController,
    ServicesController,
    CabinetController};
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
        Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('brackets/admin-auth::admin/login');
        Route::post('/admin/login', [LoginController::class, 'login']);

        Route::any('/admin/logout', [LoginController::class, 'logout'])->name('brackets/admin-auth::admin/logout');

        Route::get('/admin/password-reset', [ForgotPasswordController::class,'showLinkRequestForm'])->name('brackets/admin-auth::admin/password/showForgotForm');
        Route::post('/admin/password-reset/send', [ForgotPasswordController::class,'sendResetLinkEmail']);
        Route::get('/admin/password-reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('brackets/admin-auth::admin/password/showResetForm');
        Route::post('/admin/password-reset/reset', [ResetPasswordController::class, 'reset']);

        Route::get('/admin/activation/{token}', [ActivationController::class, 'activate'])->name('brackets/admin-auth::admin/activation/activate');
    });
});


/* Auto-generated admin routes */
Route::middleware(['web', 'auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/', [HomeController::class, 'index'])->name('admin.index');

});
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/admin-users', [AdminUsersController::class, 'index']);
    Route::get('/admin/admin-users/{user}', [AdminUsersController::class, 'show'])->where('user', '[0-9]+');
    Route::get('/admin/admin-users/create', [AdminUsersController::class, 'create']);
    Route::post('/admin/admin-users', [AdminUsersController::class, 'store']);
    Route::get('/admin/admin-users/{adminUser}/edit', [AdminUsersController::class, 'edit'])->name('admin/admin-users/edit');
    Route::post('/admin/admin-users/{adminUser}', [AdminUsersController::class, 'update'])->name('admin/admin-users/update');
    Route::delete('/admin/admin-users/{adminUser}', [AdminUsersController::class, 'destroy'])->name('admin/admin-users/destroy');
    Route::get('/admin/admin-users/{adminUser}/resend-activation', [AdminUsersController::class, 'resendActivationEmail'])->name('admin/admin-users/resendActivationEmail');
});

/* Auto-generated profile routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/profile', [ProfileController::class, 'editProfile']);
    Route::post('/admin/profile', [ProfileController::class, 'updateProfile']);
    Route::get('/admin/password', [ProfileController::class, 'editPassword']);
    Route::post('/admin/password', [ProfileController::class, 'updatePassword']);
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/categories', [CategoriesController::class, 'index']);
    Route::get('/admin/categories/create', [CategoriesController::class, 'create']);
    Route::post('/admin/categories', [CategoriesController::class, 'store']);
    Route::get('/admin/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('admin/categories/edit');
    Route::post('/admin/categories/bulk-destroy', [CategoriesController::class, 'bulkDestroy'])->name('admin/categories/bulk-destroy');
    Route::post('/admin/categories/{category}', [CategoriesController::class, 'update'])->name('admin/categories/update');
    Route::delete('/admin/categories/{category}', [CategoriesController::class, 'destroy'])->name('admin/categories/destroy');
});

Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/reception', [ReceptionController::class, 'index'])->name('admin/reception');
    Route::post('/admin/reception', [ReceptionController::class, 'store'])->name('admin/reception/store');
    Route::post('/admin/reception/skip-all', [ReceptionController::class, 'skipAll'])->name('admin/reception/skip-all');
});

Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(function () {
    Route::get('/admin/cabinet', [CabinetController::class, 'index'])->name('admin/cabinet');
    Route::get('/admin/cabinet/services', [CabinetController::class, 'services'])->name('admin/services');
    Route::post('/admin/cabinet/accept', [CabinetController::class, 'accept'])->name('admin/cabinet/accept');
    Route::post('/admin/cabinet/done', [CabinetController::class, 'done'])->name('admin/cabinet/done');
    Route::post('/admin/cabinet/save', [CabinetController::class, 'saveTicket'])->name('admin/cabinet/save');
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::get('/admin/clients', [ClientsController::class, 'index'])->name('admin/clients');
    Route::get('/admin/clients/create', [ClientsController::class, 'create'])->name('admin/clients/create');
    Route::post('/admin/clients', [ClientsController::class, 'store'])->name('admin/clients/store');
    Route::get('/admin/clients/{client}', [ClientsController::class, 'show'])->name('admin/clients/show');
    Route::get('/admin/clients/{client}/edit', [ClientsController::class, 'edit'])->name('admin/clients/edit');
    Route::post('/admin/clients/bulk-destroy', [ClientsController::class, 'bulkDestroy'])->name('admin/clients/bulk-destroy');
    Route::post('/admin/clients/{client}', [ClientsController::class, 'update'])->name('admin/clients/update');
    Route::delete('/admin/clients/{client}', [ClientsController::class, 'destroy'])->name('admin/clients/destroy');
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

