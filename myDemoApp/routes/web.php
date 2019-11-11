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

// 테스트용 주석 추가

Route::get('/', function () {
    // return redirect('/login');
    return redirect('/questions');
});

Route::resource('/comments', 'CommentController');

Route::resource('/questions', 'QuestionController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
