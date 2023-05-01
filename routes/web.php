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

Route::get('/search', 'UsersController@index');

Route::get('/follow-list', 'PostsController@index');
Route::get('/follower-list', 'PostsController@index');

Route::post('/logout', 'Auth\loginController@logout')->name('logout');

//投稿機能のルーティング

Route::resource('posts', 'PostsController');
Route::get('/post', 'PostController@index')->name('posts.index');

//マイページ遷移のルーティング
Route::get('/user/{id}', [App\Http\Controllers\UsersController::class, 'show'])->name('user.show');
//フォロー機能のルーティング
Route::post('/follow/{user}', 'FollowsController@follow')->name('follow');
Route::post('/unfollow/{user}', 'FollowsController@unfollow')->name('unfollow');

//投稿編集のルーティング
Route::get('/posts/{id}edit', 'PostController@edit')->name('posts.edit');

//投稿削除のルーティング
Route::delete('/posts/{id}', 'PostController@destroy')->name('posts.destroy');
