<?php

namespace App\Http\Models;

class Questions extends BaseModel
{
    //試題資料
    protected $table = 'questions';
    protected $primaryKey = 'id';
    public $timestamps = true;
}