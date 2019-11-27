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
Route::patch('/comments/update', 'CommentController@update');
Route::delete('/comments/delete', 'CommentController@destroy');
Route::post('/comments/create', 'CommentController@create');

Route::resource('/questions', 'QuestionController');
Route::patch('/questions/update', 'QuestionController@update');
Route::post('/questions/search', 'QuestionController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/intro','IntroController@index');
Route::get('/intro/create','IntroController@create');
Route::post('/intro','IntroController@store');
Route::get('/intro/alter', 'IntroController@alter');
