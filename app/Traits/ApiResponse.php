<?php

namespace App\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponse
{
    public string $message = "";

    public int $code = ResponseAlias::HTTP_OK;

    public bool $success = true;

    /**
     * @param array|Collection|Model $data
     * @return Application|ResponseFactory|Response
     */
    public function response(array|Collection|Model $data = []): Response|Application|ResponseFactory
    {
        return response([
            'meta' => [
                'success' => $this->success,
                'code' => $this->code,
                'message' => $this->message
            ],
            'response' => $data ?? []
        ]);
    }

    public function responseUnsuccess(): Response|Application|ResponseFactory
    {
        $this->success = false;

        return response();
    }

    /**
     * @param string $message
     * @param int $code
     * @return Response|Application|ResponseFactory
     */
    public function responseError(
        string $message, int $code = ResponseAlias::HTTP_BAD_REQUEST
    ): Response|Application|ResponseFactory {
        $this->success = false;
        $this->code = $code;
        $this->message = $message;

        return $this->response([]);
    }

    /**
     * @param array $errors
     * @param string $message
     * @param int $code
     * @return Application|ResponseFactory|Response
     */
    public function responseValidationException(
        array $errors, string $message = "Validation error.", int $code = ResponseAlias::HTTP_NOT_FOUND
    ): Response|Application|ResponseFactory {
        $this->success = false;
        $this->code = $code;
        $this->message = $message;

        return $this->response($errors);
    }
}
