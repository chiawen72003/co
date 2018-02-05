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
}
