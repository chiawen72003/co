@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        新增學校/科系
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">區域</label>
                <select id="area" onchange="setSchoolList()">
                    <option value="1">北一區</option>
                    <option value="2">北二區</option>
                    <option value="3">桃竹苗區</option>
                    <option value="4">中區</option>
                    <option value="5">雲嘉南區</option>
                    <option value="6">高屏區</option>
                    <option value="7">東區</option>
                </select>
                <label class="i-label">學校</label>
                <select id="school_id">
                </select>
                <label class="i-label">科系</label>
                <input type="text" class="i-input" id="subject_title">
                <button type="button" class="i-btn i-btn-primary i-btn-circle" onclick="addSubject()">
                    <i class="ion-android-add"></i>
                    新增
                </button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增科系
            </div>
            <div class="table-wrapper">
                <table class="table" id="subject_list">
                    <tr>
                        <th width="120">
                            <div class="cell center">學校名稱</div>
                        </th>
                        <th>
                            <div class="cell">科系名稱</div>
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
        <td><div class="cell center" id="school_area"></div></td>
        <td><div class="cell"  id="subject_area"></div></td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_school_subject');
    var list_item = $('#subject_list');
    var area_item = $('#area');
    var school_id_item = $('#school_id');
    var tr_item = $('#copy_tr');
    var current = 'current';
    var school_item = [];
    var subject_item = [];
    $( document ).ready(function() {
        li_item.addClass( current);
        getSchoolData();
        getListData();
    });

    function getSchoolData() {
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
                setSchoolList();
            }
        });
    }

    function getListData() {
        $.ajax({
            url: "[! route('ma.subject.list') !]",
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
                        subject_item.push(
                            {
                                'id':response['data'][x]['id'],
                                'school_id':response['data'][x]['school_id'],
                                'subject_title':response['data'][x]['subject_title']
                            }
                        );
                    }
                }
                setList();
            }
        });
    }

    function setSchoolList() {
        var t_val = area_item.val();
        $("#school_id option").remove();
        for(var x=0;x<school_item.length;x++){
            if(school_item[x]['area'] == t_val){
                school_id_item.append($("<option></option>").attr("value", school_item[x]['id']).text(school_item[x]['school_title']));
            }
        }
    }

    function setList() {
        for(var x=0;x<subject_item.length;x++){
            var t = tr_item.clone();
            var school_name = getSchoolName(subject_item[x]['school_id']);
            t.find('#school_area').html(school_name).removeAttr('id');
            t.find('#subject_area').html(subject_item[x]['subject_title']).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }

    function getSchoolName(id)
    {
        for(var x=0;x<school_item.length;x++){
            if(school_item[x]['id'] == id){

               return school_item[x]['school_title'];
            }
        }
    }

    var isSend = false;
    function addSubject(){
        if(!isSend){
            $.ajax({
                url: "[! route('ma.subject.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    subject_title:$('#subject_title').val(),
                    school_id:$('#school_id').val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
                        subject_item.push(
                            {
                                'id':response['id'],
                                'school_id':response['school_id'],
                                'subject_title':response['subject_title']
                            }
                        );
                        addList(response['subject_title'],response['id']);
                        alert(response['msg']);
                    }
                    isSend = false;
                }
            });
            isSend = true;
            clearInput();
        }
    }

    function addList(title,id) {
        var t = tr_item.clone();
        var school_name = getSchoolName(id);
        t.find('#school_area').html(school_name).removeAttr('id');
        t.find('#subject_area').html(school_name).removeAttr('id');
        t.removeAttr('id');
        list_item.append(t);
    }

    function clearInput() {
        $('#subject_title').val('');
    }
</script>
@stop