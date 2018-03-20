@extends('admin.layout.layout')
@section('content')
    <div class="article">
        <div class="article-header">
            課程-班級設定
        </div>
        <div class="article-content">
            <div class="article-content-header">
                <form>
                    <label class="i-label">學校</label>
                    <input type="text" class="i-input" id="subject_title" value="" onkeydown="searchSchool()">
                </form>
            </div>
            <div class="article-content-body">
                <div class="title">
                    <i class="ion-information-circled"></i>
                    已新增學校
                </div>
                <div class="table-wrapper">
                    <table class="table" id="school_list">
                        <tr id="tr_title">
                            <th width="120">
                                <div class="cell center">區域</div>
                            </th>
                            <th width="120">
                                <div class="cell center">學校代碼</div>
                            </th>
                            <th>
                                <div class="cell">學校名稱</div>
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
            <td><div class="cell center" id="side"></div></td>
            <td><div class="cell center" id="code"></div></td>
            <td><div class="cell" ><a href="#" class="i-link" id="name"></a></div></td>
        </tr>
    </table>
    [! Html::script('js/jquery-1.11.3.js') !]
    <script>
        var list_item = $('#school_list');
        var tr_item = $('#copy_tr');
        var search_obj = $('#subject_title');
        var school_item = [];
        var area_item = [];
        $( document ).ready(function() {
            setMenu('li_course_student', 'main_li_2');
            getSchoolData();
        });

        function getSchoolData() {
            $.ajax({
                url: "[! route('ma.school.init') !]",
                type:'GET',
                dataType: "json",
                data: {
                },
                error: function(xhr) {
                    //alert('Ajax request 發生錯誤');
                },
                success: function(response) {
                    if(response['status'] == true){
                        for(var x=0;x<response['data']['school_data'].length;x++){
                            var data = response['data']['school_data'][x];
                            school_item.push(
                                {
                                    'id':data['id'],
                                    'code':data['code'],
                                    'area':data['area'],
                                    'school_title':data['school_title']
                                }
                            );
                        }
                        for(var x=0;x<response['data']['area_data'].length;x++){
                            var data = response['data']['area_data'][x];
                            area_item.push(
                                {
                                    'id':data['id'],
                                    'name':data['name']
                                }
                            );
                        }
                    }
                    setSchoolList();
                }
            });
        }

        //設定學校列表
        function setSchoolList() {
            for(var x=0;x<school_item.length;x++){
                var s_obj = school_item[x];
                var t = tr_item.clone();
                var area_name = getAreaName(s_obj['area']);
                t.find('#side').html(area_name).removeAttr('id');
                t.find('#code').html(s_obj['code']).removeAttr('id');
                t.find('#name').attr('href','[! route("ma.course.student.page") !]?s_id='+s_obj['id']).html(s_obj['school_title']).removeAttr('id');
                t.removeAttr('id');
                list_item.append(t);
            }
        }

        //搜尋學校名稱
        function searchSchool()
        {
            var s_name = search_obj.val();
            //先清除學校資料
            list_item.find('tr').each(function(){
                if($(this).attr('id') != 'tr_title'){
                    $(this).remove();
                }
            });
            if(s_name == ''){
                setSchoolList();
            }else{
                //搜尋資料
                for(var x=0;x<school_item.length;x++){
                    var s_obj = school_item[x];
                    var t = tr_item.clone();
                    var title = s_obj['school_title'];
                    if(title.indexOf(search_obj.val()) >= 0)
                    {
                        var area_name = getAreaName(s_obj['area']);
                        t.find('#side').html(area_name).removeAttr('id');
                        t.find('#code').html(s_obj['code']).removeAttr('id');
                        t.find('#name').attr('href','[! route("ma.classes") !]?s_id='+s_obj['id']).html(s_obj['school_title']).removeAttr('id');
                        t.removeAttr('id');
                        list_item.append(t);
                    }
                }
            }

        }

        //取得區域名稱
        function getAreaName(id) {
            for(var x=0;x<area_item.length;x++){
                if( area_item[x]['id']== id)
                {
                    return area_item[x]['name'];
                }
            }

            return '';
        }
    </script>
@stop