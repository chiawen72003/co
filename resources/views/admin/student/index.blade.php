@extends('admin.layout.layout')
@section('content')
<div class="article" id="list_div">
    <div class="article-header">
        查詢/編輯使用者資料
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">區域</label>
                <select id="area" onchange="setSchoolList('area','school_id','subject_id')">
                    <option value="1">北區</option>
                    <option value="2">桃竹苗區</option>
                    <option value="3">中區</option>
                    <option value="4">雲嘉南區</option>
                    <option value="5">高屏東區</option>
                    <option value="6">外島</option>
                </select>
                <label class="i-label">學校</label>
                <select id="school_id" onchange="setSubjectList('school_id','subject_id')">
                </select>
                <label class="i-label">科系</label>
                <select id="subject_id">
                </select>
                <button type="button" class="i-btn i-btn-primary i-btn-circle" onclick="getStudent()">
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
                    <tr>
                        <th>
                            <div class="cell">學校</div>
                        </th>
                        <th>
                            <div class="cell">科系</div>
                        </th>
                        <th>
                            <div class="cell">帳號</div>
                        </th>
                        <th>
                            <div class="cell">姓名</div>
                        </th>
                        <th width="100">
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
                <label class="i-label">區域</label>
                <select id="area_add" onchange="setSchoolList('area_add','school_id_add','subject_id_add')">
                    <option value="1">北區</option>
                    <option value="2">桃竹苗區</option>
                    <option value="3">中區</option>
                    <option value="4">雲嘉南區</option>
                    <option value="5">高屏東區</option>
                    <option value="6">外島</option>
                </select>
            </div>
            <div class="form-group">
                <label class="i-label">學校</label>
                <select id="school_id_add" onchange="setSubjectList('school_id_add','subject_id_add')">
                </select>
            </div>
            <div class="form-group">
                <label class="i-label">科系</label>
                <select id="subject_id_add">
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
        <td><div class="cell" id="subject_area"></div></td>
        <td><div class="cell" id="login_name_area"></div></td>
        <td><div class="cell" id="name_area"></div></td>
        <td>
            <div class="cell center"><a class="i-link" id="a_area"><i class="ion-android-settings"></i>編輯</a></div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#student_list');
    var tr_item = $('#copy_tr');
    var subject_id_item = $('#subject_id');
    var student_item = [];
    var school_item = [];
    var subject_item = [];

    $( document ).ready(function() {
        setMenu('li_member', 'main_li_1');
        getSchoolData();
    });

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
                setSchoolList('area','school_id','subject_id');
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
                setSubjectList('school_id','subject_id');
            }
        });
    }

    function setSchoolList(item1,item2,item3) {
        var t_val = $('#'+item1).val();
        $("#"+item2+" option").remove();
        $("#"+item3+" option").remove();
        for(var x=0;x<school_item.length;x++){
            if(school_item[x]['area'] == t_val){
                $("#"+item2).append($("<option></option>").attr("value", school_item[x]['id']).text(school_item[x]['school_title']));
            }
        }
        setSubjectList(item2,item3);
    }


    function setSubjectList(item1,item2) {
        var t_val = $('#'+item1).val();
        $("#"+item2+" option").remove();
        for(var x=0;x<subject_item.length;x++){
            if(subject_item[x]['school_id'] == t_val){
                $("#"+item2).append($("<option></option>").attr("value", subject_item[x]['id']).text(subject_item[x]['subject_title']));
            }
        }
    }

    function getStudent() {
        var t = subject_id_item.val();
        if(t != ''){
            student_item = [];
            $.ajax({
                url: "[! route('ma.student.list') !]",
                type:'GET',
                dataType: "json",
                data: {
                    'school':$('#school_id').val(),
                    'subject':$('#subject_id').val(),
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

    function setStudentList() {
        var school = $("#school_id").find(":selected").text();
        var subject = $("#subject_id").find(":selected").text();
        for(var x=0;x<student_item.length;x++){
            var t = tr_item.clone();
            //var a = "[! route('ma.question.pg.edit') !]?id="+ question_item[x]['id'];
            var login_name = student_item[x]['login_name'];
            var name = student_item[x]['name'];
            t.find('#school_area').html(school).removeAttr('id');
            t.find('#subject_area').html(subject).removeAttr('id');
            t.find('#login_name_area').html(login_name).removeAttr('id');
            t.find('#name_area').html(name).removeAttr('id');
            t.find('#a_area').attr('onclick','showUpArea("'+student_item[x]['id']+'")').removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }

    //------------------------------------------------------------------
    //下面是新增使用者會用到的方法
    function showAddArea() {
        $('#add_div').show();
        $('#list_div').hide();
        setSchoolList('area_add','school_id_add','subject_id_add');
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
                url: "[! route('ma.student.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    login_name:$('#new_login_name').val(),
                    login_pw:$('#new_pw').val(),
                    school_id:$('#school_id_add').val(),
                    school_subject:$('#subject_id_add').val(),
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
        if(o_pw.val() == ''){
            msg = msg + '請輸入舊密碼!!\r\n';
        }else{
            if(o_pw.val() != pw){
                msg = msg + '舊密碼不一致!!\r\n';
            }
        }
        if(n_pw.val() == ''){
            msg = msg + '請輸入新密碼!!\r\n';
        }else{
            if(n_pw.val() != n_pw_r.val()){
                msg = msg + '新密碼不一致!!\r\n';
            }
        }
        if(msg == '' && n_pw.val() == o_pw.val()){
            msg = msg + '新舊密碼不能一樣!!\r\n';
        }

        if(msg == ''){
            pw = n_pw.val();
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
           if(student_item[x]['id'] == u_id){
               $('#up_school_name').val(student_item[x]['school_title']);
               $('#up_login_name').val(student_item[x]['login_name']);
               $('#up_name').val(student_item[x]['name']);
               $('#up_student_id').val(student_item[x]['student_id']);
           }
        }
        update_id = u_id;
    }
    function sendUpdateData()
    {
        if(!is_send && chkUpInput()){
            is_send = true;
            $.ajax({
                url: "[! route('ma.student.update') !]",
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
        if($('#up_student_id').val() == ''){
            msg = msg + '請輸入學號!!\r\n';
        }
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