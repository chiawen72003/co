@extends('admin.layout.layout')
@section('content')
    <div class="article">
        <div class="article">
            <div class="article-header">
                試卷管理
            </div>
            <div class="article-content">
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
                <div class="article-content-body">
                    <div class="title">
                        <i class="ion-information-circled"></i>
                        試卷列表
                    </div>
                    <div class="table-wrapper">
                        <table class="table" id="reel_list">
                            <tr>
                                <th>
                                    <div class="cell">試卷名稱</div>
                                </th>
                                <th>
                                    <div class="cell">學校</div>
                                </th>
                                <th width="120">
                                    <div class="cell center">區域</div>
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
            <td><div class="cell" id="title_area">試題名稱</div></td>
            <td>
                <div class="cell"></div>
            </td>
            <td>
                <div class="cell center"></div>
            </td>
        </tr>
    </table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_reel');
    var tr_item = $('#copy_tr');
    var list_item = $('#reel_list');
    var current = 'current';
    var reel_item = [];
    $( document ).ready(function() {
        li_item.addClass( current);
        getListData();
    });

    function getListData() {
        $.ajax({
            url: "[! route('ur.reel.list') !]",
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
                        reel_item.push(
                            {
                                'reel_id':response['data'][x]['reel_id'],
                                'reel_title':response['data'][x]['reel_title'],
                            }
                        );
                    }
                }
                setList();
            }
        });
    }

    function setList() {
        for(var x=0;x<reel_item.length;x++){
            var t = tr_item.clone();
            var title = reel_item[x]['reel_title'];
            var id = reel_item[x]['reel_id'];
            t.find('#title_area').html(title).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }
</script>
@stop