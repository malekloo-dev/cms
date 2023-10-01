<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedirectUrl extends Model
{
    protected $table = 'redirect_url';
    protected $fillable = [
        'url', 'redirect_to'
    ];
    // public $timestamps = false;

    function createIfChange($uri,$to) {
        if ($uri != $to) {
            return RedirectUrl::create(['url' => '/'.$uri, 'redirect_to' => '/'.$to]);
        }
        return false;
    }
}
