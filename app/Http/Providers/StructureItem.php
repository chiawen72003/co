<?php

namespace App\Http\Providers;

use App\Http\Models\UnitStructure;
use App\Http\Models\Course;
use App\Http\Models\Reel;
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
     * 新增 單元結構資料
     *
     */
    public function addUnit()
    {
        $update = new UnitStructure();
        $update->version = $this->input_array['version'];
        $update->subject = $this->input_array['subject'];
        $update->book = $this->input_array['book'];
        $update->unit_title = $this->input_array['unit_title'];
        $update->save();
        $getID  = $update->id;
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
            'id' => $getID,
            'version' => $this->input_array['version'],
            'subject' => $this->input_array['subject'],
            'book' => $this->input_array['book'],
            'unit_title' => $this->input_array['unit_title'],
        );

        return $this->msg;
    }


    /**
     * 更新 單元結構資料
     *
     */
    public function updateUnit()
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
    public function deleteUnit()
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
     * 取得 課程資料
     *
     */
    public function getCourse()
    {
        $return_data = array();
        $temp_obj = Course::select('id','school_year', 'semester', 'course_title')
            ->orderby('school_year', 'ASC')
            ->orderby('semester', 'ASC')
            ->orderby('course_title', 'ASC')
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

    /**
     * 新增 課程資料
     *
     */
    public function addCourse()
    {
        $update = new Course();
        $update->school_year = $this->input_array['school_year'];
        $update->semester = $this->input_array['semester'];
        $update->course_title = $this->input_array['course_title'];
        $update->save();
        $getID  = $update->id;
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
            'id' => $getID,
            'school_year' => $this->input_array['school_year'],
            'semester' => $this->input_array['semester'],
            'course_title' => $this->input_array['course_title'],
        );

        return $this->msg;
    }


    /**
     * 更新 課程資料
     *
     */
    public function updateCourse()
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
    public function deleteCourse()
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


    /**
     * 新增 試卷資料
     *
     */
    public function addReel()
    {
        $update = new Reel();
        $update->version = $this->input_array['version'];
        $update->subject = $this->input_array['subject'];
        $update->book = $this->input_array['book'];
        $update->unit = $this->input_array['unit'];
        $update->reel_title = $this->input_array['reel_title'];
        $update->save();
        $getID  = $update->id;
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
            'id' => $getID,
            'version' => $this->input_array['version'],
            'subject' => $this->input_array['subject'],
            'book' => $this->input_array['book'],
            'unit' => $this->input_array['unit'],
            'reel_title' => $this->input_array['reel_title'],
        );

        return $this->msg;
    }


    /**
     * 更新 試卷資料
     *
     */
    public function updateRreel()
    {
        if (isset($this->input_array['id']) && isset($this->input_array['reel_title'])) {
            $update = Reel::find($this->input_array['id']);
            $update->reel_title = $this->input_array['reel_title'];
            $update->save();
            $this->msg = array(
                'status' => true,
                'msg' => '更新成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 移除 試卷資料
     *
     */
    public function deleteReel()
    {
        if (isset($this->input_array['id'])) {
            Reel::destroy($this->input_array['id']);
            $this->msg = array(
                'status' => true,
                'msg' => '刪除成功!',
            );
        }

        return $this->msg;
    }
}
