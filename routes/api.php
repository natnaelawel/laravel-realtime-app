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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::post('register', 'UserController@register');
// Route::post('login', 'UserController@authenticate');
// Route::get('open', 'DataController@open');

// Route::group(['middleware' => ['jwt.verify']], function() {
//     Route::get('user', 'UserController@getAuthenticatedUser');
//     Route::get('closed', 'DataController@closed');
// });

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('authenticated','AuthController@getAuthenticatedUser');



});


Route::apiResource('questions/{question}/replies', 'ReplyController');
Route::apiResource('questions', 'QuestionController');
Route::apiResource('categories', 'CategoryController');
Route::get('likes/{reply}', 'LikeController@likes');
Route::post('likes/{reply}', 'LikeController@likeIt');
Route::put('likes/{reply}', 'LikeController@likeUpdate');
Route::delete('likes/{reply}', 'LikeController@unLikeIt');


Route::post('notifications','NotificationController@index');
Route::post('markAsRead','NotificationController@markAsRead');
