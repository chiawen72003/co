@extends('schoolman.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        作答結果查詢
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
                <button type="button" class="i-btn i-btn-primary" onclick="searchReel()">
                    <i class="ion-android-add"></i>
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
                    <tr id="tr_title">
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
                <a class="i-link" id="a_search"><i class="ion-trash-a"></i>查詢</a>
            </div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#reel_list');
    var version_item = $('#version');
    var subject_item = $('#subject');
    var book_item = $('#book');
    var unit_sw_item = $('#unit');
    var tr_item = $('#copy_tr');
    var current = 'current';
    var unit_item = [];
    var reel_item = [];
    var unit_id = [! isset($unit_id)?$unit_id:0 !];
    $( document ).ready(function() {
        setMenu('li_reel_analysis', '');
        getInitData();
    });

    //取得初始化資料
    function getInitData() {
        $.ajax({
            url: "[! route('sm.analysis.init') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data']['unit'].length;x++)
                    {
                        var t_data = response['data']['unit'][x];
                        unit_item.push(
                            {
                                'id':t_data['id'],
                                'version':t_data['version'],
                                'subject':t_data['subject'],
                                'book':t_data['book'],
                                'unit_title':t_data['unit_title'],
                            }
                        );
                        //如果有指定查詢的單元ID時
                        if(t_data['id'] == unit_id){
                            version_item.val(t_data['version']);
                            subject_item.val(t_data['subject']);
                            book_item.val(t_data['book']);
                        }
                    }
                    for(var x=0;x<response['data']['reel'].length;x++)
                    {
                        var t_data = response['data']['reel'][x];
                        reel_item.push(
                            {
                                'id':t_data['id'],
                                'version':t_data['version'],
                                'subject':t_data['subject'],
                                'book':t_data['book'],
                                'unit':t_data['unit'],
                                'reel_title':t_data['reel_title'],
                            }
                        );
                    }
                }
                setUnitList();
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
                //如果有指定查詢的單元ID時
                if(unit_item[x]['id'] == unit_id){
                    unit_sw_item.append($("<option></option>").attr("value", unit_item[x]['id']).attr('selected', true).text(unit_item[x]['unit_title']));
                }else{
                    unit_sw_item.append($("<option></option>").attr("value", unit_item[x]['id']).text(unit_item[x]['unit_title']));
                }
            }
        }
    }

    function setList() {
        version = version_item.val();
        subject = subject_item.val();
        book = book_item.val();
        unit = unit_sw_item.val();
        for(var x=0;x<reel_item.length;x++){
            if(reel_item[x]['version'] == version && reel_item[x]['subject'] == subject && reel_item[x]['book'] == book  && reel_item[x]['unit'] == unit)
            {
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
                t.find('#a_search').attr('onclick','chgList("'+ reel_item[x]['id'] +'")').removeAttr('id');
                t.removeAttr('id');
                list_item.append(t);
            }
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
    
    function searchReel()
    {
        if(unit_sw_item.val() != null)
        {
            location.href = "[! route('sm.analysis') !]?unit_id="+unit_sw_item.val();
        }else{
            alert("請選擇要查詢的單元!!");
        }
    }

    function chgList(id)
    {
        location.href = "[! route('sm.analysis.list') !]?unit_id="+unit_id+'&reel_id='+id;
    }
</script>
@stop