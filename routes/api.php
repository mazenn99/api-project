<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route Create User , Login User , Update Profile and password , reset password :
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
// using UserController update profile and change password
Route::post('update-profile', 'UserController@updateProfile');
Route::post('update-password', 'UserController@updatePassword');
// using ForgetPasswordController , ResetPasswordController
Route::post('password/email' , 'ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset' , 'ResetPasswordController@reset');
// Route Create User , Login User , Update Profile and password , reset password :
// ------------------------------------------------------------------------------ //
// Route Articles CRUD :
Route::apiResource('article' , 'ArticleController');
// article upload image
Route::post('article/upload' , 'ArticleController@uploadImage');
// ------------------------------------------------------------------------------ //
// Route Comment
Route::apiResource('comment' , 'CommentController');
// ------------------------------------------------------------------------------ //
// Route CONTACT CREATE :
Route::post('contact' , 'ContactController@save');
// ------------------------------------------------------------------------------ //
// Route FAVORITE INDEX , STORE , DELETE :
Route::apiResource('favorite' , 'FavoriteController');
// ------------------------------------------------------------------------------ //
// Route Report
Route::apiResource('report' , 'ReportController');
// ------------------------------------------------------------------------------ //
// Route Question
Route::apiResource('question' , 'QuestionController');
// ------------------------------------------------------------------------------ //
// Route Answers
Route::apiResource('answer' , 'QaAnswerController');
// ------------------------------------------------------------------------------ //
// Route Votes
Route::apiResource('votes' , 'VotesController');
// ------------------------------------------------------------------------------ //
// Route Votes
Route::apiResource('category' , 'CategoryController');
// ------------------------------------------------------------------------------ //
// Route Votes_answer
Route::apiResource('votes/answer' , 'QaVotesAnswerController');
// Route Search (Article && Question)
Route::post('question/search' , 'SearchController@QuestionSearch');
// articles search
Route::post('article/search' , 'SearchController@ArticleSearch');
// ------------------------------------------------------------------------------ //
// Route Notification
Route::get('notifications' , 'NotificationController@allNotification');
Route::get('notifications/read' , 'NotificationController@unReadNotification');
Route::get('notifications/unread' , 'NotificationController@readNotification');

