@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        課程-試卷設定
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">學年度</label>
                <select id="year">
                </select>
                <label class="i-label">學期</label>
                <select id="semester">
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
                    <tr>
                        <th width="120">
                            <div class="cell center">課程名稱</div>
                        </th>
                        <th >
                            <div class="cell center">試卷名稱</div>
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
        <td><div class="cell center" id="course_area"></div></td>
        <td><div class="cell  center"  id="reel_area"></div></td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_course_reel');
    var list_item = $('#course_list');
    var tr_item = $('#copy_tr');
    var semester_item = $('#semester');
    var year_item = $('#year');
    var courseName = $('#courseName');
    var reelName = $('#reelName');
    var current = 'current';
    var course_obj = [];
    var reel_obj = [];
    var list_obj = [];
    $( document ).ready(function() {
        li_item.addClass( current);
        getCourseData();
    });

    function getCourseData() {
        $.ajax({
            url: "[! route('ma.course.list') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data'].length;x++){
                        course_obj.push(
                            {
                                'id':response['data'][x]['id'],
                                'school_year':response['data'][x]['school_year'],
                                'semester':response['data'][x]['semester'],
                                'course_title':response['data'][x]['course_title']
                            }
                        );
                    }
                }
                getReelData();
            }
        });
    }
    function getReelData() {
        $.ajax({
            url: "[! route('ma.reel.list') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data'].length;x++){
                        reel_obj.push(
                            {
                                'id':response['data'][x]['id'],
                                'reel_title':response['data'][x]['reel_title']
                            }
                        );
                    }
                }
                getListData();
            }
        });
    }

    function getListData() {
        $.ajax({
            url: "[! route('ma.course.reel.list') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data'].length;x++){
                        list_obj.push(
                            {
                                'id':response['data'][x]['id'],
                                'course_id':response['data'][x]['course_id'],
                                'reel_id':response['data'][x]['reel_id'],
                            }
                        );
                    }
                }
                setYear();
                setCourse();
                setReel();
                setList();
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
        for(var x=0;x<list_obj.length;x++){
            var t = tr_item.clone();
            var c = '';
            var r = '';

            for(var y=0;y<reel_obj.length;y++){
                if(reel_obj[y]['id'] == list_obj[x]['reel_id']){
                    r = reel_obj[y]['reel_title'];
                }
            }

            for(var y=0;y<course_obj.length;y++){
                if(course_obj[y]['id'] == list_obj[x]['course_id']){
                    c = course_obj[y]['course_title'];
                }
            }
            t.find('#course_area').html(c).removeAttr('id');
            t.find('#reel_area').html(r).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }



    var isSend = false;
    function add(){
        if(!isSend && courseName.val() != '' && reelName.val() != ''){
            $.ajax({
                url: "[! route('ma.course.reel.add') !]",
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
                        location.reload();
                    }
                    isSend = false;
                }
            });
            isSend = true;
        }
    }
</script>
@stop