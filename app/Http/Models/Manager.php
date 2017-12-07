<?php

namespace App\Http\Models;

class Manager extends BaseModel
{
    //學校端管理者資料
    protected $table = 'manager';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
