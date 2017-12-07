<?php
Blade::setContentTags('[[', ']]'); 		// for variables and all things Blade
Blade::setEscapedContentTags('[[[', ']]]'); 	// for escaped data
Blade::setRawTags('[!', '!]');	// for raw data

Route::pattern('id', '[0-9]+');
Route::pattern('uid', '[0-9]+');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//管理員 學校-科系
Route::get('/Ma/Subject', ['as' => 'ma.subject', 'uses' => 'AdController@SchoolSubject']);
Route::get('/Ma/Subject/list', ['as' => 'ma.subject.list', 'uses' => 'AdController@SchoolSubjectList']);
Route::post('/Ma/Subject/Add', ['as' => 'ma.subject.add', 'uses' => 'AdController@SchoolSubjectAdd']);

//管理員 管理使用者-匯入學校/代碼
Route::get('/Ma/School', ['as' => 'ma.school', 'uses' => 'AdController@School']);
Route::get('/Ma/School/list', ['as' => 'ma.school.list', 'uses' => 'AdController@SchoolList']);
Route::post('/Ma/School/Add', ['as' => 'ma.school.add', 'uses' => 'AdController@SchoolAdd']);

//管理員 課程設定
Route::get('/Ma/Course', ['as' => 'ma.course', 'uses' => 'AdController@Course']);
Route::get('/Ma/Course/list', ['as' => 'ma.course.list', 'uses' => 'AdController@CourseList']);
Route::post('/Ma/Course/Add', ['as' => 'ma.course.add', 'uses' => 'AdController@CourseAdd']);
