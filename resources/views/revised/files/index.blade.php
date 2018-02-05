@extends('revised.layout.layout')
@section('content')
    <div class="article">
        <div class="article-header">
            檔案下載
        </div>
        <div class="article-content">
            <div class="article-content-body">
                <div class="table-wrapper">
                    <table class="table">
                        <tr id="insert_point">
                            <th width="100">
                                <div class="cell">編號</div>
                            </th>
                            <th >
                                <div class="cell">檔案名稱</div>
                            </th>
                            <th  width="100">
                                <div class="cell">功能</div>
                            </th>
                        </tr>
                        @foreach($list_data as $k => $v)
                            <tr >
                                <td>
                                    <div class="cell" >[! $k+1 !]</div>
                                </td>
                                <td><div class="cell">[! $v['title'] !]</div></td>
                                <td><div class="cell"><a class="i-link"  target="_blank" href="[! route('rv.files.download',array($v['id'])) !]">下載</a></div></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="">
                    [! $list_data -> links()  !]
                </div>
            </div>
        </div>
    </div>
    [! Html::script('js/jquery-1.11.3.js') !]
    <script>
        var li_item = $('#li_files');
        var tr_item = $('#copy_tr');
        var current = 'current';
        $( document ).ready(function() {
            li_item.addClass( current);
        });

    </script>
@stop