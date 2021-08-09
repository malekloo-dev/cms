<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request)
    {

        $user = User::where('mobile', '=', $request->mobile)->first();
        if ($user) {

            $user->password = Hash::make($user->pass);
            $user->save();

            // $msg = 'رمز عبور:'.$user->pass." \n ". env('TEMPLATE_NAME');
            $msg = "رمز عبور شما : " . $user->pass . "\n" . Lang::get('messages.' . env('TEMPLATE_NAME'));

            // $msg = "رمز عبور شما : ".$user->pass."
            // ".Lang::get('messages.' . env('TEMPLATE_NAME'));

            $res = sendSms(array($request->mobile), $msg);
            // dd($res);
            if ($res == 0) {
                $message = Lang::get('messages.Send Password to your mobile');
            } else {
                $message = Lang::get('messages.error') . $res;
            }
            // dd(1);

            return redirect(route('login'))->with('success', $message);
        }

        return redirect()->back()->with('error', Lang::get('messages.your number not exist'));
    }
}
