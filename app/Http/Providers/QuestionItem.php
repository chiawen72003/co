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
     * 取得 試題資料
     *
     */
    public function getQuestion()
    {
        $return_data = array();
        $temp_obj = UnitStructure::select('id', 'version', 'subject', 'book', 'unit_title')
            ->orderby('version', 'ASC')
            ->orderby('subject', 'ASC')
            ->orderby('book', 'ASC')
            ->orderby('unit_title', 'ASC')
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
     * 新增 試題資料
     *
     */
    public function addQuestion()
    {
        $update = new Questions();
        $update->type = $this->input_array['type'];
        $update->type_title = json_encode($this->input_array['type_title']);
        $update->question_title = $this->input_array['question_title'];
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
            $update->unit_title = $this->input_array['unit_title'];
            $update->type = $this->input_array['type'];
            $update->type_title = json_encode($this->input_array['type_title']);
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
