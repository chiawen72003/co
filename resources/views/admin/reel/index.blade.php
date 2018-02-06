@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        新增試卷
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">版本</label>
                <select id="version" class="i-select" onchange="setUnitList()">
                    <option value="1">全國</option>
                    <option value="2">中區</option>
                    <option value="3">測試</option>
                </select>
                <label class="i-label">科目</label>
                <select id="subject" class="i-select" onchange="setUnitList()">
                    <option value="1">國語</option>
                    <option value="2">國文</option>
                </select>
                <label class="i-label">冊</label>
                <select id="book" class="i-select" onchange="setUnitList()">
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
                <label class="i-label">單元</label>
                <select id="unit" class="i-select">
                </select>
                <label class="i-label">試卷名稱</label>
                <input type="text" class="i-input" id="reel_title">
                <button type="button" class="i-btn i-btn-primary" onclick="addReel()">
                    <i class="ion-android-add"></i>
                    新增
                </button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增試卷
            </div>
            <div class="table-wrapper">
                <table class="table" id="reel_list">
                    <tr id="point">
                        <th width="120">
                            <div class="cell center">版本</div>
                        </th>
                        <th>
                            <div class="cell">科目</div>
                        </th>
                        <th>
                            <div class="cell">冊</div>
                        </th>
                        <th>
                            <div class="cell">單元</div>
                        </th>
                        <th>
                            <div class="cell">試卷名稱</div>
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
        <td><div class="cell center" id="version_area"></div></td>
        <td><div class="cell"  id="subject_area"></div></td>
        <td><div class="cell"  id="book_area"></div></td>
        <td><div class="cell"  id="unit_area"></div></td>
        <td><div class="cell"  id="name_area"></div></td>
        <td>
            <div class="cell center">
                <a class="i-link" id="a_del"><i class="ion-trash-a"></i>移除</a>
            </div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_reel');
    var list_item = $('#reel_list');
    var version_item = $('#version');
    var subject_item = $('#subject');
    var book_item = $('#book');
    var unit_sw_item = $('#unit');
    var title_item = $('#reel_title');
    var tr_item = $('#copy_tr');
    var current = 'current';
    var unit_item = [];
    var reel_item = [];
    $( document ).ready(function() {
        setMenu('li_reel', 'main_li_3');
        getUnitData();//因ajax有差性，須先取得單元資料才能抓試卷資料。
    });

    function getUnitData() {
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
                                'unit_title':response['data'][x]['unit_title'],
                            }
                        );
                    }
                }
                setUnitList();
                getListData();
            }
        });
    }

    function getListData() {
        reel_item =[];
        //todo 這邊需要清空列表資料
        $('#point').after().remove();
        $.ajax({
            url: "[! route('ma.reel.list') !]",
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
                                'id':response['data'][x]['id'],
                                'version':response['data'][x]['version'],
                                'subject':response['data'][x]['subject'],
                                'book':response['data'][x]['book'],
                                'unit':response['data'][x]['unit'],
                                'reel_title':response['data'][x]['reel_title'],
                            }
                        );
                    }
                }
                setList();
            }
        });
    }

    function setUnitList() {
        var v = version_item.val();
        var s = subject_item.val();
        var b = book_item.val();
        $("#unit option").remove();
        for(var x=0;x<unit_item.length;x++){
            if(unit_item[x]['version'] == v && unit_item[x]['subject'] == s && unit_item[x]['book'] == b){
                unit_sw_item.append($("<option></option>").attr("value", unit_item[x]['id']).text(unit_item[x]['unit_title']));
            }
        }
    }

    function setList() {
        for(var x=0;x<reel_item.length;x++){
            var t = tr_item.clone();
            var v = $("#version option[value="+ reel_item[x]['version'] +"]").text();
            var s = $("#subject option[value="+ reel_item[x]['subject'] +"]").text();
            var b = $("#book option[value="+ reel_item[x]['book'] +"]").text();
            var u = getUnitName(reel_item[x]['unit']);
            var r = reel_item[x]['reel_title'];
            t.find('#version_area').html(v).removeAttr('id');
            t.find('#subject_area').html(s).removeAttr('id');
            t.find('#book_area').html(b).removeAttr('id');
            t.find('#unit_area').html(u).removeAttr('id');
            t.find('#name_area').html(r).removeAttr('id');
            t.find('#a_del').attr('onclick','unsetReel("'+reel_item[x]['id']+'")').removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }

    function getUnitName(id)
    {
        for(var x=0;x<unit_item.length;x++){
            if(unit_item[x]['id'] == id){

               return unit_item[x]['unit_title'];
            }
        }
    }

    var isSend = false;
    function addReel(){
        if(!isSend){
            $.ajax({
                url: "[! route('ma.reel.add') !]",
                type:'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    version:version_item.val(),
                    subject:subject_item.val(),
                    book:book_item.val(),
                    unit:unit_sw_item.val(),
                    reel_title:title_item.val(),
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response)
                {
                    if(response['status'] == true)
                    {
                        reel_item.push(
                            {
                                'id':response['id'],
                                'version':response['version'],
                                'subject':response['subject'],
                                'book':response['book'],
                                'unit':response['unit'],
                                'reel_title':response['reel_title'],
                            }
                        );
                        addList(response['version'],response['subject'],response['book'],response['unit'],response['reel_title']);
                        alert(response['msg']);
                    }
                    isSend = false;
                }
            });
            isSend = true;
            clearInput();
        }
    }

    function addList(version,subject,book,unit,reel_title) {
        var t = tr_item.clone();
        var v = $("#version option[value="+ version +"]").text();
        var s = $("#subject option[value="+ subject +"]").text();
        var b = $("#book option[value="+ book +"]").text();
        var u = getUnitName(unit);
        t.find('#version_area').html(v).removeAttr('id');
        t.find('#subject_area').html(s).removeAttr('id');
        t.find('#book_area').html(b).removeAttr('id');
        t.find('#unit_area').html(u).removeAttr('id');
        t.find('#name_area').html(reel_title).removeAttr('id');
        t.removeAttr('id');
        list_item.append(t);
    }

    function clearInput() {
        title_item.val('');
    }

    //移除試卷資料
    function unsetReel(id) {
        if(confirm("確定刪除試卷及相關的資料嗎?\r\n")) {
            $.ajax({
                url: "[! route('ma.reel.del') !]",
                type: 'POST',
                dataType: "json",
                data: {
                    _token: '[! csrf_token() !]',
                    reel_id: id,
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if (response['status'] == true) {
                        alert(response['msg']);
                    }
                    getListData();
                }
            });
        }
    }
</script>
@stop