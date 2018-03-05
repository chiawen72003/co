@extends('schoolman.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        新增班級
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label" id="school_area">區域</label>
                <label class="i-label" id="school_code">學校代碼</label>
                <label class="i-label" id="school_name">學校名稱</label>
                <label class="i-label">學年度</label>
                <input type="text" class="i-input" id="classes_year" value="" onkeydown="searchSchool()">
                <label class="i-label">班級</label>
                <input type="text" class="i-input" id="classes_name" value="" onkeydown="searchSchool()">
                <button type="button" class="i-btn i-btn-primary" onclick="addClasses()">
                    <i class="ion-android-add"></i>
                    新增
                </button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增班級
            </div>
            <div class="table-wrapper">
                <table class="table" id="school_list">
                    <tr id="tr_title">
                        <th width="120">
                            <div class="cell center">學年度</div>
                        </th>
                        <th width="120">
                            <div class="cell center">班級名稱</div>
                        </th>
                        <th>
                            <div class="cell">功能</div>
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
        <td><div class="cell center" id="year"></div></td>
        <td><div class="cell center" id="name"></div></td>
        <td>
            <div class="cell" >
                <input type="file" class="i-input" id="up_file" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                <a href="#" class="i-link" id="tool">匯入學生資料</a>
            </div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#school_list');
    var tr_item = $('#copy_tr');
    var school_item = [];
    var classes_item = [];
    var area_item = [];

    $( document ).ready(function() {
        setMenu('li_classes', 'main_li_1');
        getClassesData();
    });

    function getClassesData() {
        $.ajax({
            url: "[! route('sm.classes.init') !]",
            type:'GET',
            dataType: "json",
            data: {
                'sid':'[! $school_id !]'
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data']['classes_data'].length;x++){
                        var data = response['data']['classes_data'][x];
                        classes_item.push(
                            {
                                'id':data['id'],
                                'school_year':data['school_year'],
                                'title':data['title'],
                            }
                        );
                    }
                    for(var x=0;x<response['data']['area_data'].length;x++){
                        var data = response['data']['area_data'][x];
                        area_item.push(
                            {
                                'id':data['id'],
                                'name':data['name']
                            }
                        );
                    }
                    school_item = response['data']['school_data'];
                }
                setSchoolData();
                setClassesList();
            }
        });
    }

    //設定班級列表
    function setClassesList() {
        for(var x=0;x<classes_item.length;x++){
            var s_obj = classes_item[x];
            var t = tr_item.clone();
            t.find('#year').html(s_obj['school_year']).removeAttr('id');
            t.find('#name').html(s_obj['title']).removeAttr('id');
            t.find('#tool').attr('onclick', 'upExcel('+x+','+s_obj['id']+')').removeAttr('id');
            t.find('#up_file').attr('id', 'up_file_'+x);
            t.removeAttr('id');
            list_item.append(t);
        }
    }

    function setSchoolData() {
        var side = getAreaName(school_item['area']);
        $('#school_area').html(side);
        $('#school_code').html(school_item['code']);
        $('#school_name').html(school_item['school_title']);
    }

    //取得區域名稱
    function getAreaName(id) {
        for(var x=0;x<area_item.length;x++){
            if( area_item[x]['id']== id)
            {
                return area_item[x]['name'];
            }
        }

        return '';
    }

    //新增班級資料
    var isSend = false;
    function addClasses(){
        if(!isSend){
            $.ajax({
                url: "[! route('sm.classes.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    school_year:$('#classes_year').val(),
                    title:$('#classes_name').val(),
                    school_id:'[! $school_id !]'
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
                        alert(response['msg']);
                        location.reload();
                    }
                    isSend = false;
                }
            });
            isSend = true;
        }
    }

    //上傳excel
    function upExcel(id,classes_id)
    {
        var val = $("#up_file_"+id).val();
        if(val != ''){
            var form_data = new FormData();
            form_data.append('import_file', $("#up_file_"+id)[0].files[0]);
            form_data.append('_token', '[! csrf_token() !]');
            form_data.append('classes_id', classes_id);
            form_data.append('school_id', '[! $school_id !]');
            $.ajax({
                type:'POST',
                dataType: "json",
                url:"[! route('sm.classes.add.student') !]",
                processData: false,
                contentType: false,
                data:form_data,
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
                        alert(response['msg']);
                    }
                    isSend = false;
                }
            });
            isSend = true;
        }else{
            alert('請選擇要上傳的Excel檔案!!');
        }
    }
</script>
@stop