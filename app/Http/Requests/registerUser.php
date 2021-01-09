<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerUser extends FormRequest
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
            'fullName'        => 'required|min:2|max:100',
            'email'           => 'required|email|max:100|unique:users,email',
            'password'        => 'required',
            'twitter'         => 'nullable|url',
            'bio'             => 'nullable|max:200',
            'askfm'           => 'nullable|url|max:45',
            'linkedin'        => 'nullable|url|max:45',
            'image'           => 'nullable|mimes:jpg,jpeg,pdf,png|max:5000',
            'facebookID'      => 'nullable|integer',
            'twitterID'       => 'nullable|integer',
            'facebook'        => 'nullable|max:45',
            'user_university' => 'nullable|string|max:35',
            'user_specialist' => 'nullable|string|max:35',
            'user_region'     => 'nullable|string|max:35',
            'user_faculity'   => 'nullable|string|max:50',
        ];
    }
}
