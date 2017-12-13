@extends('revised.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        寫作閱卷標準手冊
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <a href="" class="i-btn i-btn-primary">功能性寫作</a>
            <a href="" class="i-btn">批判性寫作</a>
            <a href="" class="i-btn">敘述性寫作</a>
        </div>
        <div class="article-content-body">
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
                        <td><div class="cell">離開校園、走進..</div></td>
                        <td>
                            <div class="cell center"><a href="unit-problem-edit.html" class="i-link"><i class="ion-arrow-down-c"></i>前往下載</a></div>
                        </td>
                    </tr>
                    <!-- 重複 -->
                    <tr>
                        <td><div class="cell">題組1</div></td>
                        <td><div class="cell">離開校園、走進..</div></td>
                        <td>
                            <div class="cell center"><a href="unit-problem-edit.html" class="i-link"><i class="ion-arrow-down-c"></i>前往下載</a></div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="cell">題組1</div></td>
                        <td><div class="cell">離開校園、走進..</div></td>
                        <td>
                            <div class="cell center"><a href="unit-problem-edit.html" class="i-link"><i class="ion-arrow-down-c"></i>前往下載</a></div>
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
</script>
@stop