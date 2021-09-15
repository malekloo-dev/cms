<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyContents extends Model
{
    // protected $table = 'company_contents';
    // protected $casts = [
    //     'phone' => 'array'
    // ];

    protected $fillable = [
        'company_id', 'content_id'
    ];
}
