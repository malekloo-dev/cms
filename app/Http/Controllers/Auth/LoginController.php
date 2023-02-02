<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'mobile';
    }

    public function showLoginForm(Request $request)
    {

        switch (Request::segment(1)) {
            case 'admin':
                return view('admin.auth.login');
                break;
            case 'company':
                return view('auth.company.login');
                break;
            default:
                return view('auth.customer.login');
                break;
        }
    }

    protected function redirectTo()
    {

        // User role
        $roles = Auth::user()->getRoleNames();

        // Check user role
        if ($roles->contains('super admin'))
            return '/admin';
        else if ($roles->contains('company'))
            return '/company';
        else if ($roles->contains('customer'))
            return '/customer';
        else
            return '/';
    }
}
