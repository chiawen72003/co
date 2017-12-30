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
                </div>
                <div class="form-group" id="type_title_1">
                    <div class="form-group">
                        <label class="i-label">區塊標題</label>
                        <input class="i-input" name="type_title_1[]" value="">
                    </div>
                </div>
                <div class="form-group" id="type_title_2">
                    <div class="form-group">
                        <label class="i-label">區塊標題</label>
                        <input class="i-input" name="type_title_2[]" value="">
                    </div>
                </div>
                <div class="form-group" id="type_title_3">
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
                <div class="form-group" id="type_title_4">
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
                <div class="i-form mt1">
                    <textarea class="i-textarea i-ckeditor" name="dsc" id="dsc"></textarea>
                </div>
                <div class="form-group form-bottom">
                    <button type="button" class="i-btn" onclick="history.back()">
                        取消
                    </button>
                    <button type="button" class="i-btn i-btn-primary" onclick="sendData()">
                        更新
                    </button>
                </div>
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
        var type_item = $('#type');
        var question_title = $('#question_title');
        var type = $('#type');
        var power = $('#power');

        $(document).ready(function() {
            setMenu('li_question', 'main_li_3');
            getQuestionData();
        });

        function getQuestionData() {
            $.ajax({
                url: "[! route('ma.question.data') !]",
                type:'GET',
                dataType: "json",
                data: {
                    id:'[! $id !]'
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true){
                        for(var y=0;y<response['data'].length;y++){
                            var x=0;
                            question_title.val(response['data'][y]['question_title']);
                            type.val(response['data'][y]['type']);
                            power.val(response['data'][y]['power']);
                            $('input[name="type_title_'+response['data'][y]['type']+'[]"]').each(function() {
                                $(this).val(response['data'][y]['type_title'][x]);
                                x++;
                            });
                            CKEDITOR.instances.dsc.setData(response['data'][y]['dsc'])
                        }
                    }
                    showTypeTitle();
                }
            });
        }

        function showTypeTitle()
        {
            var t = type_item.val();
            for (var x = 1; x < 5; x++) {
               if(t == x){
                   $('#type_title_'+ x).show();
               }else{
                   $('#type_title_'+ x).hide();
               }
            }
        }
        
        var isSend = false;
        function sendData()
        {
            if(!isSend){
                var type_val = type.val();
                var type_titles = [];
                $('input[name="type_title_'+type_val+'[]"]').each(function() {
                    type_titles.push($(this).val());
                });

                $.ajax({
                    url: "[! route('ma.question.update') !]",
                    type:'POST',
                    dataType: "json",
                    data: {
                        _token: '[! csrf_token() !]',
                        id:'[! $id !]',
                        question_title:question_title.val(),
                        type:$('#type').val(),
                        type_title:type_titles,
                        dsc:CKEDITOR.instances.dsc.getData(),
                        power:power.val(),
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
    </script>
@stop