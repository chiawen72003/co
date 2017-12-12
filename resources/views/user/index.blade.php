@extends('user.layout.layout')
@section('content')
    <div class="article">
        <div class="article">
            <div class="article-header">
                歡迎使用 語文素養寫作系統
            </div>
            <div class="article-content">
                <div class="article-content-body">
                    <div class="title">
                        <i class="ion-information-circled"></i>
                        使用者資訊
                    </div>
                    <ul>
                        <li>學校：國立臺中教育大學</li>
                        <li>身份：學生</li>
                        <li>學號：ASC106102</li>
                        <li>姓名：王曉明</li>
                    </ul>
                    <hr>
                    <div class="title">
                        <i class="ion-information-circled"></i>
                        功能列表
                    </div>
                    <ul class="bigLink-list mt1 clearfix">
                        <li><a href="note.html">參加測驗</a></li>
                        <li><a href="results.html">成果查詢</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    [! Html::script('js/jquery-1.11.3.js') !]
@stop