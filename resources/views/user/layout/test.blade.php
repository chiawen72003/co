<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>iview example</title>
    [! Html::style('css/ionicons.min.css') !]
    [! Html::style('css/style.css') !]
</head>
<body>
<div id="mainbody">
    <div id="page-header">
        <div class="page-header-left">
            大學生語文素養－線上寫作測驗平台
        </div>
        <div class="page-header-right">
            <div class="setting-user">
                <i class="ion-ios-contact-outline"></i>
                <span>身份：學生</span>
                <span>姓名：[! $user_name !]</span>
            </div>
            <div class="setting-logout">
                <a onclick="logout()">
                    <i class="ion-log-out"></i>
                    登出
                </a>
            </div>
        </div>
    </div>
    @yield('content')
</div>
<script>
    function logout() {
        $.ajax({
            url: "[! route('member.logout') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response)
            {
                if(response['status'] == true)
                {
                    alert(response['msg']);
                    location.replace(response['redir']);
                }
            }
        });
    }
</script>

</body>
</html>