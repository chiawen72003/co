@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        評閱者資料管理
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <div class="form-group">
                    <div class="form-group">
                        <label class="i-label">區域</label>
                        <select id="area" class="i-select" onchange="setSchoolData()">
                            <option value="1">北區</option>
                            <option value="2">桃竹苗區</option>
                            <option value="3">中區</option>
                            <option value="4">雲嘉南區</option>
                            <option value="5">高屏東區</option>
                            <option value="6">外島</option>
                        </select>
                        <label class="i-label">學校名稱</label>
                        <select id="school" class="i-select">
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            <label class="i-label">帳號</label>
                            <input type="text" class="i-input">
                            <label class="i-label">姓名</label>
                            <input type="text" class="i-input">
                        </div>
                        <button type="button" class="i-btn">
                            查詢
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增評閱者
                <div class="title-right">
                    <a href="[! route('ma.revised.add.pg') !]" class="i-add i-btn-primary"><i class="ion-android-add"></i>新增評閱者</a>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table" id="revised_list">
                    <tr>
                        <th>
                            <div class="cell">學校</div>
                        </th>
                        <th>
                            <div class="cell">帳號</div>
                        </th>
                        <th>
                            <div class="cell">姓名</div>
                        </th>
                        <th width="120">
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
        <td><div class="cell" id="school_name"></div></td>
        <td><div class="cell" id="login_name"></div></td>
        <td><div class="cell" id="name"></div></td>
        <td>
            <div class="cell center"><a href="#" class="i-link" id="reel_area"><i class="ion-android-settings"></i>試卷管理</a></div>
            <div class="cell center"><a href="#" class="i-link" id="a_area"><i class="ion-android-settings"></i>編輯</a></div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#revised_list');
    var school = $('#school');
    var area = $('#area');
    var tr_item = $('#copy_tr');
    var revised_item = [];
    var school_item = [];
    $( document ).ready(function() {
        setMenu('li_revised', 'main_li_4');
        getInitData();
    });

    function getInitData() {
        $.ajax({
            url: "[! route('ma.revised.init') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data']['revised'].length;x++)
                    {
                        var t = response['data']['revised'][x];
                        revised_item.push(
                            {
                                'id':t['id'],
                                'name':t['name'],
                                'login_name':t['login_name'],
                                'school_id':t['school_id']
                            }
                        );
                    }
                    for(var x=0;x<response['data']['school'].length;x++)
                    {
                        var t = response['data']['school'][x];
                        school_item.push(
                            {
                                'id':t['id'],
                                'area':t['area'],
                                'school_title':t['school_title']
                            }
                        );
                    }
                }
                setSchoolData();
                setRevisedList();
            }
        });
    }

    function setSchoolData() {
        var area_val = area.val();
        $("#school option").remove();
        school.append($("<option></option>").attr("value", '').text(''));
        for(var x=0;x<school_item.length;x++){
            if( school_item[x]['area'] == area_val){
                school.append($("<option></option>").attr("value", school_item[x]['id']).text(school_item[x]['school_title']));
            }
        }
    }

    function setRevisedList() {
        for(var x=0;x<revised_item.length;x++){
            var t = tr_item.clone();
            var a = "[! route('ma.revised.edit.pg') !]?id="+ revised_item[x]['id'];
            var reel = "[! route('ma.revised.reel') !]?id="+ revised_item[x]['id'];
            var r = revised_item[x]['login_name'];
            var n = revised_item[x]['name'];
            var s = '';
            for(var y=0;y<school_item.length;y++){
                if( school_item[y]['id'] == revised_item[x]['school_id']){
                    s = school_item[y]['school_title'];
                }
            }
            t.find('#school_name').html(s).removeAttr('id');
            t.find('#login_name').html(r).removeAttr('id');
            t.find('#name').html(n).removeAttr('id');
            t.find('#a_area').attr('href',a).removeAttr('id');
            t.find('#reel_area').attr('href',reel).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }
</script>
@stop