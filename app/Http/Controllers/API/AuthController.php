<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {   
        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials)){
            return response()->json([
                'status' => 401,
                'Email or password invalid',
            ]);
        }

        $user = $request->user();
        
        $tokenResult = $user->createToken('Admin access token', ['users-list']);
        
        
        return response()->json([
            'accessToken' => $tokenResult->plainTextToken,
            'status' => 200,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        auth()->guard()->logout();
    }
}
