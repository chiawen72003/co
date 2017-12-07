<?php

namespace App\Http\Controllers;

use App\Http\Models\ExamPaperAccess;
use App\Http\Providers\ExamPaperAccessClass;
use App\Http\Providers\MemberClass;
use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;
use App\Http\Providers\ExamClass;
use App\Http\Providers\QuestionsItemClass;
use App\Http\Providers\SchoolClass;
use App\Http\Providers\NewsItem;
use App\Http\Providers\FeedbackListClass;
use App\Http\Providers\SubjectClass;
use App\Http\Providers\UnitClass;
use App\Http\Providers\ExamPaperClass;
use App\Http\Providers\PhpExcel;
use App\Http\Providers\ScriptClass;

class AdController extends Controller
{
    public static $module_type = array(
        '1' => '單代理人',
        '2' => '雙代理人',
        '3' => '多代理人',
    );

    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * 建立結構(單元)
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unitList()
    {
        $unit_class_obj = new UnitClass();
        if (!in_array(app('request')->session()->get('user_data.access_level'), array('91', '92'))) {
            $unit_class_obj->init(array('uid' => app('request')->session()->get('user_data.uid')));
        }
        $subject_obj = new SubjectClass();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $data['list_data'] = $unit_class_obj->get_all_unit();
        $data['subject_list'] = $subject_obj->subject_list();
        $data['module_type'] = self::$module_type;

        return view('admin.unit.unit_list', $data);
    }

    /**
     * 新增一個結構(單元)的頁面
     *
     */
    public function unitAddPage()
    {
        $subject_obj = new SubjectClass();
        $data = array();
        $data['title'] = '新增 ';
        $data['subject_list'] = $subject_obj->subject_list();

        return view('admin.unit.unit_add_page', $data);
    }

    /**
     * 編輯一個結構(單元)的頁面
     *
     */
    public function unitEditPage($id)
    {
        $unit_class_obj = new UnitClass();
        $unit_class_obj->init(array('id' => $id));
        $subject_obj = new SubjectClass();
        $data = array();
        $data['title'] = '編輯 ';
        $data['subject_list'] = $subject_obj->subject_list();
        $data['old_data'] = $unit_class_obj->get_unit();

        return view('admin.unit.unit_edit_page', $data);
    }


    /**
     * 新增一筆結構(單元)的資料
     *
     */
    public function unitAddData()
    {
        $unit_class_obj = new UnitClass();
        $data = array();
        $data['uid'] = app('request')->session()->get('user_data.uid');
        $data['module_type'] = app('request')->get('module_type');
        $data['subject'] = app('request')->get('subject');
        $data['vol'] = app('request')->get('vol');
        $data['grade'] = app('request')->get('grade');
        $data['unit'] = app('request')->get('unit');
        $data['title'] = app('request')->get('title');
        $data['indicator_nums'] = app('request')->get('indicator_nums');
        if (Input::file('img') != null AND Input::file('img')->isValid()) {
            $extension = Input::file('img')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension; // renameing image
            Input::file('img')->move('upfire/image', $fileName); // uploading file to given path
            $data['img'] = $fileName;
        }
        $unit_class_obj->unit_add($data);

        return redirect()->route('ad.unit.list')->with('message', '單元結構新增完畢!');
    }

    /**
     * 更新一筆結構(單元)的資料
     *
     */
    public function unitUpdateData()
    {
        $unit_class_obj = new UnitClass();
        $data = array();
        $id = app('request')->get('id');
        $data['module_type'] = app('request')->get('module_type');
        $data['subject'] = app('request')->get('subject');
        $data['vol'] = app('request')->get('vol');
        $data['grade'] = app('request')->get('grade');
        $data['unit'] = app('request')->get('unit');
        $data['title'] = app('request')->get('title');
        $data['indicator_nums'] = app('request')->get('indicator_nums');
        if (Input::file('img') != null AND Input::file('img')->isValid()) {
            $extension = Input::file('img')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension; // renameing image
            Input::file('img')->move('upfire/image', $fileName); // uploading file to given path
            $data['img'] = $fileName;
        }

        $unit_class_obj->init(array('id' => $id));
        $unit_class_obj->unit_update($data);


        return redirect()->route('ad.unit.list')->with('message', '單元結構更新完畢!');
    }

