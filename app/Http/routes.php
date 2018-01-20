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

//首頁 登入頁面
Route::get('/', ['as' => 'member.login', 'uses' => 'MemController@Login']);
Route::get('/Logout', ['as' => 'member.logout', 'uses' => 'MemController@Logout']);
Route::post('/Login/Chk', ['as' => 'member.login.chk', 'uses' => 'MemController@LoginChk']);
Route::get('/Login/School/list', ['as' => 'member.school.list', 'uses' => 'MemController@SchoolList']);

//管理員端
Route::group(['middleware' => 'AdSessionCheck'], function () {
    //管理員 最新消息
    Route::get('/Ma/News', ['middleware' => 'IsLoginCheck','as' => 'ma.news', 'uses' => 'AdController@News']);
    Route::get('/Ma/News/list', ['as' => 'ma.news.list', 'uses' => 'AdController@NewsList']);
    Route::post('/Ma/News/Add', ['as' => 'ma.news.add', 'uses' => 'AdController@NewsAdd']);
    Route::post('/Ma/News/Update', ['as' => 'ma.news.update', 'uses' => 'AdController@NewsUpdate']);

    //管理員 學校-科系
    Route::get('/Ma/Subject', ['as' => 'ma.subject', 'uses' => 'AdController@SchoolSubject']);
    Route::get('/Ma/Subject/list', ['as' => 'ma.subject.list', 'uses' => 'AdController@SchoolSubjectList']);
    Route::post('/Ma/Subject/Add', ['as' => 'ma.subject.add', 'uses' => 'AdController@SchoolSubjectAdd']);

    //管理員 管理使用者-匯入學校/代碼
    Route::get('/Ma/School', ['as' => 'ma.school', 'uses' => 'AdController@School']);
    Route::get('/Ma/School/list', ['as' => 'ma.school.list', 'uses' => 'AdController@SchoolList']);
    Route::get('/Ma/School/Init', ['as' => 'ma.school.init', 'uses' => 'AdController@SchoolInit']);

    //管理員 學校-班級
    Route::get('/Ma/Classes/', ['as' => 'ma.classes', 'uses' => 'AdController@Classes']);
    Route::get('/Ma/Classes/Init', ['as' => 'ma.classes.init', 'uses' => 'AdController@ClassesInit']);
    Route::post('/Ma/Classes/Add', ['as' => 'ma.classes.add', 'uses' => 'AdController@ClassesAdd']);

    //管理員 課程設定 新增課程
    Route::get('/Ma/Course', ['as' => 'ma.course', 'uses' => 'AdController@Course']);
    Route::get('/Ma/Course/list', ['as' => 'ma.course.list', 'uses' => 'AdController@CourseList']);
    Route::post('/Ma/Course/Add', ['as' => 'ma.course.add', 'uses' => 'AdController@CourseAdd']);

    //管理員 課程設定 課程與學員對應
    Route::get('/Ma/Course/Student', ['as' => 'ma.course.student', 'uses' => 'AdController@CourseStudent']);
    Route::get('/Ma/Course/Student/list', ['as' => 'ma.course.student.list', 'uses' => 'AdController@CourseStudentList']);
    Route::post('/Ma/Course/Student/Add', ['as' => 'ma.course.student.add', 'uses' => 'AdController@CourseStudentAdd']);

    //管理員 課程設定 課程-試卷對應
    Route::get('/Ma/Course/Reel', ['as' => 'ma.course.reel', 'uses' => 'AdController@CourseReel']);
    Route::get('/Ma/Course/Reel/list', ['as' => 'ma.course.reel.list', 'uses' => 'AdController@CourseReelList']);
    Route::post('/Ma/Course/Reel/Add', ['as' => 'ma.course.reel.add', 'uses' => 'AdController@CourseReelAdd']);

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
    Route::get('/Ma/Question/api', ['as' => 'ma.question.api', 'uses' => 'AdController@QuestionApi']);
    Route::get('/Ma/Question/list', ['as' => 'ma.question.list', 'uses' => 'AdController@QuestionList']);
    Route::get('/Ma/Question/pg/add', ['as' => 'ma.question.pg.add', 'uses' => 'AdController@QuestionPgAdd']);
    Route::get('/Ma/Question/pg/edit', ['as' => 'ma.question.pg.edit', 'uses' => 'AdController@QuestionPgEdit']);
    Route::post('/Ma/Question/api', ['as' => 'ma.question.api', 'uses' => 'AdController@QuestionEditApi']);
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

    //管理員 評閱者-試卷資料管理
    Route::get('/Ma/revised/Reel', ['as' => 'ma.revised.reel', 'uses' => 'AdController@RevisedReel']);
    Route::get('/Ma/revised/Reel/List', ['as' => 'ma.revised.reel.list', 'uses' => 'AdController@RevisedReelList']);
    Route::post('/Ma/revised/Reel/Add', ['as' => 'ma.revised.reel.add', 'uses' => 'AdController@RevisedReelAdd']);

    //管理員 修改個人資訊
    Route::get('/Ma/User', ['as' => 'ma.user', 'uses' => 'AdController@User']);
    Route::get('/Ma/User/Data', ['as' => 'ma.user.data', 'uses' => 'AdController@UserData']);
    Route::post('/Ma/User/Update', ['as' => 'ma.user.update', 'uses' => 'AdController@UserUpdate']);

    //管理員 管理使用者 修改學生資訊
    Route::get('/Ma/Student', ['as' => 'ma.student', 'uses' => 'AdController@Student']);
    Route::get('/Ma/Student/List', ['as' => 'ma.student.list', 'uses' => 'AdController@StudentList']);
    Route::post('/Ma/Student/Add', ['as' => 'ma.student.add', 'uses' => 'AdController@StudentAdd']);
    Route::post('/Ma/Student/Update', ['as' => 'ma.student.update', 'uses' => 'AdController@StudentUpdate']);
});

