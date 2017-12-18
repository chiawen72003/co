<?php

namespace App\Http\Controllers;

use \Input;
use \Validator;
use \Session;
use \DB;
use \Response;
use App\Http\Providers\MeasuredItem;
use App\Http\Providers\StructureItem;
use App\Http\Providers\UserItem;

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
     * 注意事項的資料
     *
     *
     */
    public function PrecautionsData()
    {
        $question = new StructureItem();
        $id = '1';

        echo json_encode($question->getPrecautions($id));
    }

    /**
     * 線上閱卷
     *
     *
     */
    public function Scroll()
    {
        $data = array();

        return view('revised.scroll.index', $data);
    }

    /**
     * 參考樣卷
     *
     *
     */
    public function ScrollDemo()
    {
        $data = array();

        return view('revised.scroll.index', $data);
    }

    /**
     * 試卷選擇頁面
     *
     *
     */
    public function ScrollReelList()
    {
        $data = array();

        return view('revised.reel.index', $data);
    }

    /**
     * 批改試卷資料
     *
     *
     */
    public function ScrollReelView($id)
    {
        $data = array();
        $data['id'] = $id;

        return view('revised.reel.view', $data);
    }

    /**
     * 隨機取得一個試卷受測的資料
     *
     *
     */
    public function ScrollReelData()
    {
        $data = array();
        $data['reel_id'] = app('request')->get('id');
        $data['user_id'] = 1;
        $t_obj = new MeasuredItem();
        $t_obj->init($data);

        echo json_encode($t_obj->getReelTestData());
    }

    /**
     * 新增一筆評閱資料
     *
     *
     */
    public function ScrollReelUpdate()
    {
        $data = array();
        $data['id'] = app('request')->get('id');
        $data['user_id'] = 1;
        $data['reel_id'] = app('request')->get('reel_id');
        $data['order'] = app('request')->get('order');
        $data['add_data'] = app('request')->get('add_data');
        $t_obj = new MeasuredItem();
        $t_obj->init($data);

        echo json_encode($t_obj->setViewData());
    }

    /**
     * 批改統計
     *
     *
     */
    public function Statistics()
    {
        $data = array();

        return view('revised.statistics.index', $data);
    }

    /**
     * 閱卷訓練
     *
     *
     */
    public function ScrollTraining()
    {
        $data = array();

        return view('revised.statistics.index', $data);
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
        $user = new UserItem();
        $id = app('request')->get('id');

        echo json_encode($user->getReviewer($id));
    }

    /**
     * 更新使用者的資料
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

        echo json_encode($t_obj->setReviewerPw());
    }

    /**
     * 檔案下載
     *
     *
     */
    public function Files()
    {
        $data = array();

        return view('revised.files.index', $data);
    }
}
