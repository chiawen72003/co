<?php

namespace App\Http\Models;

class School extends BaseModel
{
    //學校資料
    protected $table = 'school';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
