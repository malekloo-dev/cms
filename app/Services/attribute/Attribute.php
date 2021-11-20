<?php

namespace App\Services\attribute;

use App\Models\ContentAttribute;
use App\Models\ContentAttributeValue;
use App\Models\ContentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class Attribute
{

    /**
     * @param $contentTypeId
     * @return mixed
     */
    public static function getFormFieldsByContentTypeId($contentTypeId)
    {
        return ContentType::find($contentTypeId)->load('contentAattributeFields');
    }
    public static function getFormValue($contentId)
    {
        //dd($contentId);

        $attributeValue=ContentAttributeValue::where('content_id','=',$contentId)->first();
        //todo check exist object
        $content_type_id=$attributeValue->content_type_id;
        $content=ContentType::find($content_type_id);

        $content->load('contentAattributeFields');
        $content->contentAattributeFields->load(['value' => function ($query) use ($contentId,$content_type_id)
        {
            $query ->where('content_id', '=', $contentId);
        }]);

        // $attributeValue



        return $content;
    }
    public static function upsert($data,$content_id,$content_type_id)
    {

        $attribute=self::getFormFieldsByContentTypeId($content_type_id);
        $fieldsId=[];
        foreach ($attribute->contentAattributeFields as $field)
        {
            $formFieldName='attr_'.$field->id.'_'.$field->field_name;
            if(isset($data[$formFieldName])){
                $attrValueData['content_id']=$content_id;
                $attrValueData['content_type_id']=$content_type_id;
                $attrValueData['content_attribute_id']=$field->id;
                $attrValueData['company_id']=0;
                $attrValueData['label']=$field->label;
                $attrValueData['type']=$field->element_type;
                $attrValueData['value']=$data[$formFieldName];
                $ContentAttributeValue = ContentAttributeValue::updateOrCreate(
                    ['content_id' => $content_id, 'content_attribute_id' => $field->id, 'content_type_id' =>$content_type_id ],
                    $attrValueData
                );
                $fieldsId[]=$field->id;
               // dd($ContentAttributeValue);

                //$ContentAttributeValue=ContentAttributeValue::create($attrValueData);
            }
        }

        $deleteObject=ContentAttributeValue::where('content_id','=',$content_id)
        ->where('content_type_id','<>',$content_type_id)->
            orWhereNotIn('content_attribute_id',$fieldsId)->delete();

        return 1;
    }

    public static function create($data,$content_id,$content_type_id)
    {
        $attribute=self::getFormFieldsByContentTypeId($content_type_id);
        //dd($fieldsName);
        foreach ($attribute->contentAattributeFields as $field)
        {
            $formFieldName='attr_'.$field->id.'_'.$field->field_name;
            if(isset($data[$formFieldName])){
                $attrValueData['content_id']=$content_id;
                $attrValueData['content_type_id']=$content_type_id;
                $attrValueData['content_attribute_id']=$field->id;
                $attrValueData['company_id']=0;
                $attrValueData['label']=$field->label;
                $attrValueData['type']=$field->element_type;
                $attrValueData['value']=$data[$formFieldName];
                $ContentAttributeValue=ContentAttributeValue::create($attrValueData);
                //dd($value);
            }
        }
        return 1;
    }
}
