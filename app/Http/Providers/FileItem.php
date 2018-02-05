<?php

namespace App\Http\Providers;

use App\Http\Models\Files;
use \Input;

/**
 * 下載檔案
 */
class FileItem
{
    private $init = array();
    private $page_num = 5;
    private $msg = array(
        'status' => false,
        'msg' => '',
    );

    public function init($input_data = array())
    {
        foreach ($input_data as $k => $v) {
            $this->init[$k] = $v;
        }
    }

    /**
     * 取出檔案list資料
     *
     * @return null
     */
    public function getFilesData()
    {
        $return_data = array(
            'files' =>array(),
            'page_data' =>'',
        );
        $temp_obj = Files::orderby('id', 'DESC')
            ->paginate($this->page_num);

        return $temp_obj;
    }


    /**
     * 取出單一檔案資料
     *
     * @return null
     */
    public function getOneFilesData()
    {
        $news_data = null;
        $temp_obj = Files::where('id',$this->init['id'])
            ->get();
        foreach ($temp_obj as $value) {
            $news_data = $value;
        }

        return $news_data;
    }

    /**
     * 移除一筆系統資料
     *
     */
    public function deleteFile()
    {
        if(isset($this->init['id']))
        {
            $temp_data = Files::where('id',$this->init['id'])->get();
            foreach ($temp_data as $v){
                if($v['file_path'] > '' AND file_exists($v['file_path']))
                {
                    unlink($v['file_path']);
                }
            }
            Files::destroy($this->init['id']);
        }
        $this->msg = array(
            'status' => true,
            'msg' => '檔案刪除成功!!',
        );

        return $this->msg;
    }
}
