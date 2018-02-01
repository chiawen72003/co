<!DOCTYPE html>
<html class="reviewers">
<head>
    <meta charset="utf-8">
    <title>寫作閱卷標準手冊 | 大學生語文素養</title>
    [! Html::style('css/ionicons.min.css') !]
    [! Html::style('css/style.css') !]
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.4/datepicker.css">
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
                <span>身分：評閱委員</span>
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
    <div id="page-container">
        <div id="page-body" class="clearfix">
            <nav class="navigate">
                <ul class="mainnav">
                    <li id="li_manual">
                        <a href="[! route('rv.manual') !]">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            寫作閱卷標準手冊
                        </a>
                    </li>
                    <li id="li_precautions">
                        <a href="[! route('rv.precautions') !]">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            注意事項
                        </a>
                    </li>
                    <li id="li_scroll">
                        <a href="[! route('rv.scroll') !]">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            線上閱卷
                        </a>
                    </li>
                    <li id="li_statistics">
                        <a href="[! route('rv.statistics') !]">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            批改統計
                        </a>
                    </li>
                    <li id="li_user">
                        <a href="[! route('rv.user') !]">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            基本資料
                        </a>
                    </li>
                    <li id="li_files">
                        <a href="[! route('rv.files') !]">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            檔案下載
                        </a>
                    </li>
                </ul>
            </nav>
            @yield('content')
        </div>
    </div>
    <div id="page-footer"></div>
</div>
<script>
    $(document).ready(function(){
        $('.hs-sub').click(function(event) {
            var hsSub = $('.hs-sub');

            hsSub.not(this).each(function(index, el) {
                $(this).removeClass('is-opened');
            });

            $(this).toggleClass('is-opened');
        });
    });

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