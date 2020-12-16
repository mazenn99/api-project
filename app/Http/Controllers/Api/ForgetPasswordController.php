<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\forgetPassRequest;
use App\Http\Requests\ResetRequest;
use App\Traits\apiTraitFunction;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    use apiTraitFunction;
    public function forgetPassword(forgetPassRequest $request) {
        $email = $request->input('email');
        $tokenPass = Str::random(50);
        DB::table('password_resets')->insert([
            'email'     => $email,
            'token'     => $tokenPass,
            'created_at'=> now(),
        ]);

        Mail::send('emails.reset' , ['token' => $tokenPass] , function(Message $message) use($email) {
            $message->to($email);
            $message->subject('Reset Your Password');
        });

        return $this->returnResponseSuccessMessages('send reset password successfully');

    }

    public function resetPassword(ResetRequest $request) {

    }
}
