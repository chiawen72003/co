@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        建立單元結構
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">版本</label>
                <select id="version">
                    <option value="1">全國</option>
                    <option value="2">中區</option>
                    <option value="3">測試</option>
                </select>
                <label class="i-label">科目</label>
                <select id="subject">
                    <option value="1">國語</option>
                    <option value="2">國文</option>
                </select>
                <label class="i-label">冊</label>
                <select id="book">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                </select>
                <label class="i-label">單元名稱</label>
                <input type="text" class="i-input" id="unit_title">
                <button type="button" class="i-btn i-btn-primary i-btn-circle" onclick="addUnit()">
                    <i class="ion-android-add"></i>
                    新增
                </button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增單元
            </div>
            <div class="table-wrapper">
                <table class="table" id="unit_list">
                    <tr>
                        <th width="120">
                            <div class="cell center">版本</div>
                        </th>
                        <th >
                            <div class="cell">科目</div>
                        </th>
                        <th >
                            <div class="cell">冊</div>
                        </th>
                        <th>
                            <div class="cell">單元名稱</div>
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
        <td><div class="cell center" id="version_area"></div></td>
        <td><div class="cell"  id="subject_area"></div></td>
        <td><div class="cell"  id="book_area"></div></td>
        <td><div class="cell"  id="name_area"></div></td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_question_bank');
    var list_item = $('#unit_list');
    var tr_item = $('#copy_tr');
    var version_item = $('#version');
    var subject_item = $('#subject');
    var book_item = $('#book');
    var title_item = $('#unit_title');
    var current = 'current';
    var unit_item = [];
    $( document ).ready(function() {
        li_item.addClass( current);
        getListData();
    });
    
    function getListData() {
        $.ajax({
            url: "[! route('ma.unit.list') !]",
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
                        unit_item.push(
                            {
                                'id':response['data'][x]['id'],
                                'version':response['data'][x]['version'],
                                'subject':response['data'][x]['subject'],
                                'book':response['data'][x]['book'],
                                'unit_title':response['data'][x]['unit_title']
                            }
                        );
                    }
                }
                setList();
            }
        });
    }

    function setList() {
        for(var x=0;x<unit_item.length;x++){
            var t = tr_item.clone();
            t.find('#version_area').html(unit_item[x]['version']).removeAttr('id');
            t.find('#subject_area').html(unit_item[x]['subject']).removeAttr('id');
            t.find('#book_area').html(unit_item[x]['book']).removeAttr('id');
            t.find('#name_area').html(unit_item[x]['unit_title']).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }
    var isSend = false;
    function addUnit(){
        if(!isSend){
            $.ajax({
                url: "[! route('ma.unit.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    version:version_item.val(),
                    subject:subject_item.val(),
                    book:book_item.val(),
                    unit_title:title_item.val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
                        unit_item.push(
                            {
                                'id':response['id'],
                                'version':response['version'],
                                'subject':response['subject'],
                                'book':response['book'],
                                'unit_title':response['unit_title'],
                            }
                        );
                        addList(response['version'],response['subject'],response['book'],response['unit_title']);
                        alert(response['msg']);
                    }
                    isSend = false;
                }
            });
            isSend = true;
            clearInput();
        }
    }

    function addList(version,subject,book,title) {
        var t = tr_item.clone();
        var v = $("#version option[value="+ id +"]").text();
        var s = $("#subject option[value="+ id +"]").text();
        var b = $("#book option[value="+ id +"]").text();
        t.find('#version_area').html(v).removeAttr('id');
        t.find('#subject_area').html(s).removeAttr('id');
        t.find('#book_area').html(b).removeAttr('id');
        t.find('#name_area').html(title).removeAttr('id');
        t.removeAttr('id');
        list_item.append(t);
    }

    function clearInput() {
        version_item.val(1);
        subject_item.val(1);
        book_item.val(1);
        title_item.val('');
    }
</script>
@stop