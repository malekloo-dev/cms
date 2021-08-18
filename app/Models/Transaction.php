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
        'status',
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
