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
    Route::get('/Ma/Subject/Init', ['as' => 'ma.subject.init', 'uses' => 'AdController@SchoolSubjectInit']);
    Route::post('/Ma/Subject/Add', ['as' => 'ma.subject.add', 'uses' => 'AdController@SchoolSubjectAdd']);

    //管理員 管理使用者-匯入學校/代碼
    Route::get('/Ma/School', ['as' => 'ma.school', 'uses' => 'AdController@School']);
    Route::get('/Ma/School/list', ['as' => 'ma.school.list', 'uses' => 'AdController@SchoolList']);
    Route::get('/Ma/School/Init', ['as' => 'ma.school.init', 'uses' => 'AdController@SchoolInit']);

    //管理員 學校-班級
    Route::get('/Ma/Classes/', ['as' => 'ma.classes', 'uses' => 'AdController@Classes']);
    Route::get('/Ma/Classes/Init', ['as' => 'ma.classes.init', 'uses' => 'AdController@ClassesInit']);
    Route::post('/Ma/Classes/Add', ['as' => 'ma.classes.add', 'uses' => 'AdController@ClassesAdd']);
    Route::post('/Ma/Classes/Add/Student', ['as' => 'ma.classes.add.student', 'uses' => 'AdController@ClassesAddStudent']);

    //管理員 課程設定 新增課程
    Route::get('/Ma/Course', ['as' => 'ma.course', 'uses' => 'AdController@Course']);
    Route::get('/Ma/Course/page', ['as' => 'ma.course.page', 'uses' => 'AdController@CoursePage']);
    Route::get('/Ma/Course/list', ['as' => 'ma.course.list', 'uses' => 'AdController@CourseList']);
    Route::post('/Ma/Course/Add', ['as' => 'ma.course.add', 'uses' => 'AdController@CourseAdd']);

    //管理員 課程設定 課程與學員對應
    Route::get('/Ma/Course/Student', ['as' => 'ma.course.student', 'uses' => 'AdController@CourseStudent']);
    Route::get('/Ma/Course/Student/Init', ['as' => 'ma.course.student.init', 'uses' => 'AdController@CourseStudentInit']);
    Route::get('/Ma/Course/Student/list', ['as' => 'ma.course.student.list', 'uses' => 'AdController@CourseStudentList']);
    Route::post('/Ma/Course/Student/Add', ['as' => 'ma.course.student.add', 'uses' => 'AdController@CourseStudentAdd']);

    //管理員 課程設定 課程-試卷對應
    Route::get('/Ma/Course/Reel', ['as' => 'ma.course.reel', 'uses' => 'AdController@CourseReel']);
    Route::get('/Ma/Course/Reel/Init', ['as' => 'ma.course.reel.init', 'uses' => 'AdController@CourseReelInit']);
    Route::get('/Ma/Course/Reel/list', ['as' => 'ma.course.reel.list', 'uses' => 'AdController@CourseReelList']);
    Route::post('/Ma/Course/Reel/Add', ['as' => 'ma.course.reel.add', 'uses' => 'AdController@CourseReelAdd']);
    Route::post('/Ma/Course/Reel/Del', ['as' => 'ma.course.reel.del', 'uses' => 'AdController@CourseReelDel']);

    //管理員 單元結構
    Route::get('/Ma/Unit', ['as' => 'ma.unit', 'uses' => 'AdController@Unit']);
    Route::get('/Ma/Unit/list', ['as' => 'ma.unit.list', 'uses' => 'AdController@UnitList']);
    Route::post('/Ma/Unit/Add', ['as' => 'ma.unit.add', 'uses' => 'AdController@UnitAdd']);
    Route::post('/Ma/Unit/Del', ['as' => 'ma.unit.del', 'uses' => 'AdController@UnitDel']);

    //管理員 試卷設定
    Route::get('/Ma/Reel', ['as' => 'ma.reel', 'uses' => 'AdController@Reel']);
    Route::get('/Ma/Reel/Init', ['as' => 'ma.reel.init', 'uses' => 'AdController@ReelInit']);
    Route::get('/Ma/Reel/List', ['as' => 'ma.reel.list', 'uses' => 'AdController@ReelList']);
    Route::post('/Ma/Reel/Add', ['as' => 'ma.reel.add', 'uses' => 'AdController@ReelAdd']);
    Route::post('/Ma/Reel/Del', ['as' => 'ma.reel.del', 'uses' => 'AdController@ReelDel']);

    //管理員 試題管理
    Route::get('/Ma/Question', ['as' => 'ma.question', 'uses' => 'AdController@Question']);
    Route::get('/Ma/Question/api', ['as' => 'ma.question.api', 'uses' => 'AdController@QuestionApi']);
    Route::get('/Ma/Question/list', ['as' => 'ma.question.list', 'uses' => 'AdController@QuestionList']);
    Route::get('/Ma/Question/pg/add', ['as' => 'ma.question.pg.add', 'uses' => 'AdController@QuestionPgAdd']);
    Route::get('/Ma/Question/pg/edit', ['as' => 'ma.question.pg.edit', 'uses' => 'AdController@QuestionPgEdit']);
    Route::post('/Ma/Question/api', ['as' => 'ma.question.api', 'uses' => 'AdController@QuestionEditApi']);
    Route::post('/Ma/Question/Add', ['as' => 'ma.question.add', 'uses' => 'AdController@QuestionAdd']);
    Route::post('/Ma/Question/Update', ['as' => 'ma.question.update', 'uses' => 'AdController@QuestionUpdate']);
    Route::post('/Ma/Question/Del', ['as' => 'ma.question.del', 'uses' => 'AdController@QuestionDel']);

    //管理員 注意事項
    Route::get('/Ma/Precautions', ['as' => 'ma.precautions', 'uses' => 'AdController@Precautions']);
    Route::get('/Ma/Precautions/Data', ['as' => 'ma.precautions.data', 'uses' => 'AdController@PrecautionsData']);
    Route::post('/Ma/Precautions/Update', ['as' => 'ma.precautions.update', 'uses' => 'AdController@PrecautionsUpdate']);

    //管理員 評閱者資料管理
    Route::get('/Ma/revised', ['as' => 'ma.revised', 'uses' => 'AdController@Revised']);
    Route::get('/Ma/revised/Init', ['as' => 'ma.revised.init', 'uses' => 'AdController@RevisedInit']);
    Route::get('/Ma/revised/Data', ['as' => 'ma.revised.data', 'uses' => 'AdController@RevisedData']);
    Route::get('/Ma/revised/Add/Pg', ['as' => 'ma.revised.add.pg', 'uses' => 'AdController@RevisedAddPg']);
    Route::get('/Ma/revised/Edit/Pg', ['as' => 'ma.revised.edit.pg', 'uses' => 'AdController@RevisedEditPg']);
    Route::post('/Ma/revised/Add', ['as' => 'ma.revised.add', 'uses' => 'AdController@RevisedAdd']);
    Route::post('/Ma/revised/Update', ['as' => 'ma.revised.update', 'uses' => 'AdController@RevisedUpdate']);

    //管理員 批改管理 派卷管理
    Route::get('/Ma/revised/Reel', ['as' => 'ma.revised.reel', 'uses' => 'AdController@RevisedReel']);
    Route::get('/Ma/revised/Reel/Init', ['as' => 'ma.revised.reel.init', 'uses' => 'AdController@RevisedReelInit']);
    Route::post('/Ma/revised/Reel/Add', ['as' => 'ma.revised.reel.add', 'uses' => 'AdController@RevisedReelAdd']);

    //管理員 修改個人資訊
    Route::get('/Ma/User', ['as' => 'ma.user', 'uses' => 'AdController@User']);
    Route::get('/Ma/User/Data', ['as' => 'ma.user.data', 'uses' => 'AdController@UserData']);
    Route::post('/Ma/User/Update', ['as' => 'ma.user.update', 'uses' => 'AdController@UserUpdate']);

    //管理員 修改學生資訊
    Route::get('/Ma/Student', ['as' => 'ma.student', 'uses' => 'AdController@Student']);
    Route::get('/Ma/Student/Init', ['as' => 'ma.student.init', 'uses' => 'AdController@StudentInit']);
    Route::get('/Ma/Student/List', ['as' => 'ma.student.list', 'uses' => 'AdController@StudentList']);
    Route::post('/Ma/Student/Add', ['as' => 'ma.student.add', 'uses' => 'AdController@StudentAdd']);
    Route::post('/Ma/Student/Update', ['as' => 'ma.student.update', 'uses' => 'AdController@StudentUpdate']);
    Route::post('/Ma/Student/Del', ['as' => 'ma.student.del', 'uses' => 'AdController@StudentDel']);

    //管理員 檔案下載管理
    Route::get('/Ma/Files', ['as' => 'ma.files', 'uses' => 'AdController@Files']);
    Route::get('/Ma/Files/Download/{id}', ['as' => 'ma.files.download', 'uses' => 'AdController@FilesDownload']);
    Route::post('/Ma/Files/Add', ['as' => 'ma.files.add', 'uses' => 'AdController@FilesAdd']);
    Route::post('/Ma/Files/Delete', ['as' => 'ma.files.delete', 'uses' => 'AdController@FilesDelete']);

    //管理員 作答結果查詢設定
    Route::get('/Ma/Reel/Analysis', ['as' => 'ma.reel.analysis', 'uses' => 'AdController@ReelAnalysis']);
    Route::get('/Ma/Reel/Analysis/Init', ['as' => 'ma.reel.analysis.init', 'uses' => 'AdController@ReelAnalysisInit']);
    Route::get('/Ma/Reel/Analysis/List', ['as' => 'ma.reel.analysis.list', 'uses' => 'AdController@ReelAnalysisList']);
    Route::get('/Ma/Reel/Analysis/List/Init', ['as' => 'ma.reel.analysis.list.init', 'uses' => 'AdController@ReelAnalysisListInit']);
    Route::get('/Ma/Reel/Analysis/Download/Excel', ['as' => 'ma.reel.analysis.download.excel', 'uses' => 'AdController@ReelAnalysisDownloadExcel']);

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

    //受測者 成果查詢
    Route::get('/Ur/Score', ['as' => 'ur.score', 'uses' => 'UrController@Score']);
    Route::get('/Ur/Score/Api', ['as' => 'ur.score.api', 'uses' => 'UrController@ScoreApi']);
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
    Route::get('/Rv/Scroll/Change/List', ['as' => 'rv.scroll.change.list', 'uses' => 'RvController@ScrollChangeList']);
    Route::get('/Rv/Scroll/Change/Api', ['as' => 'rv.scroll.change.api', 'uses' => 'RvController@ScrollChangeApi']);
    Route::get('/Rv/Scroll/Change/{id}', ['as' => 'rv.scroll.reel.change', 'uses' => 'RvController@ScrollChange']);
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
    Route::get('/Rv/Files/Download/{id}', ['as' => 'rv.files.download', 'uses' => 'RvController@FilesDownload']);
});

