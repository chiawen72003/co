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
                身分：總管理者
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
                    <li class="hs-sub" id="main_li_1" >
                        <a href="#">
                            <i class="mainnav-title-icon ion-ios-people"></i>
                            管理使用者
                            <i class="mainnav-arrow ion-ios-arrow-down"></i>
                        </a>
                        <ul class="mainnav-sub">
                            <li id="li_classes"><a href="[! route('ma.school') !]">新增學校/班級</a></li>
                            <li id="li_member"><a href="[! route('ma.student') !]">查詢/編輯使用者資料</a></li>
                        </ul>
                    </li>
                    <li class="hs-sub" id="main_li_2">
                        <a href="#">
                            <i class="mainnav-title-icon ion-ios-calculator"></i>
                            課程設定
                            <i class="mainnav-arrow ion-ios-arrow-down"></i>
                        </a>
                        <ul class="mainnav-sub">
                            <li id="li_course"><a href="[! route('ma.course') !]">新增課程</a></li>
                            <li id="li_course_student"><a href="[! route('ma.course.student') !]">課程與班級對應</a></li>
                            <li id="li_course_reel"><a href="[! route('ma.course.reel') !]">試卷與班級存取控制</a></li>
                        </ul>
                    </li>
                    <li id="li_reel_analysis">
                        <a href="[! route('ma.reel.analysis') !]">
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
                    <li class="hs-sub" id="main_li_3">
                        <a href="#" >
                            <i class="mainnav-title-icon ion-ios-albums-outline"></i>
                            題庫管理
                            <i class="mainnav-arrow ion-ios-arrow-down"></i>
                        </a>
                        <ul class="mainnav-sub">
                            <li id="li_unit"><a href="[! route('ma.unit') !]">單元結構管理</a></li>
                            <li id="li_reel"><a href="[! route('ma.reel') !]">試卷管理</a></li>
                            <li id="li_question"><a href="[! route('ma.question') !]">試題管理</a></li>
                        </ul>
                    </li>
                    <li class="hs-sub" id="main_li_4">
                        <a href="#">
                            <i class="mainnav-title-icon ion-ios-book-outline"></i>
                            批改管理
                            <i class="mainnav-arrow ion-ios-arrow-down"></i>
                        </a>
                        <ul class="mainnav-sub">
                            <li id="li_revised"><a href="[! route('ma.revised') !]">評閱者資料管理</a></li>
                            <li id="li_reel_modify"><a href="[! route('ma.revised.reel') !]">派卷管理</a></li>
                        </ul>
                    </li>
                    <li id="li_precautions">
                        <a href="[! route('ma.precautions') !]">
                            <i class="mainnav-title-icon ion-android-alert"></i>
                            設定注意事項
                        </a>
                    </li>
                    <li id="li_files">
                        <a href="[! route('ma.files') !]">
                            <i class="mainnav-title-icon ion-android-archive"></i>
                            下載檔案管理
                        </a>
                    </li>
                    <li id="li_user">
                        <a href="[! route('ma.user') !]">
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
    <script>
        var li_item,menu_item;
        var current = 'current';
        var is_opened = 'is-opened';

        $(document).ready(function(){
            $('.hs-sub').click(function(event) {
                var hsSub = $('.hs-sub');

                hsSub.not(this).each(function(index, el) {
                    $(this).removeClass('is-opened');
                });

                $(this).toggleClass('is-opened');
            });
        });

        function setMenu(li, menu) {
            if(li != ''){
                li_item = $('#'+li);
                li_item.addClass( current);
            }
            if(menu != ''){
                menu_item = $('#'+menu);
                menu_item.addClass(is_opened);
            }
        }
        
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
</div>
</body>
</html>