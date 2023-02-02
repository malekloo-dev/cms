<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $casts = [
        'phone' => 'array'
    ];

    protected $fillable = [
        'name', 'description', 'address', 'city', 'province', 'mobile', 'location',
        'phone', 'email', 'whatsapp', 'telegram', 'instagram', 'image', 'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
