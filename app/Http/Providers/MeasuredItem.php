<?php

namespace App\Http\Providers;

use App\Http\Models\ListUnderTest;
use App\Http\Models\ReelQuestion;
use App\Http\Models\ReelModify;
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
            ->where('has_test',0)
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
                'questions.id',
                'questions.max_score'
            )
            ->get();
        foreach ($t as $v){
            $data[] = array(
                'type' => $v['type'],
                'type_title' => json_decode($v['type_title'], true),
                'question_title' => $v['question_title'],
                'dsc' => $v['dsc'],
                'id' => $v['id'],
                'max_score' => $v['max_score'],
            );
        }

        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $data,
        );

        return $this->msg;
    }

    /**
     * 新增 受測者填寫的試題資料
     *
     * 備註：新增資料時預設先設定給一個評閱者
     */
    public function setTestData()
    {
        if (isset($this->input_array['reel_id'])) {
            $def_m = 0;
            $t_array = null;
            $t = ReelModify::where('reel_id',$this->input_array['reel_id'])
                ->get();
            foreach($t as $v){
                if($v['view_num'] <= ['need_num']){
                    $t_array[] = $v['user_id'];
                }
            }
            if(!is_null($t_array)){
                $t_num = array_rand($t_array, 1);
                $def_m = $t_array[$t_num];
            }

            ListUnderTest::where('user_id',$this->input_array['user_id'])
            ->where('reel_id',$this->input_array['reel_id'])
            ->update([
                'test_data'=>json_encode($this->input_array['add_data'],JSON_UNESCAPED_UNICODE),
                'has_test'=>1,
                'modify_id' => $def_m,
            ]);
            $this->msg = array(
                'status' => true,
                'msg' => '新增成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 隨機取得一個指定試卷的受測資料
     */
    public function getReelTestData()
    {
        $return_data = array();
        $temp_obj = ListUnderTest::select('id','test_data')
            ->where('reel_id',$this->input_array['reel_id'])
            ->where('has_test',1)
            ->where('has_review',0)
            ->get();
        foreach($temp_obj as $v ){
            $return_data[] = array(
                'id' => $v['id'],
                'test_data' => json_decode($v['test_data'], true),
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
