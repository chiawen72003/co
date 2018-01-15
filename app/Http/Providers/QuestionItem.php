<?php

namespace App\Http\Providers;

use App\Http\Models\Questions;
use Illuminate\Support\Str;
use \Input;

/**
 * Class QuestionItem
 * 試題物件：處理試題、受測者填寫的資料等
 *
 * @package App\Http\Providers
 */
class QuestionItem
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
     * 取得 指定試卷內所有試題資料
     *
     */
    public function getQuestion()
    {
        $return_data = array();
        $temp_obj = Questions::select('id', 'question_title', 'type', 'type_title')
            ->where('reel_id', $this->input_array['reel_id'])
            ->orderby('id', 'ASC')
            ->get();
        foreach ($temp_obj as $v) {
            $return_data[] = $v;
        }

        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $return_data,
        );

        return $this->msg;
    }

    /**
     * 取得 試題資料
     *
     */
    public function getQuestionByID()
    {
        $return_data = array();
        $temp_obj = Questions::select('id', 'reel_id', 'power', 'question_title', 'type', 'type_title', 'dsc',
            'max_score')
            ->where('id', $this->input_array['question_id'])
            ->get();
        foreach ($temp_obj as $v) {
            $v['type'] = json_decode($v['type']);
            $v['type_title'] = json_decode($v['type_title']);
            $v['question_title'] = json_decode($v['question_title']);
            $v['power'] = json_decode($v['power']);
            $v['max_score'] = json_decode($v['max_score']);
            $return_data[] = $v;
        }
        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $return_data,
        );

        return $this->msg;
    }

    /**
     * 新增 試題資料
     *
     */
    public function addQuestion()
    {
        $update = new Questions();
        $update->reel_id = $this->input_array['reel_id'];
        $update->type = json_encode($this->input_array['type'], JSON_UNESCAPED_UNICODE);
        $update->type_title = json_encode($this->input_array['type_title'], JSON_UNESCAPED_UNICODE);
        $update->question_title = json_encode($this->input_array['question_title'], JSON_UNESCAPED_UNICODE);
        $update->power = json_encode($this->input_array['power'], JSON_UNESCAPED_UNICODE);
        $update->max_score = json_encode($this->input_array['max_score'], JSON_UNESCAPED_UNICODE);
        $update->dsc = $this->input_array['dsc'];
        $update->save();
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
        );

        return $this->msg;
    }


    /**
     * 更新 試題資料
     *
     */
    public function updateQuestion()
    {
        if (isset($this->input_array['id'])) {
            $update = Questions::find($this->input_array['id']);
            $update->question_title = $this->input_array['question_title'];
            $update->type = $this->input_array['type'];
            $update->type_title = json_encode($this->input_array['type_title'], JSON_UNESCAPED_UNICODE);
            $update->power = $this->input_array['power'];
            $update->dsc = $this->input_array['dsc'];
            $update->save();
            $this->msg = array(
                'status' => true,
                'msg' => '更新成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 移除 試題資料
     *
     */
    public function deleteQuestion()
    {
        if (isset($this->input_array['id'])) {
            Questions::destroy($this->input_array['id']);
            $this->msg = array(
                'status' => true,
                'msg' => '刪除成功!',
            );
        }

        return $this->msg;
    }

}
