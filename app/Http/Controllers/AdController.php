<?php

namespace App\Http\Controllers;

use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;
use App\Http\Providers\SchoolItem;
use App\Http\Providers\StructureItem;

class AdController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * 學校-科系
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function SchoolSubject()
    {
        $data = array();

        return view('admin.school_subject.index', $data);
    }

    /**
     * 所有學校-科系的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function SchoolSubjectList()
    {
        $school = new SchoolItem();

        echo json_encode($school->getSubject());
    }

    /**
     * 新增學校-科系的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function SchoolSubjectAdd()
    {
        $data = array();
        $data['subject_title'] = app('request')->get('subject_title');
        $data['school_id'] = app('request')->get('school_id');
        $t_obj = new SchoolItem();
        $t_obj ->init($data);
        echo json_encode($t_obj->addSubject());
    }

    /**
     * 學校
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function School()
    {
        $data = array();

        return view('admin.school.index', $data);
    }

    /**
     * 所有學校的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function SchoolList()
    {
        $school = new SchoolItem();

        echo json_encode($school->getSchool());
    }

    /**
     * 新增學校的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function SchoolAdd()
    {
        $data = array();
        $data['school_title'] = app('request')->get('school_title');
        $data['area'] = app('request')->get('area');
        $data['code'] = app('request')->get('code');
        $data['city'] = 0;
        $t_obj = new SchoolItem();
        $t_obj ->init($data);
        echo json_encode($t_obj->addSchool());
    }

    /**
     * 課程設定
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Course()
    {
        $data = array();

        return view('admin.course.index', $data);
    }

    /**
     * 所有課程的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function CourseList()
    {
        $school = new StructureItem();

        echo json_encode($school->getCourse());
    }

    /**
     * 新增課程的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function CourseAdd()
    {
        $data = array();
        $data['school_year'] = app('request')->get('school_year');
        $data['semester'] = app('request')->get('semester');
        $data['course_title'] = app('request')->get('course_title');
        $t_obj = new StructureItem();
        $t_obj ->init($data);
        echo json_encode($t_obj->addCourse());
    }

    /**
     * 單元結構
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Unit()
    {
        $data = array();

        return view('admin.unit_structure.index', $data);
    }

    /**
     * 所有單元結構的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function UnitList()
    {
        $school = new StructureItem();

        echo json_encode($school->getUnit());
    }

    /**
     * 新增單元結構的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function UnitAdd()
    {
        $data = array();
        $data['version'] = app('request')->get('version');
        $data['subject'] = app('request')->get('subject');
        $data['book'] = app('request')->get('book');
        $data['unit_title'] = app('request')->get('unit_title');
        $t_obj = new StructureItem();
        $t_obj ->init($data);
        echo json_encode($t_obj->addUnit());
    }

    /**
     * 試卷
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Reel()
    {
        $data = array();

        return view('admin.reel.index', $data);
    }

    /**
     * 所有試卷的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ReelList()
    {
        $school = new StructureItem();

        echo json_encode($school->getReel());
    }

    /**
     * 新增試卷的資料
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        $t_obj ->init($data);
        echo json_encode($t_obj->addReel());
    }
}
