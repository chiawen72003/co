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
    <div style="display: none">
        <div class="chapter-body" id="obj_1" >
            <div class="chapter-content-wrap">
                <div class="chapter-content-title">
                    敘述性寫作題組評分標準表：
                </div>
                <div class="chapter-content">
                    <div class="chapter-content-article-left" id="obj_1_dsc">
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
                <div class="chapter-content-title" id="obj_1_title">
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
                                    <input type="text" class="i-input" style="width: 40px" value="0" disabled id="obj_1_count">
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
        <div class="chapter-body" id="obj_2">
            <div class="chapter-content-wrap">
                <div class="chapter-content-title">
                    敘述性寫作題組評分標準表：
                </div>
                <div class="chapter-content">
                    <div class="chapter-content-article-left" id="obj_2_dsc">
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
                <div class="chapter-content-title" >
                    <br id="obj_2_title">
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
                                    <input type="text" class="i-input" style="width: 40px" value="500" disabled id="obj_2_count">
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
        <div class="chapter-body" id="obj_3">
            <div class="chapter-content-wrap">
                <div class="chapter-content-title">
                    敘述性寫作題組評分標準表：
                </div>
                <div class="chapter-content">
                    <div class="chapter-content-article-left" id="obj_3_dsc">
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
                <div class="chapter-content-title" id="obj_3_title">
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
                                    <input type="text" class="i-input" style="width: 40px" value="500" disabled id="obj_3_count">
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
        <div class="chapter-body" id="obj_4">
            <div class="chapter-content-wrap">
                <div class="chapter-content-title">
                    敘述性寫作題組評分標準表：
                </div>
                <div class="chapter-content">
                    <div class="chapter-content-article-left" id="obj_4_dsc">
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
                <div class="chapter-content-title" id="obj_4_title">
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
                                    <input type="text" class="i-input" style="width: 40px" value="500" disabled id="obj_4_count">
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
    </div>
    <script>
        var question_item = [];
        var obj_1 = $('#obj_1');
        var obj_2 = $('#obj_2');
        var obj_3 = $('#obj_3');
        var obj_4 = $('#obj_4');
        var test_area = $('#test_area');
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
                    if(response['status'] == true){
                        for(var x=0;x<response['data'].length;x++){
                            question_item.push(
                                {
                                    'id':response['data'][x]['id'],
                                    'question_title':response['data'][x]['question_title'],
                                    'type':response['data'][x]['type'],
                                    'type_title':response['data'][x]['type_title'],
                                    'dsc':response['data'][x]['dsc']
                                }
                            );
                        }
                    }
                    setList();
                }
            });
        }

        function setList() {
            var div_total=0;
            for(var x=0;x<question_item.length;x++)
            {
                if(question_item[x]['type'] == 1){
                    var t = obj_1.clone();
                    t.find('#obj_1_dsc').html(question_item[x]['dsc']).removeAttr('id');
                    t.find('#obj_1_title').html(question_item[x]['question_title']).removeAttr('id');
                    t.find('#obj_1_count').attr('id', 'write_'+x+'_count');
                    t.find('#textarea').each(function(){
                        $(this).attr('name', 'write_'+div_total+'_text');
                        div_total++;
                    });
                    t.attr('id','write_'+x);
                    if(x > 0){
                     t.hide();
                    }
                    test_area.append(t);
                }
                if(question_item[x]['type'] == 2){
                    var t = obj_2.clone();
                    t.find('#obj_2_dsc').html(question_item[x]['dsc']).removeAttr('id');
                    t.find('#obj_2_title').before(question_item[x]['question_title']).removeAttr('id');
                    t.find('#obj_2_count').attr('id', 'write_'+x+'_count');
                    t.find('#textarea').each(function(){
                        $(this).attr('name', 'write_'+div_total+'_text');
                        div_total++;
                    });
                    t.attr('id','write_'+x);
                    if(x > 0){
                        //t.hide();
                    }
                    test_area.append(t);
                }
                if(question_item[x]['type'] == 3){
                    var t = obj_3.clone();
                    t.find('#obj_3_dsc').html(question_item[x]['dsc']).removeAttr('id');
                    t.find('#obj_3_title').before(question_item[x]['question_title']).removeAttr('id');
                    t.find('#obj_3_count').attr('id', 'write_'+x+'_count');
                    t.find('#textarea').each(function(){
                        $(this).attr('name', 'write_'+div_total+'_text');
                        div_total++;
                    });
                    t.attr('id','write_'+x);
                    if(x > 0){
                        //t.hide();
                    }
                    test_area.append(t);
                }
                if(question_item[x]['type'] == 4){
                    var t = obj_4.clone();
                    t.find('#obj_4_dsc').html(question_item[x]['dsc']).removeAttr('id');
                    t.find('#obj_4_title').before(question_item[x]['question_title']).removeAttr('id');
                    t.find('#obj_4_count').attr('id', 'write_'+x+'_count');
                    t.find('#textarea').each(function(){
                        $(this).attr('name', 'write_'+div_total+'_text');
                        div_total++;
                    });
                    t.attr('id','write_'+x);
                    if(x > 0){
                        //t.hide();
                    }
                    test_area.append(t);
                }
            }
            //文字輸入區綁定計算字數的功能
            for(var x=0;x<div_total;x++){
                $("div[name='write_"+x+"_text']").bind("DOMSubtreeModified",function(){
                    reCount();
                });
            }
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

        //重新計算所有DIV的字數
        function reCount() {
            for(var x=0;x<question_item.length;x++)
            {
                var t = $('#write_'+x).clone();
                var total =0;
                t.find('#textarea').each(function(){
                    total = total + $(this).text().length;
                });

                $('#write_'+x+'_count').val(total);
            }
        }
    </script>
@stop