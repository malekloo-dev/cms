<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    //protected $loginPath = '/admin/login';


    public function login(LoginRequest $request)
    {


        auth()->attempt([
            'email' => $request->username,
            'password' => $request->password,
        ]);

        //اگر کاربر لاگین باشد
        if (auth()->check())
        {
            return response([
                'token' => auth()->user()->generateToken()
            ]);
        }
        return response([
            'error' => 'اطلاعات کاربری اشتباه وارد شده است'
        ], 401);
    }
}
