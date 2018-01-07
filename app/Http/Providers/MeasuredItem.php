<?php

namespace App\Http\Providers;

use App\Http\Models\ListUnderTest;
use App\Http\Models\ReelQuestion;
use App\Http\Models\ReelModify;
use Illuminate\Support\Str;
use \Input;
use Illuminate\Support\Facades\DB;

/**
 * Class StructureItem
 * 結構物件：試卷分派、受測者填寫的資料、評閱者評閱後的資料等
 *
 * @package App\Http\Providers處理
 */
class MeasuredItem
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
     * 取得 受測者需要測試的試卷資料
     *
     */
    public function getMeasured()
    {
        $return_data = array();
        $temp_obj = ListUnderTest::where('list_under_test.user_id', $this->input_array['id'])
            ->where('list_under_test.has_test', 0)
            ->leftJoin('reel', 'list_under_test.reel_id', '=', 'reel.id')
            ->select(
                'list_under_test.reel_id',
                'reel.reel_title'
            )
            ->get();
        foreach ($temp_obj as $v) {
            $return_data[] = array(
                'reel_title' => $v['reel_title'],
                'path' => route('ur.reel.edit', array($v['reel_id'])),
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
     * 回傳指定試卷內所有試題資料
     *
     */
    public function getReelQuation()
    {
        $data = array();
        $t = ReelQuestion::where('reel_question.reel_id', $this->input_array['id'])
            ->leftJoin('questions', 'questions.id', '=', 'reel_question.question_id')
            ->select(
                'questions.type',
                'questions.type_title',
                'questions.question_title',
                'questions.dsc',
                'questions.id',
                'questions.max_score'
            )
            ->get();
        foreach ($t as $v) {
            $data[] = array(
                'type' => $v['type'],
                'type_title' => json_decode($v['type_title'], true),
                'question_title' => $v['question_title'],
                'dsc' => $v['dsc'],
                'id' => $v['id'],
                'max_score' => $v['max_score'],
            );
        }

        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $data,
        );

        return $this->msg;
    }

    /**
     * 新增 受測者填寫的試題資料
     *
     * 備註：新增資料時預設先設定給一個評閱者
     */
    public function setTestData()
    {
        if (isset($this->input_array['reel_id'])) {
            $def_m = 0;
            $t_array = null;
            $t = ReelModify::where('reel_id', $this->input_array['reel_id'])
                ->get();
            foreach ($t as $v) {
                if ($v['view_num'] <= ['need_num']) {
                    $t_array[] = $v['user_id'];
                }
            }
            if (!is_null($t_array)) {
                $t_num = array_rand($t_array, 1);
                $def_m = $t_array[$t_num];
            }

            ListUnderTest::where('user_id', $this->input_array['user_id'])
                ->where('reel_id', $this->input_array['reel_id'])
                ->update([
                    'test_data' => json_encode($this->input_array['add_data'], JSON_UNESCAPED_UNICODE),
                    'has_test' => 1,
                    'modify_id' => $def_m,
                ]);
            $this->msg = array(
                'status' => true,
                'msg' => '新增成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 隨機取得一個指定試卷的受測資料
     */
    public function getReelTestData()
    {
        $return_data = array();
        $temp_obj = ListUnderTest::select('id', 'test_data', 'modify_id', 's_modify_id')
            ->where('reel_id', $this->input_array['reel_id'])
            ->where('has_test', 1)
            ->where('has_review', 0)
            ->where(function ($query) {
                $query->where('modify_id', $this->input_array['user_id'])
                    ->orWhere('s_modify_id', $this->input_array['user_id']);
            })->get();
        foreach ($temp_obj as $v) {
            $order = ($v['modify_id'] == $this->input_array['user_id']) ? 'F' : 'S';
            $return_data = array(
                'id' => $v['id'],
                'order' => $order,
                'test_data' => json_decode($v['test_data'], true),
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
     * 新增一筆評閱資料
     *
     */
    public function setViewData()
    {
        if (isset($this->input_array['id'])) {
            $total_score = 0;
            $is_blank = false;
            $is_abnormal = false;
            foreach ($this->input_array['add_data'] as $v) {
                if (is_numeric($v['score'])) {
                    $total_score += $v['score'];
                }
                if ($v['is_blank'] == true) {
                    $is_blank = true;
                }
                if ($v['is_abnormal'] == true) {
                    $is_abnormal = true;
                }
            }
            $add_data = array(
                'total_score' => $total_score,
                'has_blank' => $is_blank,
                'has_abnormal' => $is_abnormal,
                'view_data' => $this->input_array['add_data'],
            );
            $m_tab = ($this->input_array['order'] == 'F') ? 'modify_id' : 's_modify_id';
            $v_tab = ($this->input_array['order'] == 'F') ? 'review_1' : 'review_2';
            ListUnderTest::where($m_tab, $this->input_array['user_id'])
                ->where('id', $this->input_array['id'])
                ->where('reel_id', $this->input_array['reel_id'])
                ->update([
                    $v_tab => json_encode($add_data, JSON_UNESCAPED_UNICODE),
                    'has_review' => 1,
                ]);
            ReelModify::where('reel_id', $this->input_array['reel_id'])
                ->where('user_id', $this->input_array['user_id'])
                ->update([
                    'view_num' => DB::raw('view_num+1'),
                    'total_blank' => ($is_blank == true)?DB::raw('total_blank+1'):DB::raw('total_blank'),
                    'total_abnormal' => ($is_abnormal == true)?DB::raw('total_abnormal+1'):DB::raw('total_abnormal'),
                ]);
            $this->msg = array(
                'status' => true,
                'msg' => '新增成功!',
            );
        }

        return $this->msg;
    }

    /**
     * 取得評閱者的評改統計資料
     */
    public function getRvStatisticsData()
    {
        $return_data = array();
        $temp_obj = ReelModify::select(
            'reel_modify.view_num',
            'reel_modify.need_num',
            'reel_modify.total_blank',
            'reel_modify.total_abnormal',
            'reel.reel_title'
            )
            ->leftJoin('reel', 'reel.id', '=', 'reel_modify.reel_id')
            ->where('reel_modify.user_id', $this->input_array['user_id'])
            ->get();
        foreach ($temp_obj as $v) {
            $return_data[] = array(
                'title' => $v['reel_title'],
                'total' => $v['need_num'],
                'has' => $v['view_num'],
                'white' => $v['total_blank'],
            );
        }
        $return_data = array_values($return_data);
        $this->msg = array(
            'status' => true,
            'msg' => '',
            'data' => $return_data,
        );

        return $this->msg;
    }
}
