<?php

namespace App\Services\attribute;

use App\Models\ContentAttribute;
use App\Models\ContentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class Attribute
{

    public function getFormFieldsByContentTypeId($id)
    {
        $contentType = ContentType::find($id)->load('contentAattributeFields');

        //$t->content_aattribute_fields();
        dd($contentType->contentAattributeFields);

        if(!is_object($contentType)){
            die('not found');
        }

        foreach ($contentType->contentAattributeFields as $fields) {
            dd($fields);

        }





    }

}
