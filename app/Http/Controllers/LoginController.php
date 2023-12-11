<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $token = Auth::guard('web')->attempt($request->only('email', 'password'));
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please check your email or password!!'
            ], 401);
        }

        if (!Auth::guard('web')->user()) {
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
        $user = auth()->guard('web')->user();
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
        $user = auth()->guard('web')->user();
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
