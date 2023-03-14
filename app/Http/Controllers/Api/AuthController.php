<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * API Login, on success return JWT Auth token
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (!$token = $request->user()->createToken($request->token_name)) {
                return response()->json(['success' => false, 'error' => 'We cant find an account with this credentials.'], 401);
            }
        } catch (Exception $e) {

            return response()->json(['success' => false, 'error' => 'Failed to login, please try again.'], 500);
        }

        return response()->json(['success' => true, 'data' => ['token' => $token]]);
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

}
