<?php

namespace App\Http\Controllers;

use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;
use App\Http\Providers\SchoolItem;

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

}
