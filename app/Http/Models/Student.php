<?php

namespace App\Http\Models;

class Student extends BaseModel
{
    //學生資料
    protected $table = 'student';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
