<?php

namespace App\Http\Providers;

use App\Http\Models\NewsList;
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
     * 取得 所有的系統公告列表
     *
     * @return Array $list_data 系統公告資料
     */
    public function get_all_news()
    {
        $list_data = array();
        $temp_obj = NewsList::orderBy('id', 'DESC')
            ->get();
        foreach ($temp_obj as $value) {
            $list_data[] = $value;
        }

        return $list_data;
    }

    /**
     * 取得 系統公告列表
     *
     * @return Array $list_data 系統公告資料
     */
    public function get_news_list()
    {
        $list_data = array();
        $temp_obj = NewsList::orderBy('id', 'DESC')
            ->paginate(20);

        return $temp_obj;
    }

    /**
     * 取得 一筆系統公告資料
     *
     * @return Array $news_data 系統公告資料
     */
    public function get_old_data()
    {
        $news_data = null;
        $temp_obj = NewsList::where('id', $this->input_array['id'])
            ->get();
        foreach ($temp_obj as $value) {
            $news_data = $value;
        }

        return $news_data;
    }

    /**
     * 新增 系統資料
     *
     */
    public function add_data()
    {
        if ($this->input_array['title']) {
            $update = new NewsList();
            $update->title = $this->input_array['title'];
            $update->dsc = $this->input_array['dsc'];
            $update->save();
            $getID = $update->id;

            //處理上傳圖片檔案
            $files = Input::file('updateFile');
            if (count($files) > 0 and $files != null) {
                $lists = $this->uploadFile($files, $getID);
            }
        }

        return;
    }


    /**
     * 更新 系統資料
     *
     */
    public function update_data()
    {
        if ($this->input_array['id'] AND $this->input_array['title']) {
            $update = NewsList::find($this->input_array['id']);
            $update->title = $this->input_array['title'];
            $update->dsc = $this->input_array['dsc'];
            $update->save();
            $getID = $this->input_array['id'];

            //處理上傳圖片檔案
            $files = Input::file('updateFile');
            if (count($files) > 0 and $files != null) {
                if ($update->file_path > '' AND file_exists($update->file_path)) {
                    unlink('./' . $update->file_path);
                }
                $lists = $this->uploadFile($files, $getID);
            }
        }

        return;
    }

    /**
     * 移除一筆系統資料
     *
     */
    public function delete_data()
    {
        if ($this->input_array['id']) {
            $temp_data = NewsList::where('id', $this->input_array['id'])->get();
            foreach ($temp_data as $v) {
                if ($v['file_path'] > '' AND file_exists('upfire/file' . $v['file_path'])) {
                    unlink('upfire/file' . $v['file_path']);
                }
            }
            NewsList::destroy($this->input_array['id']);
        }

        return;
    }


    //上傳圖片檔
    protected static function uploadFile($file, $id)
    {
        $upload_path = env('NEWS_FILE_BATH');
        $file_name = Str::random(32);
        $org_name = $file->getClientOriginalName();

        $mime = $file->getMimeType();
        $ext = '';
        switch ($mime) {
            case 'image/png':
                $ext = 'png';
                break;
            case 'image/pjpeg':
            case 'image/jpg':
            case 'image/jpeg':
                $ext = 'jpg';
                break;
            case 'image/gif':
                $ext = 'gif';
                break;
            case 'image/x-ms-bmp':
                $ext = 'bmp';
                break;
            default:
                $_t = explode('.', $org_name);
                if (count($_t) > 0) {
                    $ext = $_t[count($_t) - 1];
                }
                break;
        }
        if (!empty($ext)) {
            $file_name = "{$file_name}.{$ext}";
        }


        $real_path = public_path() . DIRECTORY_SEPARATOR . $upload_path;

        $year = date('Y');
        $month = date('m');
        $day = date('d');
        if (!file_exists($real_path)) {
            mkdir($real_path);
        }
        $real_path = $real_path . DIRECTORY_SEPARATOR . $year;
        if (!file_exists($real_path)) {
            mkdir($real_path);
        }
        $real_path = $real_path . DIRECTORY_SEPARATOR . $month;
        if (!file_exists($real_path)) {
            mkdir($real_path);
        }
        $real_path = $real_path . DIRECTORY_SEPARATOR . $day;
        if (!file_exists($real_path)) {
            mkdir($real_path);
        }

        $destinationPath = $real_path;
        $file->move($destinationPath, $file_name);

        $file_path = $upload_path . '/' . $year . '/' . $month . '/' . $day . '/' . $file_name;

        $update = NewsList::find($id);
        $update->file_path = $file_path;
        $update->file_name = $org_name;
        $update->save();

        return $update;
    }
}
