<?php

namespace App\Http\Controllers;

use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;

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
     * 使用者管理
     *
     *
     */
    public function User()
    {
        $data = array();

        return view('user.userdata.index', $data);
    }

    /**
     * 使用者的資料
     *
     *
     */
    public function UserData()
    {
        $question = new StructureItem();
        $id = app('request')->get('id');

        echo json_encode($question->getPrecautions($id));
    }

    /**
     * 更新使用者的資料
     *
     *
     */
    public function UserUpdate()
    {
        $data = array();
        $data['id'] = app('request')->get('id');
        $data['dsc'] = app('request')->get('dsc');
        $t_obj = new StructureItem();
        $t_obj->init($data);

        echo json_encode($t_obj->updatePrecautions());
    }
}