//校管理
Route::group(['middleware' => 'SchoolMenCheck'], function () {
    //課程設定 新增課程
    Route::get('/Sm/Course', ['as' => 'sm.course', 'uses' => 'SmController@Course']);
    Route::get('/Sm/Course/list', ['as' => 'sm.course.list', 'uses' => 'SmController@CourseList']);
    Route::post('/Sm/Course/Add', ['as' => 'sm.course.add', 'uses' => 'SmController@CourseAdd']);

    //學校-班級
    Route::get('/Sm/Classes/', ['as' => 'sm.classes', 'uses' => 'SmController@Classes']);
    Route::get('/Sm/Classes/Init', ['as' => 'sm.classes.init', 'uses' => 'SmController@ClassesInit']);
    Route::post('/Sm/Classes/Add', ['as' => 'sm.classes.add', 'uses' => 'SmController@ClassesAdd']);
    Route::post('/Sm/Classes/Add/Student', ['as' => 'sm.classes.add.student', 'uses' => 'SmController@ClassesAddStudent']);

    //修改學生資訊
    Route::get('/Sm/Student', ['as' => 'sm.student', 'uses' => 'SmController@Student']);
    Route::get('/Sm/Student/Init', ['as' => 'sm.student.init', 'uses' => 'SmController@StudentInit']);
    Route::get('/Sm/Student/List', ['as' => 'sm.student.list', 'uses' => 'SmController@StudentList']);
    Route::post('/Sm/Student/Add', ['as' => 'sm.student.add', 'uses' => 'SmController@StudentAdd']);
    Route::post('/Sm/Student/Update', ['as' => 'sm.student.update', 'uses' => 'SmController@StudentUpdate']);
    Route::post('/Sm/Student/Del', ['as' => 'sm.student.del', 'uses' => 'SmController@StudentDel']);

    //課程設定 課程與學員對應
    Route::get('/Sm/Course/Student', ['as' => 'sm.course.student', 'uses' => 'SmController@CourseStudent']);
    Route::get('/Sm/Course/Student/Init', ['as' => 'sm.course.student.init', 'uses' => 'SmController@CourseStudentInit']);
    Route::get('/Sm/Course/Student/list', ['as' => 'sm.course.student.list', 'uses' => 'SmController@CourseStudentList']);
    Route::post('/Sm/Course/Student/Add', ['as' => 'sm.course.student.add', 'uses' => 'SmController@CourseStudentAdd']);

    //課程設定 課程-試卷對應
    Route::get('/Sm/Course/Reel', ['as' => 'sm.course.reel', 'uses' => 'SmController@CourseReel']);
    Route::get('/Sm/Course/Reel/Init', ['as' => 'sm.course.reel.init', 'uses' => 'SmController@CourseReelInit']);
    Route::get('/Sm/Course/Reel/list', ['as' => 'sm.course.reel.list', 'uses' => 'SmController@CourseReelList']);
    Route::post('/Sm/Course/Reel/Add', ['as' => 'sm.course.reel.add', 'uses' => 'SmController@CourseReelAdd']);
    Route::post('/Sm/Course/Reel/Del', ['as' => 'sm.course.reel.del', 'uses' => 'SmController@CourseReelDel']);

    //修改個人資訊
    Route::get('/Sm/User', ['as' => 'sm.user', 'uses' => 'SmController@User']);
    Route::get('/Sm/User/Data', ['as' => 'smuser.data', 'uses' => 'SmController@UserData']);
    Route::post('/Sm/User/Update', ['as' => 'sm.user.update', 'uses' => 'SmController@UserUpdate']);

    //管理員 作答結果查詢設定
    Route::get('/Sm/Analysis', ['as' => 'sm.analysis', 'uses' => 'SmController@Analysis']);
    Route::get('/Sm/Analysis/Init', ['as' => 'sm.analysis.init', 'uses' => 'SmController@AnalysisInit']);
    Route::get('/Sm/Analysis/List', ['as' => 'sm.analysis.list', 'uses' => 'SmController@AnalysisList']);
    Route::get('/Sm/Analysis/List/Init', ['as' => 'sm.analysis.list.init', 'uses' => 'SmController@AnalysisListInit']);
    Route::get('/Sm/Analysis/Download/Excel', ['as' => 'sm.analysis.download.excel', 'uses' => 'SmController@AnalysisDownloadExcel']);

});


