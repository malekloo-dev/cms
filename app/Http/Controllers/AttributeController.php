<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentAttribute;
use App\Models\ContentAttributeCombo;
use App\Models\ContentAttributeContentType;
use App\Models\ContentType;
use App\Services\attribute\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /*
    show content type list
    */
    public function contentTypeList()
    {
        $contentType = ContentType::all();

        $attributes = ContentAttribute::all();

        $contents = Content::all();


        return view('admin.attribute.page.ContentTypeList', compact('contentType', 'attributes', 'contents'));
    }

    /*
    content type store
    */
    public function contentTypeStore(Request $request)
    {
        ContentType::create($request->all());

        return redirect(route('admin.content.type.index'))->with('seccess', 'افزوده شد.');
    }


    /*
    content type update
    */
    public function contentTypeUpdate(Request $request, ContentType $contentType)
    {
        $contentType->fill($request->all())->save();

        return redirect(route('admin.content.type.index'))->with('seccess', 'ویرایش شد.');
    }

    /*
    content type destroy
    */
    public function contentTypeDestroy(ContentType $contentType)
    {

        if ($contentType->attributes->count() == 0) {
            $contentType->delete();
        }

        return redirect(route('admin.content.type.index'))->with('seccess', 'حذف شد.');
    }






    /*
    show attributes by content type id
    */
    public function contentTypeShow(ContentType $contentType)
    {

        $attributes = $contentType->attributes;

        return view('admin.attribute.page.AttributesList', compact('attributes', 'contentType'));
    }

    /*
    sync attribute by content type
    */
    public function contentTypeAddAttribute(Request $request, ContentType $contentType)
    {
        // $contentType->attributes()->attach();

        ContentAttributeContentType::firstOrCreate([
            'content_type_id' => $contentType->id,
            'content_attribute_id' => $request->attribute_type_id
        ]);


        return redirect()->back()->with('success', 'assigned');
    }
    /*
    detach attribute
    */
    public function contentTypeDeleteAttribute(ContentType $contentType, $attributeId)
    {
        $contentType->attributes()->detach($attributeId);

        return redirect()->back()->with('success', 'Detached');
    }


    /*
    attribute store
    */
    public function attributeStore(Request $request)
    {
        ContentAttribute::create($request->all());

        return redirect()->back()->with('success','add attribute');
    }


    /*
    add combo to attribute
    */
    public function attributeAddCombo(Request $request, ContentAttribute $attribute)
    {


        ContentAttributeCombo::firstOrCreate([
            'content_attribute_id' => $attribute->id,
            'name' => $request->name,
            'value' => (int) ContentAttributeCombo::where('content_attribute_id', '=', $attribute->id)->max('value') + 1 ?? 1
        ]);

        return redirect()->back()->with('success','Add combo');
    }

    /*
    delete combo from attr
    */
    public function attributeDeleteCombo(Request $request ,ContentAttributeCombo $combo)
    {
        $combo->delete();


        return redirect()->back()->with('success', 'Detached');
    }


    /*
    sync attribute by contents
    */
    public function contentTypeAddToContents(Request $request, ContentType $contentType)
    {
    }
}
