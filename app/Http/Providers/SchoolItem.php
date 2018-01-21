<?php

namespace App\Http\Providers;

use App\Http\Models\School;
use App\Http\Models\SchoolClasses;
use App\Http\Models\SchoolSubject;
use App\Http\Models\Student;
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

    private $init = array();

    private $msg = array(
        'status' => false,
        'msg' => '',
    );

    public function __construct($init = array())
    {
        foreach ($init as $k => $v) {
            $this->init[$k] = $v;
        }
    }

    public function init($init = array())
    {
        foreach ($init as $k => $v) {
            $this->init[$k] = $v;
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
        $update->school_id = $this->init['school_id'];
        $update->subject_title = $this->init['subject_title'];
        $update->save();
        $getID  = $update->id;
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
            'id' => $getID,
            'school_id' => $this->init['school_id'],
            'subject_title' => $this->init['subject_title'],
        );

        return $this->msg;
    }


    /**
     * 更新 科系資料
     *
     */
    public function updateSubject()
    {
        if (isset($this->init['id']) && isset($this->init['subject_title'])) {
            $update = SchoolSubject::find($this->init['id']);
            $update->subject_title = $this->init['subject_title'];
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
        if (isset($this->init['id'])) {
            SchoolSubject::destroy($this->init['id']);
            $this->msg = array(
                'status' => true,
                'msg' => '刪除成功!',
            );
        }

        return $this->msg;
    }

    /**
     *  取得所有學校資料
     *
     */
    public function getSchool()
    {
        $return_data = array();
        $temp_obj = School::select('id','city', 'code', 'area', 'school_title')
            ->orderby('city', 'DESC')
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
     *  取得單一學校資料
     *
     */
    public function getOneSchool()
    {
        $return_data = array();
        $temp_obj = School::select('id','city', 'code', 'area', 'school_title')
            ->where('id',  $this->init['id'])
            ->get();
        foreach($temp_obj as $v ){
            $return_data = $v->toArray();
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
        $update->city = $this->init['city'];
        $update->code = $this->init['code'];
        $update->area = $this->init['area'];
        $update->school_title = $this->init['school_title'];
        $update->save();
        $getID  = $update->id;
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
            'id' => $getID,
            'code' => $this->init['code'],
            'school_title' => $this->init['school_title'],
            'area' => $this->init['area'],
        );

        return $this->msg;
    }


    /**
     * 更新 學校資料
     *
     */
    public function updateSchool()
    {
        if (isset($this->init['id']) && isset($this->init['school_title'])) {
            $update = School::find($this->init['id']);
            $update->school_title = $this->init['school_title'];
            $update->area = $this->init['area'];
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
        if (isset($this->init['id'])) {
            School::destroy($this->init['id']);
            $this->msg = array(
                'status' => true,
                'msg' => '刪除成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 取得 所有班級資料
     *
     */
    public function getAllClasses()
    {
        $return_data = array();
        $temp_obj = SchoolClasses::select('id','school_id', 'school_year', 'title')
            ->orderby('school_year', 'ASC')
            ->orderby('title', 'ASC')
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
     * 取得 班級資料
     *
     */
    public function getClasses()
    {
        $return_data = array();
        $temp_obj = SchoolClasses::select('id','school_id', 'school_year', 'title')
            ->where('school_id', $this->init['id'])
            ->orderby('school_year', 'ASC')
            ->orderby('title', 'ASC')
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
    public function addClasses()
    {
        $update = new SchoolClasses();
        $update->school_id = $this->init['school_id'];
        $update->school_year = $this->init['school_year'];
        $update->title = $this->init['title'];
        $update->save();
        $this->msg = array(
            'status' => true,
            'msg' => '新增成功!',
        );

        return $this->msg;
    }

    /**
     * 從excel匯入學生的檔案
     */
    function get_import_student()
    {
        if(
            $this -> init['classes_id']
            AND $this -> init['school_id']
            AND $this -> init['import_user_file']
        )
        {
            if ( $this -> init['import_user_file'] ->isValid() )
            {
                $extension = $this -> init['import_user_file'] -> getClientOriginalExtension(); // getting image extension
                $fileName = time().'.'.$extension; // renameing image
                $this -> init['import_user_file'] -> move('files/tmp/', $fileName); // uploading file to given path
                $this -> init['import_file_name'] = 'files/tmp/'.$fileName;

                $excel_obj = new PhpExcel();
                $excel_obj -> init($this -> init);
                $cell_data = $excel_obj -> import_student_data();
                $user_info = null;
                $user_status = null;
                //系統產生登入帳號
                $t_id = time();
                $data_total = count($cell_data);
                if($data_total > 0)
                {
                    $user_info = array();
                    foreach($cell_data as $v)
                    {
                        if(
                            $v['D']
                            AND $v['E']
                        )
                        {
                            $user_info[] = array(
                                'login_name' => $t_id,
                                'login_pw' => '123456',
                                'school_id' => $this -> init['school_id'],
                                'classes_id' => $this -> init['classes_id'],
                                'student_id' => !is_null($v['D'])?$v['D']:'',
                                'name' => !is_null($v['E'])?$v['E']:'',
                            );
                            $t_id++;
                        }
                    }
                    //以批次新增的方式處理
                    Student::insert($user_info);
                }
            }
        }
        $this->msg = array(
            'status' => true,
            'msg' => '匯入成功!',
        );

        return $this->msg;
    }

}
