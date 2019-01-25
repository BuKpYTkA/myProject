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

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get('myposts', 'PostController@myPosts')->name('posts.myPosts');
        Route::prefix('post')->group(function () {
            Route::get('{id}/edit', 'PostController@editPostForm')->name('posts.editPostForm')->where('id', '[0-9]+');
            Route::post('{id}/edit', 'PostController@editPost')->name('posts.editPost');
            Route::get('create', 'PostController@createPostForm')->name('posts.createPostForm');
            Route::post('create', 'PostController@createPost')->name('posts.createPost');
            Route::get('deletePost/{id}', 'UserController@returnHome')->name('posts.deletePostForm')->where('id', '[0-9]+');
            Route::post('deletePost/{id}', 'PostController@deletePost')->name('posts.deletePost')->where('id', '[0-9]+');
        });
    });
    Route::prefix('cabinet')->group(function () {
        Route::get('/', 'UserController@editPersonalForm')->name('cabinet.mainCabinet');
        Route::post('/', 'UserController@editPersonal')->name('cabinet.editPersonal')->where('id', '[0-9]+');
        Route::get('edit_password', 'UserController@editPasswordForm')->name('cabinet.editPasswordForm');
        Route::post('edit_password', 'UserController@editPassword')->name('cabinet.editPassword');
    });
});
Route::prefix('user')->group(function () {
    Route::get('alias/{alias}', 'PostController@postsByUserAliasForm')->name('posts.postsByAlias');
    Route::get('id/{id}', 'PostController@postsByUserIdForm')->name('posts.postsById')->where('id', '[0-9]+');
    Route::post('search_result', 'UserController@searchUser')->name('userSearch');
    Route::get('search_result', 'HomeController@index')->name('userSearchForm');
});

Route::prefix('posts')->group(function () {
    Route::prefix('post')->group(function () {
        Route::get('{id}', 'PostController@getPost')->name('posts.post')->where('id', '[0-9]+');
    });
});


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
