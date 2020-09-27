<?php

namespace App\Http\Controllers\Api\Auth;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends Controller
{
    use ApiResponse;

        
    /**
     * Performs login with email and password
     *
     * @param  Request $request
     * @return mixed
     */
    public function login(Request $request) 
    {
        $creds = $request->only('email','password');
        if (! $token = auth('api')->attempt($creds, true)) {
            return $this->errorResponse("Wrong email or password");
        }

        return $this->successResponse(['token' => $token]);
    }

     /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->successResponse(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->successResponse(null);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->successResponse(['token' => auth()->refresh()]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken()
    {
        return $this->successResponse([
            'access_token' => auth()->tokenById(auth()->user()->id),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
