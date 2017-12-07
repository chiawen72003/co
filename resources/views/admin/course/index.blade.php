@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        課程設定
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">學年度</label>
                <input type="text" class="i-input" id="school_year">
                <label class="i-label">學期</label>
                <select id="semester">
                    <option value="1">第一學期</option>
                    <option value="2">第二學期</option>
                </select>
                <label class="i-label">課程名稱</label>
                <input type="text" class="i-input" id="course_title">
                <button type="button" class="i-btn i-btn-primary i-btn-circle" onclick="addCourse()">
                    <i class="ion-android-add"></i>
                    新增
                </button>
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
                        <th >
                            <div class="cell center">學期</div>
                        </th>
                        <th>
                            <div class="cell">課程名稱</div>
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
        <td><div class="cell"  id="semester_area"></div></td>
        <td><div class="cell"  id="name_area"></div></td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_course');
    var list_item = $('#course_list');
    var tr_item = $('#copy_tr');
    var semester_item = $('#semester');
    var year_item = $('#school_year');
    var title_item = $('#course_title');
    var current = 'current';
    var course_item = [];
    $( document ).ready(function() {
        li_item.addClass( current);
        getListData();
    });
    
    function getListData() {
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
                        course_item.push(
                            {
                                'id':response['data'][x]['id'],
                                'school_year':response['data'][x]['school_year'],
                                'semester':response['data'][x]['semester'],
                                'course_title':response['data'][x]['course_title']
                            }
                        );
                    }
                }
                setList();
            }
        });
    }

    function setList() {
        for(var x=0;x<course_item.length;x++){
            var t = tr_item.clone();
            var s = $("#semester option[value="+ course_item[x]['semester'] +"]").text();
            t.find('#year_area').html(course_item[x]['school_year']).removeAttr('id');
            t.find('#semester_area').html(s).removeAttr('id');
            t.find('#name_area').html(course_item[x]['course_title']).removeAttr('id');
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
                        addList(response['school_year'],response['semester'],response['course_title']);
                        alert(response['msg']);
                    }
                    isSend = false;
                }
            });
            isSend = true;
            clearInput();
        }
    }

    function addList(year,semester,title) {
        var t = tr_item.clone();
        var s = $("#semester option[value="+ semester +"]").text();
        t.find('#year_area').html(year).removeAttr('id');
        t.find('#semester_area').html(s).removeAttr('id');
        t.find('#name_area').html(title).removeAttr('id');
        t.removeAttr('id');
        list_item.append(t);
    }

    function clearInput() {
        $('#school_year').val('');
        $('#semester').val(1);
        $('#course_title').val('');
    }
</script>
@stop