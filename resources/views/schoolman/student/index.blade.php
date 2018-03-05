@extends('schoolman.layout.layout')
@section('content')
<div class="article" id="list_div">
    <div class="article-header">
        查詢/編輯使用者資料
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label" id="school_name">學校名稱</label>
                <label class="i-label">學年度</label>
                <select id="year_val" class="i-select" onchange="setClassesOption('year_val','classes_id')">
                </select>
                <label class="i-label">班級</label>
                <select id="classes_id" class="i-select">
                </select>
                <button type="button" class="i-btn i-btn-primary" onclick="getStudent()">
                    <i class="ion-android-add"></i>
                    查詢
                </button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                使用者資料
                <div class="title-right">
                    <a href="#" onclick="showAddArea()" class="i-add i-btn-primary"><i class="ion-android-add"></i>新增使用者</a>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table" id="student_list">
                    <tr id="tr_default">
                        <th>
                            <div class="cell">學校</div>
                        </th>
                        <th>
                            <div class="cell">學年度</div>
                        </th>
                        <th>
                            <div class="cell">班級</div>
                        </th>
                        <th>
                            <div class="cell">帳號</div>
                        </th>
                        <th>
                            <div class="cell">姓名</div>
                        </th>
                        <th width="150">
                            <div class="cell center">
                                功能
                            </div>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="article" id="add_div" style="display: none">
    <div class="article-header">
        查詢/編輯使用者資料
    </div>
    <div class="article-content">
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                新增使用者
            </div>
            <div class="form-group">
                <label class="i-label" id="school_id_add">學校</label>
            </div>
            <div class="form-group">
                <label class="i-label">學年度</label>
                <select id="year_val_add" onchange="setClassesOption('year_val_add','classes_id_add')">
                </select>
            </div>
            <div class="form-group">
                <label class="i-label">班級</label>
                <select id="classes_id_add">
                </select>
            </div>
            <div class="form-group">
                <label class="i-label">帳號</label>
                <input class="i-input" value="" id="new_login_name">
            </div>
            <div class="form-group">
                <label class="i-label">密碼</label>
                <input type="password" class="i-input" id="new_pw">
            </div>
            <div class="form-group">
                <label class="i-label">姓名</label>
                <input class="i-input" value="" id="new_name">
            </div>
            <div class="form-group">
                <label class="i-label">學號</label>
                <input class="i-input" value="" id="new_student_id">
            </div>
            <div class="form-group form-bottom">
                <button type="button" class="i-btn" onclick="returnList()">
                    取消
                </button>
                <button type="button" class="i-btn i-btn-primary" onclick="sendAddData()">
                    新增
                </button>
            </div>
        </div>
    </div>
</div>
<div class="article" id="edit_div" style="display: none">
    <div class="article-header">
        查詢/編輯使用者資料
    </div>
    <div class="article-content">
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                編輯使用者
            </div>
            <div class="form-group">
                <label class="i-label">學校</label>
                <input class="i-input" id="up_school_name" disabled>
            </div>
            <div class="form-group">
                <label class="i-label">帳號</label>
                <input class="i-input" id="up_login_name" disabled>
            </div>
            <div class="form-group">
                <label class="i-label">姓名</label>
                <input class="i-input" value="" id="up_name">
            </div>
            <div class="form-group">
                <label class="i-label">學號</label>
                <input class="i-input" value="" id="up_student_id">
            </div>
            <div class="form-group">
                <label class="i-label">原始密碼</label>
                <input class="i-input" value="" id="up_login_pw" disabled>
            </div>
            <div class="form-group">
                <label class="i-label">新密碼</label>
                <input type="password" class="i-input" id="up_pw">
            </div>
            <div class="form-group">
                <label class="i-label">確認新密碼</label>
                <input type="password" class="i-input" id="up_pw_r">
            </div>
            <div class="form-group form-bottom">
                <button type="button" class="i-btn" onclick="returnList()">
                    取消
                </button>
                <button type="button" class="i-btn i-btn-primary" onclick="sendUpdateData()">
                    更新
                </button>
            </div>
        </div>
    </div>
