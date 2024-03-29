<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use FilterBuilder;
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*protected $hidden = [
        'password', 'remember_token', 'token', 'email_verified_at'
    ];*/

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function generateToken()
    {
        //$token = str_random(50);

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token= substr(str_shuffle(str_repeat($pool, 5)), 0, 50);
        $this->api_token = $token;
        //print_r($this);

        $this->save();
        //print_r($this);
        //print_r($r);

        return $token;
    }

    public function index(Request $request)
    {
        dd(auth()->guard('api')->user());
        return User::all();
    }
    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
