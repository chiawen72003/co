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
        $this->spreadsheet_obj = new Spreadsheet();
        $this->file_name = date("Y-m-d") . ".xls";
    }

    public function init($data = array())
    {
        foreach ($data as $k => $v) {
            $this->input_data[$k] = $v;
        }
    }

    /**
     * 設定輸出資料
     *
     * @param $get_data 輸出的資料
     */
    public function set_excel_data($get_data)
    {
        $this->excel_data = $get_data;
    }

    /**
     * 設定存檔名稱
     *
     * @param $get_data 輸出的資料
     */
    public function set_file_name($get_data)
    {
        $this->file_name = $get_data;
    }

    /**
     * 匯入 班級內學生的資料
     */
    public function import_student_data()
    {
        $return_data = array();

        if ($this->input_data['import_file_name']) {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->input_data['import_file_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow(); // e.g. 10
            //如果對應欄位沒有值，會用null代替
            $dataArray = $worksheet->rangeToArray(
                'B2:k' . $highestRow,
                NULL,        // Value that should be returned for empty cells
                TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                TRUE         // Should the array be indexed by cell row and cell column
            );

            return $dataArray;
        }
    }

    /**
     * 輸出 指定試題統計資料的excel檔
     */
    public function get_reel_analysis_data()
    {
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $this->file_name . '"');
        //外部讀取檔案
        $spreadsheet = IOFactory::load(public_path().'\demo_file\reel_analysis_demo.xls');
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($this->excel_data as $k => $v) {
            $sheet->setCellValue($k, $v);
        }
        $writer = new Excel5($spreadsheet);
        $writer->save('php://output');
    }
}
