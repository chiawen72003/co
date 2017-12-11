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

//管理員 單元結構
Route::get('/Ma/Unit', ['as' => 'ma.unit', 'uses' => 'AdController@Unit']);
Route::get('/Ma/Unit/list', ['as' => 'ma.unit.list', 'uses' => 'AdController@UnitList']);
Route::post('/Ma/Unit/Add', ['as' => 'ma.unit.add', 'uses' => 'AdController@UnitAdd']);

//管理員 試卷設定
Route::get('/Ma/Reel', ['as' => 'ma.reel', 'uses' => 'AdController@Reel']);
Route::get('/Ma/Reel/list', ['as' => 'ma.reel.list', 'uses' => 'AdController@ReelList']);
Route::post('/Ma/Reel/Add', ['as' => 'ma.reel.add', 'uses' => 'AdController@ReelAdd']);

//管理員 試題管理
Route::get('/Ma/Question', ['as' => 'ma.question', 'uses' => 'AdController@Question']);
Route::get('/Ma/Question/list', ['as' => 'ma.question.list', 'uses' => 'AdController@QuestionList']);
Route::get('/Ma/Question/data', ['as' => 'ma.question.data', 'uses' => 'AdController@QuestionData']);
Route::get('/Ma/Question/pg/add', ['as' => 'ma.question.pg.add', 'uses' => 'AdController@QuestionPgAdd']);
Route::get('/Ma/Question/pg/edit', ['as' => 'ma.question.pg.edit', 'uses' => 'AdController@QuestionPgEdit']);
Route::post('/Ma/Question/Add', ['as' => 'ma.question.add', 'uses' => 'AdController@QuestionAdd']);
Route::post('/Ma/Question/Update', ['as' => 'ma.question.update', 'uses' => 'AdController@QuestionUpdate']);

//管理員 注意事項
Route::get('/Ma/Precautions', ['as' => 'ma.precautions', 'uses' => 'AdController@Precautions']);
Route::get('/Ma/Precautions/Data', ['as' => 'ma.precautions.data', 'uses' => 'AdController@PrecautionsData']);
Route::post('/Ma/Precautions/Update', ['as' => 'ma.precautions.update', 'uses' => 'AdController@PrecautionsUpdate']);
