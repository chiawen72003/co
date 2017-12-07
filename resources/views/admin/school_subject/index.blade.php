@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header">
        新增學校/科系
    </div>
    <div class="article-content">
        <div class="article-content-header">
            <form>
                <label class="i-label">學校名稱</label>
                <input type="text" class="i-input">
                <label class="i-label">代碼</label>
                <input type="text" class="i-input">
                <label class="i-label">區域</label>
                <select id="">
                    <option value="1">北一區</option>
                    <option value="2">北二區</option>
                    <option value="3">桃竹苗區</option>
                    <option value="4">中區</option>
                    <option value="5">雲嘉南區</option>
                    <option value="6">高屏區</option>
                    <option value="7">東區</option>
                </select>
                <button class="i-btn">新增</button>
            </form>
        </div>
        <div class="article-content-body">
            <div class="table-wrapper">
                <table class="table">
                    <tr>
                        <th width="120">
                            <div class="cell center">學校代碼</div>
                        </th>
                        <th>
                            <div class="cell">學校名稱</div>
                        </th>
                    </tr>
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0050</div></td>
                        <td><div class="cell">國立中興大學</div></td>
                    </tr>
                </table>
            </div>
            <div class="right mt1">
                <button class="i-btn i-btn-primary i-btn-circle">
                    <i class="ion-android-add"></i>
                    新增
                </button>
            </div>
            <hr>
            <div class="title">
                <i class="ion-information-circled"></i>
                已新增學校
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <tr>
                        <th width="120">
                            <div class="cell center">學校代碼</div>
                        </th>
                        <th>
                            <div class="cell">學校名稱</div>
                        </th>
                    </tr>
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0050</div></td>
                        <td><div class="cell">國立中興大學</div></td>
                    </tr>
                    <!--  -->
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0050</div></td>
                        <td><div class="cell">國立中興大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0050</div></td>
                        <td><div class="cell">國立中興大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0039</div></td>
                        <td><div class="cell">國立臺中教育大學</div></td>
                    </tr>
                    <tr>
                        <td><div class="cell center">0050</div></td>
                        <td><div class="cell">國立中興大學</div></td>
                    </tr>
                    <!--  -->
                </table>
            </div>
        </div>
    </div>
</div>
@stop