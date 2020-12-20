<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QaVotesAnswerRequest extends FormRequest
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
            'answer_id'   => 'required|integer|exists:qa_answers,id',
            'vote_code_down' => 'integer',
            'vote_code_up'   => 'integer',
        ];
    }
}
