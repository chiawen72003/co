<?php

namespace App\Http\Models;

class SchoolClasses extends BaseModel
{
    //班級資料
    protected $table = 'school_classes';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
