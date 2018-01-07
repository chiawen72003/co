@extends('revised.layout.layout')
@section('content')
    <div class="article">
        <div class="article-header">
            批改統計
        </div>
        <div class="article-content">
            <div class="article-content-body">
                <div class="title">
                    <i class="ion-information-circled"></i>
                    批改統計列表
                </div>
                <div class="table-wrapper">
                    <table class="table">
                        <tr id="insert_point">
                            <th width="100">
                                <div class="cell"></div>
                            </th>
                            <th width="100">
                                <div class="cell">待批閱份數</div>
                            </th>
                            <th  width="100">
                                <div class="cell">已批閱份數</div>
                            </th>
                            <th width="100">
                                <div class="cell">空白份數</div>
                            </th>
                        </tr>
                        <tr>
                            <td >
                                <div class="cell">總份數</div>
                            </td>
                            <td >
                                <div class="cell" id="need_total">0</div>
                            </td>
                            <td >
                                <div class="cell" id="has_total">0</div>
                            </td>
                            <td >
                                <div class="cell" id="white_total">0</div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <table style="display: none">
        <tr id="copy_tr" >
            <td width="100">
                <div class="cell" id="title"></div>
            </td>
            <td>
                <div class="cell" id="need_num">0</div>
            </td>
            <td>
                <div class="cell" id="has_num">0</div>
            </td>
            <td>
                <div class="cell" id="white_num">0</div>
            </td>
        </tr>
    </table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_statistics');
    var tr_item = $('#copy_tr');
    var insert_point = $('#insert_point');
    var current = 'current';
    $( document ).ready(function() {
        li_item.addClass( current);
        getCountData();
    });
    var total = 0;
    var has_view_total = 0;
    var white_total = 0;
    function getCountData() {
        $.ajax({
            url: "[! route('rv.statistics.data') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    var t = tr_item.clone();
                    for(var x=0;x<response['data'].length;x++){
                        t.find('#title').html(response['data'][x]['title']).removeAttr('id');
                        t.find('#need_num').html(response['data'][x]['total']).removeAttr('id');
                        t.find('#has_num').html(response['data'][x]['has']).removeAttr('id');
                        t.find('#white_num').html(response['data'][x]['white']).removeAttr('id');
                        t.removeAttr('id');
                        insert_point.after(t);
                        total = total + parseInt(response['data'][x]['total']);
                        has_view_total = has_view_total + parseInt(response['data'][x]['has']);
                        white_total = white_total + parseInt(response['data'][x]['white']);
                    }
                }
                setTotalData();
            }
        });
    }

    function setTotalData() {
        $('#need_total').html(total);
        $('#has_total').html(has_view_total);
        $('#white_total').html(white_total);
    }
</script>
@stop