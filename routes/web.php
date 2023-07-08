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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top', 'PostsController@index')->name('top');

//プロフィール中のページ
Route::get('/users/profile', 'UsersController@profile')->name('profile');
Route::post('/update-profile', 'UsersController@updateProfile')->name('user.update-profile');

//　検索機能
Route::get('/users/search', 'UsersController@search')->name('users.search');

//　ログアウト
Route::post('/logout', 'Auth\loginController@logout')->name('logout');

//　投稿機能
Route::resource('posts', 'PostsController');

Route::get('/post', 'PostsController@index')->name('posts.index');

//　フォロー機能
Route::post('/users/{user}/follow', 'UsersController@follow')->name('follow');

Route::delete('/users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

Route::get('/follow-list', 'FollowsController@followList')->name('follow-list');

Route::get('/follower-list', 'FollowsController@followerList')->name('follower-list');

//　投稿編集
Route::get('/posts/{id}edit', 'PostsController@edit')->name('posts.edit');

Route::put('/posts/{id}', 'PostsController@update')->name('posts.update');

//　投稿削除
Route::delete('/posts/{id}', 'PostsController@destroy')->name('posts.destroy');

//　マイページ表示
Route::get('/users/{id}', 'UsersController@show')->name('users.show');
