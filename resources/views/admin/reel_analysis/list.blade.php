@extends('admin.layout.layout')
@section('content')
<div class="article">
    <div class="article-header" id="reel_name">
        試卷名稱
    </div>
    <div class="article-content">
        <div class="article-content-header">
        </div>
        <div class="article-content-body">
            <div class="title">
                <i class="ion-information-circled"></i>
                功能性題組1
            </div>
            <div class="table-wrapper">
                <table class="table" id="reel_list">
                    <tr id="tr_title">
                        <th width="300">
                            <div class="cell center"></div>
                        </th>
                        <th>
                            <div class="cell">級分</div>
                        </th>
                        <th>
                            <div class="cell">0</div>
                        </th>
                        <th>
                            <div class="cell">1</div>
                        </th>
                        <th>
                            <div class="cell">2</div>
                        </th>
                        <th>
                            <div class="cell">3</div>
                        </th>
                        <th>
                            <div class="cell">4</div>
                        </th>
                        <th>
                            <div class="cell">5</div>
                        </th>
                        <th>
                            <div class="cell">空白</div>
                        </th>
                    </tr>
                    <tr id="tr_title">
                        <td width="300">
                            <div class="cell">3-1能書寫切合功能性寫作文本目的的內容</div>
                        </td>
                        <td>
                            <div class="cell"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_1_0"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_1_1"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_1_2"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_1_3"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_1_4"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_1_5"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_1_blank"></div>
                        </td>
                    </tr>
                    <tr id="tr_title">
                        <td width="300">
                            <div class="cell">3-2能寫出切合功能性寫作文本語意清楚、語用正確、組織有條理的內容</div>
                        </td>
                        <td>
                            <div class="cell"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_2_0"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_2_1"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_2_2"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_2_3"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_2_4"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_2_5"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_2_blank"></div>
                        </td>
                    </tr>
                    <!--  -->
                </table>
            </div>
            <div class="title">
                <i class="ion-information-circled"></i>
                批判性題組9
            </div>
            <div class="table-wrapper">
                <table class="table" id="reel_list">
                    <tr id="tr_title">
                        <th width="300">
                            <div class="cell center"></div>
                        </th>
                        <th>
                            <div class="cell">級分</div>
                        </th>
                        <th>
                            <div class="cell">0</div>
                        </th>
                        <th>
                            <div class="cell">1</div>
                        </th>
                        <th>
                            <div class="cell">2</div>
                        </th>
                        <th>
                            <div class="cell">3</div>
                        </th>
                        <th>
                            <div class="cell">4</div>
                        </th>
                        <th>
                            <div class="cell">5</div>
                        </th>
                        <th>
                            <div class="cell">空白</div>
                        </th>
                    </tr>
                    <tr id="tr_title">
                        <td width="300">
                            <div class="cell">3-3能書寫切合批判性寫作文本目的的內容</div>
                        </td>
                        <td>
                            <div class="cell"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_3_0"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_3_1"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_3_2"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_3_3"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_3_4"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_3_5"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_3_blank"></div>
                        </td>
                    </tr>
                    <tr id="tr_title">
                        <td width="300">
                            <div class="cell">3-4能寫出切合批判性寫作文本語意清楚、語用正確、組織有條理的內容</div>
                        </td>
                        <td>
                            <div class="cell"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_4_0"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_4_1"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_4_2"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_4_3"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_4_4"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_4_5"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_4_blank"></div>
                        </td>
                    </tr>
                    <tr id="tr_title">
                        <td width="300">
                            <div class="cell">3-5能針對批判性寫作文本之特定議題寫出個人立場或想法</div>
                        </td>
                        <td>
                            <div class="cell"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_5_0"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_5_1"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_5_2"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_5_3"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_5_4"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_5_5"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_5_blank"></div>
                        </td>
                    </tr>
                    <tr id="tr_title">
                        <td width="300">
                            <div class="cell">3-6能整合與評估批判性寫作文本特定議題的兩方觀點並寫出來</div>
                        </td>
                        <td>
                            <div class="cell"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_6_0"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_6_1"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_6_2"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_6_3"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_6_4"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_6_5"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_6_blank"></div>
                        </td>
                    </tr>
                    <!--  -->
                </table>
            </div>

            <div class="title">
                <i class="ion-information-circled"></i>
                敘事性題組13
            </div>
            <div class="table-wrapper">
                <table class="table" id="reel_list">
                    <tr id="tr_title">
                        <th width="300">
                            <div class="cell center"></div>
                        </th>
                        <th>
                             <div class="cell">級分</div>
                        </th>
                        <th>
                            <div class="cell">0</div>
                        </th>
                        <th>
                            <div class="cell">1</div>
                        </th>
                        <th>
                            <div class="cell">2</div>
                        </th>
                        <th>
                            <div class="cell">3</div>
                        </th>
                        <th>
                            <div class="cell">4</div>
                        </th>
                        <th>
                            <div class="cell">5</div>
                        </th>
                        <th>
                            <div class="cell">空白</div>
                        </th>
                    </tr>
                    <tr id="tr_title">
                        <td width="300">
                            <div class="cell">3-7能針對命題寫出個人之經歷與感受</div>
                        </td>
                        <td>
                            <div class="cell"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_7_0"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_7_1"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_7_2"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_7_3"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_7_4"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_7_5"></div>
                        </td>
                        <td>
                            <div class="cell" id="num_7_blank"></div>
                        </td>
                    </tr>

                    <!--  -->
                </table>
            </div>
            <div class="form-group form-bottom" id="insert_point">
                <button type="button" class="i-btn" onclick="history.back()">
                    回上一頁
                </button>
                <button type="button" class="i-btn i-btn-primary" onclick="getExcel()">
                    檔案下載
                </button>
            </div>
        </div>
    </div>
</div>
[! Html::script('js/jquery-1.11.3.js') !]
<script>
    var list_item = $('#reel_list');
    var version_item = $('#version');
    var subject_item = $('#subject');
    var book_item = $('#book');
    var tr_item = $('#copy_tr');
    var current = 'current';
    var reel_item = [];
    $( document ).ready(function() {
        setMenu('li_reel_analysis', '');
        getInitData();
    });

    //取得初始化資料
    function getInitData() {
        $.ajax({
            url: "[! route('ma.reel.analysis.list.init') !]",
            type:'GET',
            dataType: "json",
            data: {
                'reel_id':'[! $reel_id !]'
            },
            error: function(xhr) {
                //alert('Ajax request 發生錯誤');
            },
            success: function(response) {
                if(response['status'] == true){
                    $('#reel_name').html('試卷名稱：'+response['reelname']);
                    for(var x=1;x<8;x++)
                    {
                        var t_array = response['data'][x];
                        console.log(response['data'][x]);
                        $('#num_'+x+'_0').html(t_array['0']);
                        $('#num_'+x+'_1').html(t_array['1']);
                        $('#num_'+x+'_2').html(t_array['2']);
                        $('#num_'+x+'_3').html(t_array['3']);
                        $('#num_'+x+'_4').html(t_array['4']);
                        $('#num_'+x+'_5').html(t_array['5']);
                        $('#num_'+x+'_blank').html(t_array['blank']);
                    }
                }
            }
        });
    }

    //下載excel
    function getExcel()
    {
        window.open('[! route("ma.reel.analysis.download.excel") !]?reel_id=[! $reel_id !]','_blank');
    }
</script>
@stop