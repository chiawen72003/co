@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        課程-班級設定
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <div class="form-group">
                    <label class="i-label">學年度</label>
                    <select id="year" class="i-select" onchange="setCourse()">
                    </select>
                    <label class="i-label">學期</label>
                    <select id="semester" class="i-select" onchange="setCourse()">
                        <option value="1">第一學期</option>
                        <option value="2">第二學期</option>
                    </select>
                    <label class="i-label">課程名稱</label>
                    <select id="courseName" class="i-select">
                    </select>
                </div>
                <div class="form-group">
                    <label class="i-label" class="i-select">學校</label>
                    <select id="school" class="i-select" onchange="setClassesYear()">
                    </select>
                    <label class="i-label" class="i-select">學年度</label>
                    <select id="classes_year" class="i-select" onchange="setClasses()">
                    </select>
                    <label class="i-label" class="i-select">班級</label>
                    <select id="classes" class="i-select">
                    </select>
                    <button type="button" class="i-btn i-btn-primary" onclick="add()">
                        <i class="ion-android-add"></i>
                        新增
                    </button>
                </div>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增課程-學員資料
            </div>
            <div class="table-wrapper">
                <table class="table" id="course_list">
                    <tr>
                        <th width="120">
                            <div class="cell center">課程名稱</div>
                        </th>
                        <th >
                            <div class="cell center">學校名稱</div>
                        </th>
                        <th >
                            <div class="cell center">學年度</div>
                        </th>
                        <th >
                            <div class="cell center">班級</div>
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
        <td><div class="cell  center"  id="school_area"></div></td>
        <td><div class="cell  center"  id="classes_area"></div></td>
        <td><div class="cell  center"  id="classes_name"></div></td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#course_list');
    var tr_item = $('#copy_tr');
    var semester_item = $('#semester');
    var year_item = $('#year');
    var courseName = $('#courseName');
    var school = $('#school');
    var classesYear = $('#classes_year');
    var classes = $('#classes');
    var course_obj = [];
    var list_obj = [];
    var school_item = [];
    var classes_item = [];

    $( document ).ready(function() {
        setMenu('li_course_student', 'main_li_2');
        geInitData();
    });

    //資料初始化 課程、學校、班級(?學生)
    function geInitData() {
        $.ajax({
            url: "[! route('ma.course.student.init') !]",
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
                    }
                    for(var x=0;x<response['data']['school'].length;x++){
                        var school = response['data']['school'][x];
                        school_item.push(
                            {
                                'id':school['id'],
                                'code':school['code'],
                                'area':school['area'],
                                'school_title':school['school_title']
                            }
                        );
                    }
                    for(var x=0;x<response['data']['classes'].length;x++){
                        var classes = response['data']['classes'][x];
                        classes_item.push(
                            {
                                'id':classes['id'],
                                'school_id':classes['school_id'],
                                'school_year':classes['school_year'],
                                'title':classes['title']
                            }
                        );
                    }
                    for(var x=0;x<response['data']['list'].length;x++){
                        var list = response['data']['list'][x];
                        list_obj.push(
                            {
                                'id':list['id'],
                                'course_id':list['course_id'],
                                'school_id':list['school_id'],
                                'classes_id':list['classes_id']
                            }
                        );
                    }
                }
                setYearOption();
                setCourse();
                setSchoolOption();
                setClassesYear();
                setList();
            }
        });
    }
    
    //設定學校的下拉選單
    function setSchoolOption() {
        $("#school option").remove();
        for(var x=0;x<school_item.length;x++){
            school.append($("<option></option>").attr("value", school_item[x]['id']).text(school_item[x]['school_title']));
        }
    }
    //設定學年度下拉選單
    function setYearOption() {
        var tt = [];
        for(var x=0;x<course_obj.length;x++){
            if($.inArray( course_obj[x]['school_year'], tt ) < 0 ){
                tt.push(course_obj[x]['school_year']);
            }
        }
        for(var x=0;x<tt.length;x++){
            year_item.append($("<option></option>").attr("value", tt[x]).text(tt[x]));
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

    //設定班級的學年度下拉選單
    function setClassesYear() {
        $("#classes_year option").remove();
        var tt = [];
        for (var x = 0; x < classes_item.length; x++) {
            if (classes_item[x]['school_id'] == school.val()) {
                if ($.inArray(classes_item[x]['school_year'], tt) < 0) {
                    tt.push(classes_item[x]['school_year']);
                }
            }
        }

        for (var x = 0; x < tt.length; x++) {
            classesYear.append($("<option></option>").attr("value", tt[x]).text(tt[x]));
        }
        setClasses();
    }

    //設定班級的下拉選單
    function setClasses() {
        $("#classes option").remove();
        var tt = [];
        for (var x = 0; x < classes_item.length; x++) {
            var t = classes_item[x];
            if (t['school_id'] == school.val() && t['school_year'] == classesYear.val()) {
                classes.append($("<option></option>").attr("value", t['id']).text(t['title']));
            }
        }

    }

    function setList() {
        for(var x=0;x<list_obj.length;x++){
            var t = tr_item.clone();
            var course = '';
            var school = '';
            var classes_year = '';
            var classes = '';

            for(var y=0;y<school_item.length;y++){
                if(school_item[y]['id'] == list_obj[x]['school_id']){
                    school = school_item[y]['school_title'];
                }
            }

            for(var y=0;y<course_obj.length;y++){
                if(course_obj[y]['id'] == list_obj[x]['course_id']){
                    course = course_obj[y]['course_title'];
                }
            }
            for(var y=0;y<classes_item.length;y++){
                if(classes_item[y]['id'] == list_obj[x]['classes_id']){
                    classes_year = classes_item[y]['school_year'];
                    classes = classes_item[y]['title'];
                }
            }

            t.find('#course_area').html(course).removeAttr('id');
            t.find('#school_area').html(school).removeAttr('id');
            t.find('#classes_area').html(classes_year).removeAttr('id');
            t.find('#classes_name').html(classes).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }

    var isSend = false;
    function add(){
        if(!isSend && courseName.val() != '' && classes.val() != ''){
            $.ajax({
                url: "[! route('ma.course.student.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    course_id:courseName.val(),
                    school_id:school.val(),
                    classes_id:classes.val(),
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