    /**
     * 移除一個結構(單元)
     *
     */
    public function unitDelete()
    {
        $get_id = app('request')->get('getID');
        $unit_class_obj = new UnitClass();
        $unit_class_obj->init(array('id' => $get_id));
        $unit_class_obj->unit_delete();

        return;
    }

    /**
     * 試卷列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function examPaperList($unit_id)
    {
        $exam_class_obj = new ExamClass();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $data['list_data'] = $exam_class_obj->get_exam_paper_data($unit_id);
        $data['questions_item_nums'] = $exam_class_obj->get_questions_item_nums($data['list_data']);
        $data['unit_id'] = $unit_id;

        return view('admin.paper_list', $data);
    }

    /**
     * 新增一個試卷的頁面
     *
     */
    public function examPaperAddPage()
    {
        $data = array();
        $data['unit_id'] = '';
        $unit_obj = new UnitClass();
        $subject_obj = new SubjectClass();
        $data['subject_data'] = $subject_obj->subject_list();
        $data['unit_data'] = $unit_obj->get_all_unit();
        if (!in_array(app('request')->session()->get('user_data.access_level'), array('91', '92'))) {
            $subject_obj->init(array('uid' => app('request')->session()->get('user_data.uid')));
            $data['subject_access'] = $subject_obj->get_access_subject();
        }

        return view('admin.exampaper.paper_add', $data);
    }

    /**
     * 新增一筆試卷的資料
     *
     */
    public function exampaperAddData()
    {
        $exam_class_obj = new ExamClass();
        $data = array();
        $data['uid'] = app('request')->session()->get('user_data')['uid'];
        $data['unit_list_id'] = app('request')->get('unit_list_id');
        $data['paper_vol'] = app('request')->get('paper_vol');
        if (Input::file('img') != null AND Input::file('img')->isValid()) {
            $extension = Input::file('img')->getClientOriginalExtension(); // getting image extension
            $fileName = time() . '.' . $extension; // renameing image
            Input::file('img')->move('upfire/image', $fileName); // uploading file to given path
            $data['img'] = $fileName;
        }
        $exam_class_obj->exampaper_add($data);

        return redirect()->route('ad.exampaper.add.page')->with('message', '試卷新增完畢!');
    }

    /**
     * 刪除一個試卷
     */
    public function exampaperDelete()
    {
        $get_id = app('request')->get('getID');
        $exam_class_obj = new ExamClass();
        $questions_obj = new QuestionsItemClass();
        $questions_obj->init(array('exam_paper_id' => $get_id));
        $exam_class_obj->exampaper_delete($get_id);
        $questions_obj->delete_by_exam_paper_id();

        return;
    }

    /**
     * 新增試題資料頁面
     *
     *
     */
    public function questionsAddPage()
    {
        $uid = app('request')->session()->get('user_data')['uid'];
        $data = array();
        $unit_obj = new UnitClass();
        $subject_obj = new SubjectClass();
        $exampaper_obj = new ExamPaperClass();
        $exampaper_obj->init(array('uid' => $uid));
        $t = new FeedbackListClass();
        $data['unit_data'] = $unit_obj->get_all_unit();
        $data['subject_data'] = $subject_obj->subject_list();
        $data['feedback_list'] = $t->get_list_data();
        $data['exampaper_data'] = $exampaper_obj->get_all_exampaper();
        //設定ckfinder
        //https://dotblogs.com.tw/jellycheng/archive/2013/09/11/118175.aspx
        $data['ck_finder_path'] = url('/admin/js/ckfinder');
        session_start();
        $_SESSION['ckfiner_key'] = true;
        $_SESSION['dirroot'] = url('/cc_upload') . '/';//讀取路徑
        $_SESSION['upload_path'] = public_path('/cc_upload') . '/';//儲存實體路徑

        return view('admin.questions.questions_item_add', $data);
    }


