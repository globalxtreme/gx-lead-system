<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $token = Auth::guard('api')->attempt($request->only('email', 'password'));
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please check your email or password!!'
            ], 401);
        }

        if (!Auth::guard('api')->user()) {
            return response()->json([
                'status' => 'error',
                'message' => "Can\'t get the user data!!"
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'type' => 'bearer'
        ]);
    }

    public function profile()
    {
        $user = auth()->guard('api')->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => "User not found!!"
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Success',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }

    public function logout()
    {
        $user = auth()->guard('api')->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => "User not found!!"
            ], 401);
        }

        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Success'
        ]);
    }

}
