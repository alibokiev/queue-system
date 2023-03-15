<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function login(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return $this->responseError('We cant find an account with this credentials.', ResponseAlias::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $e) {
            Log::critical($e->getMessage(), $e->getTrace());

            return $this->responseError('Failed to login, please try again.', ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

        $user = User::query()->where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->response(['token' => $token]);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function logout(Request $request): JsonResponse
    {
        $this->validate($request, ['token' => 'required']);

        try {
            Auth::user()->tokens()->each->delete();
            return response()->json(['success' => true, 'message' => "You have successfully logged out."]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
