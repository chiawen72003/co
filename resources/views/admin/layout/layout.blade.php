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
            大學生語文素養－寫作自動計分暨線上寫作測驗平台
        </div>
        <div class="page-header-right">
            <div class="setting-user">
                <i class="ion-ios-contact-outline"></i>
                身分：總管理者
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
                    <li id="li_school_subject">
                        <a href="[! route('ma.subject') !]">
                            <i class="mainnav-title-icon ion-android-add-circle"></i>
                            新增學校/科系
                        </a>
                    </li>
                    <li class="is-opened" >
                        <a href="">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            管理使用者
                            <i class="mainnav-arrow ion-ios-arrow-down"></i>
                        </a>
                        <ul class="mainnav-sub">
                            <li id="li_school"><a href="[! route('ma.school') !]">匯入學校/代碼</a></li>
                            <li id="li_member"><a href="">查詢/編輯使用者資料</a></li>
                        </ul>
                    </li>
                    <li id="li_course">
                        <a href="[! route('ma.course') !]">
                            <i class="mainnav-title-icon ion-ios-calculator"></i>
                            課程設定
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="mainnav-title-icon ion-ios-star"></i>
                            作答結果查詢
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="mainnav-title-icon ion-ios-pause-outline"></i>
                            試題結構控制
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="mainnav-title-icon ion-ios-albums-outline"></i>
                            題庫管理
                            <i class="mainnav-arrow ion-ios-arrow-down"></i>
                        </a>
                        <ul class="mainnav-sub">
                            <li id="li_unit"><a href="[! route('ma.unit') !]">建立單元結構</a></li>
                            <li id="li_reel"><a href="[! route('ma.reel') !]">新增試卷</a></li>
                            <li id="li_member"><a href="">新增試題</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="">
                            <i class="mainnav-title-icon ion-ios-book-outline"></i>
                            批改管理
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="mainnav-title-icon ion-person"></i>
                            修改個人資訊
                        </a>
                    </li>
                </ul>
            </nav>
            @yield('content')

        </div>
    </div>
    <div id="page-footer"></div>
</div>
</body>
</html>