@extends('user.layout.layout')
@section('content')
    <div class="article">
        <div class="article">
            <div class="article-header">
                成果查詢
            </div>
            <div class="article-content">
                <!--
                <div class="article-content-header">
                    <form>
                        <div class="form-inline">
                            <label class="i-label">試卷</label>
                            <select id="semester" class="i-select">
                                <option>試卷別選項</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label class="i-label">學校</label>
                            <select id="semester" class="i-select">
                                <option>學校列表</option>
                            </select>
                        </div>
                        <div class="form-inline">
                            <label class="i-label">區域</label>
                            <select id="semester" class="i-select">
                                <option>台中市</option>
                            </select>
                            <input type="text" class="i-input" placeholder="請輸入關鍵字..">
                        </div>
                        <button type="button" class="i-btn">
                            查詢
                        </button>
                    </form>
                </div>
                -->
                <div class="article-content-body">
                    <div class="title">
                        <i class="ion-information-circled"></i>
                        試卷列表
                    </div>
                    <div class="table-wrapper">
                        <table class="table" id="reel_list">
                            <tr>
                                <th>
                                    <div class="cell center">試卷名稱</div>
                                </th>
                                <th>
                                    <div class="cell center">受測日期</div>
                                </th>
                                <th>
                                    <div class="cell center">每題得分</div>
                                </th>
                                <th>
                                    <div class="cell center">總分</div>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table style="display: none">
        <tr id="copy_tr" >
            <td>
                <div class="cell center" id="title"></div>
            </td>
            <td>
                <div class="cell center" id="date"></div>
            </td>
            <td>
                <div class="cell center" id="scores"></div>
            </td>
            <td>
                <div class="cell center" id="total"></div>
            </td>
        </tr>
    </table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#reel_list');
    var tr_item = $('#copy_tr');
    var list_item = $('#reel_list');
    var current = 'current';
    var list_data = [];
    var now_pg = 0;
    $( document ).ready(function() {
        li_item.addClass( current);
        getListData();
    });

    function getListData() {
        $.ajax({
            url: "[! route('ur.score.api') !]",
            type:'GET',
            dataType: "json",
            data: {
                'page':now_pg,
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data'].length;x++){
                        var t = response['data'][x];
                        list_data.push(
                            {
                                'total':t['total'],
                                'scores':t['scores'],
                                'title':t['title'],
                                'date':t['date']
                            }
                        );
                    }
                }
                setList();
            }
        });
    }

    function setList() {
        for(var x=0;x<list_data.length;x++){
            var t = tr_item.clone();
            var data = list_data[x];
            t.find('#title').html(data['title']).removeAttr('id');
            t.find('#date').html(data['date']).removeAttr('id');
            t.find('#scores').html(data['scores']).removeAttr('id');
            t.find('#total').html(data['total']).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }
</script>
@stop