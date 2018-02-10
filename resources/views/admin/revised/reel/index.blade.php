@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        評閱者-試卷資料管理
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <div class="form-group">
                    <div class="form-group">
                        <label class="i-label">試卷名稱</label>
                        <select id="reel">
                        </select>
                        <label class="i-label">需閱卷數量</label>
                        <input type="text" class="i-input" id="needNum" value="0">
                    </div>
                    <button type="button" class="i-btn" onclick="SendData()">
                        新增
                    </button>
                </div>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已指派的試卷
            </div>
            <div class="table-wrapper">
                <table class="table" id="revised_list">
                    <tr>
                        <th>
                            <div class="cell">試卷名稱</div>
                        </th>
                        <th>
                            <div class="cell">需閱卷數量</div>
                        </th>
                        <th>
                            <div class="cell">已經閱卷數量</div>
                        </th>
                        <th width="100">
                            <div class="cell center">
                                功能
                            </div>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<table style="display: none">
    <tr id="copy_tr">
        <td><div class="cell" id="reel_name"></div></td>
        <td><div class="cell" id="need_num"></div></td>
        <td><div class="cell" id="view_num"></div></td>
        <td>
            <div class="cell center"><a href="#" class="i-link" id="a_area"><i class="ion-android-settings"></i>編輯</a></div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#revised_list');
    var tr_item = $('#copy_tr');
    var reel_item = $('#reel');
    var needNum = $('#needNum');
    var current = 'current';
    var reel_obj = [];
    var list_obj = [];
    $( document ).ready(function() {
        setMenu('li_reel_modify', 'main_li_4');
        getInitData();
    });

    function getInitData() {
        $.ajax({
            url: "[! route('ma.revised.reel.init') !]",
            type:'GET',
            dataType: "json",
            data: {
                'id':'[! $id !]'
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data']['list'].length;x++)
                    {
                        var t = response['data']['list'][x];
                        list_obj.push(
                            {
                                'reel_id':t['reel_id'],
                                'reel_title':t['reel_title'],
                                'need_num':t['need_num'],
                                'view_num':t['view_num']
                            }
                        );
                    }
                    for(var x=0;x<response['data']['reel'].length;x++)
                    {
                        var t = response['data']['reel'][x];

                        reel_obj.push(
                            {
                                'id':t['id'],
                                'version':t['version'],
                                'subject':t['subject'],
                                'book':t['book'],
                                'unit':t['unit'],
                                'reel_title':t['reel_title'],
                            }
                        );
                    }
                }
                setListData();
                setReelData();
            }
        });
    }

    function setReelData() {
        for(var x=0;x<reel_obj.length;x++){
            var hsa_set = false;
            for(var y=0;y<list_obj.length;y++){
               if(list_obj[x]['reel_id'] == reel_obj[x]['id'] ){
                   hsa_set = true;
               }
            }
            if(!hsa_set){
                reel_item.append($("<option></option>").attr("value", reel_obj[x]['id']).text(reel_obj[x]['reel_title']));
            }
        }
    }

    function setListData() {
        for(var x=0;x<list_obj.length;x++){
            var t = tr_item.clone();
            var r = list_obj[x]['reel_title'];
            var n = list_obj[x]['need_num'];
            var v = list_obj[x]['view_num'];
            var a = '#';
            t.find('#reel_name').html(r).removeAttr('id');
            t.find('#need_num').html(n).removeAttr('id');
            t.find('#view_num').html(v).removeAttr('id');
            t.find('#a_area').attr('href',a).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }

    var isSend = false;
    function SendData(){
        if(!isSend){
            $.ajax({
                url: "[! route('ma.revised.reel.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    reel_id:reel_item.val(),
                    user_id:'[! $id !]',
                    need_num:needNum.val(),
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
                    location.reload();
                }
            });
            isSend = true;
        }
    }
</script>
@stop