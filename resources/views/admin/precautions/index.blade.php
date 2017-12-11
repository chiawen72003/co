@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        設定注意事項
    </div>
    <div class="article-content">
        <div class="article-content-body">
            <div class="i-form mt1">
                <textarea class="i-textarea i-ckeditor" name="dsc" id="dsc"></textarea>
            </div>
            <div class="form-group form-bottom">
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
    var li_item = $('#li_precautions');
    var current = 'current';
    CKEDITOR.replace('dsc', {
        filebrowserBrowseUrl : '[! $ck_finder_path !]/ckfinder.html',
        filebrowserImageBrowseUrl : '[! $ck_finder_path !]/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl : '[! $ck_finder_path !]/ckfinder.html?type=Flash',
        filebrowserUploadUrl : '[! $ck_finder_path !]/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '[! $ck_finder_path !]/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '[! $ck_finder_path !]/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });

    $( document ).ready(function() {
        li_item.addClass( current);
        getData();
    });

    function getData() {
        $.ajax({
            url: "[! route('ma.precautions.data') !]",
            type:'GET',
            dataType: "json",
            data: {
                id:'1'
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var y=0;y<response['data'].length;y++){
                        CKEDITOR.instances.dsc.setData(response['data'][y]['dsc'])
                    }
                }
            }
        });
    }

    var isSend = false;
    function sendData()
    {
        if(!isSend){
            $.ajax({
                url: "[! route('ma.precautions.update') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    id:'[! $id !]',
                    dsc:CKEDITOR.instances.dsc.getData(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
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