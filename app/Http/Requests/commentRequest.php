<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class CommentRequest extends FormRequest
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
            'content_id' => 'required',
            'name' => 'required',
            'comment' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'content_id.required' => Lang::get('messages.enter content id'),
            'name.required' => Lang::get('messages.enter name'),
            'comment.required' => Lang::get('messages.enter comment')
        ];
    }
}
