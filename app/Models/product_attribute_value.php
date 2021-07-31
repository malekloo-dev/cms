<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_attribute_value extends Model
{
    protected $fillable = [
        'product_id','product_type_id','product_attribute_id','company_id','label','type','value',
    ];
}
