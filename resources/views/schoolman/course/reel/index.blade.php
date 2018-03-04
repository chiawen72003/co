@extends('schoolman.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        課程-試卷設定
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">學年度</label>
                <select id="year" onchange="setCourse()">
                </select>
                <label class="i-label">學期</label>
                <select id="semester" onchange="setCourse()">
                    <option value="1">第一學期</option>
                    <option value="2">第二學期</option>
                </select>
                <label class="i-label">課程名稱</label>
                <select id="courseName">
                </select>
                <label class="i-label">試卷</label>
                <select id="reelName">
                </select>
                <button type="button" class="i-btn i-btn-primary i-btn-circle" onclick="add()">
                    <i class="ion-android-add"></i>
                    新增
                </button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增課程-試卷資料
            </div>
            <div class="table-wrapper">
                <table class="table" id="course_list">
                    <tr id="tr_default">
                        <th width="100">
                            <div class="cell center">學年度</div>
                        </th>
                        <th width="100">
                            <div class="cell center">學期</div>
                        </th>
                        <th width="200">
                            <div class="cell center">課程名稱</div>
                        </th>
                        <th width="200">
                            <div class="cell center">試卷名稱</div>
                        </th>
                        <th >
                            <div class="cell">功能</div>
                        </th>
                    </tr>
                    <!--  -->
                </table>
            </div>
        </div>
    </div>
</div>
<table style="display: none">
    <tr id="copy_tr" >
        <td><div class="cell center" id="year"></div></td>
        <td><div class="cell center" id="semester"></div></td>
        <td><div class="cell center" id="course_title"></div></td>
        <td><div class="cell center" id="reel_title"></div></td>
        <td><div class="cell center" >
                <a class="i-link" id="a_del"><i class="ion-trash-a"></i>移除</a>
            </div></td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#course_list');
    var tr_item = $('#copy_tr');
    var semester_item = $('#semester');
    var year_item = $('#year');
    var courseName = $('#courseName');
    var reelName = $('#reelName');
    var course_obj = [];
    var reel_obj = [];
    var list_obj = [];
    $( document ).ready(function() {
        setMenu('li_course_reel', 'main_li_2');
        getInitData();
    });

    //資料初始
    function getInitData() {
        $.ajax({
            url: "[! route('sm.course.reel.init') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data']['course'].length;x++){
                        var course = response['data']['course'][x];
                        course_obj.push(
                            {
                                'id':course['id'],
                                'school_year':course['school_year'],
                                'semester':course['semester'],
                                'course_title':course['course_title']
                            }
                        );
                        for(var u=0;u<course['reel_id'].length;u++){
                            var reel_id = course['reel_id'][u];
                            list_obj.push(
                                {
                                    'id':reel_id,
                                    'course_id':course['id'],
                                    'reel_id':reel_id,
                                }
                            );
                        }

                    }
                    for(var x=0;x<response['data']['reel'].length;x++){
                        var reel = response['data']['reel'][x];
                        reel_obj.push(
                            {
                                'id':reel['id'],
                                'reel_title':reel['reel_title']
                            }
                        );
                    }
                    setYear();
                    setCourse();
                    setReel();
                    setList();
                }
            }
        });
    }

    //設定學年度下拉選單
    function setYear() {
        var t = new Array();
        for(var x=0;x<course_obj.length;x++){
            if(t.indexOf(course_obj[x]['school_year']) == -1){
                t.push(course_obj[x]['school_year']);
            }
        }
        for(var x=0;x<t.length;x++){
            year_item.append($("<option></option>").attr("value", t[x]).text(t[x]));
        }
    }

    //設定課程下拉選單
    function setCourse() {
        $("#courseName option").remove();
        for(var x=0;x<course_obj.length;x++){
            if(course_obj[x]['school_year'] == year_item.val() && course_obj[x]['semester'] == semester_item.val() ){
                courseName.append($("<option></option>").attr("value", course_obj[x]['id']).text(course_obj[x]['course_title']));
            }
        }

    }

    //設定試卷下拉選單
    function setReel() {
        $("#reelName option").remove();
        for(var x=0;x<reel_obj.length;x++){
            reelName.append($("<option></option>").attr("value", reel_obj[x]['id']).text(reel_obj[x]['reel_title']));
        }
    }

    function setList() {
        //先清除學校資料
        list_item.find('tr').each(function(){
            if($(this).attr('id') != 'tr_default'){
                $(this).remove();
            }
        });

        for(var x=0;x<list_obj.length;x++){
            var t = tr_item.clone();
            var year = '';
            var semester = '';
            var course_title = '';
            var reel_title = '';
            for(var y=0;y<reel_obj.length;y++){
                if(reel_obj[y]['id'] == list_obj[x]['reel_id']){
                    reel_title = reel_obj[y]['reel_title'];
                }
            }

            for(var y=0;y<course_obj.length;y++){
                if(course_obj[y]['id'] == list_obj[x]['course_id']){
                    year = course_obj[y]['school_year'];
                    semester = course_obj[y]['semester'];
                    course_title = course_obj[y]['course_title'];
                }
            }
            t.find('#year').html(year).removeAttr('id');
            t.find('#semester').html(semester).removeAttr('id');
            t.find('#course_title').html(course_title).removeAttr('id');
            t.find('#reel_title').html(reel_title).removeAttr('id');
            t.find('#a_del').attr('onclick','unset("'+list_obj[x]['id']+'","'+list_obj[x]['course_id']+'")').removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }

    var isSend = false;
    function add(){
        if(!isSend && courseName.val() != '' && reelName.val() != ''){
            $.ajax({
                url: "[! route('sm.course.reel.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    course_id:courseName.val(),
                    reel_id:reelName.val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
                        alert(response['msg']);
                        getListData();
                    }
                    isSend = false;
                }
            });
            isSend = true;
        }
    }

    //取得所有設定的資料
    function getListData()
    {
        list_obj = [];
        $.ajax({
            url: "[! route('sm.course.reel.list') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response)
            {
                if(response['status'] == true)
                {
                    for(var x=0;x<response['data'].length;x++){
                        var list = response['data'][x];
                        list_obj.push(
                            {
                                'id':list['id'],
                                'course_id':list['course_id'],
                                'reel_id':list['reel_id'],
                            }
                        );
                    }
                }
                setList();
            }
        });
    }

    //移除資料
    function unset(reelid,courseid) {
        $.ajax({
            url: "[! route('sm.course.reel.del') !]",
            type: 'POST',
            dataType: "json",
            data: {
                _token: '[! csrf_token() !]',
                reel_id: reelid,
                course_id: courseid,
            },
            error: function (xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function (response) {
                if(response['status'] == true){
                    alert(response['msg']);
                }
                getListData();
            }
        });
    }
</script>
@stop