<?php

namespace App\Http\Models;

class City extends BaseModel
{
    //縣市資料
    protected $table = 'city';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
