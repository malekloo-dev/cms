<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use FilterBuilder;
    use HasRoles;
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','mobile','pass', 'password', 'api_token'
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

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token= substr(str_shuffle(str_repeat($pool, 5)), 0, 50);
        $this->api_token = $token;

        $this->save();

        return $token;
    }

    // public function index(Request $request)
    // {
    //     dd(auth()->guard('api')->user());
    //     return User::all();
    // }
    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class,'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
