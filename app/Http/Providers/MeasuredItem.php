<?php

namespace App\Http\Providers;

use App\Http\Models\ListUnderTest;
use App\Http\Models\Course;
use App\Http\Models\Reel;
use App\Http\Models\Precautions;
use Illuminate\Support\Str;
use \Input;

/**
 * Class StructureItem
 * 結構物件：試卷分派、受測者填寫的資料
 *
 * @package App\Http\Providers處理
 */
class MeasuredItem
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
     * 取得 受測者需要測試的試卷資料
     *
     */
    public function getMeasured($user_id)
    {
        $return_data = array();
        $temp_obj = ListUnderTest::select('id','reel_id')
            ->get();
        foreach($temp_obj as $v ){
            $return_data[] = $v;
        }

        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $return_data,
        );

        return $this->msg;
    }

}
