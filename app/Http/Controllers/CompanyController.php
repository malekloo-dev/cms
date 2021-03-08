<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function dashboard(){
        return view('auth.dashboard');
    }
    public function profile(){
        return view('auth.profile');
    }
}
