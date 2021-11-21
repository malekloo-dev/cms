<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
    public function showRegistrationForm()
    {
        $result = app('App\Http\Controllers\CategoryController')->tree_set();
        $category = app('App\Http\Controllers\CategoryController')->convertTemplateSelect1($result);


        return view('auth.register',compact('category'));

    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {


        return User::create([
            'mobile' => $data['mobile'],
            'pass' => $data['password'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered($request, $user)
    {

        $company = Company::create([
            'user_id'=> $user->id,
            'mobile' => $user->mobile,
            'parent_id' => $request->parent_id
        ]);



        $user->assignRole('company');

        $company->categories()->attach($request->parent_id);

    }
    protected function redirectTo()
    {
        if (Auth::user()->getRoleName == 'company') {
            return redirect()->intended('/company');
        }
        return '/';
    }

    // protected function showRegistrationForm()
    // {
    //     return view('auth.register');
    // }


}
