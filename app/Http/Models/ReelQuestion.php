<?php

namespace App\Http\Models;

class ReelQuestion extends BaseModel
{
    //試卷-試題關聯資料
    protected $table = 'reel_question';
    protected $primaryKey = 'id';
    public $timestamps = true;
}
