@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        試題管理
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">版本</label>
                <select id="version" class="i-select" onchange="setUnitOption()">
                    <option value="1">全國</option>
                    <option value="2">中區</option>
                    <option value="3">測試</option>
                </select>
                <label class="i-label">科目</label>
                <select id="subject" class="i-select" onchange="setUnitOption()">
                    <option value="1">國語</option>
                    <option value="2">國文</option>
                </select>
                <label class="i-label">冊</label>
                <select id="book" class="i-select" onchange="setUnitOption()">
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
                <select id="unit" class="i-select" onchange="setReelOption()">
                </select>
                <label class="i-label">試卷名稱</label>
                <select id="reel" class="i-select">
                </select>
                <button type="button" class="i-btn i-btn-primary" onclick="rePath()">
                    <i class="ion-android-add"></i>
                    查詢
                </button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增試題
                <div class="title-right">
                    @if($has_reel_id)
                        <a href="[! route('ma.question.pg.add') !]?reelID=[! $reel_id !]" class="i-add i-btn-primary"><i class="ion-android-add"></i>新增試題</a>
                    @else
                        <a href="[! route('ma.question.pg.add') !]" class="i-add i-btn-primary"><i class="ion-android-add"></i>新增試題</a>
                    @endif
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table" id="question_list">
                    <tr>
                        <th>
                            <div class="cell">試題名稱</div>
                        </th>
                        <th width="300">
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
        <td><div class="cell" id="title_area"></div></td>
        <td>
            <div class="cell center">
                <a href="#" class="i-link" id="a_area"><i class="ion-android-settings"></i>編輯</a>
                <a class="i-link" id="a_del"><i class="ion-trash-a"></i>移除</a>
            </div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#question_list');
    var tr_item = $('#copy_tr');
    var question_item = [];
    var unit_item = [];
    var reel_item = [];
    var version_item = $('#version');
    var subject_item = $('#subject');
    var book_item = $('#book');
    var unit_sw_item = $('#unit');
    var reel_sw_item = $('#reel');

    $( document ).ready(function() {
        setMenu('li_question', 'main_li_3');
        getApiData();
        @if($has_reel_id)
        getQuestionData();
        @endif
    });

    function getApiData() {
        $.ajax({
            url: "[! route('ma.question.api') !]",
            type:'GET',
            dataType: "json",
            data: {
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data']['unit'].length;x++){
                        unit_item.push(
                            {
                                'id':response['data']['unit'][x]['id'],
                                'version':response['data']['unit'][x]['version'],
                                'subject':response['data']['unit'][x]['subject'],
                                'book':response['data']['unit'][x]['book'],
                                'unit_title':response['data']['unit'][x]['unit_title'],
                            }
                        );
                    }
                    for(var x=0;x<response['data']['reel'].length;x++){
                        reel_item.push(
                            {
                                'id':response['data']['reel'][x]['id'],
                                'version':response['data']['reel'][x]['version'],
                                'subject':response['data']['reel'][x]['subject'],
                                'book':response['data']['reel'][x]['book'],
                                'unit':response['data']['reel'][x]['unit'],
                                'reel_title':response['data']['reel'][x]['reel_title'],
                            }
                        );
                    }
                }
                setUnitOption();
                setReelOption();
                @if($has_reel_id)
                setReel('[! $reel_id !]');
                @endif

            }
        });
    }

    /**
     * 單元選項設定
     */
    function setUnitOption() {
        var v = version_item.val();
        var s = subject_item.val();
        var b = book_item.val();
        $("#unit option").remove();
        $("#reel option").remove();
        for(var x=0;x<unit_item.length;x++){
            if(unit_item[x]['version'] == v && unit_item[x]['subject'] == s && unit_item[x]['book'] == b){
                unit_sw_item.append($("<option></option>").attr("value", unit_item[x]['id']).text(unit_item[x]['unit_title']));
            }
        }
        setReelOption();
    }

    /**
     * 試卷選項設定
     */
    function setReelOption() {
        var unit_val = unit_sw_item.val();
        $("#reel option").remove();
        for(var x=0;x<reel_item.length;x++){
            if(reel_item[x]['unit'] == unit_val){
                reel_sw_item.append($("<option></option>").attr("value", reel_item[x]['id']).text(reel_item[x]['reel_title']));
            }
        }
    }

    /**
     * 轉址
     */
    function rePath() {
        if(reel_sw_item.val() != ''){
            location.href = "[! route('ma.question') !]?reelID="+reel_sw_item.val();
        }
    }

    /**
     * 取指定試卷的所有試題資料
     */
    function getQuestionData() {
        $.ajax({
            url: "[! route('ma.question.list') !]",
            type:'GET',
            dataType: "json",
            data: {
                'id':'[! $reel_id !]',
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    for(var x=0;x<response['data'].length;x++){
                        question_item.push(
                            {
                                'id':response['data'][x]['id'],
                                'question_name':response['data'][x]['question_name'],
                                'type':response['data'][x]['type'],
                                'type_title':response['data'][x]['type_title'],
                            }
                        );
                    }
                }
                setQuestionList();
            }
        });
    }

    /**
     * 設定試題列表
     */
    function setQuestionList() {
        for(var x=0;x<question_item.length;x++){
            var t = tr_item.clone();
            var a = "[! route('ma.question.pg.edit') !]?id="+ question_item[x]['id']+'&reelID=[! $reel_id !]';
            var r = question_item[x]['question_name'];
            t.find('#title_area').html(r).removeAttr('id');
            t.find('#a_area').attr('href',a).removeAttr('id');
            t.find('#a_del').attr('onclick','unsetQuestion("'+question_item[x]['id']+'")').removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }

    /**
     * 根據試卷ID設定單元跟試卷的下拉選項
     */
    function setReel(reel_id) {
        for(var x=0;x<reel_item.length;x++){
            if(reel_item[x]['id'] == reel_id){
                var t_obj = reel_item[x];
                $('#version').val(t_obj['version']);
                $('#subject').val(t_obj['subject']);
                $('#book').val(t_obj['book']);
                setUnitOption();
                $('#unit').val(t_obj['unit']);
                setReelOption();
                $('#reel').val(t_obj['id']);
            }
        }
    }

    //移除試題資料
    function unsetQuestion(id) {
        if(confirm("確定刪除試題的資料嗎?\r\n")) {
            $.ajax({
                url: "[! route('ma.question.del') !]",
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
                    location.reload();
                }
            });
        }
    }
</script>
@stop