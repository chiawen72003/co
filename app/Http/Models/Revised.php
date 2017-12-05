<?php

namespace App\Http\Models;

class Revised extends BaseModel
{
    //批改者資料
    protected $table = 'revised';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
