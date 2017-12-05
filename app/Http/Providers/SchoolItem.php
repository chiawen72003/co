<?php

namespace App\Http\Providers;

use App\Http\Models\School;
use App\Http\Models\SchoolSubject;
use Illuminate\Support\Str;
use \Input;

/**
 * Class SchoolItem
 * 學校物件：處理學校名稱、代碼、學期等資料
 *
 * @package App\Http\Providers
 */
class SchoolItem
{
    private $input_array = array(
        'id' => null,
        'title' => null,
        'dsc' => null,
        'file' => null,
        'updateFile' => null,
    );

    public function init($input_data = array())
    {
        foreach ($input_data as $k => $v) {
            $this->input_array[$k] = $v;
        }
    }

    /**
     * 新增 科系資料
     *
     */
    public function add_subject()
    {
        $update = new SchoolSubject();
        $update->school_id = $this->input_array['school_id'];
        $update->subject_title = $this->input_array['subject_title'];
        $update->save();
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
        );

        return $this->msg;
    }


    /**
     * 更新 科系資料
     *
     */
    public function update_subject()
    {
        if (isset($this->input_array['id']) && isset($this->input_array['subject_title'])) {
            $update = SchoolSubject::find($this->input_array['id']);
            $update->subject_title = $this->input_array['subject_title'];
            $update->save();
            $this->msg = array(
                'status' => true,
                'msg' => '更新成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 移除 科系資料
     *
     */
    public function delete_subject()
    {
        if (isset($this->input_array['id'])) {
            SchoolSubject::destroy($this->input_array['id']);
            $this->msg = array(
                'status' => true,
                'msg' => '刪除成功!',
            );
        }

        return $this->msg;
    }


    /**
     * 新增 學校資料
     *
     */
    public function add_school()
    {
        $update = new School();
        $update->city = $this->input_array['city'];
        $update->code = $this->input_array['code'];
        $update->school_title = $this->input_array['school_title'];
        $update->save();
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
        );

        return $this->msg;
    }


    /**
     * 更新 科系資料
     *
     */
    public function update_school()
    {
        if (isset($this->input_array['id']) && isset($this->input_array['school_title'])) {
            $update = School::find($this->input_array['id']);
            $update->school_title = $this->input_array['school_title'];
            $update->save();
            $this->msg = array(
                'status' => true,
                'msg' => '更新成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 移除 科系資料
     *
     */
    public function delete_school()
    {
        if (isset($this->input_array['id'])) {
            School::destroy($this->input_array['id']);
            $this->msg = array(
                'status' => true,
                'msg' => '刪除成功!',
            );
        }

        return $this->msg;
    }

}
