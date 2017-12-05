<?php

namespace App\Http\Providers;

use App\Http\Models\UnitStructure;
use App\Http\Models\Course;
use Illuminate\Support\Str;
use \Input;

/**
 * Class StructureItem
 * 結構物件：處理版本、冊、單元、卷等資料
 *
 * @package App\Http\Providers處理
 */
class StructureItem
{
    private $input_array = array(
        'id' => null,
        'title' => null,
        'dsc' => null,
        'file' => null,
        'updateFile' => null,
    );
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
     * 新增 單元結構資料
     *
     */
    public function add_unit()
    {
        $update = new UnitStructure();
        $update->version = $this->input_array['version'];
        $update->subject = $this->input_array['subject'];
        $update->book = $this->input_array['book'];
        $update->unit_title = $this->input_array['unit_title'];
        $update->save();
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
        );

        return $this->msg;
    }


    /**
     * 更新 單元結構資料
     *
     */
    public function update_unit()
    {
        if (isset($this->input_array['id']) && isset($this->input_array['unit_title'])) {
            $update = UnitStructure::find($this->input_array['id']);
            $update->unit_title = $this->input_array['unit_title'];
            $update->save();
            $this->msg = array(
                'status' => true,
                'msg' => '更新成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 移除 單元結構資料
     *
     */
    public function delete_unit()
    {
        if (isset($this->input_array['id'])) {
            UnitStructure::destroy($this->input_array['id']);
            $this->msg = array(
                'status' => true,
                'msg' => '刪除成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 新增 課程資料
     *
     */
    public function add_course()
    {
        $update = new Course();
        $update->school_year = $this->input_array['school_year'];
        $update->semester = $this->input_array['semester'];
        $update->course_title = $this->input_array['course_title'];
        $update->save();
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
        );

        return $this->msg;
    }


    /**
     * 更新 課程資料
     *
     */
    public function update_course()
    {
        if (isset($this->input_array['id']) && isset($this->input_array['course_title'])) {
            $update = Course::find($this->input_array['id']);
            $update->course_title = $this->input_array['course_title'];
            $update->save();
            $this->msg = array(
                'status' => true,
                'msg' => '更新成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 移除 課程資料
     *
     */
    public function delete_course()
    {
        if (isset($this->input_array['id'])) {
            Course::destroy($this->input_array['id']);
            $this->msg = array(
                'status' => true,
                'msg' => '刪除成功!',
            );
        }

        return $this->msg;
    }


}
