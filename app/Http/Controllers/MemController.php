<?php

namespace App\Http\Controllers;

use App\Http\Providers\UserItem;
use App\Http\Providers\SchoolItem;
use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;

class MemController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * 登入
     *
     *
     */
    public function Login()
    {
        $data = array();

        return view('login.index', $data);
    }

    /**
     * 登入-檢查
     *
     *
     */
    public function LoginChk()
    {
        $data = array();
        $data['school_id'] = app('request')->get('schoolId');
        $data['login_name'] = app('request')->get('loginName');
        $data['login_pw'] = app('request')->get('loginPW');
        $t_obj = new UserItem();
        $t_obj->init($data);

        echo json_encode($t_obj->loginChk());
    }

    /**
     * 登出
     *
     *
     */
    public function Logout()
    {
        $t_obj = new UserItem();

        echo json_encode($t_obj->logout());
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
}
