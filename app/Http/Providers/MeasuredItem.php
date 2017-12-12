<?php

namespace App\Http\Providers;

use App\Http\Models\ListUnderTest;
use App\Http\Models\ReelQuestion;
use App\Http\Models\Questions;
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
        $temp_obj = ListUnderTest::select('reel_id')
            ->where('user_id',$user_id)
            ->get();
        foreach($temp_obj as $v ){
            $return_data[] = route('ur.reel.edit',array($v['reel_id']));
        }

        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $return_data,
        );

        return $this->msg;
    }

    /**
     * 回傳指定試卷內所有試題資料
     *
     */
    public function getReelQuation(){
        $data = array();
        $t = ReelQuestion::where('reel_question.reel_id', $this -> input_array['id'])
            ->leftJoin('questions', 'questions.id', '=', 'reel_question.question_id')
            ->select(
                'questions.type',
                'questions.type_title',
                'questions.question_title',
                'questions.dsc',
                'questions.id'
            )
            ->get();
        foreach ($t as $v){
            $data[] = array(
                'type' => $v['type'],
                'type_title' => json_decode($v['type_title'], true),
                'question_title' => $v['question_title'],
                'dsc' => $v['dsc'],
                'id' => $v['id'],
            );
        }

        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $data,
        );

        return $this->msg;
    }
}
