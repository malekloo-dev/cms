<?php

namespace App\Http\Controllers;

use App\Models\ContentAttribute;
use App\Models\ContentAttributeContentType;
use App\Models\ContentType;
use App\Services\attribute\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function contentTypeList()
    {
        $contentType = ContentType::all();
        // dd($contentType);
        return view('admin.attribute.page.ContentTypeList',compact('contentType'));
    }

    public function contentTypeShow(ContentType $contentType)
    {

        $attributes = $contentType->attributes;
        // dd($attributes);

        return view('admin.attribute.page.AttributesList',compact('attributes','contentType'));
    }
}
