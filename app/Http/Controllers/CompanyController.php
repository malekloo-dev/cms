<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function dashboard(){
        return view('auth.dashboard');
    }
    public function profile(){
        $user = Auth::user();
        return view('auth.profile',compact('user'));
    }
}
