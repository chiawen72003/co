@extends('revised.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        寫作閱卷標準手冊
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <a href="#" onclick="menuChange(1)" id="a_1" class="i-btn i-btn-primary">功能性寫作</a>
            <a href="#" onclick="menuChange(2)" id="a_2" class="i-btn">批判性寫作</a>
            <a href="#" onclick="menuChange(3)" id="a_3" class="i-btn">敘述性寫作</a>
        </div>
        <div class="article-content-body" id="menu_1">
            <div class="title">
                <i class="ion-information-circled"></i>
                功能性寫作
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <tr>
                        <th width="100">
                            <div class="cell">題組</div>
                        </th>
                        <th>
                            <div class="cell">單元名稱</div>
                        </th>
                        <th width="120">
                            <div class="cell center">功能</div>
                        </th>
                    </tr>
                    <tr>
                        <td><div class="cell">題組1</div></td>
                        <td><div class="cell">106(上)全國檢測寫作評分標準_功能性寫作</div></td>
                        <td>
                            <div class="cell center"><a href="[! url('files/menu/106(上)全國檢測寫作評分標準_功能性寫作.docx') !]" class="i-link" target="_blank"><i class="ion-arrow-down-c"></i>前往下載</a></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="article-content-body" id="menu_2" style="display: none">
            <div class="title">
                <i class="ion-information-circled"></i>
                批判性寫作
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <tr>
                        <th width="100">
                            <div class="cell">題組</div>
                        </th>
                        <th>
                            <div class="cell">單元名稱</div>
                        </th>
                        <th width="120">
                            <div class="cell center">功能</div>
                        </th>
                    </tr>
                    <tr>
                        <td><div class="cell">題組1</div></td>
                        <td><div class="cell">106(上)全國檢測寫作評分標準_批判性寫作</div></td>
                        <td>
                            <div class="cell center"><a href="[! url('files/menu/106(上)全國檢測寫作評分標準_批判性寫作.docx') !]" class="i-link" target="_blank"><i class="ion-arrow-down-c"></i>前往下載</a></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="article-content-body" id="menu_3" style="display: none">
            <div class="title">
                <i class="ion-information-circled"></i>
                敘述性寫作
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <tr>
                        <th width="100">
                            <div class="cell">題組</div>
                        </th>
                        <th>
                            <div class="cell">單元名稱</div>
                        </th>
                        <th width="120">
                            <div class="cell center">功能</div>
                        </th>
                    </tr>
                    <tr>
                        <td><div class="cell">題組1</div></td>
                        <td><div class="cell">106(上)全國檢測寫作評分標準_敘事性寫作</div></td>
                        <td>
                            <div class="cell center"><a href="[! url('files/menu/106(上)全國檢測寫作評分標準_敘事性寫作.docx') !]" class="i-link" target="_blank"><i class="ion-arrow-down-c"></i>前往下載</a></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_manual');
    var current = 'current';
    $( document ).ready(function() {
        li_item.addClass( current);
    });

    var setMenu = 'i-btn-primary';
    function menuChange(id) {
        for(var x=1;x<4;x++){
            if(x == id){
                $('#a_'+x).addClass(setMenu);
                $('#menu_'+x).show();
            }else{
                $('#a_'+x).removeClass(setMenu);
                $('#menu_'+x).hide();
            }
        }
    }

</script>
@stop