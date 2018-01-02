<?php

namespace App\Http\Controllers;

use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;
use App\Http\Providers\MeasuredItem;
use App\Http\Providers\UserItem;


class UrController extends Controller
{
    private $data =array();

    public function __construct()
    {
        $this->data['user_name'] = app('request')->session()->get('name');
        $this->data['user_id'] = app('request')->session()->get('user_id');
    }

    /**
     * 受測者-首頁
     *
     *
     */
    public function Index()
    {

        return view('user.index', $this->data);
    }

    /**
     * 受測者管理
     *
     *
     */
    public function User()
    {

        return view('user.userdata.index', $this->data);
    }

    /**
     * 受測者的資料
     *
     *
     */
    public function UserData()
    {
        $data = array();
        $data['user_id'] = $this->data['user_id'];
        $user = new UserItem();
        $user->init($data);

        echo json_encode($user->getStudent());
    }

    /**
     * 更新受測者的資料
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

        echo json_encode($t_obj->setStudentPw());
    }

    /**
     * 試卷管理
     *
     *
     */
    public function Reel()
    {

        return view('user.reel.index', $this->data);
    }

    /**
     * 試卷管理
     *
     *
     */
    public function ReelList()
    {
        $data = array();
        $data['id'] = $this->data['user_id'];
        $reel = new MeasuredItem();
        $reel->init($data);

        echo json_encode($reel->getMeasured());
    }


    /**
     * 試卷 填寫頁面
     *
     *
     */
    public function ReelEdit($id)
    {
        $this->data['id'] = $id;
        $this->data['user_name'] = app('request')->session()->get('name');
        $this->data['user_id'] = app('request')->session()->get('user_id');
        $this->data['student_id'] = app('request')->session()->get('student_id');
        $this->data['school_title'] = app('request')->session()->get('school_title');

        return view('user.reel.edit', $this->data);
    }

    /**
     * 試卷的試題資料
     * 1. 需檢測使用者是否有權限受測
     * 2. 回傳項目：試題資料，作文頁面的版面
     */
    public function ReelData()
    {
        $data = array();
        $data['id'] = app('request')->get('id');
        $t_obj = new MeasuredItem();
        $t_obj->init($data);

        echo json_encode($t_obj->getReelQuation());
    }

    /**
     * 新增試卷填寫的資料
     *
     *
     */
    public function ReelAdd()
    {
        $data = array();
        $data['user_id'] = $this->data['user_id'];
        $data['reel_id'] = app('request')->get('reel_id');
        $data['add_data'] = app('request')->get('add_data');
        $t_obj = new MeasuredItem();
        $t_obj->init($data);

        echo json_encode($t_obj->setTestData());
    }
}
