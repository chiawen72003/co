<?php

namespace App\Http\Providers;

use App\Http\Models\Admin;
use App\Http\Models\Revised;
use App\Http\Models\Student;
use \Input;
use \Session;

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
     * 登入檢查
     *
     */
    public function loginChk()
    {
        $this->msg['msg'] = '帳號或密碼錯誤!!';
        $has_data = false;
        $temp_obj = Admin::select('id','name')
            ->where('login_name',$this->input_array['login_name'])
            ->where('login_pw',$this->input_array['login_pw'])
            ->get();
        foreach($temp_obj as $v ){
            session([
                'user_type' => 'Admin',
                'user_id' => $v['id'],
                'name' => $v['name'],
                'login_name' => $v['login_name'],
            ]);
            $this->msg = array(
                'status' => true,
                'msg' => '',
                'redir' => route('ma.school'),
            );
            $has_data = true;
        }

        if(!$has_data){
            $temp_obj = Revised::select('id','name')
                ->where('login_name',$this->input_array['login_name'])
                ->where('login_pw',$this->input_array['login_pw'])
                ->where('school_id',$this->input_array['school_id'])
                ->get();
            foreach($temp_obj as $v ){
                session([
                    'user_type' => 'Revised',
                    'user_id' => $v['id'],
                    'name' => $v['name'],
                    'login_name' => $v['login_name'],
                ]);
                $this->msg = array(
                    'status' => true,
                    'msg' => '',
                    'redir' => route('rv.manual'),
                );
                $has_data = true;
            }
        }

        if(!$has_data){
            $temp_obj = Student::select('id','name')
                ->where('login_name',$this->input_array['login_name'])
                ->where('login_pw',$this->input_array['login_pw'])
                ->where('school_id',$this->input_array['school_id'])
                ->get();
            foreach($temp_obj as $v ){
                session([
                    'user_type' => 'Student',
                    'user_id' => $v['id'],
                    'name' => $v['name'],
                    'login_name' => $v['login_name'],
                ]);
                $this->msg = array(
                    'status' => true,
                    'msg' => '',
                    'redir' => route('ur.index'),
                );
            }
        }

        return $this->msg;
    }


    /**
     * 登出
     *
     */
    public function logout()
    {
        app('request')->session()->flush();

        $this->msg = array(
            'status' => true,
            'msg' => '已經登出!!',
            'redir' => route('member.login'),
        );

        return $this->msg;
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
     * 取得 所有評閱者資料
     *
     */
    public function getAllRevised()
    {
        $return_data = array();
        $temp_obj = Revised::select(
                'id',
                'login_name',
                'name',
                'school_id'
            )
            ->get();
        foreach($temp_obj as $v ){
            $return_data[] = array(
                'id' => $v['id'],
                'login_name' => $v['login_name'],
                'name' => $v['name'],
                'school_id' => $v['school_id']
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
     * 取得 單一評閱者資料
     *
     */
    public function getRevised()
    {
        $return_data = array();
        $temp_obj = Revised::select(
            'id',
            'login_name',
            'login_pw',
            'name',
            'school_id'
        )
            ->where('id', $this->input_array['id'])
            ->get();
        foreach($temp_obj as $v ){
            $return_data = array(
                'id' => $v['id'],
                'login_name' => $v['login_name'],
                'login_pw' => $v['login_pw'],
                'name' => $v['name'],
                'school_id' => $v['school_id']
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
     * 新增 所有評閱者資料
     *
     */
    public function addRevised()
    {
        $update = new Revised();
        $update->login_name = $this->input_array['login_name'];
        $update->login_pw = $this->input_array['login_pw'];
        $update->school_id = $this->input_array['school_id'];
        $update->name = $this->input_array['name'];
        $update->save();
        $getID  = $update->id;
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
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
        $temp_obj = Student::where('student.id',$this->input_array['user_id'])
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
     * 取得 受測試者資料
     *
     */
    public function getAllStudent()
    {
        $return_data = array();
        $temp_obj = Student::leftJoin('school', 'school.id', '=', 'student.school_id')
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


    /**
     * 取得 管理員資料
     *
     */
    public function getAdmin()
    {
        $return_data = array();
        $temp_obj = Admin::select('login_name','login_pw','name')
            ->where('id',$this->input_array['user_id'])
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
     * 更新 管理員密碼資料
     *
     */
    public function setAdminPw()
    {
        if (isset($this->input_array['new_pw'])) {
            $update = Admin::find($this->input_array['id']);
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
