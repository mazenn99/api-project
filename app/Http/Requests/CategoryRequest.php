<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name'       => 'required|max:255',
            'type'       => 'required|in:category,article',
            'article_id' => 'integer|exists:articles,id|required_without:question_id',
            'question_id'=> 'integer|exists:qa_questions,id|required_without:article_id'
        ];
    }
}
