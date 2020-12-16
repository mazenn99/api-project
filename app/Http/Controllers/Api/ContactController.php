<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    use apiTraitFunction;
    public function save(ContactRequest $request) {
        if(Contact::create($request->except('apiPassword'))) {
            return $this->returnResponseSuccessMessages('successfully send');
        }
    }
}
