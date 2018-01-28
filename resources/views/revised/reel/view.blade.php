@extends('revised.layout.test')
@section('content')
    <div id="page-container">
        <div id="page-body" class="clearfix">
            <div class="time-wrap">
                <div class="time">
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
                    請先閱讀文本，並於右方欄位回答問題
                </div>
                <div class="chapter-content">
                    <div class="chapter-content-article-left" id="dsc">
                    </div>
                    <div class="chapter-content-page">
                        <ul class="i-pages">
                            <li><a class="i-link" id="dsc_prev"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                            <li><a class="i-link" id="dsc_next">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chapter-content-wrap">
                <div class="chapter-content-title" id="title">
                </div>
                <div class="chapter-content" style="border-top: 0;">
                    <div class="chapter-content-article-right">
                        
                        <div class="textarea-wrap">
                            <div id="textarea" contenteditable="true" onkeypress="return onKeyPress_(event);"></div>
                        </div>
                        <div class="chapter-content-page">
                            <ul class="row">
                                <li>
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="checkbox1" />
                                        <label id="label_1" for="checkbox1">空白卷</label>
                                    </div>
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="checkbox2" />
                                        <label id="label_2" for="checkbox2">試卷異常，無法批改</label>
                                    </div>
                                </li>
                                <li class="right pos-right">
                                    <div class="form-inline">
                                        得分：
                                        <input type="text" class="i-input" style="width: 40px" id="score">
                                        分（上限5分）
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
                    請先閱讀文本，並於右方欄位回答問題
                </div>
                <div class="chapter-content">
                    <div class="chapter-content-article-left" id="dsc">
                    </div>
                    <div class="chapter-content-page">
                        <ul class="i-pages">
                            <li><a class="i-link" id="dsc_prev"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                            <li><a class="i-link" id="dsc_next">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chapter-content-wrap">
                <div class="chapter-content-title" >
                    <br id="title">
                    <br>(請點選
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
                        <div class="textarea-wrap">
                            <div id="textarea" name="text_1" contenteditable="true" onkeypress="return onKeyPress_(event);"></div>
                            <div id="textarea" name="text_2" contenteditable="true" onkeypress="return onKeyPress_(event);"></div>
                        </div>
                        <div class="chapter-content-page">
                            <ul class="row">
                                <li>
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="checkbox1" />
                                        <label id="label_1" for="checkbox1">空白卷</label>
                                    </div>
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="checkbox2" />
                                        <label id="label_2" for="checkbox2">試卷異常，無法批改</label>
                                    </div>
                                </li>
                                <li class="right pos-right">
                                    <div class="form-inline">
                                        得分：
                                        <input type="text" class="i-input" style="width: 40px" id="score">
                                        分（上限5分）
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
                    請先閱讀文本，並於右方欄位回答問題
                </div>
                <div class="chapter-content">
                    <div class="chapter-content-article-left" id="dsc">
                    </div>
                    <div class="chapter-content-page">
                        <ul class="i-pages">
                            <li><a class="i-link" id="dsc_prev"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                            <li><a class="i-link" id="dsc_next">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chapter-content-wrap">
                <div class="chapter-content-title" id="title">
                </div>
                <div class="chapter-content" style="border-top: 0;">
                    <div class="chapter-content-article-right">
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
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="checkbox1" />
                                        <label id="label_1" for="checkbox1">空白卷</label>
                                    </div>
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="checkbox2" />
                                        <label id="label_2" for="checkbox2">試卷異常，無法批改</label>
                                    </div>
                                </li>
                                <li class="right pos-right">
                                    <div class="form-inline">
                                        得分：
                                        <input type="text" class="i-input" style="width: 40px" id="score">
                                        分（上限5分）
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
                    請先閱讀文本，並於右方欄位回答問題
                </div>
                <div class="chapter-content">
                    <div class="chapter-content-article-left" id="dsc">
                    </div>
                    <div class="chapter-content-page">
                        <ul class="i-pages">
                            <li><a class="i-link" id="dsc_prev"><i class="ion-ios-arrow-back"></i> 上一頁</a></li>
                            <li><a class="i-link" id="dsc_next">下一頁 <i class="ion-ios-arrow-forward"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chapter-content-wrap">
                <div class="chapter-content-title" id="title">
                </div>
                <div class="chapter-content" style="border-top: 0;">
                    <div class="chapter-content-article-right">
                        
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
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="checkbox1" />
                                        <label id="label_1" for="checkbox1">空白卷</label>
                                    </div>
                                    <div class="checkbox-group">
                                        <input type="checkbox" id="checkbox2" />
                                        <label id="label_2" for="checkbox2">試卷異常，無法批改</label>
                                    </div>
                                </li>
                                <li class="right pos-right">
                                    <div class="form-inline">
                                        得分：
                                        <input type="text" class="i-input" style="width: 40px" id="score">
                                        分（上限5分）
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
        var test_item = [];
        var question_item = [];
        var obj_1 = $('#obj_1');
        var obj_2 = $('#obj_2');
        var obj_3 = $('#obj_3');
        var obj_4 = $('#obj_4');
        var test_area = $('#test_area');
        var order = 'F';
        var id = 0;
        $( document ).ready(function() {
            getData();
        });

        function getData() {
            $.ajax({
                url: "[! route('rv.scroll.reel.data') !]",
                type:'GET',
                dataType: "json",
                data: {
                    'id':'[! $id !]'
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true && typeof(response['data']['t_data']['test_data'])  !== "undefined"){
                        order = response['data']['t_data']['order'];
                        id = response['data']['t_data']['id'];
                        for(var x=0;x<response['data']['t_data']['test_data'].length;x++){
                            var t = response['data']['t_data']['test_data'][x];
                            var q_id = response['data']['t_data']['questions_id'][x];
                            test_item.push(
                                {
                                    'question_id':q_id,
                                    'question_title':t['question_title'],
                                    'type':t['type'],
                                    'type_title':t['type_title'],
                                    'dsc':t['dsc'],
                                    'max_score':t['max_score'],
                                    'agree':t['agree'],
                                    'ans':t['ans'],
                                }
                            );
                        }
                        if(typeof(response['data']['q_data'])  !== "undefined")
                        {
                            for(var x=0;x<response['data']['q_data'].length;x++){
                                var tp = response['data']['q_data'][x];
                                question_item.push(
                                    {
                                        'id':tp['id'],
                                        'dsc':tp['dsc']
                                    }
                                );
                            }
                        }

                        setList();
                    }else{
                        alert('目前沒有試卷可以批閱!!');
                        location.replace("[! route('rv.scroll.reel.pg') !]");
                    }
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
            var max_page = test_item.length;
            for(var x=0,y=1;x<test_item.length;x++,y++)
            {
                var t;
                if(test_item[x]['type'] == 1){
                    t = obj_1.clone();
                }
                if(test_item[x]['type'] == 2){
                    t = obj_2.clone();
                }
                if(test_item[x]['type'] == 3){
                    t = obj_3.clone();
                }
                if(test_item[x]['type'] == 4){
                    t = obj_4.clone();
                }
                //試題標題
                if(test_item[x]['type'] == 2){
                    t.find('#title').after(test_item[x]['question_title']).removeAttr('id');
                    if(test_item[x]['agree'] == 0){
                        t.find('#radio1').prop('checked', true).removeAttr('id');
                    }
                    if(test_item[x]['agree'] == 1){
                        t.find('#radio2').prop('checked', true).removeAttr('id');
                    }
                    var temp_num = 0;
                    t.find('#textarea').each(function(){
                        if(test_item[x]['agree'] == temp_num){
                            $(this).show();
                        }else{
                            $(this).hide();
                        }

                        temp_num++;
                    });

                }else{
                    t.find('#title').html(test_item[x]['question_title']).removeAttr('id');
                }
                //試題內容
                for(var k=0;k<question_item.length;k++){
                    if(question_item[k]['id'] == test_item[x]['question_id']){
                        t.find('#dsc').html(question_item[k]['dsc']).attr('id','dsc_'+x);
                        //文章上下頁按鈕
                        t.find('#dsc_prev').attr('onclick', 'dsc_prev("'+x+'")').attr('id','prev_'+x);
                        t.find('#dsc_next').attr('onclick', 'dsc_next("'+x+'")').attr('id','next_'+x);
                    }
                }

                //試題輸入區
                var temp_num = 0;
                t.find('#textarea').each(function(){
                    $(this).html(test_item[x]['ans'][temp_num]);
                    temp_num++;
                });
                //上一試題按鈕
                if(x == 0){
                    t.find('#bt_up').hide().removeAttr('id');
                }else{
                    var t_num = x - 1;
                    t.find('#bt_up').attr('onclick', 'page_change("'+ t_num +'")');
                }
                //下一試題按鈕
                if(y == max_page){
                    t.find('#bt_down').html('送出').attr('onclick', 'send_data()').removeAttr('id');
                }else{
                    t.find('#bt_down').attr('onclick', 'page_change("'+ y +'")').removeAttr('id');
                }
                //空白卷
                t.find('#checkbox1').attr('id','chk_w_'+x);
                t.find('#label_1').attr('for','chk_w_'+x).removeAttr('id');
                t.find('#checkbox2').attr('id','chk_e_'+x);
                t.find('#label_2').attr('for','chk_e_'+x).removeAttr('id');
                t.attr('id','write_'+x);
                if(x > 0){
                    t.hide();
                }
                test_area.append(t);
            }
            setDefaultScrollData();
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

        //試題切換
        function page_change(num)
        {
            for(var x=0;x<test_item.length;x++)
            {
                if(num == x){
                    $('#write_'+x).show();
                }else{
                    $('#write_'+x).hide();
                }
            }
        }

        //上傳資料
        var is_send = false;
        var add_data = [];
        function send_data()
        {
            if(!is_send){
                for(var x=0;x<test_item.length;x++)
                {
                    var t = $('#write_'+x);
                    var score = 0;
                    var is_blank = false;
                    var is_abnormal = false;
                    score = t.find('#score').val();
                    if(t.find('#chk_w_'+x).is(':checked')){
                        is_blank = true;
                    }
                    if(t.find('#chk_e_'+x).is(':checked')){
                        is_abnormal = true;
                    }

                    add_data.push({
                        'score':score,
                        'is_blank':is_blank,
                        'is_abnormal':is_abnormal,
                    });
                }

                $.ajax({
                    url: "[! route('rv.scroll.reel.update') !]",
                    type:'POST',
                    dataType: "json",
                    data: {
                        _token: '[! csrf_token() !]',
                        id:id,
                        reel_id:'[! $id !]',
                        add_data:add_data,
                        order:order,
                    },
                    error: function(xhr) {
                        //alert('Ajax request 發生錯誤');
                    },
                    success: function(response) {
                        if(response['status'] == true){
                           alert(response['msg']);
                           location.reload();
                        }
                    }
                });
            }
        }

        //下面處理文章過長時，可以點擊上下頁按鈕來移動文章
        var st = 0,
            sb = 0,
            hPage = 400;//頁面滑動時要移動的量

        //綁定一個自定義的方法到每個物件內
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

        function setDefaultScrollData()
        {
            for(var z=0;z<question_item.length;z++){
                var t = $('#dsc_'+z);
                if (t.prop('scrollHeight') > 400) {
                    t.scrollStopped(checkCtrl);//上下頁滑動完以後，檢查是否顯示按鈕
                }
            }
        }
        //判斷是否顯示上、下頁按鈕
        function checkCtrl()
        {
            for(var z=0;z<question_item.length;z++){
                var t_prev = $('#prev_'+z);
                var t_next = $('#next_'+z);
                t_prev.removeClass('disabled');
                t_next.removeClass('disabled');
                st = $('#dsc_'+z).scrollTop();
                sb = $('#dsc_'+z).prop('scrollHeight') - (hPage+100);//st大於此值時，就不顯示下一頁按鈕
                if (st >= sb) {
                    t_next.addClass('disabled');
                } else if (st <= 0) {
                    t_prev.addClass('disabled');
                }
            }
        }

        //文章內容上一頁
        function dsc_prev(id) {
            var temp_dsc = $('#dsc_'+id);
            var st = temp_dsc.scrollTop();//現在scroltop的位置
            temp_dsc.stop().animate({
                scrollTop: st + hPage * -1
            });
        }

        //文章內容下一頁
        function dsc_next(id) {
            var temp_dsc = $('#dsc_'+id);
            var st = temp_dsc.scrollTop();//現在scroltop的位置
            temp_dsc.stop().animate({
                scrollTop: st + hPage * 1
            });
        }

    </script>
@stop