    /**
     * 編輯試題資料頁面
     *
     *
     */
    public function questionsEdit($id)
    {
        $uid = app('request')->session()->get('user_data')['uid'];
        $data = array();
        $unit_obj = new UnitClass();
        $subject_obj = new SubjectClass();
        $exampaper_obj = new ExamPaperClass();
        $exampaper_obj->init(array('uid' => $uid));
        $questions_item_obj = new QuestionsItemClass();
        $questions_item_obj->init(array('id' => $id));
        $t = new FeedbackListClass();
        $data['unit_data'] = $unit_obj->get_all_unit();
        $data['subject_data'] = $subject_obj->subject_list();
        $data['feedback_list'] = $t->get_list_data();
        $data['exampaper_data'] = $exampaper_obj->get_all_exampaper();
        $data['item_data'] = $questions_item_obj->get_one_item_data();
        $data['item_id'] = $id;
        //設定ckfinder
        //https://dotblogs.com.tw/jellycheng/archive/2013/09/11/118175.aspx
        $data['ck_finder_path'] = url('/admin/js/ckfinder');
        session_start();
        $_SESSION['ckfiner_key'] = true;
        $_SESSION['dirroot'] = url('/cc_upload') . '/';//讀取路徑
        $_SESSION['upload_path'] = public_path('/cc_upload') . '/';//儲存實體路徑

        return view('admin.questions.questions_item_edit', $data);
    }

    /**
     * 新增一個試題
     */
    public function questionsAdd()
    {
        $fp = Input::all();
        if (isset($fp['add_data'])) {
            $get_input = array();
            foreach ($fp['add_data'] as $v) {
                $get_input = array_merge($get_input, $v);
            }
            $t = new QuestionsItemClass();
            $t->init($get_input);
            $id = $t->add();
        }


        return $id;
    }

    /**
     * 更新一個試題
     */
    public function questionsUpdate()
    {
        $fp = Input::all();
        if (isset($fp['update_data'])) {
            $get_input = array();
            foreach ($fp['update_data'] as $v) {
                $get_input = array_merge($get_input, $v);
            }
            $t = new QuestionsItemClass();
            $t->init($get_input);
            $id = $t->update_data();
        }

        return $id;
    }

    /**
     * 取得下一個試題資料
     */
    public function questionsNext($paper_id)
    {
        $return_data = array(
            'type' => 'error',
            'data' => array(),
            'has_next' => false,
            'has_back' => false,
        );

        $fp = Input::all();
        if (isset($fp['question_id'])) {
            $t = new QuestionsItemClass();
            $t->init(array('id' => $fp['question_id'], 'exam_paper_id' => $paper_id));
            $return_data = $t->next_data($return_data);
        }

        return json_encode($return_data);
    }


    /**
     * 取得下一個試題資料
     */
    public function questionsBack($paper_id)
    {
        $return_data = array(
            'type' => 'error',
            'data' => array(),
            'has_next' => false,
            'has_back' => false,
        );

        $fp = Input::all();
        if (isset($fp['question_id'])) {
            $t = new QuestionsItemClass();
            $t->init(array('id' => $fp['question_id'], 'exam_paper_id' => $paper_id));
            $return_data = $t->back_data($return_data);
        }

        return json_encode($return_data);
    }


    /**
     * 科目列表
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subjectList()
    {
        $subject_obj = new SubjectClass();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $data['list_data'] = $subject_obj->get_list();

        return view('admin.subject.subject_list', $data);
    }

    /**
     * 新增一筆科目的資料
     *
     */
    public function subjectAdd()
    {
        $fp = Input::all();
        $subject_obj = new SubjectClass();
        $subject_obj->init($fp);
        $subject_obj->add();

        return '';
    }

    /**
     * 移除一個科目
     *
     */
    public function subjectDelete()
    {
        $fp = Input::all();
        $subject_obj = new SubjectClass();
        $subject_obj->init($fp);
        $subject_obj->delete_data();

        return json_encode(array('message' => 'success'));
    }

