@extends('revised.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        注意事項
    </div>
    <div class="article-content">
        <div class="article-content-body">
            <p>假文開始</p>
            <p>數只文這狀人之後，自天聞！研有非，灣傳己國後太水念目道己人天真的同史是大積遊達意沒據到。畫人重？然多觀的美學必目風種高上決電輪代裡引老……門只家冷的改不，合命一科的把記境期不，檢心落多過大獨國政消地活！舉人節的條各你一小兒。</p>
            <p>過母品存種一在。一對型裡，傷情是作，世響家我學。</p>
            <p>步車是證，顯下開軍來想灣，興巴車作華我反論部投動人原不生歷學們大意十曾發得馬然十屋幾集！本正未來在鄉爭。統法相動國遠在目作動保中小廣眾象後最該。</p>
        </div>
    </div>
</div>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_precautions');
    var current = 'current';
    $( document ).ready(function() {
        li_item.addClass( current);
    });
</script>
@stop