<?php

namespace App\Http\Controllers;

use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;
use App\Http\Providers\MeasuredItem;


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

    /**
     * 試卷管理
     *
     *
     */
    public function Reel()
    {
        $data = array();

        return view('user.userdata.index', $data);
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

        echo json_encode($reel->getMeasured($id));
    }


    /**
     * 試卷 填寫頁面
     *
     *
     */
    public function ReelEdit()
    {
        $data = array();

        return view('user.userdata.index', $data);
    }

    /**
     * 試卷的試題資料
     *
     *
     */
    public function ReelData()
    {
        $question = new StructureItem();
        $id = app('request')->get('id');

        echo json_encode($question->getPrecautions($id));
    }

    /**
     * 新增試卷填寫的資料
     *
     *
     */
    public function ReelUpdate()
    {
        $data = array();
        $data['id'] = app('request')->get('id');
        $data['dsc'] = app('request')->get('dsc');
        $t_obj = new StructureItem();
        $t_obj->init($data);

        echo json_encode($t_obj->updatePrecautions());
    }
}
