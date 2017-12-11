@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        試題管理
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <div class="form-group">
                    <div class="form-inline">
                        <label class="i-label">試題名稱</label>
                        <input type="text" class="i-input">
                    </div>
                    <button type="button" class="i-btn">
                        查詢
                    </button>
                </div>
            </form>
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增試題
                <div class="title-right">
                    <a href="[! route('ma.question.pg.add') !]" class="i-add i-btn-primary"><i class="ion-android-add"></i>新增試題</a>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table" id="question_list">
                    <tr>
                        <th>
                            <div class="cell">試題名稱</div>
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
        <td><div class="cell" id="title_area"></div></td>
        <td>
            <div class="cell center"><a href="#" class="i-link" id="a_area"><i class="ion-android-settings"></i>編輯</a></div>
        </td>
    </tr>
</table>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_question');
    var list_item = $('#question_list');
    var tr_item = $('#copy_tr');
    var current = 'current';
    var question_item = [];
    $( document ).ready(function() {
        li_item.addClass( current);
        getQuestionData();
    });

    function getQuestionData() {
        $.ajax({
            url: "[! route('ma.question.list') !]",
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
                        question_item.push(
                            {
                                'id':response['data'][x]['id'],
                                'question_title':response['data'][x]['question_title'],
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

    function setQuestionList() {
        for(var x=0;x<question_item.length;x++){
            var t = tr_item.clone();
            var a = "[! route('ma.question.pg.edit') !]?id="+ question_item[x]['id'];
            var r = question_item[x]['question_title'];
            t.find('#title_area').html(r).removeAttr('id');
            t.find('#a_area').attr('href',a).removeAttr('id');
            t.removeAttr('id');
            list_item.append(t);
        }
    }
</script>
@stop