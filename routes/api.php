<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\{ConfirmPasswordController,
    ForgotPasswordController,
    LoginController,
    RegisterController,
    ResetPasswordController,
    VerificationController};
use App\Http\Controllers\Api\Admin\{CabinetController,
    CategoriesController,
    ClientsController,
    HomeController,
    ProfileController,
    ReceptionController,
    ServicesController,
    UsersController};
use App\Http\Controllers\Api\{AuthController,MonitorController};
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', function () {
    return 'Queue system service';
});

Route::namespace('Api')->group(function () {

    Route::post('/register', [RegisterController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => ['auth']], function () {
        Route::get('logout', [AuthController::class, 'logout']);
    });

    Route::middleware('auth:sanctum')->group(function () {
        //user
        Route::get('/me', [AuthController::class, 'me']);

        Route::get('/cabinet', [CabinetController::class, 'index']);
        Route::post('/cabinet/accept', [CabinetController::class, 'accept']);
        Route::post('/cabinet/done', [CabinetController::class, 'done']);

        Route::get('/reception', [ReceptionController::class, 'index']);
        Route::post('/reception', [ReceptionController::class, 'store']);
    });


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/monitor/', [MonitorController::class, 'index'])->name('monitor');
    Route::get('/monitor/{grad}', [MonitorController::class, 'index']);
    Route::get('/monitor/{grad}/{size}', [MonitorController::class, 'index']);

    Route::namespace('Admin\AdminAuth')->group(static function () {
        Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/admin/login', [LoginController::class, 'login']);

        Route::any('/admin/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/admin/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/admin/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/admin/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/admin/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

        Route::get('/admin/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
        Route::post('/admin/password/confirm', [ConfirmPasswordController::class, 'confirm']);

        Route::get('/admin/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
        Route::get('/admin/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
        Route::post('/admin/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    });

    Route::middleware(['web', 'auth:' . config('auth.defaults.guard'), 'admin'])->group(static function () {
        Route::get('/admin/', [HomeController::class, 'index'])->name('admin.index');

    });

    Route::middleware(['auth:' . config('auth.defaults.guard'), 'admin'])->group(static function () {
        Route::get('/admin/users', [UsersController::class, 'index']);
        Route::get('/admin/users/{user}', [UsersController::class, 'show'])->where('user', '[0-9]+');
        Route::get('/admin/users/create', [UsersController::class, 'create']);
        Route::post('/admin/users', [UsersController::class, 'store']);
        Route::get('/admin/users/{adminUser}/edit', [UsersController::class, 'edit'])->name('admin/admin-users/edit');
        Route::post('/admin/users/{adminUser}', [UsersController::class, 'update'])->name('admin/admin-users/update');
        Route::delete('/admin/users/{adminUser}', [UsersController::class, 'destroy'])->name('admin/admin-users/destroy');
        Route::get('/admin/users/{adminUser}/resend-activation', [UsersController::class, 'resendActivationEmail'])->name('admin/admin-users/resendActivationEmail');
    });

    /* Auto-generated profile routes */
    Route::middleware(['auth:' . config('auth.defaults.guard'), 'admin'])->group(static function () {
        Route::get('/admin/profile', [ProfileController::class, 'editProfile']);
        Route::post('/admin/profile', [ProfileController::class, 'updateProfile']);
        Route::get('/admin/password', [ProfileController::class, 'editPassword']);
        Route::post('/admin/password', [ProfileController::class, 'updatePassword']);
    });


    /* Auto-generated admin routes */
    Route::middleware(['auth:' . config('auth.defaults.guard'), 'admin'])->group(static function () {
        Route::get('/admin/categories', [CategoriesController::class, 'index']);
        Route::get('/admin/categories/create', [CategoriesController::class, 'create']);
        Route::post('/admin/categories', [CategoriesController::class, 'store']);
        Route::get('/admin/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('admin/categories/edit');
        Route::post('/admin/categories/bulk-destroy', [CategoriesController::class, 'bulkDestroy'])->name('admin/categories/bulk-destroy');
        Route::post('/admin/categories/{category}', [CategoriesController::class, 'update'])->name('admin/categories/update');
        Route::delete('/admin/categories/{category}', [CategoriesController::class, 'destroy'])->name('admin/categories/destroy');
    });

    Route::middleware(['auth:' . config('auth.defaults.guard'), 'admin'])->group(function () {
        Route::get('/admin/reception', [ReceptionController::class, 'index'])->name('admin/reception');
        Route::post('/admin/reception', [ReceptionController::class, 'store'])->name('admin/reception/store');
        Route::post('/admin/reception/skip-all', [ReceptionController::class, 'skipAll'])->name('admin/reception/skip-all');
    });

    Route::middleware(['auth:' . config('auth.defaults.guard'), 'admin'])->group(function () {
        Route::get('/admin/cabinet', [CabinetController::class, 'index'])->name('admin/cabinet');
        Route::get('/admin/cabinet/services', [CabinetController::class, 'services'])->name('admin/services');
        Route::post('/admin/cabinet/accept', [CabinetController::class, 'accept'])->name('admin/cabinet/accept');
        Route::post('/admin/cabinet/done', [CabinetController::class, 'done'])->name('admin/cabinet/done');
        Route::post('/admin/cabinet/save', [CabinetController::class, 'saveTicket'])->name('admin/cabinet/save');
    });

    /* Auto-generated admin routes */
    Route::middleware(['auth:' . config('auth.defaults.guard'), 'admin'])->group(static function () {
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
    Route::middleware(['auth:' . config('auth.defaults.guard'), 'admin'])->group(static function () {
        Route::get('/admin/services', [ServicesController::class, 'index'])->name('admin/services');
        Route::get('/admin/services/create', [ServicesController::class, 'create'])->name('admin/services/create');
        Route::post('/admin/services', [ServicesController::class, 'store'])->name('admin/services/store');
        Route::get('/admin/services/{service}/edit', [ServicesController::class, 'edit'])->name('admin/services/edit');
        Route::post('/admin/services/bulk-destroy', [ServicesController::class, 'bulkDestroy'])->name('admin/services/bulk-destroy');
        Route::post('/admin/services/{service}', [ServicesController::class, 'update'])->name('admin/services/update');
        Route::delete('/admin/services/{service}', [ServicesController::class, 'destroy'])->name('admin/services/destroy');
    });
});

// 404 json
Route::fallback([\App\Http\Controllers\HomeController::class, 'fallback']);

