<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if ($e instanceof AuthenticationException) {
                return $this->responseError($e->getMessage(), $e->getCode());
            }

            if ($e instanceof ModelNotFoundException) {
                return $this->responseError("No query results in {$e->getModel()}", $e->getCode());
            }

            if ($e instanceof ValidationException) {
                return $this->responseValidationException($e->errors());
            }

            if ($e instanceof ValidationException) {
                return $this->respondValidationsError($e->errors());
            }

            if ($e instanceof ApiErrorException) {
                return $this->respondWithError($e->getMessage());
            }

            if ($e instanceof AppException) {
                return $this->respondWithError($e->getMessage());
            }
        });
    }
}
