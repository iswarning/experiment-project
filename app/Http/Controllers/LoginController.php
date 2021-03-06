<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        
        $credentials = request(['email','password']);

        if(!Auth::attempt($credentials))
            return response()->json(['error'=>'Email or password is invalid'], 401);

        if(Auth::user()->type == 1){
            $user = $request->user();
            $tokenResult  = $user->createToken('Admin Access Token', ['users-list']);
            // return response()->json([
            //     'status' => 200 ,
            //     'token' => $tokenResult->plainTextToken
            // ]);
            // dd($tokenResult);
        }
        
        
        return redirect('/api/users');
        
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        
        $request->user()->tokens()->delete();

        auth()->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $validated = $request->validate([
            'email' => 'unique:users' ,
            'password' => 'min:6|confirmed'
        ],[
            'email.unique' => 'Email đã tồn tại' ,
            'password.min' => 'Mật khẩu có ít nhất 6 ký tự' ,
            'password.confirmed' => 'Mật khẩu không trùng khớp' ,
        ]);


        $register = new User();
        $register->name = $request->name;
        $register->email = $request->email;
        $register->password = bcrypt($request->password);
        $register->type = 4;
        $register->save();

        if($register){
            return redirect('/');

        }else{
            return redirect()->withErrors($validated);
        }
    }

}
