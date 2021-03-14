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
    public function showLoginForm(Request $request)
    {
        switch (Request::segment(1)) {
            case 'admin':
                return view('admin.auth.login');
                break;
            default:
                return view('auth.login');
                break;
        }
    }
    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     dd(33);
    //     if ($request->expectsJson()) {
    //         return response()->json(['error' => 'Unauthenticated.'], 401);
    //     }

    //     return redirect()->guest('login');
    // }

    // protected function authenticated(Request $request, $user)
    // {
    //     die(2);
    //     if ($user->isAdmin()) { // do your magic here
    //         return redirect()->route('admin');
    //     }
    //     return redirect('/company');

    // }
    // public function authenticate(Request $request){
    //     // Retrive Input
    //     dd(7);
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // if success login

    //         return redirect('berhasil');

    //         //return redirect()->intended('/details');
    //     }
    //     // if failed login
    //     return redirect('login');
    // }
    // public function login($request, $user)
    // {
    //     dd(1);
    //     switch ($user->rol) {
    //         case 'Administrador':
    //             return redirect()->route('home');
    //         case 'Docente':
    //             return redirect()->route('balance');
    //         default:
    //             return redirect()->route('profile');
    //     }
    // }

    protected function redirectTo()
    {

        // User role
        $roles = Auth::user()->getRoleNames();

        // dd($roles->contains('super admin'));
        // Check user role
        if ($roles->contains('super admin'))
            return '/admin';
        else
            return '/company';
    }
}
