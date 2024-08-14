<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('jwt')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

//    public function refresh()
//    {
//        $permissions = auth('jwt')->payload()->get('permissions');
//        if (!in_array('refresh', $permissions)) {
//            abort(403);
//        }
//
//        return [
//            ...
//        ];
//    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('jwt')->factory()->getTTL() * 60
        ]);
    }
}