    /**
     * 學校列表
     *
     */
    public function schoolList()
    {
        $fp = Input::all();
        $city_code = isset($fp['city']) ? $fp['city'] : '1';
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $school_tmp = new SchoolClass();
        $school_tmp->init(
            array('city_code' => $city_code)
        );
        $data['list_data'] = $school_tmp->get_school_list();
        $data['city_data'] = $school_tmp->get_all_city_data();
        $data['city_code'] = $city_code;

        return view('admin.school_list', $data);
    }

    /**
     * 學校新增 頁面
     *
     */
    public function schoolAddPage()
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $school_tmp = new SchoolClass();
        $data['city_data'] = $school_tmp->get_all_city_data();

        return view('admin.school_add_page', $data);
    }

    /**
     * 學校更新 頁面
     *
     */
    public function schoolEditPage($id)
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $school_tmp = new SchoolClass();
        $school_tmp->init(
            array('id' => $id)
        );
        $data['school_data'] = $school_tmp->get_school_data();
        $data['city_data'] = $school_tmp->get_all_city_data();

        return view('admin.school_edit_page', $data);
    }

    /**
     * 新增一筆學校的資料
     *
     * 備註：先檢查id是否重複，沒有重複在新增
     */
    public function schoolAdd()
    {
        $fp = Input::all();
        $school_tmp = new SchoolClass();
        $school_tmp->init($fp);
        $isAdd = $school_tmp->add();

        return redirect()->route('ad.school.list');
    }

    /**
     * 更新一筆學校的資料
     *
     */
    public function schoolUpdate()
    {
        $fp = Input::all();
        $school_tmp = new SchoolClass();
        $school_tmp->init($fp);
        $school_tmp->update_data();

        return;
    }

    /**
     * 移除一個學校
     *
     */
    public function schoolDelete()
    {
        $fp = Input::all();
        $school_tmp = new SchoolClass();
        $school_tmp->init($fp);
        $school_tmp->delete_data();

        return;
    }

    /**
     * 使用者新增 頁面
     *
     */
    public function userAddPage()
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $school_tmp = new SchoolClass();
        $member_tmp = new MemberClass();
        $data['city_data'] = $school_tmp->get_all_city_data();
        $data['all_school'] = $school_tmp->get_all_school();
        $data['all_level'] = $member_tmp->get_all_level();

        return view('admin.user.user_add_page', $data);
    }

    /**
     * 使用者新增
     *
     */
    public function userAdd()
    {
        $fp = Input::all();
        $school_tmp = new MemberClass();
        $school_tmp->init($fp);
        $school_tmp->set_add_user();

        return;
    }


    /**
     * 匯入使用者頁面
     *
     */
    public function userImportPage()
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $school_tmp = new SchoolClass();
        $member_tmp = new MemberClass();
        $data['city_data'] = $school_tmp->get_all_city_data();
        $data['all_school'] = $school_tmp->get_all_school();
        $data['all_level'] = $member_tmp->get_all_level();

        return view('admin.user.user_import_page', $data);
    }

    /**
     * 匯入使用者的資料
     *
     */
    public function userImportFile()
    {
        $fp = Input::all();
        $data = array(
            'city_code' => isset($fp['city_code']) ? $fp['city_code'] : null,
            'organization_id' => isset($fp['organization_id']) ? $fp['organization_id'] : null,
            'grade' => isset($fp['grade']) ? $fp['grade'] : null,
            'class' => isset($fp['class']) ? $fp['class'] : null,
            'access_level' => isset($fp['user_level']) ? $fp['user_level'] : null,
            'import_user_file' => Input::file('import_file') ? Input::file('import_file') : null,
        );
        $member_obj = new MemberClass();
        $member_obj->init($data);
        $member_obj->get_import_student();

        return redirect()->route('ad.user.import.page');
    }

    /**
     * 查詢使用者資料頁面
     *
     */
    public function userSearchPage()
    {
        $fp = Input::all();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $school_tmp = new SchoolClass();
        $member_tmp = new MemberClass();
        $member_tmp->init($fp);
        $data['city_data'] = $school_tmp->get_all_city_data();
        $data['all_school'] = $school_tmp->get_all_school();
        $data['all_level'] = $member_tmp->get_all_level();
        $data['class_member'] = $member_tmp->get_class_member();
        $data['city_code'] = isset($fp['city_code']) ? $fp['city_code'] : null;
        $data['organization_id'] = isset($fp['organization_id']) ? $fp['organization_id'] : null;
        $data['grade'] = isset($fp['grade']) ? $fp['grade'] : null;
        $data['class'] = isset($fp['class']) ? $fp['class'] : null;

        return view('admin.user.user_search_page', $data);
    }

    /**
     * 下載 指定學校-班級的所有人員資料
     *
     */
    public function userSearchDownload()
    {
        $fp = Input::all();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $school_tmp = new SchoolClass();
        $school_tmp->init($fp);
        $member_tmp = new MemberClass();
        $member_tmp->init($fp);
        $city_data = $school_tmp->get_all_city_data();
        $school_data = $school_tmp->get_school_data();
        $class_student = $member_tmp->get_all_class_data();
        $city_code = isset($fp['city_code']) ? $fp['city_code'] : null;
        $organization_id = isset($fp['organization_id']) ? $fp['organization_id'] : null;
        $grade = isset($fp['grade']) ? $fp['grade'] : null;
        $class = isset($fp['class']) ? $fp['class'] : null;
        if ($class_student
            and isset($city_data[$city_code])
            and count($school_data) > 0
        ) {
            $file_name = $city_data[$city_code];
            $file_name .= $school_data['name'];
            $file_name .= $grade . '年';
            $file_name .= $grade . '班';
            $file_name .= '.xls';
            $excel_obj = new PhpExcel();
            $excel_obj->set_file_name($file_name);
            $excel_obj->set_excel_data($class_student);
            $excel_obj->get_class_data();
        }
    }

    /**
     * 編輯使用者資料頁面
     *
     */
    public function userEditPage($uid)
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $member_obj = new MemberClass();
        $member_obj->init(array('uid' => $uid));
        $data['edit_data'] = $member_obj->get_user_data();
        $data['uid'] = $uid;

        return view('admin.user.user_edit_page', $data);
    }

    /**
     * 更新使用者資料
     *
     */
    public function userDataUpdate()
    {
        $fp = Input::all();
        $member_obj = new MemberClass();
        $member_obj->init($fp);
        $member_obj->update_user_data();

        return;
    }

    /**
     * 移除一個學生
     *
     */
    public function userSearchDelete()
    {
        $fp = Input::all();
        $school_tmp = new MemberClass();
        $school_tmp->init($fp);
        $school_tmp->set_remove_student();

        return;
    }

    /**
     * 移除一個班級的學生
     *
     */
    public function userSearchAllDelete()
    {
        $fp = Input::all();
        $school_tmp = new MemberClass();
        $school_tmp->init($fp);
        $school_tmp->set_remove_all_student();

        return;
    }

    /**
     * 科目控管
     */
    public function userSubjectLimitPage()
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $member_tmp = new MemberClass();
        $data['all_teacher'] = $member_tmp->get_teacher_data();
        $data['all_level'] = $member_tmp->get_all_level();

        return view('admin.subject.subject_limit', $data);
    }

    /**
     * 取得教師開放跟未開放的科目資料
     */
    public function userSubjectLockUnLock()
    {
        $fp = Input::all();
        $subject_obj = new SubjectClass();
        $subject_obj->init($fp);
        $access_data = $subject_obj->get_access_subject();
        $subject_data = $subject_obj->subject_list();
        $return_data = array(
            'subject_data' => $subject_data,
            'access_data' => $access_data
        );

        return json_encode($return_data);
    }

    /**
     * 增加教師開放的科目資料
     */
    public function userSubjectSetUnLock()
    {
        $fp = Input::all();
        $subject_obj = new SubjectClass();
        $subject_obj->init($fp);
        $subject_obj->set_access_subject();

        return;
    }

    /**
     * 移除教師開放的科目資料
     */
    public function userSubjectSetLock()
    {
        $fp = Input::all();
        $subject_obj = new SubjectClass();
        $subject_obj->init($fp);
        $subject_obj->unset_access_subject();

        return;
    }

    /**
     * 單元上鎖頁面
     */
    public function unitLockPage()
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $subject_obj = new SubjectClass();
        $data['subject_data'] = $subject_obj->subject_list();

        return view('admin.unit.unit_lock', $data);
    }


    /**
     * 增加 單元上鎖的資料
     */
    public function unitSetLock()
    {
        $fp = Input::all();
        $unit_obj = new UnitClass();
        $unit_obj->init($fp);
        $unit_obj->set_unit_lock();

        return;
    }

    /**
     * 解除 單元上鎖的資料
     */
    public function unitSetUnLock()
    {
        $fp = Input::all();
        $unit_obj = new UnitClass();
        $unit_obj->init($fp);
        $unit_obj->unit_set_Lock();

        return;
    }


    /**
     * 所有單元的資料
     */
    public function unitLockData()
    {
        $unit_obj = new UnitClass();
        $unit_data = $unit_obj->get_all_unit();

        return json_encode($unit_data);
    }

    /**
     * 系統公告列表
     *
     */
    public function newsList()
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $organization = new NewsItem();
        $data['list_data'] = $organization->get_all_news();

        return view('admin.news_list', $data);
    }

    /**
     * 系統公告 新增頁面
     *
     */
    public function newsAddPage()
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        //設定ckfinder
        //https://dotblogs.com.tw/jellycheng/archive/2013/09/11/118175.aspx
        $data['ck_finder_path'] = url('/admin/js/ckfinder');
        session_start();
        $_SESSION['ckfiner_key'] = true;
        $_SESSION['dirroot'] = url('/cc_upload') . '/news/';//讀取路徑
        $_SESSION['upload_path'] = public_path('/cc_upload') . '/news/';//儲存實體路徑

        return view('admin.news_add_page', $data);
    }

    /**
     * 系統公告 編輯頁面
     *
     */
    public function newsEditPage($id)
    {
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $newsobj = new NewsItem();
        $newsobj->init(array('id' => $id));
        $data['news_data'] = $newsobj->get_old_data();
        //設定ckfinder
        //https://dotblogs.com.tw/jellycheng/archive/2013/09/11/118175.aspx
        $data['ck_finder_path'] = url('/admin/js/ckfinder');
        session_start();
        $_SESSION['ckfiner_key'] = true;
        $_SESSION['dirroot'] = url('/cc_upload') . '/news/';//讀取路徑
        $_SESSION['upload_path'] = public_path('/cc_upload') . '/news/';//儲存實體路徑

        return view('admin.news_edit_page', $data);
    }

    /**
     * 新增一筆系統公告的資料
     */
    public function newsAdd()
    {
        $fp = Input::all();
        $newsobj = new NewsItem();
        $newsobj->init($fp);
        $isAdd = $newsobj->add_data();

        return redirect()->route('ad.news.list')->with('message', '系統公告新增完畢!');
    }

    /**
     * 更新一筆系統公告的資料
     *
     */
    public function newsUpdate()
    {
        $fp = Input::all();
        $newsobj = new NewsItem();
        $newsobj->init($fp);
        $newsobj->update_data();

        return redirect()->route('ad.news.list')->with('message', '系統公告更新完畢!');
    }

    /**
     * 移除一個系統公告
     *
     */
    public function newsDelete()
    {
        $fp = Input::all();
        $newsobj = new NewsItem();
        $newsobj->init($fp);
        $newsobj->delete_data();

        return;
    }

    /**
     * 編輯試題-選擇試卷頁面
     */
    public function exampaperVolListPage()
    {
        $uid = app('request')->session()->get('user_data')['uid'];
        $data = array();
        $unit_obj = new UnitClass();
        $subject_obj = new SubjectClass();
        $exampaper_obj = new ExamPaperClass();
        $exampaper_obj->init(array('uid' => $uid));
        $data['unit_data'] = $unit_obj->get_all_unit();
        $data['subject_data'] = $subject_obj->subject_list();
        $data['exampaper_data'] = $exampaper_obj->get_all_exampaper();

        return view('admin.exampaper.vol_select_page', $data);
    }


    /**
     * 編輯試題-選擇試題頁面
     */
    public function questionsListPage($id)
    {
        $uid = app('request')->session()->get('user_data')['uid'];
        $data = array();
        $unit_obj = new UnitClass();
        $subject_obj = new SubjectClass();
        $exampaper_obj = new ExamPaperClass();
        $exampaper_obj->init(array('uid' => $uid, 'id' => $id));
        $questions_obj = new QuestionsItemClass();
        $questions_obj->init(array('exam_paper_id' => $id));
        $data['subject_data'] = $subject_obj->subject_list();
        $data['exampaper_data'] = $exampaper_obj->get_exampaper();
        $data['exampaper_id'] = $id;
        $unit_obj->init(array('id' => $data['exampaper_data'][0]['unit_list_id']));
        $data['unit_data'] = $unit_obj->get_unit();
        $data['questions'] = $questions_obj->get_questions_data();

        return view('admin.questions.questions_list', $data);
    }

    /**
     * 刪除一個試題資料
     */
    public static function questionsDelete()
    {
        $fp = Input::all();
        if (isset($fp['id'])) {
            $t = new QuestionsItemClass();
            $t->init(array('id' => $fp['id'], 'exam_paper_id' => $fp['exam_paper_id']));
            $t->delete_data();
        }

        return;
    }

    /**
     * 學習紀錄查詢 首頁
     */
    public function ExamRecordListPage()
    {
        $fp = Input::all();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $school_tmp = new SchoolClass();
        $member_tmp = new MemberClass();
        $member_tmp->init($fp);
        $data['city_data'] = $school_tmp->get_all_city_data();
        $data['all_school'] = $school_tmp->get_all_school();
        $data['all_level'] = $member_tmp->get_all_level();
        $data['class_student'] = $member_tmp->get_class_student_data();
        $data['city_code'] = isset($fp['city_code']) ? $fp['city_code'] : null;
        $data['organization_id'] = isset($fp['organization_id']) ? $fp['organization_id'] : null;
        $data['grade'] = isset($fp['grade']) ? $fp['grade'] : null;
        $data['class'] = isset($fp['class']) ? $fp['class'] : null;
        $data['uid'] = isset($fp['uid']) ? $fp['uid'] : null;
        //有指定學生時，取出該學生所有的操作紀錄資料
        if ($data['uid']) {
            $exam_class_obj = new ExamClass();
            $subject_obj = new SubjectClass();
            $data['subject_list'] = $subject_obj->subject_list();
            $data['list_data'] = $exam_class_obj->get_record_list_all($data['uid']);
        }


        return view('admin.examrecord.examrecord_list', $data);
    }

    /**
     * 學習紀錄查詢 詳細操作紀錄列表
     */
    public function ExamRecordView($id, $uid)
    {
        $exam_class_obj = new ExamClass();
        $data = array();
        $data['exam_record'] = $exam_class_obj->get_exam_record($uid, $id);
        $data['uid'] = $uid;

        return view('admin.examrecord.examrecord_detail', $data);
    }

    /**
     * 學習紀錄查詢 回傳指定班級的所有學生資料
     */
    public function ExamRecordStudent()
    {
        $fp = Input::all();
        $return_array = array();
        $member_tmp = new MemberClass();
        $member_tmp->init($fp);
        $class_student = $member_tmp->get_all_class_student_data();
        if ($class_student) {
            foreach ($class_student as $v) {
                $return_array[$v['uid']] = $v['uname'];
            }
        }

        return json_encode($return_array);
    }

    /**
     * 學習紀錄查詢 下載成果查詢的資料
     */
    public function getDownloadRecord($id, $uid)
    {
        $exam_class_obj = new ExamClass();
        if ($uid AND $id) {
            $exam_record = $exam_class_obj->get_exam_record($uid, $id);
            if (isset($exam_record['use_item']) AND count($exam_record['use_item']) > 0) {
                $excel_obj = new PhpExcel();
                $excel_obj->set_excel_data($exam_record['use_item']);
                $excel_obj->get_exam_record_file();
            }
        }
    }

    /**
     * 試卷存取頁面
     */
    public function examPaperAccessListPage()
    {
        $fp = Input::all();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $school_tmp = new SchoolClass();
        $data['city_data'] = $school_tmp->get_all_city_data();
        $data['all_school'] = $school_tmp->get_all_school();
        $data['city_code'] = isset($fp['city_code']) ? $fp['city_code'] : null;
        $data['organization_id'] = isset($fp['organization_id']) ? $fp['organization_id'] : null;
        $data['grade'] = isset($fp['grade']) ? $fp['grade'] : null;
        $data['class'] = isset($fp['class']) ? $fp['class'] : null;
        $data['begin_edit'] = false;
        //有指定到班級時
        if ($data['organization_id'] AND $data['grade'] AND $data['class']) {
            $subject_obj = new SubjectClass();
            $unit_obj = new UnitClass();
            $exampaper_obj = new ExamPaperClass();
            $exampaper_access_obj = new ExamPaperAccessClass();
            $exampaper_access_obj->init($data);
            $data['subject_data'] = $subject_obj->subject_list();
            $data['unit_data'] = $unit_obj->get_all_unit();
            $data['exampaper_data'] = $exampaper_obj->get_all_exampaper();
            $data['access_data'] = $exampaper_access_obj->get_exampaperaccess_data();
            $data['begin_edit'] = true;
        }

        return view('admin.exampaperaccess.exampaper_access_list', $data);
    }

    /**
     * 試卷存取頁面 更新資料
     */
    public function examPaperAccessUpdate()
    {
        $fp = Input::all();
        $t_tmp = new ExamPaperAccessClass();
        $t_tmp->init($fp);
        $t_tmp->update_data();
    }

    /**
     * 教學劇本設計 後端教師列表頁面
     */
    public function scriptTaPage()
    {
        $item = new ScriptClass();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $data['list_data'] = $item->teacher_list();

        return view('admin.script.teacher_list', $data);
    }

    /**
     * 教學劇本設計 後端教學劇本設計資料列表
     */
    public function scriptList()
    {
        $fp = Input::all();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $data['uid'] = '';
        if (isset($fp['uid'])) {
            $item = new ScriptClass();
            $data['script_data'] = $item->getTeacherScriptNum($fp['uid']);
            $data['uid'] = $fp['uid'];
        }

        return view('admin.script.script_list', $data);
    }

    /**
     * 教學劇本設計 後端教學劇本設計批閱頁面
     */
    public function scriptReview()
    {
        $fp = Input::all();
        $data = array();
        $data['user_data'] = app('request')->session()->get('user_data');
        $data['uid'] = '';
        $data['item_key'] = '';
        if (isset($fp['uid']) && isset($fp['item_key'])) {
            $item = new ScriptClass();
            $data['script_data'] = $item->getScriptData($fp['uid'], $fp['item_key']);
            $data['uid'] = $fp['uid'];
            $data['item_key'] = $fp['item_key'];
        }

        return view('admin.script.script_review', $data);
    }

    /**
     *教學劇本設計 後端 新增批閱資料
     *
     */
    public function scriptAdd()
    {
        $fp = Input::all();
        $script_class_obj = new ScriptClass();
        $data = array();
        $data['uid'] = $fp['uid'];
        $data['item_key'] = $fp['item_key'];
        $data['dsc'] = $fp['dsc'];
        $result = $script_class_obj -> scriptAdminAdd($data);

        return json_encode($result);
    }
}
