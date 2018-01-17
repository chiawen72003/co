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
                    <span>學校：[! $school_title !]</span>
                    <span>身份：學生</span>
                    <span>學號：[! $student_id !]</span>
                    <span>姓名：[! $user_name !]</span>
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
                    <div class="chapter-content-article-left" id="dsc">
                    </div>
                    <div class="chapter-content-page">
                        <ul class="i-pages">
                            <li><a onclick="" class="i-link prev"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                            <li><a onclick="" class="i-link next">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chapter-content-wrap">
                <div class="chapter-content-title" id="title">
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
                                    <input type="text" class="i-input" style="width: 40px" value="0" disabled id="count">
                                    字
                                </li>
                                <li class="right pos-right">
                                    <div class="form-inline" style="display: none">
                                        返回第
                                        <input type="text" class="i-input" style="width: 40px">
                                        題
                                    </div>
                                    <div class="form-inline">
                                        <button class="i-btn" id="bt_up">上一題</button>
                                        <button class="i-btn" id="bt_down">下一題</button>
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
                    <div class="chapter-content-article-left" id="dsc">
                    </div>
                    <div class="chapter-content-page">
                        <ul class="i-pages">
                            <li><a href="" class="i-link"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                            <li><a href="" class="i-link">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chapter-content-wrap">
                <div class="chapter-content-title" >
                    <br id="title">
                    (請點選
                    <div class="form-inline checkbox-group">
                        <input type="radio" id="radio1" name="agree" value="0" checked />
                        <label for="radio1" name="radio">同意</label>
                    </div>或<div class="form-inline checkbox-group">
                        <input type="radio" id="radio2" name="agree" value="1" />
                        <label for="radio2" name="radio">不同意</label>
                        </div>，150字為限，5分)
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
                                    <input type="text" class="i-input" style="width: 40px" value="0" disabled id="count">
                                    字
                                </li>
                                <li class="right pos-right">
                                    <div class="form-inline" style="display: none">
                                        返回第
                                        <input type="text" class="i-input" style="width: 40px">
                                        題
                                    </div>
                                    <div class="form-inline">
                                        <button class="i-btn" id="bt_up">上一題</button>
                                        <button class="i-btn" id="bt_down">下一題</button>
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
                    <div class="chapter-content-article-left" id="dsc">
                    </div>
                    <div class="chapter-content-page">
                        <ul class="i-pages">
                            <li><a href="" class="i-link"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                            <li><a href="" class="i-link">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chapter-content-wrap">
                <div class="chapter-content-title" id="title">
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
                                    <input type="text" class="i-input" style="width: 40px" value="0" disabled id="count">
                                    字
                                </li>
                                <li class="right pos-right">
                                    <div class="form-inline" style="display: none">
                                        返回第
                                        <input type="text" class="i-input" style="width: 40px">
                                        題
                                    </div>
                                    <div class="form-inline">
                                        <button class="i-btn" id="bt_up">上一題</button>
                                        <button class="i-btn" id="bt_down">下一題</button>
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
                    <div class="chapter-content-article-left" id="dsc">
                    </div>
                    <div class="chapter-content-page">
                        <ul class="i-pages">
                            <li><a href="" class="i-link"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                            <li><a href="" class="i-link">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chapter-content-wrap">
                <div class="chapter-content-title" id="title">
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
                                    <input type="text" class="i-input" style="width: 40px" value="0" disabled id="count">
                                    字
                                </li>
                                <li class="right pos-right">
                                    <div class="form-inline" style="display: none">
                                        返回第
                                        <input type="text" class="i-input" style="width: 40px">
                                        題
                                    </div>
                                    <div class="form-inline">
                                        <button class="i-btn" id="bt_up">上一題</button>
                                        <button class="i-btn" id="bt_down">下一題</button>
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
        var obj_1 = $('#obj_1');//輸入區模組1
        var obj_2 = $('#obj_2');//輸入區模組2
        var obj_3 = $('#obj_3');//輸入區模組3
        var obj_4 = $('#obj_4');//輸入區模組4
        var test_area = $('#test_area');
        $( document ).ready(function() {
            getData();
        });

        /**
         *  試卷內所有的資料
         */
        var max_quations = 0;
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
                            //先將所有試題內的小題都展開成物件資料
                            var temp_item = response['data'][x];
                            for(var z=0;z<temp_item['type'].length;z++){
                                max_quations++;
                                question_item.push(
                                    {
                                        'id':temp_item['id'],
                                        'question_title':temp_item['question_title'][z],
                                        'type':temp_item['type'][z],
                                        'type_title':temp_item['type_title'][z],
                                        'dsc':temp_item['dsc'],
                                        'max_score':temp_item['max_score'][z],
                                    }
                                );
                            }
                        }
                    }
                    setList();
                }
            });
        }

        /**
         * 1. dsc => 閱讀內容
         * 2. title => 試題標題
         * 3. count => 輸入字數加總
         * 4. textarea => 文字輸入區，綁定文字計算總數的功能
         * 5. bt_up => 上一頁按鈕
         * 6. bt_down => 下一頁按鈕
         */
        function setList() {
            var div_total=0;
            for(var z=0;z<question_item.length;z++){
                var t;
                if(question_item[z]['type'] == 1){
                    t = obj_1.clone();
                }
                if(question_item[z]['type'] == 2){
                    t = obj_2.clone();
                }
                if(question_item[z]['type'] == 3){
                    t = obj_3.clone();
                }
                if(question_item[z]['type'] == 4){
                    t = obj_4.clone();
                }
                //試題標題
                if(question_item[z]['type'] == 2){
                    t.find('#title').after(question_item[z]['question_title']).removeAttr('id');
                }else{
                    t.find('#title').html(question_item[z]['question_title']).removeAttr('id');
                }
                //試題內容
                t.find('#dsc').html(question_item[z]['dsc']).attr('id','dsc_'+z);
                //使用者在每一個試題內打字的總數量
                t.find('#count').attr('id', 'write_'+z+'_count');
                //試題輸入區
                t.find('#textarea').each(function(){
                    $(this).attr('name', 'write_'+div_total+'_text');
                    div_total++;
                });
                //上一試題按鈕
                if(z == 0){
                    t.find('#bt_up').hide().removeAttr('id');
                }else{
                    var t_num = z - 1;
                    t.find('#bt_up').attr('onclick', 'page_change("'+ t_num +'")');
                }
                //下一試題按鈕
                if((z+1) == max_quations){
                    t.find('#bt_down').html('送出').attr('onclick', 'send_data()').removeAttr('id');
                }else{
                    t.find('#bt_down').attr('onclick', 'page_change("'+ (z+1) +'")').removeAttr('id');
                }
                t.attr('id','write_'+z);
                if(z > 0){
                    t.hide();
                }
                test_area.append(t);
            }

            //文字輸入區綁定計算字數的功能
            for(var x=0;x<div_total;x++){
                $("div[name='write_"+x+"_text']").bind("DOMSubtreeModified",function(){
                    reCount();
                });
            }
            checkCtrl();
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
            for(var x=0;x<max_quations;x++)
            {
                var t = $('#write_'+x).clone();
                var total =0;
                t.find('#textarea').each(function(){
                    total = total + $(this).text().length;
                });

                $('#write_'+x+'_count').val(total);
            }
        }

        //試題切換
        function page_change(num)
        {
            for(var x=0;x<max_quations;x++)
            {
                if(num == x){
                    $('#write_'+x).show();
                }else{
                    $('#write_'+x).hide();
                }
            }
            $section = $('#dsc_'+x);
        }

        //上傳資料
        var is_send = false;
        var add_data = [];
        var questions_id = [];
        function send_data()
        {
            if(!is_send){
                for(var x=0;x<question_item.length;x++)
                {
                    var t = $('#write_'+x);
                    var temp_data = [];
                    var agree = 0;
                    if(question_item[x]['type'] == 2){
                        agree=t.find('input[name="agree"]:checked').val();
                    }
                    t.find('#textarea').each(function(){
                        temp_data.push($(this).text());
                    });
                    questions_id.push(question_item[x]['id']);
                    add_data.push({
                        'type':question_item[x]['type'],
                        'ans':temp_data,
                        'agree':agree,
                        'question_title':question_item[x]['question_title'],
                        'type_title':question_item[x]['type_title'],
                        'max_score':question_item[x]['max_score'],
                    });
                }

                $.ajax({
                    url: "[! route('ur.reel.add') !]",
                    type:'POST',
                    dataType: "json",
                    data: {
                        _token: '[! csrf_token() !]',
                        reel_id:'[! $id !]',
                        add_data:add_data,
                        questions_id:questions_id,
                    },
                    error: function(xhr) {
                        //alert('Ajax request 發生錯誤');
                    },
                    success: function(response) {
                        if(response['status'] == true){
                            //alert(response['msg']);
                            //location.replace("[! route('ur.reel') !]");
                        }
                    }
                });
            }
        }

        //下面處理文章過長時，可以點擊上下頁按鈕來移動文章
        $.fn.scrollStopped = function(callback) {
            var $this = $(this),
                self = this;
            $this.scroll(function() {
                if ($this.data('scrollTimeout')) {
                    clearTimeout($this.data('scrollTimeout'));
                }
                $this.data('scrollTimeout', setTimeout(callback, 250, self));
            });
        };
        $section = $('#dsc_0');
        $prev = $('.prev');
        $next = $('.next');
        var $win = $(window),
            $body = $('body'),
            sh = 0,
            st = 0,
            sb = 0,
            hPage = 400,//頁面滑動時要移動的量
            phase = 1,
            triggerEvt = ('touchend' in window) ? 'touchend' : ' click';
    $(function() {
        if ($section.prop('scrollHeight') > 400) {
            $('.question-button-wrap').addClass('show');
            calcDimension();
            $section.scrollStopped(checkCtrl);//上下頁滑動完以後，檢查是否顯示按鈕
            //$win.on('resize', calcDimension);
            $body.on(triggerEvt, '.prev, .next', function() {
                st = $section.scrollTop();//現在scroltop的位置
                if ($(this).hasClass('prev')) {
                    phase = -1;
                } else {
                    phase = 1;
                }
                $section.stop().animate({
                    scrollTop: st + hPage * phase
                });
            });
        }
    });
         //判斷是否顯示上、下頁按鈕
        function checkCtrl() {
            $prev.removeClass('disabled');
            $next.removeClass('disabled');
            st = $section.scrollTop();
            if (st >= sb) {
                $next.addClass('disabled');
            } else if (st <= 0) {
                $prev.addClass('disabled');
            }
        }

         //初始化 設定值
        function calcDimension() {
            sb = $section.prop('scrollHeight') - 50;//st大於此值時，就不顯示下一頁按鈕
        }

        //----------------------------------------------
        //控制不能複製、貼上等
        $(document).ready(function () {
            $('body').bind('cut copy paste', function (e) {
                e.preventDefault();
            });
        });
    </script>
@stop