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
                        <li id="school_title"></li>
                        <li>身份：學生</li>
                        <li id="school_id"></li>
                        <li id="name"></li>
                    </ul>
                    <hr>
                    <div class="title">
                        <i class="ion-information-circled"></i>
                        功能列表
                    </div>
                    <ul class="bigLink-list mt1 clearfix">
                        <li><a href="[! route('ur.reel') !]">參加測驗</a></li>
                        <li><a href="[! route('ur.score') !]">成果查詢</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    [! Html::script('js/jquery-1.11.3.js') !]
    <script>
        var li_item = $('#li_index');
        var current = 'current';
        var school_title = $('#school_title');
        var school_id = $('#school_id');
        var name_obj = $('#name');

        $( document ).ready(function() {
            li_item.addClass( current);
            getData();
        });

        function getData(){
            $.ajax({
                url: "[! route('ur.user.data') !]",
                type:'GET',
                dataType: "json",
                data: {
                    id:'1'
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    console.log(response);
                    if(response['status'] == true){
                        school_title.html('學校：' + response['data']['school_title']);
                        school_id.html('學號：' + response['data']['student_id']);
                        name_obj.html('姓名：' + response['data']['name']);
                    }
                }
            });
        }
    </script>
@stop