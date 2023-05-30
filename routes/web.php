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

Route::get('/profile', 'UsersController@profile')->name('profile');

//　検索機能
Route::get('/users/search', 'UsersController@search')->name('users.search');

//　ログアウト
Route::post('/logout', 'Auth\loginController@logout')->name('logout');

//　投稿機能
Route::resource('posts', 'PostsController');
Route::get('/post', 'PostController@index')->name('posts.index');

//　フォロー機能
Route::post('/users/{user}/follow', [UsersController::class, 'follow'])->name('follow');
Route::delete('/users/{user}/unfollow', [UsersController::class, 'unfollow'])->name('unfollow');
Route::get('/follow-list', 'FollowsController@followList')->name('follow-list');
Route::get('/follower-list', 'FollowsController@followerList')->name('follower-list');

//　投稿編集
Route::get('/posts/{id}edit', 'PostController@edit')->name('posts.edit');
Route::put('/posts/{id}', 'PostController@update')->name('posts.update');

//　投稿削除
Route::delete('/posts/{id}', 'PostController@destroy')->name('posts.destroy');

//　マイページ表示
Route::get('/users/{id}', [App\Http\Controllers\UsersController::class, 'show'])->name('users.show');