</div>
<table style="display: none">
    <tr id="copy_tr">
        <td><div class="cell" id="school_area"></div></td>
        <td><div class="cell" id="year_area"></div></td>
        <td><div class="cell" id="classes_area"></div></td>
        <td><div class="cell" id="login_name_area"></div></td>
        <td><div class="cell" id="name_area"></div></td>
        <td>
            <div class="cell center">
                <a class="i-link" id="a_area"><i class="ion-android-settings"></i>編輯</a>
                <a class="i-link" id="a_del"><i class="ion-trash-a"></i>移除</a>
            </div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#student_list');
    var tr_item = $('#copy_tr');
    var classes_id_item = $('#classes_id');
    var student_item = [];
    var school_item = [];
    var classes_item = [];
    var subject_item = [];

    $( document ).ready(function() {
        setMenu('li_member', 'main_li_1');
        getInit();
    });

    //取得初始化用的資料
    function getInit()
    {
        $.ajax({
            url: "[! route('sm.student.init') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    var school = response['data']['school'];
                    school_item.push(
                        {
                            'id':school['id'],
                            'code':school['code'],
                            'area':school['area'],
                            'school_title':school['school_title']
                        }
                    );
                    $('#school_name').html(school['school_title']);
                    $('#school_id_add').html(school['school_title']);
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
                }
                setSubjectOption('year_val', 'classes_id');
            }
        });
    }

    //設定學年度下拉選單資料
    function setSubjectOption(item1,item2) {
        var years = [];
        $("#"+item1+" option").remove();
        for(var x=0;x<classes_item.length;x++){
            if(jQuery.inArray(classes_item[x]['school_year'], years) == -1){
                years.push(classes_item[x]['school_year']);
            }
        }
        for(var x=0;x<years.length;x++){
            $("#"+item1).append($("<option></option>").attr("value", years[x]).text(years[x]));
        }
        setClassesOption(item1,item2);
    }

    //設定班級下拉選單資料
    function setClassesOption(item1,item2) {
        var t_val = $('#'+item1).val();
        $("#"+item2+" option").remove();
        for(var x=0;x<classes_item.length;x++){
            if(classes_item[x]['school_year'] == t_val){
                $("#"+item2).append($("<option></option>").attr("value", classes_item[x]['id']).text(classes_item[x]['title']));
            }
        }
    }

    //查詢學生資料
    function getStudent() {
        //先清除學生資料
        list_item.find('tr').each(function(){
            if($(this).attr('id') != 'tr_default'){
                $(this).remove();
            }
        });
        var t = classes_id_item.val();
        if(t != ''){
            student_item = [];
            $.ajax({
                url: "[! route('sm.student.list') !]",
                type:'GET',
                dataType: "json",
                data: {
                    'classes_id':$('#classes_id').val()
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true){
                        for(var x=0;x<response['data'].length;x++){
                            student_item.push(
                                {
                                    'id':response['data'][x]['id'],
                                    'login_name':response['data'][x]['login_name'],
                                    'login_pw':response['data'][x]['login_pw'],
                                    'name':response['data'][x]['name'],
                                    'student_id':response['data'][x]['student_id'],
                                    'school_title':response['data'][x]['school_title']
                                }
                            );
                        }
                    }
                    setStudentList();
                }
            });
        }
    }

    //設定學生列表的資料
    function setStudentList() {
        var school = $("#school_name").html();
        var classes = $("#classes_id").find(":selected").text();
        var year = $("#year_val").find(":selected").text();
        for(var x=0;x<student_item.length;x++){
            var t = tr_item.clone();
            var login_name = student_item[x]['login_name'];
            var name = student_item[x]['name'];
            t.find('#school_area').html(school).removeAttr('id');
            t.find('#year_area').html(year).removeAttr('id');
            t.find('#classes_area').html(classes).removeAttr('id');
            t.find('#login_name_area').html(login_name).removeAttr('id');
            t.find('#name_area').html(name).removeAttr('id');
            t.find('#a_area').attr('onclick','showUpArea("'+student_item[x]['id']+'")').removeAttr('id');
            t.find('#a_del').attr('onclick','unsetStudent("'+student_item[x]['id']+'")').removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }


    //移除學生資料
    function unsetStudent(id) {
        $.ajax({
            url: "[! route('sm.student.del') !]",
            type: 'POST',
            dataType: "json",
            data: {
                _token: '[! csrf_token() !]',
                user_id: id,
            },
            error: function (xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function (response) {
                if(response['status'] == true){
                    alert(response['msg']);
                }
                getStudent();
            }
        });
    }
    //------------------------------------------------------------------
    //下面是新增使用者會用到的方法
    function showAddArea() {
        $('#add_div').show();
        $('#list_div').hide();
        setSubjectOption('year_val_add','classes_id_add');
    }

    function returnList() {
        $('#list_div').show();
        $('#add_div').hide();
        $('#edit_div').hide();
        resetAddSelect();
    }

    function resetAddSelect() {
        $('#area_add').val('1');
    }

    //上傳資料
    var is_send = false;
    function sendAddData()
    {
        if(!is_send && chkInput()){
            is_send = true;
            $.ajax({
                url: "[! route('sm.student.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    login_name:$('#new_login_name').val(),
                    login_pw:$('#new_pw').val(),
                    school_id:$('#school_id_add').val(),
                    classes_id:$('#classes_id_add').val(),
                    student_id:$('#new_student_id').val(),
                    name:$('#new_name').val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true){
                        alert(response['msg']);
                    }
                    getStudent();
                    returnList();
                    is_send = false;
                }
            });
        }
    }

    function chkInput()
    {
        var msg = '';
        if($('#year_val_add').val() == ''){
            msg = msg + '請選擇學年度!!\r\n';
        }
        if($('#classes_id_add').val() == ''){
            msg = msg + '請選擇班級!!\r\n';
        }
        if($('#new_login_name').val() == ''){
            msg = msg + '請輸入帳號!!\r\n';
        }
        if($('#new_pw').val() == ''){
            msg = msg + '請輸入新密碼!!\r\n';
        }
        if($('#new_name').val() == ''){
            msg = msg + '請輸入姓名!!\r\n';
        }

        if(msg == ''){
            return true;
        }
        alert(msg);

        return false;
    }
    //------------------------------------------------------------------
    //下面是更新使用者會用到的方法
    var update_id = 0;

    function showUpArea(u_id) {
        $('#edit_div').show();
        $('#add_div').hide();
        $('#list_div').hide();
        for(var x=0;x<student_item.length;x++){
           $('#up_school_name').val(student_item[x]['school_title']);
           $('#up_login_name').val(student_item[x]['login_name']);
           $('#up_login_pw').val(student_item[x]['login_pw']);
           $('#up_name').val(student_item[x]['name']);
           $('#up_student_id').val(student_item[x]['student_id']);
        }
        update_id = u_id;
    }
    function sendUpdateData()
    {
        if(!is_send && chkUpInput()){
            is_send = true;
            $.ajax({
                url: "[! route('sm.student.update') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    new_pw:$('#up_pw').val(),
                    student_id:$('#up_student_id').val(),
                    name:$('#up_name').val(),
                    user_id:update_id,
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true){
                        alert(response['msg']);
                    }
                    getStudent();
                    returnList();
                    is_send = false;
                }
            });
        }
    }

    function chkUpInput()
    {
        var msg = '';
        if($('#up_name').val() == ''){
            msg = msg + '請輸入姓名!!\r\n';
        }
        /*
        if($('#up_student_id').val() == ''){
            msg = msg + '請輸入學號!!\r\n';
        }
        */
        if($('#up_pw').val() != ''){
            if($('#up_pw').val() != $('#up_pw_r').val()){
                msg = msg + '新密碼不一致!!\r\n';
            }
        }

        if(msg == ''){
            return true;
        }
        alert(msg);

        return false;
    }
</script>
@stop