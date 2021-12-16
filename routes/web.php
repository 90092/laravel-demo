<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PostController@postsPage');

Route::get('/home', 'PostController@postsPage')->name('home');

Route::middleware('auth')->get('/addPost', 'PostController@addPostPage')->name('addPost');

Route::middleware('auth')->get('/editPost/{post}', 'PostController@editPostPage')->name('editPost');

Auth::routes();
