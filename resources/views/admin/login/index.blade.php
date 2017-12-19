@extends('admin.layout.login')
@section('content')
    <div class="mem-wrap">
        <div class="mem-form">
            <div class="mem-group">
                <label>學校：</label>
                <select id="school_id">
                </select>
            </div>
            <div class="mem-group">
                <label>帳號：</label>
                <input type="text" class="i-input" id="loginName">
            </div>
            <div class="mem-group">
                <label>密碼：</label>
                <input type="password" class="i-input" id="loginPW">
            </div>
            <div class="mem-group mem-btn-wrap">
                <button class="i-btn" onclick="sendData()">登入</button>
            </div>
        </div>
    </div>
    <div class="news-wrap">
        <div class="table-wrapper">
            <table class="table">
                <tr>
                    <th width="120">
                        <div class="cell">日期</div>
                    </th>
                    <th>
                        <div class="cell">
                            最標題
                        </div>
                    </th>
                </tr>
                <tr>
                    <td><div class="cell">2017/12/12</div></td>
                    <td>
                        <div class="cell news-title"><a href="">最新消息標題測試很長,最新消息標題測試很長,最新消息標題測試很長,最新消息標題測試很長,</a></div>
                    </td>
                </tr>
                <tr>
                    <td><div class="cell">2017/12/12</div></td>
                    <td>
                        <div class="cell news-title"><a href="">最新消息標題</a></div>
                    </td>
                </tr>
                <tr>
                    <td><div class="cell">2017/12/12</div></td>
                    <td>
                        <div class="cell news-title"><a href="">最新消息標題</a></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="news-more right">
            <a href="#" class="i-link" onclick="window.open(' news.html ', '最新消息', config='height=550,width=720');">更多</a>
        </div>
    </div>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var school_id = $('#school_id');
    var loginName = $('#loginName');
    var loginPW = $('#loginPW');
    var school_item = [];
    $( document ).ready(function() {
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
                                'school_title':response['data'][x]['school_title']
                            }
                        );
                    }
                }
                setSchoolList();
            }
        });
    }

    function setSchoolList() {
        $("#school_id option").remove();
        for(var x=0;x<school_item.length;x++){
            school_id.append($("<option></option>").attr("value", school_item[x]['id']).text(school_item[x]['school_title']));
        }
    }

    var isSend = false;
    function sendData(){
        if(!isSend){
            $.ajax({
                url: "[! route('ma.login.chk') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    schoolId:school_id.val(),
                    loginName:loginName.val(),
                    loginPW:loginPW.val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
                        location.replace(response['redir']);
                    }else{
                        clearInput();
                        alert(response['msg']);
                    }
                    isSend = false;
                }
            });
            isSend = true;
        }
    }

    function clearInput() {
        loginPW.val('');
    }
</script>
@stop