//受測者
Route::group(['middleware' => 'StudentCheck'], function () {
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
});

//批閱者
Route::group(['middleware' => 'RevisedCheck'], function () {
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
    Route::get('/Rv/Scroll/Reel/Pg', ['as' => 'rv.scroll.reel.pg', 'uses' => 'RvController@ScrollReelPg']);
    Route::get('/Rv/Scroll/Reel/List', ['as' => 'rv.scroll.reel.list', 'uses' => 'RvController@ScrollReelList']);
    //批閱者 開始批改 批改試卷資料
    Route::get('/Rv/Scroll/Reel/View/{id}', ['as' => 'rv.scroll.reel.view', 'uses' => 'RvController@ScrollReelView']);
    Route::get('/Rv/Scroll/Reel/Data', ['as' => 'rv.scroll.reel.data', 'uses' => 'RvController@ScrollReelData']);
    Route::post('/Rv/Scroll/Reel/Update', ['as' => 'rv.scroll.reel.update', 'uses' => 'RvController@ScrollReelUpdate']);

    //批閱者 批改統計
    Route::get('/Rv/Statistics', ['as' => 'rv.statistics', 'uses' => 'RvController@Statistics']);
    Route::get('/Rv/Statistics/Data', ['as' => 'rv.statistics.data', 'uses' => 'RvController@StatisticsData']);

    //批閱者 使用者管理
    Route::get('/Rv/User', ['as' => 'rv.user', 'uses' => 'RvController@User']);
    Route::get('/Rv/User/Data', ['as' => 'rv.user.data', 'uses' => 'RvController@UserData']);
    Route::post('/Rv/User/Update', ['as' => 'rv.user.update', 'uses' => 'RvController@UserUpdate']);

    //批閱者 檔案下載
    Route::get('/Rv/Files', ['as' => 'rv.files', 'uses' => 'RvController@Files']);
});

