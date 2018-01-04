@extends('revised.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        線上閱卷 - 試卷選擇
    </div>
    <div class="article-content">
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                試卷選擇
            </div>
            <div class="table-wrapper">
                <table class="table" id="list_area">
                    <tr>
                        <th width="100">
                            <div class="cell">試卷名稱</div>
                        </th>
                        <th>
                            <div class="cell">需閱卷數量</div>
                        </th>
                        <th>
                            <div class="cell">已閱卷數量</div>
                        </th>
                        <th width="120">
                            <div class="cell center">功能</div>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<table style="display: none">
    <tr id="copy_tr" >
        <td><div class="cell" id="reelTitle"></div></td>
        <td><div class="cell" id="needNum"></div></td>
        <td><div class="cell" id="viewNum"></div></td>
        <td><div class="cell center"><a href="" class="i-link" id="path"><i class="ion-arrow-down-c"></i>前往評閱</a></div></td>

    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_scroll');
    var current = 'current';
    var tr_item = $('#copy_tr');
    var list_item = $('#list_area');
    var list_obj = [];
    $( document ).ready(function() {
        li_item.addClass( current);
        getListData();
    });

    function getListData() {
        $.ajax({
            url: "[! route('rv.scroll.reel.list') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data'].length;x++){
                        list_obj.push(
                            {
                                'path':response['data'][x]['path'],
                                'reel_title':response['data'][x]['reel_title'],
                                'need_num':response['data'][x]['need_num'],
                                'view_num':response['data'][x]['view_num'],
                            }
                        );
                    }
                }
                setList();
            }
        });
    }


    function setList() {
        for(var x=0;x<list_obj.length;x++){
            var t = tr_item.clone();
            t.find('#reelTitle').html(list_obj[x]['reel_title']).removeAttr('id');
            t.find('#needNum').html(list_obj[x]['need_num']).removeAttr('id');
            t.find('#viewNum').html(list_obj[x]['view_num']).removeAttr('id');
            t.find('#path').attr('href',list_obj[x]['path']).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }
</script>
@stop