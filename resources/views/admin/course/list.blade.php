@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        課程設定
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <div class="form-inline">
                    <label class="i-label" id="school_area">區域</label>
                    <label class="i-label" id="school_code">學校代碼</label>
                    <label class="i-label" id="school_name">學校名稱</label>
                </div>
                <div class="form-group">
                    <label class="i-label">學年度</label>
                    <input type="text" class="i-input" id="school_year">
                    <label class="i-label">學期</label>
                    <select id="semester" class="i-select">
                        <option value="1">第一學期</option>
                        <option value="2">第二學期</option>
                    </select>
                    <label class="i-label">課程名稱</label>
                    <input type="text" class="i-input" id="course_title">
                    <button type="button" class="i-btn i-btn-primary" onclick="addCourse()">
                        <i class="ion-android-add"></i>
                        新增
                    </button>
                </div>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增課程
            </div>
            <div class="table-wrapper">
                <table class="table" id="course_list">
                    <tr>
                        <th width="120">
                            <div class="cell center">學年度</div>
                        </th>
                        <th width="120">
                            <div class="cell center">學期</div>
                        </th>
                        <th>
                            <div class="cell">課程名稱</div>
                        </th>
                        <th>
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
        <td><div class="cell center" id="year_area"></div></td>
        <td><div class="cell center"  id="semester_area"></div></td>
        <td><div class="cell"  id="name_area"></div></td>
        <td>
            <div class="cell" >
                <a class="i-link" id="a_del"><i class="ion-trash-a"></i>移除</a>
            </div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#course_list');
    var tr_item = $('#copy_tr');
    var semester_item = $('#semester');
    var year_item = $('#school_year');
    var title_item = $('#course_title');
    var course_item = [];
    var school_item = [];
    var area_item = [];

    $( document ).ready(function() {
        setMenu('li_course', 'main_li_2');
        getListData();
    });
    
    function getListData() {
        $.ajax({
            url: "[! route('ma.course.list') !]",
            type:'GET',
            dataType: "json",
            data: {
                'sid':'[! $school_id !]'
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data']['course_data'].length;x++)
                    {
                        var course_array = response['data']['course_data'][x];
                        course_item.push(
                            {
                                'id':course_array['id'],
                                'school_year':course_array['school_year'],
                                'semester':course_array['semester'],
                                'course_title':course_array['course_title']
                            }
                        );
                    }
                    for(var x=0;x<response['data']['area_data'].length;x++){
                        var data = response['data']['area_data'][x];
                        area_item.push(
                            {
                                'id':data['id'],
                                'name':data['name']
                            }
                        );
                    }
                    school_item = response['data']['school_data'];
                }
                setSchoolData();
                setList();
            }
        });
    }

    //設定學校名稱
    function setSchoolData() {
        var side = getAreaName(school_item['area']);
        $('#school_area').html(side);
        $('#school_code').html(school_item['code']);
        $('#school_name').html(school_item['school_title']);
    }

    //取得區域名稱
    function getAreaName(id) {
        for(var x=0;x<area_item.length;x++){
            if( area_item[x]['id']== id)
            {
                return area_item[x]['name'];
            }
        }

        return '';
    }

    //設定課程資料
    function setList() {
        for(var x=0;x<course_item.length;x++){
            var t = tr_item.clone();
            var s = $("#semester option[value="+ course_item[x]['semester'] +"]").text();
            t.find('#year_area').html(course_item[x]['school_year']).removeAttr('id');
            t.find('#semester_area').html(s).removeAttr('id');
            t.find('#name_area').html(course_item[x]['course_title']).removeAttr('id');
            t.find('#a_del').attr('onclick','unset("'+course_item[x]['id']+'")').removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }
    var isSend = false;
    function addCourse(){
        if(!isSend){
            $.ajax({
                url: "[! route('ma.course.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    school_id:'[! $school_id !]',
                    course_title:title_item.val(),
                    semester:semester_item.val(),
                    school_year:year_item.val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
                        course_item.push(
                            {
                                'id':response['id'],
                                'school_year':response['school_year'],
                                'semester':response['semester'],
                                'course_title':response['course_title']
                            }
                        );
                        addList(response['school_year'],response['semester'],response['course_title'],response['id']);
                        alert(response['msg']);
                    }
                    isSend = false;
                }
            });
            isSend = true;
            clearInput();
        }
    }

    function addList(year,semester,title,id) {
        var t = tr_item.clone();
        var s = $("#semester option[value="+ semester +"]").text();
        t.find('#year_area').html(year).removeAttr('id');
        t.find('#semester_area').html(s).removeAttr('id');
        t.find('#name_area').html(title).removeAttr('id');
        t.find('#a_del').attr('onclick','unset("'+id+'")').removeAttr('id');
        t.removeAttr('id');
        list_item.append(t);
    }

    function clearInput() {
        $('#school_year').val('');
        $('#semester').val(1);
        $('#course_title').val('');
    }

    //刪除課程
    function unset(courseid) {
        $.ajax({
            url: "[! route('ma.course.del') !]",
            type: 'POST',
            dataType: "json",
            data: {
                _token: '[! csrf_token() !]',
                course_id: courseid,
                school_id:'[! $school_id !]',
            },
            error: function (xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function (response) {
                if(response['status'] == true){
                    alert(response['msg']);
                }
                location.reload();
            }
        });
    }
</script>
@stop