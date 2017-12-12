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
                <span>身份：評閱委員</span>
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
            <div class="time-wrap">
                <div class="time">
                    剩餘測驗時間: 59 分 57 秒
                </div>
            </div>
            <div class="chapter">
                <div class="chapter-header i-alert-info">
                    <span>學校：國立臺中教育大學</span>
                    <span>身份：學生</span>
                    <span>學號：ASC106102</span>
                    <span>姓名：王曉明</span>
                </div>
                <div class="chapter-container" id="test_area">

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //控制只能輸入全形的值
    function onKeyPress_(event)
    {
        if(event.which == 13 ){
            return true;
        }
        if (event.which && (event.which > 126 || event.which < 33) ) {
            event.preventDefault();
            return true;
        }
        return false;
    }
</script>
</body>
</html>