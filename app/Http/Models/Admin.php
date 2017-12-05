<?php

namespace App\Http\Models;

class Admin extends BaseModel
{
    //學校端管理者資料
    protected $table = 'admin';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
