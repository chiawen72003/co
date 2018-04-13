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
use App\Http\Providers\MeasuredItem;
use App\Http\Providers\PhpExcel;


class SmController extends Controller
{
    private $data =array();

    public function __construct()
    {
        $this->data['user_name'] = app('request')->session()->get('name');
        $this->data['user_id'] = app('request')->session()->get('user_id');
        $this->data['school_id'] = app('request')->session()->get('school_id');
    }


    /**
     * 學校-班級
     */
    public function Classes()
    {

        return view('schoolman.school_classes.index', $this->data);
    }

    /**
     * 指定學校跟班級的資料
     */
    public function ClassesInit()
    {
        $school = new SchoolItem(array(
            'id' => $this->data['school_id'],
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
        $data['school_id'] = $this->data['school_id'];
        $data['title'] = app('request')->get('title');
        $t_obj = new SchoolItem();
        $t_obj->init($data);

        echo json_encode($t_obj->addClasses());
    }


    /**
     * 匯入班級內的學生資料
     *
     *
     */
    public function ClassesAddStudent()
    {
        $fp = Input::all();
        $data = array(
            'school_id' => $this->data['school_id'],
            'classes_id' => isset($fp['classes_id']) ? $fp['classes_id'] : null,
            'import_user_file' => Input::file('import_file') ? Input::file('import_file') : null,
        );
        $member_obj = new SchoolItem();
        $member_obj->init($data);

        echo json_encode($member_obj->get_import_student());
    }

    /**
     * 課程設定
     *
     *
     */
    public function Course()
    {

        return view('schoolman.course.index', $this->data);
    }


    /**
     * 所有課程的資料
     *
     *
     */
    public function CourseList()
    {
        $school = new StructureItem();
        $school->init(array(
            'school_id' => $this->data['school_id'],
        ));

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
        $data['school_id'] = $this->data['school_id'];
        $t_obj = new StructureItem();
        $t_obj->init($data);
        echo json_encode($t_obj->addCourse());
    }

    /**
     * 刪除課程的資料
     *
     *
     */
    public function CourseDel()
    {
        $data = array();
        $data['course_id'] = app('request')->get('course_id');
        $data['school_id'] = $this->data['school_id'];
        $t_obj = new StructureItem();
        $t_obj->init($data);

        echo json_encode($t_obj->deleteCourse());
    }

    /**
     * 學生資訊
     *
     *
     */
    public function Student()
    {

        return view('schoolman.student.index', $this->data);
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
            'school_id' =>  $this->data['school_id'],
            'classes_id' => app('request')->get('classes_id'),
        ));

        echo json_encode($user->getStudentBySubject(),JSON_UNESCAPED_UNICODE);
    }

    /**
     * 學生的資料 初始化的資料
     *
     * 包含所有學校、班級資料
     */
    public function StudentInit()
    {
        $s_obj = new SchoolItem(array(
            'id' => $this->data['school_id'],
        ));
        $school = $s_obj->getOneSchool();
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
     * 新增學生的資料
     *
     *
     */
    public function StudentAdd()
    {
        $data = array();
        $data['login_name'] = app('request')->get('login_name');
        $data['login_pw'] = app('request')->get('login_pw');
        $data['school_id'] = $this->data['school_id'];
        $data['classes_id'] = app('request')->get('classes_id');
        $data['student_id'] = app('request')->get('student_id');
        $data['name'] = app('request')->get('name');
        $t_obj = new UserItem();
        $t_obj->init($data);

        echo json_encode($t_obj->addStudent(),JSON_UNESCAPED_UNICODE);
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

        echo json_encode($t_obj->setStudent(),JSON_UNESCAPED_UNICODE);
    }

    /**
     * 刪除學生的資料
     */
    public function StudentDel()
    {
        $data = array();
        $data['id'] = app('request')->get('user_id');
        $t_obj = new UserItem();
        $t_obj->init($data);

        echo json_encode($t_obj->unsetStudent(),JSON_UNESCAPED_UNICODE);
    }

    /**
     * 課程-學員對應設定
     *
     *
     */
    public function CourseStudent()
    {

        return view('schoolman.course.student.index', $this->data);
    }

    /**
     * 課程-學員對應 初始化資料
     */
    public function CourseStudentInit()
    {
        $structure = new StructureItem();
        $school_item = new SchoolItem();
        $structure->init(array(
            'school_id' => $this->data['school_id'],
        ));
        $school_item->init(array(
            'id' => $this->data['school_id'],
        ));
        $course = $structure->getCourse();
        $school = $school_item->getOneSchool();
        $classes = $school_item->getClasses();
        $list = $structure->getCourseStudent();
        $return = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'course' => $course['data'],
                'school' => $school['data'],
                'classes' => $classes['data'],
                'list' => $list['data'],
            ),
        );

