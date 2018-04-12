@extends('schoolman.layout.layout')
@section('content')
    <div class="article">
        <div class="article">
            <div class="article-header">
                學生成績查詢
            </div>
            <div class="article-content">
                <div class="article-content-header">
                    <form>
                        <div class="form-inline">
                            <label class="i-label">學年度</label>
                            <select id="school_year" class="i-select">
                                <option>學年度</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label class="i-label">學期</label>
                            <select id="semester" class="i-select">
                                <option>學期</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label class="i-label">課程</label>
                            <select id="course" class="i-select">
                                <option>課程</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label class="i-label">班級</label>
                            <select id="classes_id" class="i-select">
                                <option>班級</option>
                            </select>
                        </div>
                        <button type="button" class="i-btn">
                            查詢
                        </button>
                    </form>
                </div>
                <div class="article-content-body">
                    <div class="title">
                        <i class="ion-information-circled"></i>
                        試卷列表
                    </div>
                    <div class="table-wrapper">
                        <table class="table" id="reel_list">
                            <tr>
                                <th>
                                    <div class="cell center">試卷名稱</div>
                                </th>
                                <th>
                                    <div class="cell center">受測日期</div>
                                </th>
                                <th>
                                    <div class="cell center">每題得分</div>
                                </th>
                                <th>
                                    <div class="cell center">總分</div>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table style="display: none">
        <tr id="copy_tr" >
            <td>
                <div class="cell center" id="title"></div>
            </td>
            <td>
                <div class="cell center" id="date"></div>
            </td>
            <td>
                <div class="cell center" id="scores"></div>
            </td>
            <td>
                <div class="cell center" id="total"></div>
            </td>
        </tr>
    </table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var tr_item = $('#copy_tr');
    var list_item = $('#reel_list');
    var school_year = $('#school_year');
    var semester = $('#semester');
    var course = $('#course');
    var classes_id = $('#classes_id');
    var list_data = [];
    var course_data = [];
    var course_classes_data = [];
    var classes_data = [];
    var student_data = [];
    var now_pg = 0;
    $( document ).ready(function() {
        setMenu('li_score', 'main_li_2');
        getInitData();
    });
    //取得初始化資料
    function getListData() {
        $.ajax({
            url: "[! route('sm.score.init') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    //課程資料
                    for(var x=0;x<response['data']['course'].length;x++){
                        var t = response['data']['course'][x];
                        course_data.push(
                            {
                                'id':t['id'],
                                'school_year':t['school_year'],
                                'semester':t['semester'],
                                'course_title':t['course_title']
                            }
                        );
                    }
                    //課程_班級資料
                    for(var x=0;x<response['data']['course_classes'].length;x++){
                        var t = response['data']['course_classes'][x];
                        course_classes_data.push(
                            {
                                'id':t['id'],
                                'course_id':t['course_id'],
                                'classes_id':t['classes_id'],
                            }
                        );
                    }
                    //班級資料
                    for(var x=0;x<response['data']['classes'].length;x++){
                        var t = response['data']['classes'][x];
                        classes_data.push(
                            {
                                'id':t['id'],
                                'title':t['title'],
                            }
                        );
                    }
                    //學生姓名資料
                    for(var x=0;x<response['data']['student'].length;x++){
                        var t = response['data']['student'][x];
                        student_data.push(
                            {
                                'id':t['id'],
                                'name':t['name'],
                            }
                        );
                    }
                }
                InitSchoolYear();
                InitSemester();
                InitCourse();
                InitClasses();
            }
        });
    }

    //初始化 學年度 下拉選單內容
    function InitSchoolYear()
    {
        var t_array = [];
        $("#school_year option").remove();
        school_year.append($("<option></option>").text("學年度"));

        for(var x=0;x<course_data.length;x++){
            var t = course_data[x];
            if(!t_array.indexOf(t['school_year'])){
                t_array.push(t['school_year']);
            }
        }
        t_array.sort();
        for(var x=0;x<t_array.length;x++){
            school_year.append($("<option></option>").attr("value", t_array[x]).text(t_array[x]));
        }
    }

    //初始化 學期 下拉選單內容
    function InitSemester()
    {
        var t_array = [];
        var sw_year = school_year.val();
        $("#semester option").remove();
        semester.append($("<option></option>").text("學期"));

        for(var x=0;x<course_data.length;x++){
            var t = course_data[x];
            if(t['school_year'] == sw_year && !t_array.indexOf(t['semester'])){
                t_array.push(t['semester']);
            }
        }
        t_array.sort();
        for(var x=0;x<t_array.length;x++){
            semester.append($("<option></option>").attr("value", t_array[x]).text(t_array[x]));
        }
    }

    //初始化 課程 下拉選單內容
    function InitCourse()
    {
        var sw_year = school_year.val();
        var sw_semester = semester.val();
        $("#course option").remove();
        course.append($("<option></option>").text("課程"));

        for(var x=0;x<course_data.length;x++){
            var t = course_data[x];
            if(t['school_year'] == sw_year && t['semester'] == sw_semester){
                course.append($("<option></option>").attr("value", t['id']).text(t['course_title']));
            }
        }
    }

    //初始化 班級 下拉選單內容
    function InitClasses()
    {
        var sw_course = course.val();
        $("#classes_id option").remove();
        classes_id.append($("<option></option>").text("班級"));

        for(var x=0;x<course_classes_data.length;x++){
            var t = course_classes_data[x];
            if(t['course_id'] == sw_course){
                var classes_name = '';
                for(y=0;y<classes_data.length;y++){
                    var u = classes_data[y];
                    if(u['id'] == t['classes_id']){
                        classes_name = u['title'];
                    }
                }
                classes_id.append($("<option></option>").attr("value", t['classes_id']).text(classes_name));
            }
        }
    }

    //取得試卷分析資料
    function getListData() {
        if(school_year.val() != '' && semester.val() != '' && course.val() != '' && classes_id.val() != '')
        {
            $.ajax({
                url: "[! route('ur.score.api') !]",
                type:'GET',
                dataType: "json",
                data: {
                    'course_id':course.val(),
                    'classes_id':classes_id.val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true){
                        for(var x=0;x<response['data'].length;x++){
                            var t = response['data'][x];
                            list_data.push(
                                {
                                    'total':t['total'],
                                    'scores':t['scores'],
                                    'title':t['title'],
                                    'date':t['date']
                                }
                            );
                        }
                    }
                    setList();
                }
            });
        }else{
           alert('請確認查詢條件!!');
        }
    }

    //設定試卷分析資料
    function setList() {
        for(var x=0;x<list_data.length;x++){
            var t = tr_item.clone();
            var data = list_data[x];
            t.find('#title').html(data['title']).removeAttr('id');
            t.find('#date').html(data['date']).removeAttr('id');
            t.find('#scores').html(data['scores']).removeAttr('id');
            t.find('#total').html(data['total']).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }
</script>
@stop