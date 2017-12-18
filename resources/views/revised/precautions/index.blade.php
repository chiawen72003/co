@extends('revised.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        注意事項
    </div>
    <div class="article-content">
        <div class="article-content-body" id="precautions">
        </div>
    </div>
</div>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_precautions');
    var current = 'current';
    $( document ).ready(function() {
        li_item.addClass( current);
        getData();
    });

    function getData() {
        $.ajax({
            url: "[! route('rv.precautions.data') !]",
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
                        $('#precautions').html(response['data'][y]['dsc']);
                    }
                }
            }
        });
    }
</script>
@stop