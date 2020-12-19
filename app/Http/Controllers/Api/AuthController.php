<?php

namespace App\Http\Controllers\Api;

use App\Events\SendWelcomeEmailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUser;
use App\Http\Requests\registerUser;
use App\Jobs\SendWelcomeMail;
use App\Listeners\SendWelcomeEmailListener;
use App\User;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(registerUser $request) { // this function create new Users
        $request['password'] = bcrypt($request->input('password'));
        $user = User::create($request->all());
        if($user) {
            $this->dispatch(new SendWelcomeMail($user->email));
            $accessToken = $user->createToken('authToken')->accessToken;
            $user['accessToken'] = $accessToken;
            return $this->returnResponseWithData(200 , TRUE , __('apiError.register_success') , 'user' , $user , 200);
        }
    }


    public function login(LoginUser $request) { // this function login user
        if(!auth()->attempt($request->only(['email' , 'password']))) {
            return $this->returnResponseError('E002' , __('apiError.inCorrect_login') , 401);
        } else {
            $user = auth()->user();
            $accessToken = $user->createToken('authToken')->accessToken;
            $user['accessToken'] = $accessToken;
            return $this->returnResponseWithData(200, TRUE, __('apiError.login_success'), __('general.user'), $user, 200);
        }
        return $this->returnResponseError('E004' , __('apiError.server_error') , 500);
    }

}
