<?php

namespace App\Http\Controllers;

use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;

class RvController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * 寫作閱卷標準手冊
     *
     *
     */
    public function Manual()
    {
        $data = array();

        return view('revised.manual.index', $data);
    }

    /**
     * 注意事項
     *
     *
     */
    public function Precautions()
    {
        $data = array();

        return view('revised.precautions.index', $data);
    }

    /**
     * 線上閱卷
     *
     *
     */
    public function Scroll()
    {
        $data = array();

        return view('revised.precautions.index', $data);
    }

    /**
     * 批改統計
     *
     *
     */
    public function Statistics()
    {
        $data = array();

        return view('revised.precautions.index', $data);
    }

    /**
     * 使用者管理
     *
     *
     */
    public function User()
    {
        $data = array();

        return view('revised.userdata.index', $data);
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

    /**
     * 檔案下載
     *
     *
     */
    public function Files()
    {
        $data = array();

        return view('revised.precautions.index', $data);
    }
}
