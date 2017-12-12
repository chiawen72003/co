<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>iview example</title>
    [! Html::style('css/ionicons.min.css') !]
    [! Html::style('css/style.css') !]
    <script src="../js/jquery-1.11.3.js"></script>
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
                <span>姓名：王曉明</span>
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
                    <li id="li_index">
                        <a href="[! route('ur.index') !]">
                            <i class="mainnav-title-icon ion-android-home"></i>
                            首頁
                        </a>
                    </li>
                    <li>
                        <a href="papers.html">
                            <i class="mainnav-title-icon ion-ios-list"></i>
                            試卷管理
                        </a>
                    </li>
                    <li id="li_user">
                        <a href="[! route('ur.user') !]">
                            <i class="mainnav-title-icon ion-person"></i>
                            使用者管理
                        </a>
                    </li>
                </ul>
            </nav>
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>