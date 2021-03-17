<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $casts = [
        'phone' => 'array'
    ];

    protected $fillable = [
        'name', 'manager', 'sale_manager', 'address', 'city', 'province', 'mobile',
        'phone', 'email', 'site', 'whatsapp', 'telegram', 'instagram', 'logo', 'user_id'
    ];
}
