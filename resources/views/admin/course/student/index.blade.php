@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        課程-學員設定
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <div class="form-group">
                    <label class="i-label">學年度</label>
                    <select id="year" class="i-select">
                    </select>
                    <label class="i-label">學期</label>
                    <select id="semester" class="i-select">
                        <option value="1">第一學期</option>
                        <option value="2">第二學期</option>
                    </select>
                    <label class="i-label">課程名稱</label>
                    <select id="courseName" class="i-select">
                    </select>
                </div>
                <div class="form-group">
                    <label class="i-label" class="i-select">學校</label>
                    <select id="school" class="i-select">
                    </select>
                    <label class="i-label" class="i-select">科系</label>
                    <select id="subject" class="i-select">
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
    var subject = $('#subject');
    var course_obj = [];
    var list_obj = [];
    var school_item = [];
    var subject_item = [];

    $( document ).ready(function() {
        setMenu('li_course_student', 'main_li_2');
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
                getSchoolData();
            }
        });
    }


    function getSchoolData() {
        $.ajax({
            url: "[! route('ma.school.list') !]",
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
                        school_item.push(
                            {
                                'id':response['data'][x]['id'],
                                'code':response['data'][x]['code'],
                                'area':response['data'][x]['area'],
                                'school_title':response['data'][x]['school_title']
                            }
                        );
                    }
                }
                getSubjectData();
            }
        });
    }

    function getSubjectData() {
        $.ajax({
            url: "[! route('ma.subject.list') !]",
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
                        subject_item.push(
                            {
                                'id':response['data'][x]['id'],
                                'school_id':response['data'][x]['school_id'],
                                'subject_title':response['data'][x]['subject_title']
                            }
                        );
                    }
                }
                setSchoolList();
                setSubject();
                getListData();
            }
        });
    }

    function getListData() {
        $.ajax({
            url: "[! route('ma.course.student.list') !]",
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
                                'school_id':response['data'][x]['school_id'],
                            }
                        );
                    }
                }
                setYear();
                setCourse();
                setList();
            }
        });
    }

    function setSubject() {
        var t= school.val();
        for(var x=0;x<subject_item.length;x++){
            if(subject_item[x]['school_id'] == t){
                subject.append($("<option></option>").attr("value", subject_item[x]['id']).text(subject_item[x]['subject_title']));
            }
        }
    }

    function setSchoolList() {
        $("#school option").remove();
        for(var x=0;x<school_item.length;x++){
            school.append($("<option></option>").attr("value", school_item[x]['id']).text(school_item[x]['school_title']));
        }
    }
    //設定學年度下拉選單
    function setYear() {
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

    function setList() {
        for(var x=0;x<list_obj.length;x++){
            var t = tr_item.clone();
            var c = '';
            var s = '';

            for(var y=0;y<school_item.length;y++){
                if(school_item[y]['id'] == list_obj[x]['school_id']){
                    s = school_item[y]['school_title'];
                }
            }

            for(var y=0;y<course_obj.length;y++){
                if(course_obj[y]['id'] == list_obj[x]['course_id']){
                    c = course_obj[y]['course_title'];
                }
            }
            t.find('#course_area').html(c).removeAttr('id');
            t.find('#school_area').html(s).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }



    var isSend = false;
    function add(){
        if(!isSend && courseName.val() != '' && school.val() != ''){
            $.ajax({
                url: "[! route('ma.course.student.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    course_id:courseName.val(),
                    school_id:school.val(),
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