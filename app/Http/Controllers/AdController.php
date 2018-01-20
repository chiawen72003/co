<?php

namespace App\Http\Controllers;

use App\Http\Providers\UserItem;
use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;
use App\Http\Providers\SchoolItem;
use App\Http\Providers\StructureItem;
use App\Http\Providers\QuestionItem;
use App\Http\Providers\ModifyItem;

class AdController extends Controller
{
    private $data =array();

    public function __construct()
    {
        $this->data['user_name'] = app('request')->session()->get('name');
        $this->data['user_id'] = app('request')->session()->get('user_id');
    }

    /**
     * 學校-班級
     */
    public function Classes()
    {
        $this->data['school_id'] = app('request')->get('s_id');

        return view('admin.school_classes.index', $this->data);
    }

    /**
     * 指定學校跟班級的資料
     */
    public function ClassesInit()
    {
        $school_id = app('request')->get('sid');
        $school = new SchoolItem(array(
            'id' => $school_id,
        ));
        $school_obj = $school->getOneSchool();
        $classses = $school->getClasses();
        $return  = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'school_data' => $school_obj['data'],
                'classes_data' => $classses['data'],
                'area_data' => config('area'),
            ),
        );


        echo json_encode($return);
    }

    /**
     * 新增學校-班級的資料
     *
     *
     */
    public function ClassesAdd()
    {
        $data = array();
        $data['school_year'] = app('request')->get('school_year');
        $data['school_id'] = app('request')->get('school_id');
        $data['title'] = app('request')->get('title');
        $t_obj = new SchoolItem();
        $t_obj->init($data);

        echo json_encode($t_obj->addClasses());
    }

    /**
     * 學校-科系
     *
     *
     */
    public function SchoolSubject()
    {

        return view('admin.school_subject.index', $this->data);
    }

    /**
     * 所有學校-科系的資料
     *
     *
     */
    public function SchoolSubjectList()
    {
        $school = new SchoolItem();

        echo json_encode($school->getSubject());
    }

    /**
     * 新增學校-科系的資料
     *
     *
     */
    public function SchoolSubjectAdd()
    {
        $data = array();
        $data['subject_title'] = app('request')->get('subject_title');
        $data['school_id'] = app('request')->get('school_id');
        $t_obj = new SchoolItem();
        $t_obj->init($data);
        echo json_encode($t_obj->addSubject());
    }

    /**
     * 學校
     */
    public function School()
    {

        return view('admin.school.index', $this->data);
    }

    /**
     * 所有學校的資料
     *
     *
     */
    public function SchoolList()
    {
        $school = new SchoolItem();

        echo json_encode($school->getSchool());
    }

    /**
     * 學校跟區域資料
     *
     *
     */
    public function SchoolInit()
    {
        $school = new SchoolItem();
        $school_data = $school->getSchool();
        $return_data = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'school_data' => $school_data['data'],
                'area_data' => config('area'),
            ),
        );

        echo json_encode($return_data);
    }

    /**
     * 課程設定
     *
     *
     */
    public function Course()
    {

        return view('admin.course.index', $this->data);
    }

    /**
     * 所有課程的資料
     *
     *
     */
    public function CourseList()
    {
        $school = new StructureItem();

        echo json_encode($school->getCourse());
    }

    /**
     * 新增課程的資料
     *
     *
     */
    public function CourseAdd()
    {
        $data = array();
        $data['school_year'] = app('request')->get('school_year');
        $data['semester'] = app('request')->get('semester');
        $data['course_title'] = app('request')->get('course_title');
        $t_obj = new StructureItem();
        $t_obj->init($data);
        echo json_encode($t_obj->addCourse());
    }


    /**
     * 課程-試卷對應設定
     *
     *
     */
    public function CourseReel()
    {

        return view('admin.course.reel.index', $this->data);
    }

    /**
     * 所有課程-試卷對應的資料
     *
     *
     */
    public function CourseReelList()
    {
        $school = new StructureItem();

        echo json_encode($school->getCourseReel());
    }

    /**
     * 新增課程-試卷對應的資料
     *
     *
     */
    public function CourseReelAdd()
    {
        $data = array();
        $data['course_id'] = app('request')->get('course_id');
        $data['reel_id'] = app('request')->get('reel_id');
        $t_obj = new StructureItem();
        $t_obj->init($data);
        echo json_encode($t_obj->addCourseReel());
    }

    /**
     * 課程-學員對應設定
     *
     *
     */
    public function CourseStudent()
    {

        return view('admin.course.student.index', $this->data);
    }

    /**
     * 所有課程-學員對應的資料
     *
     *
     */
    public function CourseStudentList()
    {
        $school = new StructureItem();

        echo json_encode($school->getCourseStudent());
    }

    /**
     * 新增課程-學員對應的資料
     *
     *
     */
    public function CourseStudentAdd()
    {
        $data = array();
        $data['course_id'] = app('request')->get('course_id');
        $data['school_id'] = app('request')->get('school_id');
        $t_obj = new StructureItem();
        $t_obj->init($data);
        echo json_encode($t_obj->addCourseStudent());
    }

    /**
     * 單元結構
     *
     *
     */
    public function Unit()
    {

        return view('admin.unit_structure.index', $this->data);
    }

    /**
     * 所有單元結構的資料
     *
     *
     */
    public function UnitList()
    {
        $school = new StructureItem();

        echo json_encode($school->getUnit());
    }

    /**
     * 新增單元結構的資料
     *
     *
     */
    public function UnitAdd()
    {
        $data = array();
        $data['version'] = app('request')->get('version');
        $data['subject'] = app('request')->get('subject');
        $data['book'] = app('request')->get('book');
        $data['unit_title'] = app('request')->get('unit_title');
        $t_obj = new StructureItem();
        $t_obj->init($data);
        echo json_encode($t_obj->addUnit());
    }

    /**
     * 試卷
     *
     *
     */
    public function Reel()
    {

        return view('admin.reel.index', $this->data);
    }

    /**
     * 所有試卷的資料
     *
     *
     */
    public function ReelList()
    {
        $school = new StructureItem();

        echo json_encode($school->getReel());
    }

    /**
     * 新增試卷的資料
     *
     *
     */
    public function ReelAdd()
    {
        $data = array();
        $data['version'] = app('request')->get('version');
        $data['subject'] = app('request')->get('subject');
        $data['book'] = app('request')->get('book');
        $data['unit'] = app('request')->get('unit');
        $data['reel_title'] = app('request')->get('reel_title');
        $t_obj = new StructureItem();
        $t_obj->init($data);
        echo json_encode($t_obj->addReel());
    }


    /**
     * 試題
     *
     *
     */
    public function Question()
    {
        $reel_id = app('request')->get('reelID');
        $this->data['has_reel_id'] = false;
        $this->data['reel_id'] =0;

        if(!is_null($reel_id))
        {
            $this->data['reel_id'] =$reel_id;
            $this->data['has_reel_id'] =true;
        }

        return view('admin.question.index', $this->data);
    }

    /**
     * 試題 api 回傳單元、試卷資料
     */
    public function QuestionApi()
    {
        $school = new StructureItem();
        $unit = $school->getUnit();
        $reel = $school->getReel();
        $t = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'unit' => $unit['data'],
                'reel' => $reel['data'],
            ),
        );
        echo json_encode($t);
    }


    /**
     * 試題 api 回傳單元、試卷及使用者設定的資料
     */
    public function QuestionEditApi()
    {
        $id = app('request')->get('id');
        $question = new QuestionItem();
        $question->init(array('question_id' => $id));
        $school = new StructureItem();
        $unit = $school->getUnit();
        $reel = $school->getReel();
        $question_data = $question->getQuestionByID();
        $t = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'unit' => $unit['data'],
                'reel' => $reel['data'],
                'question_data' => $question_data['data'],
            ),
        );
        echo json_encode($t);
    }


    /**
     *指定試卷內所有試題的資料
     *
     *
     */
    public function QuestionList()
    {
        $question = new QuestionItem();
        $question->init(array(
            'reel_id' => app('request')->get('id'),
        ));

        echo json_encode($question->getQuestion());
    }

    /**
     * 新增試題頁面
     *
     *
     */
    public function QuestionPgAdd()
    {
        //設定ckfinder
        //https://dotblogs.com.tw/jellycheng/archive/2013/09/11/118175.aspx
        $this->data['ck_finder_path'] = url('/js/ckfinder');
        session_start();
        $_SESSION['ckfiner_key'] = true;
        $_SESSION['dirroot'] = url('/cc_upload') . '/question/';//讀取路徑
        $_SESSION['upload_path'] = public_path('/cc_upload') . '/question/';//儲存實體路徑

        return view('admin.question.add', $this->data);
    }

    /**
     * 編輯現有試題的頁面
     *
     *
     */
    public function QuestionPgEdit()
    {
        $this->data['id'] = app('request')->get('id');
        $this->data['reel_id'] = app('request')->get('reelID');
        //設定ckfinder
        //https://dotblogs.com.tw/jellycheng/archive/2013/09/11/118175.aspx
        $this->data['ck_finder_path'] = url('/js/ckfinder');
        session_start();
        $_SESSION['ckfiner_key'] = true;
        $_SESSION['dirroot'] = url('/cc_upload') . '/question/';//讀取路徑
        $_SESSION['upload_path'] = public_path('/cc_upload') . '/question/';//儲存實體路徑

        return view('admin.question.edit', $this->data);
    }

    /**
     * 新增試題的資料
     *
     *
     */
    public function QuestionAdd()
    {
        $data = array();
        $data['question_title'] = app('request')->get('question_title');
        $data['type'] = app('request')->get('type');
        $data['type_title'] = app('request')->get('type_title');
        $data['dsc'] = app('request')->get('dsc');
        $data['power'] = app('request')->get('power');
        $data['reel_id'] = app('request')->get('reel_id');
        $data['max_score'] = app('request')->get('max_score');
        $data['question_name'] = app('request')->get('question_name');
        $t_obj = new QuestionItem();
        $t_obj->init($data);
        echo json_encode($t_obj->addQuestion());
    }

    /**
     * 更新試題的資料
     *
     *
     */
    public function QuestionUpdate()
    {
        $data = array();
        $data['id'] = app('request')->get('id');
        $data['question_title'] = app('request')->get('question_title');
        $data['type'] = app('request')->get('type');
        $data['type_title'] = app('request')->get('type_title');
        $data['dsc'] = app('request')->get('dsc');
        $data['power'] = app('request')->get('power');
        $data['reel_id'] = app('request')->get('reel_id');
        $data['max_score'] = app('request')->get('max_score');
        $data['question_name'] = app('request')->get('question_name');
        $t_obj = new QuestionItem();
        $t_obj->init($data);
        echo json_encode($t_obj->updateQuestion());
    }

    /**
     * 注意事項
     *
     *
     */
    public function Precautions()
    {
        $this->data['id'] = '1';
        //設定ckfinder
        //https://dotblogs.com.tw/jellycheng/archive/2013/09/11/118175.aspx
        $this->data['ck_finder_path'] = url('/js/ckfinder');
        session_start();
        $_SESSION['ckfiner_key'] = true;
        $_SESSION['dirroot'] = url('/cc_upload') . '/precautions/';//讀取路徑
        $_SESSION['upload_path'] = public_path('/cc_upload') . '/question/';//儲存實體路徑

        return view('admin.precautions.index', $this->data);
    }

    /**
     * 注意事項的資料
     *
     *
     */
    public function PrecautionsData()
    {
        $question = new StructureItem();
        $id = app('request')->get('id');

        echo json_encode($question->getPrecautions($id));
    }

    /**
     * 更新注意事項的資料
     *
     *
     */
    public function PrecautionsUpdate()
    {
        $data = array();
        $data['id'] = app('request')->get('id');
        $data['dsc'] = app('request')->get('dsc');
        $t_obj = new StructureItem();
        $t_obj->init($data);

        echo json_encode($t_obj->updatePrecautions());
    }

    /**
     * 評閱者資料管理
     *
     *
     */
    public function Revised()
    {

        return view('admin.revised.index', $this->data);
    }

    /**
     * 所有評閱者資料的資料
     *
     *
     */
    public function RevisedList()
    {
        $revised = new UserItem();

        echo json_encode($revised->getAllRevised());
    }

    /**
     * 單一評閱者資料的資料
     *
     *
     */
    public function RevisedData()
    {
        $data = array();
        $data['id'] = app('request')->get('id');
        $t_obj = new UserItem();
        $t_obj->init($data);

        echo json_encode($t_obj->getRevised());
    }
    /**
     * 新增評閱者資料的編輯頁面
     *
     *
     */
    public function RevisedAddPg()
    {

        return view('admin.revised.add', $this->data);
    }

    /**
     * 新增評閱者資料
     *
     *
     */
    public function RevisedAdd()
    {
        $data = array();
        $data['login_name'] = app('request')->get('login_name');
        $data['login_pw'] = app('request')->get('login_pw');
        $data['school_id'] = app('request')->get('school_id');
        $data['name'] = app('request')->get('name');
        $t_obj = new UserItem();
        $t_obj->init($data);

        echo json_encode($t_obj->addRevised());
    }

    /**
     * 編輯評閱者資料的編輯頁面
     *
     *
     */
    public function RevisedEditPg()
    {
        $this->data['id'] = app('request')->get('id');

        return view('admin.revised.edit', $this->data);
    }


    /**
     * 更新評閱者資料
     *
     *
     */
    public function RevisedUpdate()
    {
        $data = array();
        $data['id'] = app('request')->get('id');
        $data['login_name'] = app('request')->get('login_name');
        $data['login_pw'] = app('request')->get('login_pw');
        $data['school_id'] = app('request')->get('school_id');
        $data['name'] = app('request')->get('name');
        $t_obj = new UserItem();
        $t_obj->init($data);

        echo json_encode($t_obj->updateRevised());
    }


    /**
     * 評閱者-試卷資料管理
     *
     *
     */
    public function RevisedReel()
    {
        $this->data['id'] = app('request')->get('id');

        return view('admin.revised.reel.index', $this->data);
    }

    /**
     * 評閱者-試卷的資料
     *
     *
     */
    public function RevisedReelList()
    {
        $data = array();
        $data['id'] = app('request')->get('id');
        $t_obj = new ModifyItem();
        $t_obj->init($data);

        echo json_encode($t_obj->getReelList());
    }

    /**
     * 新增評閱者資料
     *
     *
     */
    public function RevisedReelAdd()
    {
        $data = array();
        $data['reel_id'] = app('request')->get('reel_id');
        $data['user_id'] = app('request')->get('user_id');
        $data['need_num'] = app('request')->get('need_num');
        $t_obj = new ModifyItem();
        $t_obj->init($data);

        echo json_encode($t_obj->addReel());
    }

    /**
     * 個人資料管理
     *
     *
     */
    public function User()
    {

        return view('admin.userdata.index', $this->data);
    }

    /**
     * 個人資料的資料
     *
     *
     */
    public function UserData()
    {
        $user = new UserItem();
        $user->init(array('user_id' => $this->data['user_id']));

        echo json_encode($user->getAdmin());
    }

    /**
     * 更新個人資料的資料
     *
     *
     */
    public function UserUpdate()
    {
        $data = array();
        $data['new_pw'] = app('request')->get('new_pw');
        $data['id'] = $this->data['user_id'];
        $t_obj = new UserItem();
        $t_obj->init($data);

        echo json_encode($t_obj->setAdminPw());
    }

    /**
     * 學生資訊
     *
     *
     */
    public function Student()
    {

        return view('admin.student.index', $this->data);
    }


    /**
     * 學生的資料 初始化的資料
     *
     * 包含所有學校、班級資料
     */
    public function StudentInit()
    {
        $s_obj = new SchoolItem();
        $school = $s_obj->getSchool();
        $classes = $s_obj->getAllClasses();
        $return  = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'school' => $school['data'],
                'classes' => $classes['data'],
            ),
        );

        echo json_encode($return);
    }


    /**
     * 學生的資料
     *
     *
     */
    public function StudentList()
    {
        $user = new UserItem();
        $user->init(array(
            'school_id' => app('request')->get('school'),
            'classes_id' => app('request')->get('classes_id'),
        ));

        echo json_encode($user->getStudentBySubject());
    }

    /**
     * 新增學生的資料
     *
     *
     */
    public function StudentAdd()
    {
        $data = array();
        $data['login_name'] = app('request')->get('login_name');
        $data['login_pw'] = app('request')->get('login_pw');
        $data['school_id'] = app('request')->get('school_id');
        $data['classes_id'] = app('request')->get('classes_id');
        $data['student_id'] = app('request')->get('student_id');
        $data['name'] = app('request')->get('name');
        $t_obj = new UserItem();
        $t_obj->init($data);

        echo json_encode($t_obj->addStudent());
    }

    /**
     * 更新學生的資料
     *
     *
     */
    public function StudentUpdate()
    {
        $data = array();
        $data['id'] = app('request')->get('user_id');
        $data['student_id'] = app('request')->get('student_id');
        $data['name'] = app('request')->get('name');
        $data['new_pw'] = app('request')->get('new_pw');
        $t_obj = new UserItem();
        $t_obj->init($data);

        echo json_encode($t_obj->setStudent());
    }
}
