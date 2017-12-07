@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        匯入學校/代碼
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">學校名稱</label>
                <input type="text" class="i-input" id="school_title">
                <label class="i-label">代碼</label>
                <input type="text" class="i-input" id="code">
                <label class="i-label">區域</label>
                <select id="area">
                    <option value="1">北一區</option>
                    <option value="2">北二區</option>
                    <option value="3">桃竹苗區</option>
                    <option value="4">中區</option>
                    <option value="5">雲嘉南區</option>
                    <option value="6">高屏區</option>
                    <option value="7">東區</option>
                </select>
                <button type="button" class="i-btn i-btn-primary i-btn-circle" onclick="addSchool()">
                    <i class="ion-android-add"></i>
                    新增
                </button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增學校
            </div>
            <div class="table-wrapper">
                <table class="table" id="school_list">
                    <tr>
                        <th width="120">
                            <div class="cell center">學校代碼</div>
                        </th>
                        <th>
                            <div class="cell">學校名稱</div>
                        </th>
                    </tr>
                    <!--  -->
                </table>
            </div>
        </div>
    </div>
</div>
<table style="display: none">
    <tr id="copy_tr" >
        <td><div class="cell center" id="code_area"></div></td>
        <td><div class="cell"  id="name_area"></div></td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_school');
    var list_item = $('#school_list');
    var tr_item = $('#copy_tr');
    var current = 'current';
    var school_item = [];
    $( document ).ready(function() {
        li_item.addClass( current);
        getListData();
    });
    
    function getListData() {
        $.ajax({
            url: "[! route('ma.school.list') !]",
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
                        school_item.push(
                            {
                                'id':response['data'][x]['id'],
                                'code':response['data'][x]['code'],
                                'area':response['data'][x]['area'],
                                'school_title':response['data'][x]['school_title']
                            }
                        );
                    }
                }
                setList();
            }
        });
    }

    function setList() {
        for(var x=0;x<school_item.length;x++){
            var t = tr_item.clone();
            t.find('#code_area').html(school_item[x]['code']).removeAttr('id');
            t.find('#name_area').html(school_item[x]['school_title']).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }
    var isSend = false;
    function addSchool(){
        if(!isSend){
            $.ajax({
                url: "[! route('ma.school.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    school_title:$('#school_title').val(),
                    area:$('#area').val(),
                    code:$('#code').val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
                        school_item.push(
                            {
                                'id':response['id'],
                                'code':response['code'],
                                'area':response['area'],
                                'school_title':response['school_title']
                            }
                        );
                        addList(response['school_title'],response['code']);
                        alert(response['msg']);
                    }
                    isSend = false;
                }
            });
            isSend = true;
            clearInput();
        }
    }

    function addList(title,code) {
        var t = tr_item.clone();
        t.find('#code_area').html(code).removeAttr('id');
        t.find('#name_area').html(title).removeAttr('id');
        t.removeAttr('id');
        list_item.append(t);
    }

    function clearInput() {
        $('#school_title').val('');
        $('#code').val('');
        $('#area').val(1);

    }
</script>
@stop