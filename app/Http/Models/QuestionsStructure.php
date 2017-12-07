<?php

namespace App\Http\Models;

class QuestionsStructure extends BaseModel
{
    //試題結構資料
    protected $table = 'questions_structure';
    protected $primaryKey = 'id';
    public $timestamps = true;
}