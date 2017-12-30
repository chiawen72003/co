@extends('admin.layout.layout')
@section('content')
    <div class="article">
        <div class="article">
            <div class="article-header">
                使用者管理
            </div>
            <div class="article-content">
                <div class="article-content-body">
                    <div class="title">
                        <i class="ion-information-circled"></i>
                        修改密碼
                    </div>
                    <div class="i-form mt1">
                        <div class="form-group">
                            <label class="i-label">帳號</label>
                            <input type="text" class="i-input" id="admin" disabled>
                        </div>
                        <div class="form-group">
                            <label class="i-label">輸入舊密碼</label>
                            <input type="password" class="i-input" id="old_pw">
                        </div>
                        <div class="form-group">
                            <label class="i-label">輸入新密碼</label>
                            <input type="password" class="i-input" id="new_pw">
                        </div>
                        <div class="form-group">
                            <label class="i-label">驗證新密碼</label>
                            <input type="password" class="i-input" id="new_pw_r">
                        </div>
                        <div class="form-group form-bottom">
                            <button type="button" class="i-btn i-btn-primary" onclick="send_data()">
                                更新
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var admin =$('#admin');
    var pw = '';
    var o_pw = $('#old_pw');
    var n_pw = $('#new_pw');
    var n_pw_r = $('#new_pw_r');

    $( document ).ready(function() {
        setMenu('li_user', '');
        getData();
    });

    function getData(){
        $.ajax({
            url: "[! route('ma.user.data') !]",
            type:'GET',
            dataType: "json",
            data: {},
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    admin.val(response['data']['login_name']);
                    pw = response['data']['login_pw'];
                }
            }
        });
    }

    //上傳資料
    var is_send = false;
    function send_data()
    {
        if(!is_send && chkInput()){
            is_send = true;
            $.ajax({
                url: "[! route('ma.user.update') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    new_pw:$('#new_pw').val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true){
                         alert(response['msg']);
                    }
                    clearData();
                    is_send = false;
                }
            });
        }
    }

    function chkInput(){
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

    /**
     * 重製輸入區
     */
    function clearData() {
        o_pw.val('');
        n_pw.val('');
        n_pw_r.val('');
    }
</script>
@stop