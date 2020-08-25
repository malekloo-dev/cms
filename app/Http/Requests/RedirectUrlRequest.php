<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RedirectUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required',
            'redirect_to' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'url.required' => 'آدرس را وارد کنید.',
            'redirect_to.required' => 'آدرس جدید را وارد کنید.'
        ];
    }
}
