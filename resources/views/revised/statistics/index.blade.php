@extends('revised.layout.layout')
@section('content')
    <div class="article">
        <div class="article-header">
            批改統計
        </div>
        <div class="article-content">
            <div class="article-content-body">
                <div class="title">
                    <i class="ion-information-circled"></i>
                    批改統計列表
                </div>
                <div class="table-wrapper">
                    <table class="table">
                        <tr>
                            <th width="100">
                                <div class="cell">總批閱份數</div>
                            </th>
                            <td>
                                <div class="cell">581</div>
                            </td>
                        </tr>
                        <tr>
                            <th width="100">
                                <div class="cell">空白份數</div>
                            </th>
                            <td>
                                <div class="cell">0</div>
                            </td>
                        </tr>
                        <tr>
                            <th width="100">
                                <div class="cell">待批閱份數</div>
                            </th>
                            <td>
                                <div class="cell">346</div>
                            </td>
                        </tr>
                        <tr>
                            <th width="100">
                                <div class="cell">已批閱份數</div>
                            </th>
                            <td>
                                <div class="cell"><a href="" class="i-link">235</a></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_statistics');
    var current = 'current';
    $( document ).ready(function() {
        li_item.addClass( current);
    });
</script>
@stop