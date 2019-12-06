<?php
Route::get('/', function () {
    return view('main');
});

Route::resource('/comments', 'CommentController');
Route::patch('/comments/update', 'CommentController@update');
Route::delete('/comments/delete', 'CommentController@destroy');
Route::post('/comments/create', 'CommentController@create');

Route::resource('/questions', 'QuestionController');
Route::patch('/questions/update', 'QuestionController@update');
Route::post('/questions/search', 'QuestionController@search');

Route::resource('/members', 'MembersController');
Route::patch('/members/update', 'MembersController@update');
Route::delete('/members/delete', 'MembersController@destroy');
Route::post('/members/upload', 'MembersController@upload');
Route::post('/members/create', 'MembersController@create');

Route::resource('/infos', 'InfoController');
Route::patch('/infos/update', 'InfoController@update');
Route::delete('/infos/delete', 'InfoController@destroy');
Route::post('/infos/create', 'InfoController@create');

Route::resource('/places', 'PlaceController');
Route::patch('/places/update', 'PlaceController@update');
Route::delete('/places/delete', 'PlaceController@destroy');
Route::patch('/places/create', 'PlaceController@create');
Route::post('/places/upload', 'PlaceController@upload');
Route::post('/places/store', 'PlaceController@store');

// 회원가입 화면 띄우기
Route::get('/auth/register','UsersController@create');

// 회원가입 요청
Route::post('/signup/store','UsersController@store');

// 로그인 화면 띄우기
Route::get('/login','UsersController@login');

// 로그인 요청
Route::post('/login','UsersController@check');

// 로그아웃
Route::get('/logout','UsersController@logout');

// 비밀번호 찾기 화면 띄우기
Route::get('/auth/send', [
    'as'=>'password.send',
    'uses'=>'PasswordsController@getEmail'
]);

// 비밀번호 찾기 url 메일 보내기
Route::post('/auth/send', 'PasswordsController@sendEmail');

// 비밀번호 재설정 url 연결
Route::get('auth/reset/{token}',function($token){
    return view('users.reset')->with(['id'=>$token]);
});

// 비밀번호 재설정 요청
Route::post('auth/reset', ['as'=>'reset.store','uses'=>'PasswordsController@postReset']);




?>