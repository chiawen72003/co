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
use App\Http\Providers\FileItem;

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
     * 匯入班級內的學生資料
     *
     *
     */
    public function ClassesAddStudent()
    {
        $fp = Input::all();
        $data = array(
            'school_id' => isset($fp['school_id']) ? $fp['school_id'] : null,
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
     * 學生資訊
     *
     *
     */
    public function Student()
    {

        return view('schoolman.student.index', $this->data);
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
        $course = $structure->getCourse();
        $school = $school_item->getSchool();
        $classes = $school_item->getAllClasses();
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
        $data['school_id'] = app('request')->get('school_id');
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
        $course = $structure->getCourse();
        $reel = $structure->getReel();
        $list = $structure->getCourseReel();

        $return = array(
            'status' => true,
            'msg' => '',
            'data' => array(
                'course' => $course['data'],
                'reel' => $reel['data'],
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
     * 移除課程-試卷對應的資料
     *
     *
     */
    public function CourseReelDel()
    {
        $data = array();
        $data['reel_id'] = app('request')->get('reel_id');
        $data['course_id'] = app('request')->get('course_id');
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

}
