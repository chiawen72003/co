@extends('admin.layout.layout')
@section('content')
    <div class="article">
        <div class="article-header">
            評閱者資料管理
        </div>
        <div class="article-content">
            <div class="article-content-body">
                <div class="title">
                    <i class="ion-information-circled"></i>
                    編輯評閱者資料
                </div>
                <div class="i-form mt1">
                    <div class="form-group">
                        <label class="i-label">區域</label>
                        <select id="area" class="i-select" onchange="setSchoolData()">
                            <option value="1">北區</option>
                            <option value="2">桃竹苗區</option>
                            <option value="3">中區</option>
                            <option value="4">雲嘉南區</option>
                            <option value="5">高屏東區</option>
                            <option value="6">外島</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="i-label">學校名稱</label>
                        <select id="school" class="i-select">
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="i-label">登入帳號</label>
                        <input class="i-input" value="" id="login_name" disabled>
                    </div>
                    <div class="form-group">
                        <label class="i-label">登入密碼</label>
                        <input class="i-input" value="" id="login_pw">
                    </div>
                    <div class="form-group">
                        <label class="i-label">姓名</label>
                        <input class="i-input" value="" id="user_name">
                    </div>
                    <div class="form-group form-bottom">
                        <button type="button" class="i-btn" onclick="history.back()">
                            取消
                        </button>
                        <button type="button" class="i-btn i-btn-primary" onclick="sendData()">
                            新增
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    [! Html::script('js/jquery-1.11.3.js') !]
    <script>
        var school = $('#school');
        var area = $('#area');
        var school_item = [];
        var revised_item = [];
        $( document ).ready(function() {
            setMenu('li_revised', 'main_li_4');
            getInitData();
        });

        function getInitData() {
            $.ajax({
                url: "[! route('ma.revised.data') !]",
                type:'GET',
                dataType: "json",
                data: {
                    'id':'[! $id !]',
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true)
                    {
                        var revised = response['data']['revised'];
                        revised_item.push(
                            {
                                'id':revised['id'],
                                'name':revised['name'],
                                'login_name':revised['login_name'],
                                'login_pw':revised['login_pw'],
                                'school_id':revised['school_id']
                            }
                        );
                        for(var x=0;x<response['data']['school'].length;x++)
                        {
                            var school = response['data']['school'][x];
                            school_item.push(
                                {
                                    'id':school['id'],
                                    'area':school['area'],
                                    'school_title':school['school_title']
                                }
                            );
                        }
                    }
                    setSchoolData();
                    setRevisedList();
                }
            });
        }

        function setSchoolData() {
            var area_val = area.val();
            $("#school option").remove();
            school.append($("<option></option>").attr("value", '').text(''));
            for(var x=0;x<school_item.length;x++){
                if( school_item[x]['area'] == area_val){
                    school.append($("<option></option>").attr("value", school_item[x]['id']).text(school_item[x]['school_title']));
                }
            }
        }
        function setRevisedList() {
            for(var x=0;x<revised_item.length;x++){
                $('#login_name').val(revised_item[x]['login_name']);
                $('#login_pw').val(revised_item[x]['login_pw']);
                $('#user_name').val(revised_item[x]['name']);
            }
        }
        var isSend = false;
        function sendData()
        {
            if(!isSend){
                $.ajax({
                    url: "[! route('ma.revised.update') !]",
                    type:'POST',
                    dataType: "json",
                    data: {
                        _token: '[! csrf_token() !]',
                        'id':'[! $id !]',
                        login_name:$('#login_pw').val(),
                        login_pw:$('#login_pw').val(),
                        school_id:$('#school').val(),
                        name:$('#user_name').val(),
                    },
                    error: function(xhr) {
                        //alert('Ajax request 發生錯誤');
                    },
                    success: function(response)
                    {
                        if(response['status'] == true)
                        {
                            alert(response['msg']);
                            location.replace("[! route('ma.revised') !]");
                        }
                        isSend = false;
                    }
                });
                isSend = true;
            }
        }
    </script>
@stop