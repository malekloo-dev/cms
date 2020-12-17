<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

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
            'url.required' => Lang::get('messages.enter address'),
            'redirect_to.required' => Lang::get('messages.enter new address')
        ];
    }
}
