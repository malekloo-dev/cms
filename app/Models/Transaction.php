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
        'discount_code',
        'description',
        'status',
        'message',
        'transaction_type',
        'transaction_id',
    ];

    /**
     * Get the parent commentable model (post or video).
     */
    public function transactionble()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
