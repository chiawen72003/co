<?php

namespace App\Http\Controllers;

use App\Http\Providers\ModifyItem;
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
    private $data =array();

    public function __construct()
    {
        $this->data['user_name'] = app('request')->session()->get('name');
        $this->data['user_id'] = app('request')->session()->get('user_id');
    }

    /**
     * 寫作閱卷標準手冊
     *
     *
     */
    public function Manual()
    {

        return view('revised.manual.index', $this->data);
    }

    /**
     * 注意事項
     *
     *
     */
    public function Precautions()
    {

        return view('revised.precautions.index', $this->data);
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

        return view('revised.scroll.index', $this->data);
    }

    /**
     * 參考樣卷
     *
     *
     */
    public function ScrollDemo()
    {

        return view('revised.scroll.index', $this->data);
    }

    /**
     * 試卷選擇頁面
     *
     *
     */
    public function ScrollReelPg()
    {

        return view('revised.scroll.list', $this->data);
    }


    /**
     * 試卷選擇頁面的資料
     *
     *
     */
    public function ScrollReelList()
    {
        $question = new ModifyItem();
        $question->init(array(
            'id' => $this->data['user_id'],
        ));

        echo json_encode($question->getReelList());
    }


    /**
     * 批改試卷資料
     *
     *
     */
    public function ScrollReelView($id)
    {
        $this->data['id'] = $id;

        return view('revised.reel.view', $this->data);
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
        $data['user_id'] = $this->data['user_id'];
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
        $data['user_id'] = $this->data['user_id'];
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

        return view('revised.statistics.index', $this->data);
    }

    /**
     * 閱卷訓練
     *
     *
     */
    public function ScrollTraining()
    {

        return view('revised.statistics.index', $this->data);
    }

    /**
     * 使用者管理
     *
     *
     */
    public function User()
    {

        return view('revised.userdata.index', $this->data);
    }

    /**
     * 使用者的資料
     *
     *
     */
    public function UserData()
    {
        $user = new UserItem();
        $id = $this->data['user_id'];

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
        $data['id'] = $this->data['user_id'];
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

        return view('revised.files.index', $this->data);
    }
}
