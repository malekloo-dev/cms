<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'orderable_type',
        'orderable_id',
        'status', // 0 not pay, 1 send to bank , 2 upload bill , 3 pay successfully,4 prepairing,5 ready to send , -1 have a problem
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }


}
