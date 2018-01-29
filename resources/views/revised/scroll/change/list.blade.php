@extends('revised.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        線上閱卷 - 分數修改
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">日期</label>
                <input type="text" class="i-input" id="sw_date" value="" >
                <label class="i-label">時間</label>
                <select id="sw_time" class="i-select">
                    <option value="0">00:00 ~ 00:59</option>
                    <option value="1">01:00 ~ 01:59</option>
                    <option value="2">02:00 ~ 02:59</option>
                    <option value="3">03:00 ~ 03:59</option>
                    <option value="4">04:00 ~ 04:59</option>
                    <option value="5">05:00 ~ 05:59</option>
                    <option value="6">06:00 ~ 06:59</option>
                    <option value="7">07:00 ~ 07:59</option>
                    <option value="8">08:00 ~ 08:59</option>
                    <option value="9">09:00 ~ 09:59</option>
                    <option value="10">10:00 ~ 10:59</option>
                    <option value="11">11:00 ~ 11:59</option>
                    <option value="12">12:00 ~ 12:59</option>
                    <option value="13">13:00 ~ 13:59</option>
                    <option value="14">14:00 ~ 14:59</option>
                    <option value="15">15:00 ~ 15:59</option>
                    <option value="16">16:00 ~ 16:59</option>
                    <option value="17">17:00 ~ 17:59</option>
                    <option value="18">18:00 ~ 18:59</option>
                    <option value="19">19:00 ~ 19:59</option>
                    <option value="20">20:00 ~ 20:59</option>
                    <option value="21">21:00 ~ 21:59</option>
                    <option value="22">22:00 ~ 22:59</option>
                    <option value="23">23:00 ~ 23:59</option>
                </select>
                <button type="button" class="i-btn i-btn-primary" onclick="search()">
                    <i class="ion-android-add"></i>
                    查詢
                </button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                試卷選擇
            </div>
            <div class="table-wrapper">
                <table class="table" id="list_area">
                    <tr>
                        <th width="100">
                            <div class="cell">卷別</div>
                        </th>
                        <th>
                            <div class="cell">編號</div>
                        </th>
                        <th>
                            <div class="cell">批閱時間</div>
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
        <td><div class="cell" id="title"></div></td>
        <td><div class="cell" id="num"></div></td>
        <td><div class="cell" id="view_date"></div></td>
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
        $('#sw_date').val('[! $date !]');
        $('#sw_time').val('[! $s_time !]');
        getListData();
    });

    function getListData() {
        if($('#sw_date').val() != '' && $('#sw_time').val() != '' ){
            $.ajax({
                url: "[! route('rv.scroll.change.api') !]",
                type:'GET',
                dataType: "json",
                data: {
                    'date':$('#sw_date').val(),
                    's_time':$('#sw_time').val()
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
                                    'reel_id':response['data'][x]['reel_id'],
                                    'review_time':response['data'][x]['review_time'],
                                }
                            );
                        }
                    }
                    setList();
                }
            });
        }
    }


    function setList() {
        for(var x=0;x<list_obj.length;x++){
            var t = tr_item.clone();
            t.find('#title').html(list_obj[x]['reel_title']).removeAttr('id');
            t.find('#num').html(list_obj[x]['reel_id']).removeAttr('id');
            t.find('#view_date').html(list_obj[x]['review_time']).removeAttr('id');
            t.find('#path').attr('href',list_obj[x]['path']).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }

    function search() {
        location.href = "?date="+$('#sw_date').val()+'&s_time='+$('#sw_time').val();
    }
</script>
@stop