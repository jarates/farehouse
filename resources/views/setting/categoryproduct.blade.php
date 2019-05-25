@extends('layouts.master_layout')
@section('content')

    <?php use App\Components\Theme; ?>

	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">จัดการข้อมูลหมวดหมู่สินค้า</h4> 
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <span class="pull-right m-l-20 hidden-xs hidden-sm">
                วันที่ {{Theme::dateToday()}}
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12">

            <div class="white-box">
                
                <ul class="nav nav-tabs">
                    <li class="active" id="li-add">
                        <a  href="#form" id="a-add" data-toggle="tab">ฟอร์มหมวดหมู่สินค้า</a>
                    </li>
                    <li id="li-list">
                        <a href="#list" id="a-list" data-toggle="tab">รายการหมวดหมู่สินค้า</a>
                    </li>
                </ul>

                <div class="tab-content ">
                    <div class="tab-pane active" id="form">
                        
                        <form class="frm" id="frm">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="category_product_id" value="">
                            <div>
                                <label>ชื่อหมวดหมู่สินค้า</label>
                                <input type="text" name="category_product_name" required="" class="form-control">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default">บันทึก</button>
                                <a href="?tab=list" class="btn btn-default">ยกเลิก</a>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane" id="list">   
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อหมวดหมู่สินค้า</th>
                                    <th>อัพเดทล่าสุด</th>
                                    <th>ผู้กระทำ</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cates as $row => $type)
                                <tr>
                                    <td>{{($row+1)}}</td>
                                    <td>{{$type->category_product_name}}</td>
                                    <td>
                                        {{Theme::fullDate($type->update_date)}}
                                    </td>
                                    <td>
                                        {{$type->update_user}}
                                    </td>
                                    <td>
                                        <a href="javascript:" data-name="{{$type->category_product_name}}" data-id="{{$type->category_product_id}}" class="btn btn-default btn-xs btn-edit">
                                            แก้ไข
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')
	
	<script>

        $("#frm").submit(function(){

            $.ajax({
                url: "{{url('/setting/category-product/save')}}",
                data: $(this).serialize(),
                type: 'POST',
                dataType: 'json',
                beforeSend: function(res){

                },
                success: function(res){
                    if(res.status == 'success'){
                        window.location.href='?tab=list';
                    }
                }
            }); return false;

        });

        $(document).ready(function() {
            $('#example').DataTable();
        });

        @if($tab == 'list')

            $('.nav-tabs li').removeClass('active');
            $('.nav-tabs #li-list').addClass('active');

            $('.tab-pane').removeClass('active');
            $('.tab-content #list').addClass('active');

        @endif

        $('.btn-edit').on('click', function(){
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            
            $('.nav-tabs li').removeClass('active');
            $('.nav-tabs #li-add').addClass('active');

            $('.tab-pane').removeClass('active');
            $('.tab-content #form').addClass('active');

            $('input[name=action]').val('edit');
            $('input[name=category_product_name]').val(name);
            $('input[name=category_product_id]').val(id);

        });
    </script>

@endsection