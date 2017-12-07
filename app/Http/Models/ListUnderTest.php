<?php

namespace App\Http\Models;

class ListUnderTest extends BaseModel
{
    //受測名單資料
    protected $table = 'list_under_test';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
