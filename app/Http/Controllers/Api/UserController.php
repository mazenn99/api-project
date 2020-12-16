<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPass;
use App\Http\Requests\UpdateUserProfile;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }
    use apiTraitFunction;
    public function updateProfile(UpdateUserProfile $request) { // this function update general information of user
        if(auth()->user()->update($request->all())) {
            return $this->returnResponseSuccessMessages('updated Successfully');
        }
        return $this->returnResponseError('E004' , 'Server Error Please try again later' , 500);
    }

    public function updatePassword(UpdateUserPass $request) { // this function update ONLY password of user
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
