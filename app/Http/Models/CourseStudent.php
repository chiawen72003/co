<?php

namespace App\Http\Models;

class CourseStudent extends BaseModel
{
    //課程-試卷資料
    protected $table = 'course_student';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
