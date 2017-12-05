<?php

namespace App\Http\Models;

class TestData extends BaseModel
{
    //受測者填寫的作文資料
    protected $table = 'test_data';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
