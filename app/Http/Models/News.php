<?php

namespace App\Http\Models;

class News extends BaseModel
{
    //最新消息資料
    protected $table = 'news';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