        echo json_encode($return);
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
        $data['school_id'] = $this->data['school_id'];
        $data['classes_id'] = app('request')->get('classes_id');
        $t_obj = new StructureItem();
        $t_obj->init($data);

        echo json_encode($t_obj->addCourseStudent());
    }

    /**
     * 課程-試卷對應設定
     *
     *
     */
    public function CourseReel()
    {

        return view('schoolman.course.reel.index', $this->data);
    }

    /**
     * 課程與試卷對應 初始化資料
     */
    public function CourseReelInit()
    {
        $structure = new StructureItem();
        $classes_obj = new SchoolItem(array(
            'id' => $this->data['school_id']
        ));
        $structure->init(array(
            'school_id' => $this->data['school_id'],
        ));
        $course = $structure->getCourse();
        $reel = $structure->getReel();
        $list = $structure->getCourseReel();
        $classes = $classes_obj->getClasses();
        $return = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'course' => $course['data'],
                'reel' => $reel['data'],
                'classes' => $classes['data'],
                'list' => $list['data'],
            ),
        );

        echo json_encode($return);
    }

    /**
     * 所有課程-試卷對應的資料
     */
    public function CourseReelList()
    {
        $school = new StructureItem();
        $school->init(array(
            'school_id' => $this->data['school_id'],
        ));

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
        $data['sw_class'] = app('request')->get('sw_class');
        $data['test_time'] = app('request')->get('test_time');
        $data['school_id'] = $this->data['school_id'];
        $t_obj = new StructureItem();
        $t_obj->init($data);
        echo json_encode($t_obj->addCourseReel());
    }

    /**
     * 移除課程-試卷對應的資料
     *
     *
     */
    public function CourseReelDel()
    {
        $data = array();
        $data['reel_id'] = app('request')->get('reel_id');
        $data['course_id'] = app('request')->get('course_id');
        $data['classes_id'] = app('request')->get('classes_id');
        $data['school_id'] = $this->data['school_id'];
        $t_obj = new StructureItem();
        $t_obj->init($data);
        echo json_encode($t_obj->unsetCourseReel());
    }


    /**
     * 個人資料管理
     *
     *
     */
    public function User()
    {

        return view('schoolman.userdata.index', $this->data);
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

        echo json_encode($user->getSchoolMan());
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

        echo json_encode($t_obj->setSchoolManPw());
    }


    /**
     * 作答結果查詢頁面
     */
    public function Analysis()
    {

        $unit_id = app('request')->get('unit_id');
        if (!is_null($unit_id)) {
            $this->data['unit_id'] = $unit_id;
        }

        return view('schoolman.reel_analysis.index', $this->data);
    }

    /**
     * 作答結果查詢頁面 初始化用的資料
     */
    public function AnalysisInit()
    {
        $obj = new StructureItem();
        $unit = $obj->getUnit();
        $reel = $obj->getReel();
        $msg = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'unit' => $unit['data'],
                'reel' => $reel['data'],
            ),
        );

        echo json_encode($msg);
    }

    /**
     * 作答結果查詢頁面 顯示試題分析頁面
     */
    public function AnalysisList()
    {
        $unit_id = app('request')->get('unit_id');
        $reel_id = app('request')->get('reel_id');
        if (!is_null($unit_id)) {
            $this->data['unit_id'] = $unit_id;
        }
        if (!is_null($reel_id)) {
            $this->data['reel_id'] = $reel_id;
        }

        return view('schoolman.reel_analysis.list', $this->data);
    }

    /**
     * 作答結果查詢頁面 顯示試題分析頁面
     */
    public function AnalysisListInit()
    {
        $t_obj = new MeasuredItem();
        $t_obj->init(array(
            'reel_id' => app('request')->get('reel_id'),
            'school_id' => $this->data['school_id']
        ));

        echo json_encode($t_obj->getReelAnalys(), JSON_UNESCAPED_UNICODE);
    }

    /**
     * 作答結果查詢頁面 下載指定試題統計資料的excel檔
     */
    public function AnalysisDownloadExcel()
    {
        $t_obj = new MeasuredItem();
        $t_obj->init(array(
            'reel_id' => app('request')->get('reel_id')
        ));
        $data = $t_obj->getReelAnalysExcel();

        $file_name = $data['reel_name'];
        $file_name .= '.xls';
        $excel_obj = new PhpExcel();
        $excel_obj->set_file_name($file_name);
        $excel_obj->set_excel_data($data['excel_data']);
        $excel_obj->get_reel_analysis_data();
    }

    /**
     * 學生成績查詢頁面
     */
    public function Score()
    {

        return view('schoolman.score.index', $this->data);
    }

    /**
     * 學生成績的初始化資料
     */
    public function ScoreInit()
    {
        $obj = new StructureItem();
        $obj->init(array(
            'school_id' => $this->data['school_id'],
        ));
        $course_data = $obj->getCourse();
        $course_classes = $obj->getCourseReel();
        $school = new SchoolItem(array(
            'id' => $this->data['school_id'],
        ));
        $classses = $school->getClasses();
        $t_obj = new UserItem();
        $t_obj->init(array(
            'school_id' => $this->data['school_id'],
        ));
        $student_name = $t_obj->getAllStudentName();
        $msg = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'course' => $course_data['data'],
                'course_classes' => $course_classes['data'],
                'classes' => $classses['data'],
                'student' => array_values($student_name['data']),
            ),
        );

        echo json_encode($msg);
    }

    /**
     * 學生成績的資料
     */
    public function ScoreApi()
    {
        $data = array();
        $data['school_id'] = $this->data['school_id'];
        $data['course_id'] = app('request')->get('course_id');
        $data['classes_id'] = app('request')->get('classes_id');
        $t_obj = new MeasuredItem();
        $t_obj->init($data);

        echo json_encode($t_obj->getCourseReelScore());
    }

    /**
     * 下載指定課程跟班級內，指定試卷的excel檔
     */
    public function ScoreDownloadExcel()
    {
        //取出學生資料
        $t_obj = new UserItem();
        $t_obj->init(array(
            'school_id' => $this->data['school_id'],
        ));
        $student_name = $t_obj->getAllStudentName();

        $t_obj = new MeasuredItem();
        $year = app('request')->get('year');
        $t_obj->init(array(
            'school_id' => $this->data['school_id'],
            'course_id' => app('request')->get('course_id'),
            'classes_id' => app('request')->get('classes_id'),
            'reel_id' => app('request')->get('reel_id'),
            'students' => $student_name['data'],
        ));
        $data = $t_obj->getScoreAnalysExcel();

        $file_name = $year.'_'.$data['reel_name'];
        $file_name .= '.xls';
        $excel_obj = new PhpExcel();
        $excel_obj->set_file_name($file_name);
        $excel_obj->set_excel_data($data['excel_data']);
        $excel_obj->get_score_analysis_data();
    }
}
