<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_type_combo extends Model
{
    protected $fillable = [
        'product_attribute_id','product_type_id','name','value','created_at','updated_at'
    ];
}
