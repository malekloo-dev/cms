<?php

namespace App\Services\attribute;

use App\Models\ContentAttribute;
use App\Models\ContentAttributeCombo;
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
        $attributeValue = ContentAttributeValue::where('content_id', '=', $contentId)->first();
        if(!is_object($attributeValue))
        {
            return ;
        }
        //todo check exist object
        $content_type_id = $attributeValue->content_type_id;
        $content = ContentType::find($content_type_id);

        $content->load('contentAattributeFields');
        $content->contentAattributeFields->load(['value' => function ($query) use ($contentId, $content_type_id) {
            $query->where('content_id', '=', $contentId);
        }]);

        // $attributeValue


        return $content;
    }

    public static function upsert($data, $content_id, $content_type_id=0)
    {

        if($content_type_id==0)
        {
            $content_value=ContentAttributeValue::where('content_id','=',$content_id)->first();
            $content_type_id=$content_value->content_type_id;
        }

        $attribute = self::getFormFieldsByContentTypeId($content_type_id);
        $fieldsId = [];
        foreach ($attribute->contentAattributeFields as $field) {
            $attrValueData = array();
            $formFieldName = 'attr_' . $field->id . '_' . $field->field_name;

            $attrValueData['content_id'] = $content_id;
            $attrValueData['content_type_id'] = $content_type_id;
            $attrValueData['content_attribute_id'] = $field->id;
            if(!isset($field->company_id))
            {

                $attrValueData['company_id']=0;
            }else{
                $attrValueData['company_id'] = $field->company_id;
            }
            $attrValueData['field_name'] =  $field->field_name;
            $attrValueData['label'] = $field->label;
            $attrValueData['type'] = $field->element_type;
            $method = 'getType' . ucfirst($field->element_type);
            if (isset($data[$formFieldName])) {
                $attrValueData['value'] = $data[$formFieldName];
                if (method_exists(__CLASS__, $method)) {
                    $attrValueData['json'] = self::$method($content_type_id, $field->id)->toJson();
                    //echo '<pre/>';
                    //print_r($json);
                    // dd($attrValueData);
                }
            }

            $ContentAttributeValue = ContentAttributeValue::updateOrCreate(
                ['content_id' => $content_id, 'content_attribute_id' => $field->id, 'content_type_id' => $content_type_id],
                $attrValueData
            );

            $fieldsId[] = $field->id;
            // dd($ContentAttributeValue);

            //$ContentAttributeValue=ContentAttributeValue::create($attrValueData);

        }
       // DB::enableQueryLog();

        $deleteObject = ContentAttributeValue::where('content_id', '=', $content_id)
            ->where('content_type_id', '<>', $content_type_id)->
            orWhereNotIn('content_attribute_id', $fieldsId)->delete();
        //dd(DB::getQueryLog());

        return 1;
    }


    public static function getTypeCombo($content_type_id, $content_attribute_id)
    {
        return contentAttributeCombo::where('content_attribute_id', '=', $content_attribute_id)->get();
        /*return contentAttributeCombo::where('content_type_id', '=', $content_type_id)
            ->where('content_attribute_id', '=', $content_attribute_id)
            ->get();*/
    }

    public static function create($data, $content_id, $content_type_id)
    {
        $attribute = self::getFormFieldsByContentTypeId($content_type_id);
        //dd($fieldsName);
        foreach ($attribute->contentAattributeFields as $field) {
            $formFieldName = 'attr_' . $field->id . '_' . $field->field_name;
            if (isset($data[$formFieldName])) {

                $attrValueData['content_id'] = $content_id;
                $attrValueData['content_type_id'] = $content_type_id;
                $attrValueData['content_attribute_id'] = $field->id;
                if(!isset($field->company_id))
                {

                    $attrValueData['company_id']=0;
                }else{
                    $attrValueData['company_id'] = $field->company_id;
                }
                $attrValueData['label'] = $field->label;
                $attrValueData['type'] = $field->element_type;
                $attrValueData['value'] = $data[$formFieldName];
               // dd($attrValueData);

                $ContentAttributeValue = ContentAttributeValue::create($attrValueData);
            }
        }
        return 1;
    }
}
