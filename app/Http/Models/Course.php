<?php

namespace App\Http\Models;

class Course extends BaseModel
{
    //課程資料
    protected $table = 'course';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
