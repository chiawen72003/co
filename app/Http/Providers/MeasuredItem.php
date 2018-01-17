<?php

namespace App\Http\Providers;

use App\Http\Models\CourseStudent;
use App\Http\Models\ListUnderTest;
use App\Http\Models\Questions;
use App\Http\Models\Reel;
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
        $not_in = array();
        $has_in = array();
        $temp_obj = ListUnderTest::where('user_id', $this->input_array['user_id'])
            ->select(
                'reel_id'
            )
            ->get();
        foreach ($temp_obj as $v) {
            $not_in[] = $v['reel_id'];
        }

        $temp_obj = CourseStudent::where('course_student.student_id', $this->input_array['user_id'])
            ->leftJoin('course', 'course.id', '=', 'course_student.course_id')
            ->select(
                'course.reel_id'
            )
            ->get();
        foreach ($temp_obj as $v) {
            $t = json_decode($v->reel_id, true);
            foreach ($t as $reel_id) {
                if (!in_array($reel_id, $not_in)) {
                    $has_in[] = $reel_id;
                }
            }
        }
        if (count($has_in) > 0) {
            $temp_obj = Reel::whereIn('id', $has_in)
                ->select(
                    'id',
                    'reel_title'
                )
                ->get();
            foreach ($temp_obj as $v) {
                $return_data[] = array(
                    'path' => route('ur.reel.edit', array($v->id)),
                    'reel_title' => $v->reel_title,
                );
            }
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
        $t = Questions::where('reel_id', $this->input_array['id'])
            ->select(
                'type',
                'type_title',
                'question_title',
                'dsc',
                'id',
                'max_score'
            )
            ->get();
        foreach ($t as $v) {
            $data[] = array(
                'type' => json_decode($v['type'], true),
                'type_title' => json_decode($v['type_title'], true),
                'question_title' => json_decode($v['question_title'], true),
                'dsc' => $v['dsc'],
                'id' => $v['id'],
                'max_score' => json_decode($v['max_score'], true),
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

            $temp_obj = new ListUnderTest();
            $temp_obj->user_id = $this->input_array['user_id'];
            $temp_obj->reel_id = $this->input_array['reel_id'];
            $temp_obj->questions_id = json_encode($this->input_array['questions_id']);
            $temp_obj->test_data = json_encode($this->input_array['add_data'], JSON_UNESCAPED_UNICODE);
            $temp_obj->has_test = 1;
            $temp_obj->modify_id = $def_m;
            $temp_obj->save();
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
                    'total_blank' => ($is_blank == true) ? DB::raw('total_blank+1') : DB::raw('total_blank'),
                    'total_abnormal' => ($is_abnormal == true) ? DB::raw('total_abnormal+1') : DB::raw('total_abnormal'),
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
