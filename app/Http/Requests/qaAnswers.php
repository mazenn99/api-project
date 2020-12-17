<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class qaAnswers extends FormRequest
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
            'description'   => 'required',
            'correct'       => 'integer',
            'qa_question_id'=> 'required|exists:qa_questions,id',
            'notify_answer' => 'integer',
            'notify_correct'=> 'integer',
            'points_answer' => 'integer',
            'points_correct'=> 'integer'
        ];
    }
}
