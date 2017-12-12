@extends('admin.layout.layout')
@section('content')
    <div class="article">
        <div class="article">
            <div class="article-header">
                使用者管理
            </div>
            <div class="article-content">
                <div class="article-content-body">
                    <div class="title">
                        <i class="ion-information-circled"></i>
                        修改密碼
                    </div>
                    <div class="i-form mt1">
                        <div class="form-group">
                            <label class="i-label">帳號</label>
                            <input type="text" class="i-input" value="admin" disabled>
                        </div>
                        <div class="form-group">
                            <label class="i-label">輸入舊密碼</label>
                            <input type="password" class="i-input">
                        </div>
                        <div class="form-group">
                            <label class="i-label">輸入新密碼</label>
                            <input type="password" class="i-input">
                        </div>
                        <div class="form-group">
                            <label class="i-label">驗證新密碼</label>
                            <input type="password" class="i-input">
                        </div>
                        <div class="form-group form-bottom">
                            <button type="button" class="i-btn">
                                取消
                            </button>
                            <button type="button" class="i-btn i-btn-primary">
                                新增
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var li_item = $('#li_user');
    var current = 'current';
    $( document ).ready(function() {
        li_item.addClass( current);
    });
</script>
@stop