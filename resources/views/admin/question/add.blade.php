@extends('admin.layout.layout')
@section('content')
    <div class="article">
        <div class="article-header">
            試題管理
        </div>
        <div class="article-content">
            <div class="article-content-body">
                <div class="title">
                    <i class="ion-information-circled"></i>
                    編輯試題
                </div>
                <div class="form-group">
                    <label class="i-label">版本</label>
                    <select id="version" class="i-select" onchange="setUnit()">
                        <option value="1">全國</option>
                        <option value="2">中區</option>
                        <option value="3">測試</option>
                    </select>
                    <label class="i-label">科目</label>
                    <select id="subject" class="i-select" onchange="setUnit()">
                        <option value="1">國語</option>
                        <option value="2">國文</option>
                    </select>
                    <label class="i-label">冊</label>
                    <select id="book" class="i-select" onchange="setUnit()">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                    </select>
                    <label class="i-label">單元</label>
                    <select id="unit" class="i-select" onchange="setReel()">
                    </select>
                    <label class="i-label">試卷名稱</label>
                    <select id="reel" class="i-select">
                    </select>
                </div>
                <div class="form-group">
                    <label class="i-label">試題名稱</label>
                    <input class="i-input" value="" id="question_name">
                </div>
                <div class="form-group">
                    <textarea class="i-textarea i-ckeditor" name="dsc" id="dsc"></textarea>
                </div>
                <div class="form-group form-bottom" id="insert_point">
                    <button type="button" class="i-btn" onclick="history.back()">
                        取消
                    </button>
                    <button type="button" class="i-btn i-btn-primary" onclick="sendData()">
                        新增
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div id="cp_area" class="form-group" style="display: none">
        <div class="title" id="title">
            <i class="ion-information-circled"></i>
            試題 一
        </div>
        <div class="form-group">
            <label class="i-label">區塊標題</label>
            <input class="i-input" value="" id="question_title">
        </div>
        <div class="form-group">
            <label class="i-label">能力指標</label>
            <select class="i-select" id="power" >
                <option value="1">3-1能書寫切合功能性寫作文本目的的內容</option>
                <option value="2">3-2能寫出切合功能性寫作文本語意清楚、語用正確、組織有條理的內容</option>
                <option value="3">3-3能書寫切合批判性寫作文本目的的內容</option>
                <option value="4">3-4能寫出切合批判性寫作文本語意清楚、語用正確、組織有條理的內容</option>
                <option value="5">3-5能針對批判性寫作文本之特定議題寫出個人立場或想法</option>
                <option value="6">3-6能整合與評估批判性寫作文本特定議題的兩方觀點並寫出來</option>
                <option value="7">3-7能針對命題寫出個人之經歷與感受</option>
            </select>
        </div>
        <div class="form-group">
            <label class="i-label">試題類型</label>
            <select class="i-select" id="type" onchange="showTypeTitle()">
                <option value="1">一大區塊</option>
                <option value="2">一大區塊，包含同意選項</option>
                <option value="3">三大區塊</option>
                <option value="4">四大區塊</option>
            </select>
        </div>
        <div class="form-group" id="title_1">
            <div class="form-group">
                <label class="i-label">區塊標題</label>
                <input class="i-input" name="type_title_1[]" value="">
            </div>
        </div>
        <div class="form-group" id="title_2">
            <div class="form-group">
                <label class="i-label">區塊標題</label>
                <input class="i-input" name="type_title_2[]" value="">
            </div>
        </div>
        <div class="form-group" id="title_3">
            <div class="form-group">
                <label class="i-label">區塊標題_1</label>
                <input class="i-input" name="type_title_3[]" value="">
            </div>
            <div class="form-group">
                <label class="i-label">區塊標題_2</label>
                <input class="i-input" name="type_title_3[]" value="">
            </div>
            <div class="form-group">
                <label class="i-label">區塊標題_3</label>
                <input class="i-input" name="type_title_3[]" value="">
            </div>
        </div>
        <div class="form-group" id="title_4">
            <div class="form-group">
                <label class="i-label">區塊標題_1</label>
                <input class="i-input" name="type_title_4[]" value="">
            </div>
            <div class="form-group">
                <label class="i-label">區塊標題_2</label>
                <input class="i-input" name="type_title_4[]" value="">
            </div>
            <div class="form-group">
                <label class="i-label">區塊標題_3</label>
                <input class="i-input" name="type_title_4[]" value="">
            </div>
            <div class="form-group">
                <label class="i-label">區塊標題_4</label>
                <input class="i-input" name="type_title_4[]" value="">
            </div>
        </div>
    </div>
    [! Html::script('js/jquery-1.11.3.js') !]
    [! Html::script('js/ckeditor/ckeditor.js') !]
    <script>
        CKEDITOR.replace('dsc', {
            filebrowserBrowseUrl : '[! $ck_finder_path !]/ckfinder.html',
            filebrowserImageBrowseUrl : '[! $ck_finder_path !]/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '[! $ck_finder_path !]/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '[! $ck_finder_path !]/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '[! $ck_finder_path !]/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '[! $ck_finder_path !]/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });
        var div_num = 4;//要插入幾組試題區域
        var unit_sw_item = $('#unit');
        var reel_sw_item = $('#reel');
        var version_item = $('#version');
        var subject_item = $('#subject');
        var book_item = $('#book');
        var unit_item = [];
        var reel_item = [];
        var copy_obj = $('#cp_area');
        var insert_point = $('#insert_point');

        $(document).ready(function() {
            setMenu('li_question', 'main_li_3');
            getApiData();
            setDiv();
            //showTypeTitle();
        });

        /**
         * 插入試題區域
         */
        function setDiv()
        {
            for (var x = 0,y=1; x < div_num; x++,y++) {
                var t = copy_obj.clone();
                t.find('#title').html('試題'+y).removeAttr('id');
                t.find('#type').attr('onchange','showTypeTitle('+x+')');
                t.find('#title_2').hide();
                t.find('#title_3').hide();
                t.find('#title_4').hide();
                t.attr('id','Q_'+x).show();
                insert_point.before(t);
            }
        }

        /**
         * 顯示區塊標題區域
         */
        function showTypeTitle(id)
        {
            var temp_obj = $('#Q_'+id);
            var sw_val = temp_obj.find('#type').val();
            for (var x = 1; x < 5; x++) {
               if(sw_val == x){
                   temp_obj.find('#title_'+x).show();
               }else{
                   temp_obj.find('#title_'+ x).hide();
               }
            }
        }
        
        var isSend = false;
        function sendData()
        {
            if(!isSend){
                var question_title = [];
                var type = [];
                var type_titles = [];
                var power = [];
                var max_score = [];
                for (var x = 0,y=1; x < div_num; x++,y++) {
                    var t = $('#Q_'+x);
                    if(t.find('#question_title').val() !=''){
                        var type_val = t.find('#type').val();
                        var temp_array = [];
                        question_title.push(t.find('#question_title').val());
                        type.push(t.find('#type').val());
                        t.find('input[name="type_title_'+type_val+'[]"]').each(function() {
                            temp_array.push($(this).val());
                        });
                        type_titles.push(temp_array);
                        power.push(t.find('#power').val());
                        max_score.push(5);
                    }
                }
                $.ajax({
                    url: "[! route('ma.question.add') !]",
                    type:'POST',
                    dataType: "json",
                    data: {
                        _token: '[! csrf_token() !]',
                        question_title:question_title,
                        type:type,
                        type_title:type_titles,
                        dsc:CKEDITOR.instances.dsc.getData(),
                        power:power,
                        max_score:max_score,
                        reel_id:reel_sw_item.val(),
                        question_name:$('#question_name').val()
                    },
                    error: function(xhr) {
                        //alert('Ajax request 發生錯誤');
                    },
                    success: function(response)
                    {
                        if(response['status'] == true)
                        {
                            alert(response['msg']);
                            location.replace("[! route('ma.question') !]");
                        }
                        isSend = false;
                    }
                });
                isSend = true;
            }
        }

        function getApiData() {
            $.ajax({
                url: "[! route('ma.question.api') !]",
                type:'GET',
                dataType: "json",
                data: {
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true){
                        for(var x=0;x<response['data']['unit'].length;x++){
                            unit_item.push(
                                {
                                    'id':response['data']['unit'][x]['id'],
                                    'version':response['data']['unit'][x]['version'],
                                    'subject':response['data']['unit'][x]['subject'],
                                    'book':response['data']['unit'][x]['book'],
                                    'unit_title':response['data']['unit'][x]['unit_title'],
                                }
                            );
                        }
                        for(var x=0;x<response['data']['reel'].length;x++){
                            reel_item.push(
                                {
                                    'id':response['data']['reel'][x]['id'],
                                    'version':response['data']['reel'][x]['version'],
                                    'subject':response['data']['reel'][x]['subject'],
                                    'book':response['data']['reel'][x]['book'],
                                    'unit':response['data']['reel'][x]['unit'],
                                    'reel_title':response['data']['reel'][x]['reel_title'],
                                }
                            );
                        }
                    }
                    setUnit();
                    setReel();
                }
            });
        }

        /**
         * 單元選項設定
         */
        function setUnit() {
            var v = version_item.val();
            var s = subject_item.val();
            var b = book_item.val();
            $("#unit option").remove();
            $("#reel option").remove();
            for(var x=0;x<unit_item.length;x++){
                if(unit_item[x]['version'] == v && unit_item[x]['subject'] == s && unit_item[x]['book'] == b){
                    unit_sw_item.append($("<option></option>").attr("value", unit_item[x]['id']).text(unit_item[x]['unit_title']));
                }
            }
            setReel();
        }

        /**
         * 試卷選項設定
         */
        function setReel() {
            var unit_val = unit_sw_item.val();
            $("#reel option").remove();
            for(var x=0;x<reel_item.length;x++){
                if(reel_item[x]['unit'] == unit_val){
                    reel_sw_item.append($("<option></option>").attr("value", reel_item[x]['id']).text(reel_item[x]['reel_title']));
                }
            }
        }
    </script>
@stop