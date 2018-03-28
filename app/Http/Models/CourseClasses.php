<?php

namespace App\Http\Models;

class CourseClasses extends BaseModel
{
    //課程-試卷資料
    protected $table = 'course_classes';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
