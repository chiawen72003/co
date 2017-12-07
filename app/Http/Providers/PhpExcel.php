<?php

namespace App\Http\Providers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Excel5;

class PhpExcel
{
    private $excel_data = array();
    private $spreadsheet_obj = null;
    private $writer_obj = null;
    private $file_name = null;
    private $input_data = array(
        'import_file_name' => null,
    );

    public function __construct()
    {
        $this -> spreadsheet_obj = new Spreadsheet();
        $this -> file_name = date("Y-m-d") . ".xls";
    }

    public function init($data = array())
    {
        foreach($data as $k => $v)
        {
            $this -> input_data[$k] = $v;
        }
    }

    /**
     * 設定輸出資料
     *
     * @param $get_data 輸出的資料
     */
    public function set_excel_data($get_data)
    {
        $this -> excel_data = $get_data;
    }

    /**
     * 設定存檔名稱
     *
     * @param $get_data 輸出的資料
     */
    public function set_file_name($get_data)
    {
        $this -> file_name = $get_data;
    }

    /**
     * 輸出 操作紀錄
     */
    public function get_exam_record_file()
    {
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' .  $this -> file_name . '"');
        $sheet = $this -> spreadsheet_obj->getActiveSheet();
        $sheet->setCellValue('A1', '對話順序');
        $sheet->setCellValue('B1', '作答題號');
        $sheet->setCellValue('C1', '學生回答內容');
        $sheet->setCellValue('D1', '電腦回應內容');
        $sheet->setCellValue('E1', '答對/答錯');
        $sheet->setCellValue('F1', '回饋類型');
        if(is_array($this -> excel_data)  AND count($this -> excel_data) > 0)
        {
            $y_index = 2;
            foreach($this -> excel_data as $k => $v)
            {
                $sheet->setCellValue('A'.$y_index, ($k+1) );
                $sheet->setCellValue('B'.$y_index, $v['item_id']);
                $sheet->setCellValue('C'.$y_index, $v['student_ans']);
                $sheet->setCellValue('D'.$y_index, '');
                $sheet->setCellValue('E'.$y_index, '');
                $sheet->setCellValue('F'.$y_index, $v['feedback_dsc']);
                $y_index++;
            }
        }
        $writer = new Excel5($this -> spreadsheet_obj);
        $writer->save('php://output');
    }


    /**
     * 輸出 班級所有學生帳密
     */
    public function get_class_data()
    {
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' .  $this -> file_name . '"');
        $sheet = $this -> spreadsheet_obj->getActiveSheet();
        $sheet->setCellValue('A1', '帳號');
        $sheet->setCellValue('B1', '姓名');
        $sheet->setCellValue('C1', '密碼');
        if(is_array($this -> excel_data)  AND count($this -> excel_data) > 0)
        {
            $y_index = 2;
            foreach($this -> excel_data as $k => $v)
            {
                $sheet->setCellValue('A'.$y_index, $v['user_id']);
                $sheet->setCellValue('B'.$y_index, $v['uname']);
                $sheet->setCellValue('C'.$y_index, $v['viewpass']);
                $y_index++;
            }
        }
        $writer = new Excel5($this -> spreadsheet_obj);
        $writer->save('php://output');
    }

    /**
     * 匯入 班級內學生的資料
     */
    public function import_student_data()
    {
        $return_data = array(
        );

        if($this -> input_data['import_file_name'])
        {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this -> input_data['import_file_name']);
            $worksheet = $spreadsheet-> getActiveSheet();
            $highestRow = $worksheet -> getHighestRow(); // e.g. 10
            //如果對應欄位沒有值，會用null代替
            $dataArray = $worksheet-> rangeToArray(
                'B2:k'.$highestRow,
                NULL,        // Value that should be returned for empty cells
                TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                TRUE         // Should the array be indexed by cell row and cell column
            );

            return $dataArray;
        }
    }
}
