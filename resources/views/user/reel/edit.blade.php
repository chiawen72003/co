@extends('user.layout.test')
@section('content')
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
    [! Html::script('js/jquery-1.11.3.js') !]
    <script>
        $( document ).ready(function() {
            getData();
        });

        function getData() {
            $.ajax({
                url: "[! route('ur.reel.data') !]",
                type:'GET',
                dataType: "json",
                data: {
                    'id':'[! $id !]'
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    console.log(response);
                    if(response['status'] == true){
                        for(var x=0;x<response['data'].length;x++){
                            reel_item.push(
                                {
                                    'reel_id':response['data'][x]['reel_id'],
                                    'reel_title':response['data'][x]['reel_title'],
                                }
                            );
                        }
                    }
                }
            });
        }

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
    <div class="chapter-body" id="obj_1" style="display: none">
        <div class="chapter-content-wrap">
            <div class="chapter-content-title">
                敘述性寫作題組評分標準表：
            </div>
            <div class="chapter-content">
                <div class="chapter-content-article-left">
                    <p>內容假文不要太認真</p>
                    <p>連果理前底們覺無教商</p>
                    <p>見長保政家斷不照種他請出，演命校年全必日明文一們結北解、爸過時期所……男開高領有新西師：孩有內車前史生家道……唱生無此車化時汽至得看血心務定接火花再施我中事活演列雙沒組看如都史助我認有為紙別如民，力中件人：如西到現率外走完能我不，假先不一出遊平想成病有設遠實我紀高或人學叫。</p>
                    <p>差大意回在那球方，土大人和成期自定修多新日不說、英人民！十工氣導？一們理化。安部光知：劇超什人叫，皮建來王驚往人任不它個，這說他後兩的因子事上毛量技市世助方。道臺去回兩海現著和的喜童會會身這來時還考知方優後覺下自法證月專動洋條不顧天關經成快知前晚風期害機手兒顯讀老港界小實至同西。不有開，一巴空起近可子五象重轉升長說成角是感足廣部子球當車記樣舞千年跟使回在油中是解特是洲願麼務：不找吃山，導戰白陽年感開滿不種經年，義星終定頭即論樂分還省取？朋發口廣想亮那與景家思；個下作象操意待星不時無響。利以層場中今要國事少美代一來獨要人花我考！它開到一課價品著友我考！它開到一課價品著友我考！它開到一課價品著友價</p>
                </div>
                <div class="chapter-content-page">
                    <ul class="i-pages">
                        <li><a href="" class="i-link"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                        <li class="current"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="" class="i-link">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="chapter-content-wrap">
            <div class="chapter-content-title">
                1. 請輸入..
            </div>
            <div class="chapter-content" style="border-top: 0;">
                <div class="chapter-content-article-right">
                    <div style="height:50px">放置全形標點符號位置, 高度50px</div>
                    <div class="textarea-wrap">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);"></div>
                    </div>
                    <div class="chapter-content-page">
                        <ul class="row">
                            <li>
                                已輸入
                                <input type="text" class="i-input" style="width: 40px" value="500" disabled>
                                字
                            </li>
                            <li class="right pos-right">
                                <div class="form-inline">
                                    返回第
                                    <input type="text" class="i-input" style="width: 40px">
                                    題
                                </div>
                                <div class="form-inline">
                                    <button class="i-btn">上一題</button>
                                    <button class="i-btn">下一題</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chapter-body" id="obj_2" style="display: none">
        <div class="chapter-content-wrap">
            <div class="chapter-content-title">
                敘述性寫作題組評分標準表：
            </div>
            <div class="chapter-content">
                <div class="chapter-content-article-left">
                    <p>內容假文不要太認真</p>
                    <p>連果理前底們覺無教商</p>
                    <p>見長保政家斷不照種他請出，演命校年全必日明文一們結北解、爸過時期所……男開高領有新西師：孩有內車前史生家道……唱生無此車化時汽至得看血心務定接火花再施我中事活演列雙沒組看如都史助我認有為紙別如民，力中件人：如西到現率外走完能我不，假先不一出遊平想成病有設遠實我紀高或人學叫。</p>
                    <p>差大意回在那球方，土大人和成期自定修多新日不說、英人民！十工氣導？一們理化。安部光知：劇超什人叫，皮建來王驚往人任不它個，這說他後兩的因子事上毛量技市世助方。道臺去回兩海現著和的喜童會會身這來時還考知方優後覺下自法證月專動洋條不顧天關經成快知前晚風期害機手兒顯讀老港界小實至同西。不有開，一巴空起近可子五象重轉升長說成角是感足廣部子球當車記樣舞千年跟使回在油中是解特是洲願麼務：不找吃山，導戰白陽年感開滿不種經年，義星終定頭即論樂分還省取？朋發口廣想亮那與景家思；個下作象操意待星不時無響。利以層場中今要國事少美代一來獨要人花我考！它開到一課價品著友我考！它開到一課價品著友我考！它開到一課價品著友價</p>
                </div>
                <div class="chapter-content-page">
                    <ul class="i-pages">
                        <li><a href="" class="i-link"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                        <li class="current"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="" class="i-link">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="chapter-content-wrap">
            <div class="chapter-content-title">
                1. 作者主張應詢問外島居民的立場，尊重他們的聲音，你是否贊同此觀點？<br>
                請你結合文中資訊，說明你同意或不同意的理由。<br>
                (請點選<a href="">同意</a>或<a href="">不同意</a>，150字為限，5分)
            </div>
            <div class="chapter-content" style="border-top: 0;">
                <div class="chapter-content-article-right">
                    <div style="height:50px">放置全形標點符號位置, 高度50px</div>
                    <div class="textarea-wrap textarea-wrap2">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);"></div>
                    </div>
                    <div class="textarea-wrap textarea-wrap2">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);"></div>
                    </div>
                    <div class="chapter-content-page">
                        <ul class="row">
                            <li>
                                已輸入
                                <input type="text" class="i-input" style="width: 40px" value="500" disabled>
                                字
                            </li>
                            <li class="right pos-right">
                                <div class="form-inline">
                                    返回第
                                    <input type="text" class="i-input" style="width: 40px">
                                    題
                                </div>
                                <div class="form-inline">
                                    <button class="i-btn">上一題</button>
                                    <button class="i-btn">下一題</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chapter-body" id="obj_3" style="display: none">
        <div class="chapter-content-wrap">
            <div class="chapter-content-title">
                敘述性寫作題組評分標準表：
            </div>
            <div class="chapter-content">
                <div class="chapter-content-article-left">
                    <p>內容假文不要太認真</p>
                    <p>連果理前底們覺無教商</p>
                    <p>見長保政家斷不照種他請出，演命校年全必日明文一們結北解、爸過時期所……男開高領有新西師：孩有內車前史生家道……唱生無此車化時汽至得看血心務定接火花再施我中事活演列雙沒組看如都史助我認有為紙別如民，力中件人：如西到現率外走完能我不，假先不一出遊平想成病有設遠實我紀高或人學叫。</p>
                    <p>差大意回在那球方，土大人和成期自定修多新日不說、英人民！十工氣導？一們理化。安部光知：劇超什人叫，皮建來王驚往人任不它個，這說他後兩的因子事上毛量技市世助方。道臺去回兩海現著和的喜童會會身這來時還考知方優後覺下自法證月專動洋條不顧天關經成快知前晚風期害機手兒顯讀老港界小實至同西。不有開，一巴空起近可子五象重轉升長說成角是感足廣部子球當車記樣舞千年跟使回在油中是解特是洲願麼務：不找吃山，導戰白陽年感開滿不種經年，義星終定頭即論樂分還省取？朋發口廣想亮那與景家思；個下作象操意待星不時無響。利以層場中今要國事少美代一來獨要人花我考！它開到一課價品著友我考！它開到一課價品著友我考！它開到一課價品著友價</p>
                </div>
                <div class="chapter-content-page">
                    <ul class="i-pages">
                        <li><a href="" class="i-link"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                        <li class="current"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="" class="i-link">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="chapter-content-wrap">
            <div class="chapter-content-title">
                1. 文章中對於蘭嶼...<br>
                兩行測試<br>
            </div>
            <div class="chapter-content" style="border-top: 0;">
                <div class="chapter-content-article-right">
                    <div style="height:50px">放置全形標點符號位置, 高度50px</div>
                    <div class="textarea-wrap textarea-wrap3">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);">正方：</div>
                    </div>
                    <div class="textarea-wrap textarea-wrap3">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);">反方：</div>
                    </div>
                    <div class="textarea-wrap textarea-wrap3">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);">因應之道：</div>
                    </div>
                    <div class="chapter-content-page">
                        <ul class="row">
                            <li>
                                已輸入
                                <input type="text" class="i-input" style="width: 40px" value="500" disabled>
                                字
                            </li>
                            <li class="right pos-right">
                                <div class="form-inline">
                                    返回第
                                    <input type="text" class="i-input" style="width: 40px">
                                    題
                                </div>
                                <div class="form-inline">
                                    <button class="i-btn">上一題</button>
                                    <button class="i-btn">下一題</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chapter-body" id="obj_4" style="display: none">
        <div class="chapter-content-wrap">
            <div class="chapter-content-title">
                敘述性寫作題組評分標準表：
            </div>
            <div class="chapter-content">
                <div class="chapter-content-article-left">
                    <p>內容假文不要太認真</p>
                    <p>連果理前底們覺無教商</p>
                    <p>見長保政家斷不照種他請出，演命校年全必日明文一們結北解、爸過時期所……男開高領有新西師：孩有內車前史生家道……唱生無此車化時汽至得看血心務定接火花再施我中事活演列雙沒組看如都史助我認有為紙別如民，力中件人：如西到現率外走完能我不，假先不一出遊平想成病有設遠實我紀高或人學叫。</p>
                    <p>差大意回在那球方，土大人和成期自定修多新日不說、英人民！十工氣導？一們理化。安部光知：劇超什人叫，皮建來王驚往人任不它個，這說他後兩的因子事上毛量技市世助方。道臺去回兩海現著和的喜童會會身這來時還考知方優後覺下自法證月專動洋條不顧天關經成快知前晚風期害機手兒顯讀老港界小實至同西。不有開，一巴空起近可子五象重轉升長說成角是感足廣部子球當車記樣舞千年跟使回在油中是解特是洲願麼務：不找吃山，導戰白陽年感開滿不種經年，義星終定頭即論樂分還省取？朋發口廣想亮那與景家思；個下作象操意待星不時無響。利以層場中今要國事少美代一來獨要人花我考！它開到一課價品著友我考！它開到一課價品著友我考！它開到一課價品著友價</p>
                </div>
                <div class="chapter-content-page">
                    <ul class="i-pages">
                        <li><a href="" class="i-link"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                        <li class="current"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="" class="i-link">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="chapter-content-wrap">
            <div class="chapter-content-title">
                1. 文章中對於蘭嶼...<br>
                兩行測試<br>
            </div>
            <div class="chapter-content" style="border-top: 0;">
                <div class="chapter-content-article-right">
                    <div style="height:50px">放置全形標點符號位置, 高度50px</div>
                    <div class="textarea-wrap textarea-wrap4">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);">正方：</div>
                    </div>
                    <div class="textarea-wrap textarea-wrap4">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);">反方：</div>
                    </div>
                    <div class="textarea-wrap textarea-wrap4">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);">因應之道：</div>
                    </div>
                    <div class="textarea-wrap textarea-wrap4">
                        <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);">因應之道：</div>
                    </div>
                    <div class="chapter-content-page">
                        <ul class="row">
                            <li>
                                已輸入
                                <input type="text" class="i-input" style="width: 40px" value="500" disabled>
                                字
                            </li>
                            <li class="right pos-right">
                                <div class="form-inline">
                                    返回第
                                    <input type="text" class="i-input" style="width: 40px">
                                    題
                                </div>
                                <div class="form-inline">
                                    <button class="i-btn">上一題</button>
                                    <button class="i-btn">下一題</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop