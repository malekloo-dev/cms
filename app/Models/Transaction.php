<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'count',
        'discount_code',
        'description',
        'status', // 0 disable, 1 send to bank ,2 pay successfully ,3 Upload bill , -1 have a problem
        'message',
        'transactionable_type',
        'transactionable_id',
    ];

    /**
     * Get the parent commentable model (post or video).
     */
    public function transactionable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }



}
