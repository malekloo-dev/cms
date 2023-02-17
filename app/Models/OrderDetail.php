<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'title',
        'price',
        'count',
        'attributes',
    ];
    protected $casts = [
        'attributes' => 'array'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
