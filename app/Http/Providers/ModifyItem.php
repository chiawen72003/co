<?php

namespace App\Http\Providers;

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
        $temp_obj = ReelModify::where('reel_modify.user_id',$this->input_array['id'])
            ->leftJoin('reel', 'reel_modify.reel_id', '=', 'reel.id')
            ->select(
                'reel_modify.view_num',
                'reel_modify.need_num',
                'reel_modify.reel_id',
                'reel.reel_title'
            )
            ->get();
        foreach($temp_obj as $v ){
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

}
