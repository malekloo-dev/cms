<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_attribute extends Model
{
    protected $fillable = [
        'id','field_name','label','element_type','element_input_type','required','filter'
    ];


}
