<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function save(ContactRequest $request) {
        if(Contact::create($request->except('apiPassword'))) {
            return $this->returnResponseSuccessMessages(__('apiError.send_success', ['name' => __('general.contact')]));
        }
    }
}
