<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
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
            'environment' => 'required|max:200',
            'specialize'  => 'required|max:200',
            'companyName' => 'required|max:200',
            'requirements'=> 'required|max:300',
            'contactRule' => 'required|max:100',
            'period'      => 'required|integer',
            'description' => 'required',
            'category'    => 'nullable|max:45',
            'title'       => 'nullable|max:250',
            'tags'        => 'nullable|max:35',
            'draft'       => 'nullable|integer',
            'view_count'  => 'integer',
            'picture'     => 'mimes:jpg,jpeg,png',
        ];
    }
}
