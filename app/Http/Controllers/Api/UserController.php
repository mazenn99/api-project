<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPass;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use apiTraitFunction;
    public function updateProfile(UpdateUserProfile $request) {
        if(auth()->user()->update($request->only(['name' , 'email']))) {
            return $this->returnResponseSuccessMessages('updated Successfully');
        }
        return $this->returnResponseError('E004' , 'Server Error Please try again later' , 500);
    }

    public function updatePassword(UpdateUserPass $request) {
        if(Hash::check($request->input('old_password') , auth()->user()->password)) {
            if(auth()->user()->update(['password' => bcrypt($request->input('new_password'))])) {
                return $this->returnResponseSuccessMessages('updated Password Successfully');
            } else {
                return $this->returnResponseError('E005' , 'Server Error Please try again later' , 500);
            }
        } else {
            return $this->returnResponseError('E006' , 'sorry password inCorrect' , 401);
        }
    }
}
