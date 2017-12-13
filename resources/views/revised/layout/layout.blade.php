<!DOCTYPE html>
<html class="reviewers">
<head>
    <meta charset="utf-8">
    <title>寫作閱卷標準手冊 | 大學生語文素養</title>
    [! Html::style('css/ionicons.min.css') !]
    [! Html::style('css/style.css') !]
</head>
<body>
<div id="mainbody">
    <div id="page-header">
        <div class="page-header-left">
            大學生語文素養－寫作自動計分暨線上寫作測驗平台
        </div>
        <div class="page-header-right">
            <div class="setting-user">
                <i class="ion-ios-contact-outline"></i>
                <span>身分：評閱委員</span>
                <span>姓名：王名譽</span>
            </div>
            <div class="setting-logout">
                <a href="">
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
                        <a href="scroll.html">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            線上閱卷
                        </a>
                    </li>
                    <li id="li_statistics">
                        <a href="statistics.html">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            批改統計
                        </a>
                    </li>
                    <li id="li_user">
                        <a href="user.html">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            基本資料
                        </a>
                    </li>
                    <li id="li_files">
                        <a href="#">
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
</script>
</body>
</html>