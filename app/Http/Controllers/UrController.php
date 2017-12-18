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

    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * 受測者-首頁
     *
     *
     */
    public function Index()
    {
        $data = array();

        return view('user.index', $data);
    }

    /**
     * 受測者管理
     *
     *
     */
    public function User()
    {
        $data = array();

        return view('user.userdata.index', $data);
    }

    /**
     * 受測者的資料
     *
     *
     */
    public function UserData()
    {
        $user = new UserItem();
        $id = app('request')->get('id');

        echo json_encode($user->getStudent($id));
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
        $data['id'] = 1;
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
        $data = array();

        return view('user.reel.index', $data);
    }

    /**
     * 試卷管理
     *
     *
     */
    public function ReelList()
    {
        $reel = new MeasuredItem();
        $id = app('request')->get('id');
        $id = 1;

        echo json_encode($reel->getMeasured($id));
    }


    /**
     * 試卷 填寫頁面
     *
     *
     */
    public function ReelEdit($id)
    {
        $data = array();
        $data['id'] = $id;

        return view('user.reel.edit', $data);
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
        $data['user_id'] = 1;
        $data['reel_id'] = app('request')->get('reel_id');
        $data['add_data'] = app('request')->get('add_data');
        $t_obj = new MeasuredItem();
        $t_obj->init($data);

        echo json_encode($t_obj->setTestData());
    }
}
