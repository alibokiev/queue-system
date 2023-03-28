<?php

use App\Http\Controllers\Admin\HomeController;
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
        Route::get('/service-centers', [ServiceCenterController::class, 'list']);

        Route::post('/register', [RegisterController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
        Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
        Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::post('/profile', [ProfileController::class, 'updateProfile']);
        Route::post('/password', [ProfileController::class, 'updatePassword']);
        Route::post('/email/resend', [VerificationController::class, 'resend']);
    });

    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/home', [HomeController::class, 'index']);

        Route::get('/cabinet', [CabinetController::class, 'index']);
        Route::post('/cabinet/accept', [CabinetController::class, 'accept']);
        Route::post('/cabinet/done', [CabinetController::class, 'done']);

        Route::get('/reception', [ReceptionController::class, 'index']);
        Route::post('/reception', [ReceptionController::class, 'store']);

        Route::get('/monitor/', [MonitorController::class, 'index']);

        Route::get('/users', [UsersController::class, 'index']);
        Route::get('/users/{user}', [UsersController::class, 'show'])->where('user', '[0-9]+');
        Route::post('/users', [UsersController::class, 'store']);
        Route::put('/users/{user}', [UsersController::class, 'update'])->where('user', '[0-9]+');
        Route::delete('/users/{user}', [UsersController::class, 'destroy'])->where('user', '[0-9]+');

        Route::get('/categories', [CategoriesController::class, 'index']);
        Route::get('/categories/create', [CategoriesController::class, 'create']);
        Route::post('/categories', [CategoriesController::class, 'store']);
        Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit']);
        Route::post('/categories/bulk-destroy', [CategoriesController::class, 'bulkDestroy']);
        Route::post('/categories/{category}', [CategoriesController::class, 'update']);
        Route::delete('/categories/{category}', [CategoriesController::class, 'destroy']);

        Route::get('/reception', [ReceptionController::class, 'index']);
        Route::post('/reception', [ReceptionController::class, 'store']);
        Route::post('/reception/skip-all', [ReceptionController::class, 'skipAll']);

        Route::get('/cabinet', [CabinetController::class, 'index']);
        Route::get('/cabinet/services', [CabinetController::class, 'services']);
        Route::post('/cabinet/accept', [CabinetController::class, 'accept']);
        Route::post('/cabinet/done', [CabinetController::class, 'done']);
        Route::post('/cabinet/save', [CabinetController::class, 'saveTicket']);

        Route::get('/clients', [ClientsController::class, 'index']);
        Route::get('/clients/create', [ClientsController::class, 'create']);
        Route::post('/clients', [ClientsController::class, 'store']);
        Route::get('/clients/{client}', [ClientsController::class, 'show']);
        Route::get('/clients/{client}/edit', [ClientsController::class, 'edit']);
        Route::post('/clients/bulk-destroy', [ClientsController::class, 'bulkDestroy']);
        Route::post('/clients/{client}', [ClientsController::class, 'update']);
        Route::delete('/clients/{client}', [ClientsController::class, 'destroy']);


        Route::get('/services', [ServicesController::class, 'index']);
        Route::get('/services/create', [ServicesController::class, 'create']);
        Route::post('/services', [ServicesController::class, ' store']);
        Route::get('/services/{service}/edit', [ServicesController::class, 'edit']);
        Route::post('/services/bulk-destroy', [ServicesController::class, 'bulkDestroy']);
        Route::post('/services/{service}', [ServicesController::class, 'update']);
        Route::delete('/services/{service}', [ServicesController::class, 'destroy']);

        Route::get('/services', [ServiceCenterController::class, 'index']);
        Route::post('/services', [ServiceCenterController::class, ' store']);
        Route::post('/services/bulk-destroy', [ServiceCenterController::class, 'bulkDestroy']);
        Route::post('/services/{service}', [ServiceCenterController::class, 'update']);
        Route::delete('/services/{service}', [ServiceCenterController::class, 'destroy']);
    });
});

//Route::fallback([HomeController::class, 'fallback']);

