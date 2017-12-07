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
     * 取得 科系資料
     *
     */
    public function getSubject()
    {
        $return_data = array();
        $temp_obj = SchoolSubject::select('id','school_id', 'subject_title')
            ->orderby('school_id', 'ASC')
            ->orderby('subject_title', 'ASC')
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
     * 新增 科系資料
     *
     */
    public function addSubject()
    {
        $update = new SchoolSubject();
        $update->school_id = $this->input_array['school_id'];
        $update->subject_title = $this->input_array['subject_title'];
        $update->save();
        $getID  = $update->id;
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
            'id' => $getID,
            'school_id' => $this->input_array['school_id'],
            'subject_title' => $this->input_array['subject_title'],
        );

        return $this->msg;
    }


    /**
     * 更新 科系資料
     *
     */
    public function updateSubject()
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
    public function deleteSubject()
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
     *  取得學校資料
     *
     */
    public function getSchool()
    {
        $return_data = array();
        $temp_obj = School::select('id','city', 'code', 'area', 'school_title')
            ->orderby('city', 'ASC')
            ->orderby('area', 'ASC')
            ->orderby('code', 'ASC')
            ->orderby('school_title', 'ASC')
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
     * 新增 學校資料
     *
     */
    public function addSchool()
    {
        $update = new School();
        $update->city = $this->input_array['city'];
        $update->code = $this->input_array['code'];
        $update->area = $this->input_array['area'];
        $update->school_title = $this->input_array['school_title'];
        $update->save();
        $getID  = $update->id;
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
            'id' => $getID,
            'code' => $this->input_array['code'],
            'school_title' => $this->input_array['school_title'],
            'area' => $this->input_array['area'],
        );

        return $this->msg;
    }


    /**
     * 更新 學校資料
     *
     */
    public function updateSchool()
    {
        if (isset($this->input_array['id']) && isset($this->input_array['school_title'])) {
            $update = School::find($this->input_array['id']);
            $update->school_title = $this->input_array['school_title'];
            $update->area = $this->input_array['area'];
            $update->save();
            $this->msg = array(
                'status' => true,
                'msg' => '更新成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 移除 學校資料
     *
     */
    public function deleteSchool()
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
