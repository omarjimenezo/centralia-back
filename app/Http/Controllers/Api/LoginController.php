<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'token'   => $request->user()->createToken($request->name)->plainTextToken,
                'user_id'  => $request->user()->id,
                'message' => 'Success',
                'code' => 0
            ], 200);
        }

        return response()->json([
            'message' => 'Unauthorized', 'code' => 1
        ], 401);
    }

    public function validateLogin($request) {
        return $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'name'     => 'required'
        ]);
    }  
}