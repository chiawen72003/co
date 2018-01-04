@extends('revised.layout.layout')
@section('content')
    <div class="article">
        <div class="article-header">
            線上閱卷
        </div>
        <div class="article-content">
            <div class="article-content-body">
                <div class="precautions i-alert-error">
                    <i class="ion-ios-information"></i>
                    每天首次登入批改，請先進行閱卷訓練。
                </div>
                <ul class="bigLink-list mt1 clearfix">
                    <li><a href="[! url('files/demo/樣卷.zip') !]">參考樣卷</a></li>
                    <li><a href="[! url('files/demo/閱卷訓練.zip') !]">閱卷訓練</a></li>
                    <li><a href="[! route('rv.scroll.reel.pg') !]">開始批改</a></li>
                </ul>
            </div>
        </div>
    </div>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_scroll');
    var current = 'current';
    $( document ).ready(function() {
        li_item.addClass( current);
    });
</script>
@stop