<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'comment'    => 'required',
            'reply_to'   => 'integer',
            'article_id' => 'required|integer|exists:articles,id',
            'visitor'    => 'nullable|max:45',
        ];
    }
}
