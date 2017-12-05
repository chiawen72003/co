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



/*
//學生登入登出
Route::get('/Mem/LoginPG', ['middleware' => 'IsLoginCheck','as' => 'mem.loginpg', 'uses' => 'MemberController@LoginPage']);
Route::get('/Mem/LogOut', ['as' => 'mem.logout', 'uses' => 'MemberController@LogOut']);
Route::post('/Mem/LoginChk', ['middleware' => 'LoginDataCheck','as' => 'mem.loginchk', 'uses' => 'MemberController@LoginChk']);

//學生端 首頁
Route::get('/Mem', ['middleware' => 'MemSessionCheck','as' => 'mem.index', 'uses' => 'MemController@index']);

//學生端 測驗
Route::get('/Mem/Exam', ['middleware' => 'MemSessionCheck','as' => 'mem.exam', 'uses' => 'ExamController@examList']);
Route::get('/Mem/Exam/Paper/List/{id}', ['middleware' => 'MemSessionCheck','as' => 'mem.exam.paper.list', 'uses' => 'ExamController@examPaperList']);
Route::get('/Mem/Exam/View/Record/list/{id}', ['middleware' => 'MemSessionCheck','as' => 'mem.exam.viewrecord.list', 'uses' => 'ExamController@viewExamRecordList']);
Route::post('/Mem/Exam/TestPG', ['middleware' => 'MemSessionCheck','as' => 'mem.exam.testpg', 'uses' => 'ExamController@testPage']);
Route::post('/Mem/Exam/GetModelPage', ['middleware' => 'MemSessionCheck','as' => 'mem.exam.getmodelpage', 'uses' => 'ExamController@GetModelPage']);
Route::post('/Mem/Exam/UpdateRecord', ['middleware' => 'MemSessionCheck','as' => 'mem.exam.updateRecord', 'uses' => 'ExamController@setExamRecord']);
Route::get('/Mem/Exam/View/Record/{id}', ['middleware' => 'MemSessionCheck','as' => 'mem.exam.viewrecord', 'uses' => 'ExamController@viewExamRecord']);
Route::post('/Mem/Exam/semantic/analysis', ['middleware' => 'MemSessionCheck','as' => 'mem.exam.semantic.analysis', 'uses' => 'ExamController@getSemanticAnalysis']);

//下載成果查詢的 excel資料
Route::get('/Mem/Exam/Download/Record/{id}', ['middleware' => 'MemSessionCheck','as' => 'mem.exam.download.record', 'uses' => 'ExamController@getDownloadRecord']);

//學生端 成果查詢
Route::get('/Mem/Achievement', ['middleware' => 'MemSessionCheck','as' => 'mem.achievement', 'uses' => 'ExamController@Achievement']);
Route::get('/Mem/Achievement/List/{id}', ['middleware' => 'MemSessionCheck','as' => 'mem.achievement.list', 'uses' => 'ExamController@AchievementList']);

//學生端 系統公告
Route::get('/Mem/News', ['middleware' => 'MemSessionCheck','as' => 'mem.news', 'uses' => 'MemController@News']);
Route::get('/Mem/News/{id}', ['middleware' => 'MemSessionCheck','as' => 'mem.news.detail', 'uses' => 'MemController@NewsDetail']);
Route::get('/Mem/News/download/{id}', ['middleware' => 'MemSessionCheck','as' => 'mem.news.file', 'uses' => 'MemController@NewsFileDownload']);

//給前端直接呼叫模組修改用
Route::get('/Mem/Exam/modelPage/{modelName}', ['as' => 'mem.exam.modelpage', 'uses' => 'ExamController@modelPage']);

//管理員端 登入、登出
Route::get('/Ad/LoginPG', ['middleware' => 'IsAdLoginCheck','as' => 'ad.loginpg', 'uses' => 'MemberController@LoginPage']);
Route::get('/Ad/LogOut', ['as' => 'ad.logout', 'uses' => 'MemberController@LogOut']);

//管理員端 管理員列表
Route::get('/Mem/Admin/List', ['as' => 'mem.admin.list', 'uses' => 'MemberController@adminList']);
Route::post('/Mem/Admin/Add', ['as' => 'mem.admin.add', 'uses' => 'MemberController@adminAdd']);
Route::post('/Mem/Admin/Update', ['as' => 'mem.admin.update', 'uses' => 'MemberController@adminUpdate']);
Route::delete('/Mem/Admin/Delete', ['as' => 'mem.admin.delete', 'uses' => 'MemberController@adminDelete']);

//管理員端 系統公告列表
Route::get('/Ad/News/List', ['as' => 'ad.news.list', 'uses' => 'AdController@newsList']);
Route::get('/Ad/News/Add/Page', ['as' => 'ad.news.add.page', 'uses' => 'AdController@newsAddPage']);
Route::get('/Ad/News/Edit/Page/{id}', ['as' => 'ad.news.edit.page', 'uses' => 'AdController@newsEditPage']);
Route::post('/Ad/News/Add', ['as' => 'ad.news.add', 'uses' => 'AdController@newsAdd']);
Route::post('/Ad/News/Update', ['as' => 'ad.news.update', 'uses' => 'AdController@newsUpdate']);
Route::post('/Ad/News/Delete', ['as' => 'ad.news.delete', 'uses' => 'AdController@newsDelete']);

//管理員端 學校列表
Route::get('/Ad/School/List', ['as' => 'ad.school.list', 'uses' => 'AdController@schoolList']);
Route::get('/Ad/School/AddPage', ['as' => 'ad.school.addpage', 'uses' => 'AdController@schoolAddPage']);
Route::get('/Ad/School/EditPage/{id}', ['as' => 'ad.school.editpage', 'uses' => 'AdController@schoolEditPage']);
Route::post('/Ad/School/Add', ['as' => 'ad.school.add', 'uses' => 'AdController@schoolAdd']);
Route::post('/Ad/School/Update', ['as' => 'ad.school.update', 'uses' => 'AdController@schoolUpdate']);
Route::post('/Ad/School/Delete', ['as' => 'ad.school.delete', 'uses' => 'AdController@schoolDelete']);

//管理員端 新增使用者頁面
Route::get('/Ad/User/Add/Page', ['as' => 'ad.user.add.page', 'uses' => 'AdController@userAddPage']);
Route::post('/Ad/User/Add', ['as' => 'ad.user.add', 'uses' => 'AdController@userAdd']);

//管理員端 匯入使用者頁面
Route::get('/Ad/User/Import/Page', ['as' => 'ad.user.import.page', 'uses' => 'AdController@userImportPage']);
Route::post('/Ad/User/Import/File', ['as' => 'ad.user.import.file', 'uses' => 'AdController@userImportFile']);


//管理員端 查詢使用者資料頁面
Route::get('/Ad/User/Search/Page', ['as' => 'ad.user.search.page', 'uses' => 'AdController@userSearchPage']);
Route::post('/Ad/User/Search/Download', ['as' => 'ad.user.search.download', 'uses' => 'AdController@userSearchDownload']);
Route::post('/Ad/User/Search/Delete', ['as' => 'ad.user.search.delete', 'uses' => 'AdController@userSearchDelete']);
Route::post('/Ad/User/Search/AllDelete', ['as' => 'ad.user.search.alldelete', 'uses' => 'AdController@userSearchAllDelete']);

//管理員端 編輯使用者資料頁面
Route::get('/Ad/User/Edit/Page/{id}', ['as' => 'ad.user.edit.page', 'uses' => 'AdController@userEditPage']);
Route::post('/Ad/User/Data/Update', ['as' => 'ad.user.data.update', 'uses' => 'AdController@userDataUpdate']);

//管理員端 科目控管
Route::get('/Ad/Subject/Limit/Page', ['as' => 'ad.subject.limit.page', 'uses' => 'AdController@userSubjectLimitPage']);
Route::post('/Ad/Subject/Lock/UnLock', ['as' => 'ad.subject.lock.unlock', 'uses' => 'AdController@userSubjectLockUnLock']);
Route::post('/Ad/Subject/Set/UnLock', ['as' => 'ad.subject.set.unlock', 'uses' => 'AdController@userSubjectSetUnLock']);
Route::post('/Ad/Subject/Set/Lock', ['as' => 'ad.subject.set.lock', 'uses' => 'AdController@userSubjectSetLock']);

//管理員端 單元上鎖
Route::get('/Ad/Unit/Lock/Page', ['as' => 'ad.unit.lock.page', 'uses' => 'AdController@unitLockPage']);
Route::post('/Ad/Unit/Lock/Data', ['as' => 'ad.unit.lock.data', 'uses' => 'AdController@unitLockData']);
Route::post('/Ad/Unit/Set/Lock', ['as' => 'ad.unit.set.lock', 'uses' => 'AdController@unitSetLock']);
Route::post('/Ad/Unit/Set/UnLock', ['as' => 'ad.unit.set.unlock', 'uses' => 'AdController@unitSetUnLock']);

//管理員端 建立結構(單元)
Route::get('/Ad/Unit/List', ['middleware' => 'AdSessionCheck','as' => 'ad.unit.list', 'uses' => 'AdController@unitList']);
Route::get('/Ad/Unit/Add/Page', ['middleware' => 'AdSessionCheck','as' => 'ad.unit.add.page', 'uses' => 'AdController@unitAddPage']);
Route::get('/Ad/Unit/Edit/Page/{id}', ['middleware' => 'AdSessionCheck','as' => 'ad.unit.edit.page', 'uses' => 'AdController@unitEditPage']);
Route::post('/Ad/Unit/Delete', ['middleware' => 'AdSessionCheck','as' => 'ad.unit.delete', 'uses' => 'AdController@unitDelete']);
Route::post('/Ad/Unit/Add/Data', ['middleware' => 'AdSessionCheck','as' => 'ad.unit.add.data', 'uses' => 'AdController@unitAddData']);
Route::post('/Ad/Unit/Update/Data', ['middleware' => 'AdSessionCheck','as' => 'ad.unit.update.data', 'uses' => 'AdController@unitUpdateData']);


//管理員端 新增試題頁面
Route::get('/Ad/Questions/Add/Page', ['middleware' => 'AdSessionCheck','as' => 'ad.questions.add.page', 'uses' => 'AdController@questionsAddPage']);

//管理員端 編輯試題-選擇試卷頁面
Route::get('/Ad/ExamPaper/Vol/List/Page', ['middleware' => 'AdSessionCheck','as' => 'ad.exampaper.vol.list.page', 'uses' => 'AdController@exampaperVolListPage']);

//管理員端 編輯試題-選擇試卷頁面
Route::get('/Ad/Questions/List/Page/{id}', ['middleware' => 'AdSessionCheck','as' => 'ad.questions.list.page', 'uses' => 'AdController@questionsListPage']);
Route::post('/Ad/Questions/Delete', ['middleware' => 'AdSessionCheck','as' => 'ad.questions.delete', 'uses' => 'AdController@questionsDelete']);
Route::post('/Ad/ExamPaper/Delete', ['middleware' => 'AdSessionCheck','as' => 'ad.exampaper.delete', 'uses' => 'AdController@exampaperDelete']);

//管理員端 建立試卷頁面
Route::get('/Ad/ExamPaper/Add/Page', ['middleware' => 'AdSessionCheck','as' => 'ad.exampaper.add.page', 'uses' => 'AdController@examPaperAddPage']);

//管理員端 科目列表
Route::get('/Ad/Subject/List', ['middleware' => 'AdSessionCheck','as' => 'ad.subject.list', 'uses' => 'AdController@subjectList']);

//管理員端 學習紀錄查詢
Route::get('/Ad/ExamRecord/List/page', ['middleware' => ['AdSessionCheck'],'as' => 'ad.examrecord.list.page', 'uses' => 'AdController@ExamRecordListPage']);
Route::get('/Ad/ExamRecord/View/{id}/{uid}', ['middleware' => 'AdSessionCheck','as' => 'ad.examrecord.view', 'uses' => 'AdController@ExamRecordView']);
Route::get('/Ad/ExamRecord/Download/Record/{id}/{uid}', ['middleware' => 'AdSessionCheck','as' => 'ad.examrecord.download.record', 'uses' => 'AdController@getDownloadRecord']);
Route::post('/Ad/ExamRecord/Student', ['middleware' => 'AdSessionCheck','as' => 'ad.examrecord.student', 'uses' => 'AdController@ExamRecordStudent']);

//管理員端 試卷存取頁面
Route::get('/Ad/ExamPaperAccess/list/Page', ['middleware' => 'AdSessionCheck','as' => 'ad.exampaperaccess.list.page', 'uses' => 'AdController@examPaperAccessListPage']);
Route::post('/Ad/ExamPaperAccess/Update', ['middleware' => 'AdSessionCheck','as' => 'ad.exampaperaccess.update', 'uses' => 'AdController@examPaperAccessUpdate']);


//管理員端 單元列表
Route::get('/Ad', ['middleware' => 'AdSessionCheck','as' => 'ad.index', 'uses' => 'AdController@newsList']);
Route::get('/Ad/Questions/Edit/{id}', ['middleware' => 'AdSessionCheck','as' => 'ad.questions.edit', 'uses' => 'AdController@questionsEdit']);
Route::get('/Ad/Questions/Next/{paper_id}/', ['middleware' => 'AdSessionCheck','as' => 'ad.questions.next', 'uses' => 'AdController@questionsNext']);
Route::get('/Ad/Questions/Back/{paper_id}/', ['middleware' => 'AdSessionCheck','as' => 'ad.questions.back', 'uses' => 'AdController@questionsBack']);
Route::post('/Ad/Questions/Update/', ['middleware' => 'AdSessionCheck','as' => 'ad.questions.update', 'uses' => 'AdController@questionsUpdate']);
Route::get('/Ad/ExamPaper/List/{id}', ['middleware' => 'AdSessionCheck','as' => 'ad.exampaper.list', 'uses' => 'AdController@examPaperList']);
Route::post('/Ad/LoginChk', ['middleware' => 'LoginDataCheck','as' => 'ad.loginchk', 'uses' => 'MemberController@AdLoginChk']);
Route::post('/Ad/Subject/Add', ['middleware' => 'AdSessionCheck','as' => 'ad.subject.add', 'uses' => 'AdController@subjectAdd']);
Route::post('/Ad/ExamPaper/Add/Data', ['middleware' => 'AdSessionCheck','as' => 'ad.exampaper.add.data', 'uses' => 'AdController@exampaperAddData']);
Route::post('/Ad/Questions/Add/', ['middleware' => 'AdSessionCheck','as' => 'ad.questions.add', 'uses' => 'AdController@questionsAdd']);
Route::delete('/Ad/Subject/Delete', ['middleware' => 'AdSessionCheck','as' => 'ad.subject.delete', 'uses' => 'AdController@subjectDelete']);


//api接口 負責提供模組資料
Route::get('/Api/Model/list', ['as' => 'api.model.list', 'uses' => 'ApiController@modelList']);
Route::get('/Api/Model/Page/{id}', ['as' => 'api.model.page', 'uses' => 'ApiController@modelPage']);


//登出
Route::get('/Ta/LogOut', ['as' => 'ta.logout', 'uses' => 'MemberController@LogOut']);

//學習紀錄查詢
Route::get('/Ta/ExamRecord/List/page', ['middleware' => ['TeacherCheck'],'as' => 'ta.examrecord.list.page', 'uses' => 'TAController@ExamRecordListPage']);
Route::get('/Ta/ExamRecord/View/{id}/{uid}', ['middleware' => 'TeacherCheck','as' => 'ta.examrecord.view', 'uses' => 'TAController@ExamRecordView']);
Route::get('/Ta/ExamRecord/Download/Record/{id}/{uid}', ['middleware' => 'TeacherCheck','as' => 'ta.examrecord.download.record', 'uses' => 'TAController@getDownloadRecord']);
Route::post('/Ta/ExamRecord/Student', ['middleware' => 'TeacherCheck','as' => 'ta.examrecord.student', 'uses' => 'TAController@ExamRecordStudent']);

//建立結構(單元)
Route::get('/Ta/Unit/List', ['middleware' => 'TeacherCheck','as' => 'ta.unit.list', 'uses' => 'TAController@unitList']);
Route::get('/Ta/Unit/Add/Page', ['middleware' => 'TeacherCheck','as' => 'ta.unit.add.page', 'uses' => 'TAController@unitAddPage']);
Route::get('/Ta/Unit/Edit/Page/{id}', ['middleware' => 'TeacherCheck','as' => 'ta.unit.edit.page', 'uses' => 'TAController@unitEditPage']);
Route::post('/Ta/Unit/Delete', ['middleware' => 'TeacherCheck','as' => 'ta.unit.delete', 'uses' => 'TAController@unitDelete']);
Route::post('/Ta/Unit/Add/Data', ['middleware' => 'TeacherCheck','as' => 'ta.unit.add.data', 'uses' => 'TAController@unitAddData']);
Route::post('/Ta/Unit/Update/Data', ['middleware' => 'TeacherCheck','as' => 'ta.unit.update.data', 'uses' => 'TAController@unitUpdateData']);

//建立試卷頁面
Route::get('/Ta/ExamPaper/Add/Page', ['middleware' => 'TeacherCheck','as' => 'ta.exampaper.add.page', 'uses' => 'TAController@examPaperAddPage']);
Route::get('/Ta/ExamPaper/Vol/List/Page', ['middleware' => 'TeacherCheck','as' => 'ta.exampaper.vol.list.page', 'uses' => 'TAController@exampaperVolListPage']);
Route::post('/Ta/ExamPaper/Add/Data', ['middleware' => 'TeacherCheck','as' => 'ta.exampaper.add.data', 'uses' => 'TAController@exampaperAddData']);
Route::get('/Ta/Questions/Add/Page', ['middleware' => 'TeacherCheck','as' => 'ta.questions.add.page', 'uses' => 'TAController@questionsAddPage']);
Route::post('/Ta/Questions/Add/', ['middleware' => 'TeacherCheck','as' => 'ta.questions.add', 'uses' => 'TAController@questionsAdd']);
Route::get('/Ta/Questions/List/Page/{id}', ['middleware' => 'TeacherCheck','as' => 'ta.questions.list.page', 'uses' => 'TAController@questionsListPage']);
Route::post('/Ta/Questions/Delete', ['middleware' => 'TeacherCheck','as' => 'ta.questions.delete', 'uses' => 'TAController@questionsDelete']);
Route::post('/Ta/ExamPaper/Delete', ['middleware' => 'TeacherCheck','as' => 'ta.exampaper.delete', 'uses' => 'TAController@exampaperDelete']);
Route::get('/Ta/Questions/Edit/{id}', ['middleware' => 'TeacherCheck','as' => 'ta.questions.edit', 'uses' => 'TAController@questionsEdit']);
Route::post('/Ta/Questions/Update/', ['middleware' => 'TeacherCheck','as' => 'ta.questions.update', 'uses' => 'TAController@questionsUpdate']);

//教學劇本設計 前端編輯頁面
Route::get('/Ta/Script/Add/Page', ['middleware' => 'TeacherCheck','as' => 'ta.script.add.page', 'uses' => 'TAController@scriptAddPage']);

//教學劇本設計 前端api 新增資料
Route::post('/Ta/Script/Add', ['middleware' => 'TeacherCheck','as' => 'ta.script.add', 'uses' => 'TAController@scriptAdd']);
//教學劇本設計 前端api 取得最新的批閱資料
Route::get('/Ta/Script/ChkUpdate', ['middleware' => 'TeacherCheck','as' => 'ta.script.chkupdate', 'uses' => 'TAController@scriptChkUpdate']);
//教學劇本設計 前端api 取得使用者已經填寫的資料，包含批閱資料
Route::get('/Ta/Script/DefaultDate', ['middleware' => 'TeacherCheck','as' => 'ta.script.defaultdate', 'uses' => 'TAController@scriptDefaultDate']);

//教學劇本設計 後端教師列表頁面
Route::get('/Ad/Script/Ta/Page', ['middleware' => 'AdSessionCheck','as' => 'ad.script.ta.page', 'uses' => 'AdController@scriptTaPage']);
//教學劇本設計 後端教學劇本設計資料列表
Route::get('/Ad/Script/List', ['middleware' => 'AdSessionCheck','as' => 'ad.script.list', 'uses' => 'AdController@scriptList']);
//教學劇本設計 後端教學劇本設計資料列表
Route::get('/Ad/Script/Review', ['middleware' => 'AdSessionCheck','as' => 'ad.script.review', 'uses' => 'AdController@scriptReview']);
//教學劇本設計 後端 新增批閱資料
Route::post('/Ad/Script/Add', ['middleware' => 'AdSessionCheck','as' => 'ad.script.add', 'uses' => 'AdController@scriptAdd']);
*/