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

//管理員 評閱者資料管理
Route::get('/Ma/revised', ['as' => 'ma.revised', 'uses' => 'AdController@Revised']);
Route::get('/Ma/revised/List', ['as' => 'ma.revised.list', 'uses' => 'AdController@RevisedList']);
Route::get('/Ma/revised/Data', ['as' => 'ma.revised.data', 'uses' => 'AdController@RevisedData']);
Route::get('/Ma/revised/Add/Pg', ['as' => 'ma.revised.add.pg', 'uses' => 'AdController@RevisedAddPg']);
Route::get('/Ma/revised/Edit/Pg', ['as' => 'ma.revised.edit.pg', 'uses' => 'AdController@RevisedEditPg']);
Route::post('/Ma/revised/Add', ['as' => 'ma.revised.add', 'uses' => 'AdController@RevisedAdd']);
Route::post('/Ma/revised/Update', ['as' => 'ma.revised.update', 'uses' => 'AdController@RevisedUpdate']);


//受測者 首頁
Route::get('/Ur', ['as' => 'ur.index', 'uses' => 'UrController@Index']);

//受測者 使用者管理
Route::get('/Ur/User', ['as' => 'ur.user', 'uses' => 'UrController@User']);
Route::get('/Ur/User/Data', ['as' => 'ur.user.data', 'uses' => 'UrController@UserData']);
Route::post('/Ur/User/Update', ['as' => 'ur.user.update', 'uses' => 'UrController@UserUpdate']);


//受測者 試卷管理
Route::get('/Ur/Reel', ['as' => 'ur.reel', 'uses' => 'UrController@Reel']);
Route::get('/Ur/Reel/List', ['as' => 'ur.reel.list', 'uses' => 'UrController@ReelList']);
Route::get('/Ur/Reel/Data', ['as' => 'ur.reel.data', 'uses' => 'UrController@ReelData']);
Route::get('/Ur/Reel/Edit/{id}', ['as' => 'ur.reel.edit', 'uses' => 'UrController@ReelEdit']);
Route::post('/Ur/Reel/Add', ['as' => 'ur.reel.add', 'uses' => 'UrController@ReelAdd']);

//批閱者 寫作閱卷標準手冊
Route::get('/Rv/Manual', ['as' => 'rv.manual', 'uses' => 'RvController@Manual']);

//批閱者 注意事項
Route::get('/Rv/Precautions', ['as' => 'rv.precautions', 'uses' => 'RvController@Precautions']);
Route::get('/Rv/Precautions/Data', ['as' => 'rv.precautions.data', 'uses' => 'RvController@PrecautionsData']);

//批閱者 線上閱卷
Route::get('/Rv/Scroll', ['as' => 'rv.scroll', 'uses' => 'RvController@Scroll']);
//批閱者 參考樣卷
Route::get('/Rv/Scroll/Demo', ['as' => 'rv.scroll.demo', 'uses' => 'RvController@ScrollDemo']);
//批閱者 閱卷訓練
Route::get('/Rv/Scroll/Training', ['as' => 'rv.scroll.training', 'uses' => 'RvController@ScrollTraining']);
//批閱者 開始批改 試卷選擇頁面
Route::get('/Rv/Scroll/Reel/list', ['as' => 'rv.scroll.reel.list', 'uses' => 'RvController@ScrollReelList']);
//批閱者 開始批改 批改試卷資料
Route::get('/Rv/Scroll/Reel/View/{id}', ['as' => 'rv.scroll.reel.view', 'uses' => 'RvController@ScrollReelView']);
Route::get('/Rv/Scroll/Reel/Data', ['as' => 'rv.scroll.reel.data', 'uses' => 'RvController@ScrollReelData']);
Route::post('/Rv/Scroll/Reel/Update', ['as' => 'rv.scroll.reel.update', 'uses' => 'RvController@ScrollReelUpdate']);

//批閱者 批改統計
Route::get('/Rv/Statistics', ['as' => 'rv.statistics', 'uses' => 'RvController@Statistics']);

//批閱者 使用者管理
Route::get('/Rv/User', ['as' => 'rv.user', 'uses' => 'RvController@User']);
Route::get('/Rv/User/Data', ['as' => 'rv.user.data', 'uses' => 'RvController@UserData']);
Route::post('/Rv/User/Update', ['as' => 'rv.user.update', 'uses' => 'RvController@UserUpdate']);

//批閱者 檔案下載
Route::get('/Rv/Files', ['as' => 'rv.files', 'uses' => 'RvController@Files']);
