<?php

namespace App\Http\Providers;

use App\Http\Models\ListUnderTest;
use App\Http\Models\ReelModify;
use Illuminate\Support\Str;
use \Input;

/**
 * Class ModifyItem
 * 批閱物件：處理等資料批閱分派、給分
 *
 * @package App\Http\Providers處理
 */
class ModifyItem
{
    private $input_array = array();

    private $msg = array(
        'status' => false,
        'msg' => '',
    );

    public function init($input_data = array())
    {
        foreach ($input_data as $k => $v) {
            $this->input_array[$k] = $v;
        }
    }


    /**
     * 取得 評閱者被設定要評閱的試卷資料
     *
     */
    public function getReelList()
    {
        $return_data = array();
        $temp_obj = ReelModify::where('reel_modify.user_id', $this->input_array['id'])
            ->leftJoin('reel', 'reel_modify.reel_id', '=', 'reel.id')
            ->select(
                'reel_modify.view_num',
                'reel_modify.need_num',
                'reel_modify.reel_id',
                'reel.reel_title'
            )
            ->get();
        foreach ($temp_obj as $v) {
            $return_data[] = array(
                'path' => route('rv.scroll.reel.view', array($v['reel_id'])),
                'reel_title' => $v['reel_title'],
                'need_num' => $v['need_num'],
                'view_num' => $v['view_num'],
            );
        }

        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $return_data,
        );

        return $this->msg;
    }

    /**
     * 新增 評閱者-試卷資料
     *
     * 備註：新增時就先指派現有的試卷給此評閱者
     */
    public function addReel()
    {
        $update = new ReelModify();
        $update->reel_id = $this->input_array['reel_id'];
        $update->user_id = $this->input_array['user_id'];
        $update->need_num = $this->input_array['need_num'];
        $update->view_num = 0;
        $update->save();
        //處理指派
        ListUnderTest::where('modify_id', '0')
            ->where('reel_id', $this->input_array['reel_id'])
            ->where('has_test', '1')
            ->where('has_review', '0')
            ->limit($this->input_array['need_num'])
            ->update(['modify_id'=>$this->input_array['user_id']]);

        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
        );

        return $this->msg;
    }
}
