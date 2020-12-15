<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use App\Http\Requests\registerUser;
use App\Http\Requests\UpdateUserPass;
use App\Http\Requests\UpdateUserProfile;
use App\Traits\apiTraitFunction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use apiTraitFunction;
    public function register(registerUser $request) { // this function create new Users
        $request['password'] = bcrypt($request->input('password'));
        $user = User::create($request->only(['name' , 'email' , 'password']));
        if($user) {
            $accessToken = $user->createToken('authToken')->accessToken;
            $user['accessToken'] = $accessToken;
            return $this->returnResponseWithData(200 , TRUE , 'registered successfully' , 'user' , $user , 200);
        }
    }


    public function login(LoginUser $request) { // this function login user
        if(!auth()->attempt($request->only(['email' , 'password']))) {
            return $this->returnResponseError('E002' , 'Email or Password Incorrect' , 401);
        } else {
            $user = auth()->user();
            $accessToken = $user->createToken('authToken')->accessToken;
            $user['accessToken'] = $accessToken;
            return $this->returnResponseWithData(200, TRUE, 'login successfully', 'user', $user, 200);
        }
        return $this->returnResponseError('E004' , 'Server Error Please try again later' , 500);
    }

}
