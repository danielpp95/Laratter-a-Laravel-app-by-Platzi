<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@home');

Route::get('/messages/{message}', 'MessagesController@show');

Auth::routes();

Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');
Route::post('/auth/facebook/register', 'SocialAuthController@register');

Route::get('/@{username}', 'UsersController@show');
Route::get('/@{username}/follows', 'UsersController@follows');
Route::get('/@{username}/followers', 'UsersController@followers');



// Need to be logged for
Route::group(['middleware' => 'auth'], function () {
  // follow
  Route::post('/@{username}/follow', 'UsersController@follow');
  // unfollow
  Route::post('/@{username}/unfollow', 'UsersController@unfollow');
  // create new post
  Route::post('/messages/create', 'MessagesController@create');
  // send a DM
  Route::post('/@{username}/dms', 'UsersController@sendPrivateMessage');
  //
  Route::get('conversations/{conversation}', 'UsersController@showConversation');
});