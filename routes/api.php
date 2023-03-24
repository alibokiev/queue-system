<?php

use App\Http\Controllers\HomeController;
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
    ProfileController,
    ReceptionController,
    ServicesController,
    UsersController};
use App\Http\Controllers\Api\{AuthController, MonitorController, ServiceCenterController};

Route::get('/', function () {
    return 'Queue system service';
});

Route::namespace('Api')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/service-centers', [ServiceCenterController::class, 'index']);
        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
        Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
        Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    });

    Route::post('/email/resend', [VerificationController::class, 'resend'])->middleware('auth:sanctum');
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/home', [HomeController::class, 'index']);

        Route::get('/cabinet', [CabinetController::class, 'index']);
        Route::post('/cabinet/accept', [CabinetController::class, 'accept']);
        Route::post('/cabinet/done', [CabinetController::class, 'done']);

        Route::get('/reception', [ReceptionController::class, 'index']);
        Route::post('/reception', [ReceptionController::class, 'store']);

        Route::get('/monitor/', [MonitorController::class, 'index'])->name('monitor');
        Route::get('/monitor/{grad}', [MonitorController::class, 'index']);
        Route::get('/monitor/{grad}/{size}', [MonitorController::class, 'index']);

        Route::get('/admin/users', [UsersController::class, 'index']);
        Route::get('/admin/users/{id}', [UsersController::class, 'show'])->where('id', '[0-9]+');
        Route::get('/admin/users/create', [UsersController::class, 'create']);
        Route::post('/admin/users', [UsersController::class, 'store']);
        Route::get('/admin/users/{adminUser}/edit', [UsersController::class, 'edit']);
        Route::post('/admin/users/{adminUser}', [UsersController::class, 'update']);
        Route::delete('/admin/users/{adminUser}', [UsersController::class, 'destroy']);
        Route::get('/admin/users/{adminUser}/resend-activation', [UsersController::class, 'resendActivationEmail']);

        Route::get('/admin/profile', [ProfileController::class, 'editProfile']);
        Route::post('/admin/profile', [ProfileController::class, 'updateProfile']);
        Route::get('/admin/password', [ProfileController::class, 'editPassword']);
        Route::post('/admin/password', [ProfileController::class, 'updatePassword']);

        Route::get('/admin/categories', [CategoriesController::class, 'index']);
        Route::get('/admin/categories/create', [CategoriesController::class, 'create']);
        Route::post('/admin/categories', [CategoriesController::class, 'store']);
        Route::get('/admin/categories/{category}/edit', [CategoriesController::class, 'edit']);
        Route::post('/admin/categories/bulk-destroy', [CategoriesController::class, 'bulkDestroy']);
        Route::post('/admin/categories/{category}', [CategoriesController::class, 'update']);
        Route::delete('/admin/categories/{category}', [CategoriesController::class, 'destroy']);

        Route::get('/admin/reception', [ReceptionController::class, 'index']);
        Route::post('/admin/reception', [ReceptionController::class, 'store']);
        Route::post('/admin/reception/skip-all', [ReceptionController::class, 'skipAll']);

        Route::get('/admin/cabinet', [CabinetController::class, 'index']);
        Route::get('/admin/cabinet/services', [CabinetController::class, 'services']);
        Route::post('/admin/cabinet/accept', [CabinetController::class, 'accept']);
        Route::post('/admin/cabinet/done', [CabinetController::class, 'done']);
        Route::post('/admin/cabinet/save', [CabinetController::class, 'saveTicket']);

        Route::get('/admin/clients', [ClientsController::class, 'index']);
        Route::get('/admin/clients/create', [ClientsController::class, 'create']);
        Route::post('/admin/clients', [ClientsController::class, 'store']);
        Route::get('/admin/clients/{client}', [ClientsController::class, 'show']);
        Route::get('/admin/clients/{client}/edit', [ClientsController::class, 'edit']);
        Route::post('/admin/clients/bulk-destroy', [ClientsController::class, 'bulkDestroy']);
        Route::post('/admin/clients/{client}', [ClientsController::class, 'update']);
        Route::delete('/admin/clients/{client}', [ClientsController::class, 'destroy']);


        Route::get('/admin/services', [ServicesController::class, 'index']);
        Route::get('/admin/services/create', [ServicesController::class, 'create']);
        Route::post('/admin/services', [ServicesController::class, ' store']);
        Route::get('/admin/services/{service}/edit', [ServicesController::class, 'edit']);
        Route::post('/admin/services/bulk-destroy', [ServicesController::class, 'bulkDestroy']);
        Route::post('/admin/services/{service}', [ServicesController::class, 'update']);
        Route::delete('/admin/services/{service}', [ServicesController::class, 'destroy']);
    });
});

//Route::fallback([HomeController::class, 'fallback']);

