<?php

namespace App\Http\Providers;

use App\Http\Models\Revised;
use App\Http\Models\Student;
use App\Http\Models\ReelModify;
use Illuminate\Support\Str;
use \Input;
use Prophecy\Prophecy\Revealer;

/**
 * Class UserItem
 * 結構物件：管理員、評閱者、受測者資料
 *
 * @package App\Http\Providers處理
 */
class UserItem
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
     * 取得 評閱者資料
     *
     */
    public function getReviewer()
    {
        $return_data = array();
        $temp_obj = Revised::select('login_name','login_pw','name')
            ->where('id',1)
            ->get();
        foreach($temp_obj as $v ){
            $return_data = array(
                'login_name' => $v['login_name'],
                'login_pw' => $v['login_pw'],
                'name' => $v['name'],
            );
        }

        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $return_data,
        );

        return $this->msg;
    }

    /**
     * 更新 評閱者密碼資料
     *
     */
    public function setReviewerPw()
    {
        if (isset($this->input_array['new_pw'])) {
            $update = Revised::find($this->input_array['id']);
            $update->login_pw = $this->input_array['new_pw'];
            $update->save();
            $this->msg = array(
                'status' => true,
                'msg' => '更新成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 取得 受測試者資料
     *
     */
    public function getStudent()
    {
        $return_data = array();
        $temp_obj = Student::where('student.id',1)
            ->leftJoin('school', 'school.id', '=', 'student.school_id')
            ->select(
                'student.login_name',
                'student.login_pw','name',
                'student.student_id',
                'school.school_title'
            )
            ->get();
        foreach($temp_obj as $v ){
            $return_data = array(
                'login_name' => $v['login_name'],
                'login_pw' => $v['login_pw'],
                'name' => $v['name'],
                'student_id' => $v['student_id'],
                'school_title' => $v['school_title'],
            );
        }

        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $return_data,
        );

        return $this->msg;
    }

    /**
     * 更新 受測試者密碼資料
     *
     */
    public function setStudentPw()
    {
        if (isset($this->input_array['new_pw'])) {
            $update = Student::find($this->input_array['id']);
            $update->login_pw = $this->input_array['new_pw'];
            $update->save();
            $this->msg = array(
                'status' => true,
                'msg' => '更新成功!',
            );
        }

        return $this->msg;
    }
}
