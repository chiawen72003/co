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
                <div class="i-form mt1">
                    <div class="form-group">
                        <label class="i-label">區塊標題</label>
                        <input class="i-input" value="" id="question_title">
                    </div>
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
                    <textarea class="i-textarea i-ckeditor"></textarea>
                </div>
                <div class="form-group form-bottom">
                    <button type="button" class="i-btn" onclick="history.back()">
                        取消
                    </button>
                    <button type="button" class="i-btn i-btn-primary">
                        新增
                    </button>
                </div>
            </div>
        </div>
    </div>
    [! Html::script('js/jquery-1.11.3.js') !]
    <script>
        var li_item = $('#li_question');
        var type_item = $('#type');
        var question_title = $('#question_title');
        var type = $('#type');
        var dsc = $('#dsc');
        var current = 'current';
        $(document).ready(function() {
            li_item.addClass( current);
            showTypeTitle();
        });

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
                $.ajax({
                    url: "[! route('ma.question.add') !]",
                    type:'POST',
                    dataType: "json",
                    data: {
                        _token: '[! csrf_token() !]',
                        version:version_item.val(),
                        subject:subject_item.val(),
                        book:book_item.val(),
                        unit:unit_sw_item.val(),
                        reel_title:title_item.val(),
                    },
                    error: function(xhr) {
                        //alert('Ajax request 發生錯誤');
                    },
                    success: function(response)
                    {
                        if(response['status'] == true)
                        {
                            reel_item.push(
                                {
                                    'id':response['id'],
                                    'version':response['version'],
                                    'subject':response['subject'],
                                    'book':response['book'],
                                    'unit':response['unit'],
                                    'reel_title':response['reel_title'],
                                }
                            );
                            addList(response['version'],response['subject'],response['book'],response['unit'],response['reel_title']);
                            alert(response['msg']);
                        }
                        isSend = false;
                    }
                });
                isSend = true;
            }
        }
    </script>
@stop