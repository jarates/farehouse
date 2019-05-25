@extends('layouts.master_layout')
@section('content')

    <?php use App\Components\Theme; ?>

	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">จัดการข้อมูลซัพพลายเออร์</h4> 
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
                        <a  href="#form" id="a-add" data-toggle="tab">ฟอร์มผู้ผลิต</a>
                    </li>
                    <li id="li-list">
                        <a href="#list" id="a-list" data-toggle="tab">รายการผู้ผลิต</a>
                    </li>
                </ul>

                <div class="tab-content ">
                    <div class="tab-pane active" id="form">
                        
                        <div class="col-form">
                
                            <form id="frm">
                                <input type="hidden" name="action" value="add">
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>ชื่อไทย</label>
                                                <input type="text" name="supplier_name" class="form-control" required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label>ชื่ออังกฤษ</label>
                                                <input type="text" name="supplier_name_en" class="form-control" required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label>เลขประจำตัวผู้เสียภาษีอากร</label>
                                                <input type="text" name="supplier_tax_number" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label>ที่อยู่บริษัท</label>
                                                <input type="text" name="supplier_address" class="form-control" required="">
                                            </div>
                                            <div class="col-md-4">
                                                <label>ระบบภาษี</label>
                                                <select name="supplier_tax_system" class="form-control" required="">
                                                    <option value=""></option>
                                                    @foreach(Theme::htmlDropdownSupTaxSystem() as $v)
                                                        <option value="{{$v}}">
                                                            {{$v}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row pdg">

                                            <div class="col-md-6">

                                                <div class="col-md-4">
                                                    <label>จังหวัด</label>
                                                    <select name="province_id" class="form-control" required="">
                                                        <option value="">-</option>
                                                        @foreach (Theme::get_province() as $province)
                                                            <option value="{{$province->id}}">
                                                                {{$province->name_th}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>อำเภอ</label>
                                                    <select disabled="" id="amphur_id" name="amphur_id" class="form-control" required="">
                                                        <option value="">-</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>ตำบล</label>
                                                    <select disabled="" name="district_id" class="form-control" required="">
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                
                                            </div>

                                            <div class="col-md-6">

                                                <div class="col-md-3">
                                                    <label>รหัสไปรษณีย์</label>
                                                    <input type="number" name="zip_code" class="form-control" required="">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>โทร</label>
                                                    <input type="number" name="tel" class="form-control" required="">
                                                </div>
                                                <div class="col-md-2">
                                                    <label>ต่อ</label>
                                                    <input type="number" name="tel_next" class="form-control">
                                                </div>
                                                <div class="col-md-3">
                                                    <label>โทรสาร</label>
                                                    <input type="number" name="fax" class="form-control">
                                                </div>
                                                
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>ชื่อผู้ติดต่อ</label>
                                                <input type="text" name="contact_name" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label>ตำแหน่ง</label>
                                                <input type="text" name="contact_position" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>โทรศัพท์(ผู้ติดต่อ)</label>
                                                <input type="text" name="contact_tel" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>โทรสาร(ผู้ติดต่อ)</label>
                                                <input type="text" name="contact_fax" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label>อีเมล์</label>
                                                <input type="email" name="contact_email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row pdg">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>วิธีชำระเงิน</label>
                                                        <select name="payment_method" class="form-control" required="">
                                                            <option value=""></option>
                                                            @foreach(Theme::htmlDropdownPaymentMethod() as $v)
                                                                <option value="{{$v}}">
                                                                    {{$v}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>ธนาคาร</label>
                                                        <input type="text" name="payment_bank" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>เลขที่บัญชี</label>
                                                        <input type="text" name="payment_bank_number" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>ประเภทบัญชี</label>
                                                        <select name="payment_bank_type" class="form-control" required="">
                                                            <option value=""></option>
                                                            @foreach(Theme::htmlDropdownPaymentBankType() as $v)
                                                                <option value="{{$v}}">
                                                                    {{$v}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>ชื่อบัญชี</label>
                                                        <input type="text" name="payment_bank_name" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>สาขา</label>
                                                        <input type="text" name="payment_bank_branch" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>การชำระค่าใช้จ่ายทางการค้า</label>
                                                        <input type="text" name="payment_commercial_expenses" class="form-control">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-3">
                                                <label>หมายเหตุการจ่ายเงิน</label>
                                                <textarea class="form-control" rows="4" name="supplier_note_payment"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <button type="submit" id="btn-save" class="btn btn-default">บันทึก</button>
                                                <button type="button" onclick="javascript:window.location.reload()" class="btn btn-default">ล้างข้อมูล</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="list">   
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>รหัส</th>
                                    <th>ชื่อ(ภาษาไทย)</th>
                                    <th>ชื่อ(ภาษาอังกฤษ)</th>
                                    <th>เลขประจำตัวผู้เสียภาษี</th>
                                    <th>อัพเดทล่าสุด</th>
                                    <th>ผู้กระทำ</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $row => $supplier)
                                <tr>
                                    <td>{{ ($row+1) }}</td>
                                    <td>{{$supplier->supplier_id}}</td>
                                    <td>{{$supplier->supplier_name}}</td>
                                    <td>{{$supplier->supplier_name_en}}</td>
                                    <td>{{$supplier->supplier_tax_number}}</td>
                                    <td>{{Theme::fullDate($supplier->updated_date)}}</td>
                                    <td>{{$supplier->user_fullname}}</td>
                                    <td>
                                        <a href="" class="btn btn-default btn-xs">
                                            ลบ
                                        </a>
                                        <a href="javascript:" data-id="{{$supplier->supplier_id}}" class="btn btn-default btn-xs btn-edit">
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
            $('input[name=brand_product_name]').val(name);
            $('input[name=brand_product_id]').val(id);

        });

        $(document).ready(function() {
            $('#example').DataTable();
        });
		
        $("#frm").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "{{url('/setting/supplier/save')}}",
                data: $("#frm").serialize(),
                type: 'POST',
                dataType: 'json',
                beforeSend: function(res){
                    $('#btn-save').attr('disabled','disabled');
                    $('#pre-loading').html(htmlPreLoading());
                },
                success: function(res){
                    $('#pre-loading').html('');
                    $('#btn-save').removeAttr('disabled');
                    if(res.status == 'success'){
                        window.location.href='?tab=list';
                    }
                }
            });return false;
        });

        $('select[name=province_id]').on('change',function(){
            var province_id = this.value;
            
            changeProvinceGetAmphur(province_id);

        });

        function changeProvinceGetAmphur(province_id,amphur_id=null){
            $.ajax({
                url: "{{url('/province/get_amphur_by_province')}}",
                data: {province_id:province_id,_token:"{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                beforeSend: function(res){

                    $('select[name=amphur_id]').attr('disabled','disabled');
                    $('select[name=amphur_id]').find('option').remove().end().append(
                        '<option value="">-</option>'
                    );

                    $('select[name=district_id]').attr('disabled','disabled');
                    $('select[name=district_id]').find('option').remove().end().append(
                        '<option value="">-</option>'
                    );

                    $('input[name=zip_code]').val('');
                },
                success: function(res){
                    if(res.status == 'success'){
                        $('select[name=amphur_id]').removeAttr('disabled');
                        $.each(res.data, function(index, item){
                            var selected = '';
                            if(amphur_id == item.id){
                                selected = 'selected';
                            }
                            $('select[name=amphur_id]').append(
                                '<option value="'+item.id+'" '+selected+'>'+item.name_th+'</option>'
                            );
                        });
                    }
                }
            });return false;
        }

        $('select[name=amphur_id]').on('change',function(){
            var amphur_id = this.value;
            
            changeAmphurGetDistrict(amphur_id);

        });

        function changeAmphurGetDistrict(amphur_id,district_id=null){
            $.ajax({
                url: "{{url('/province/get_district_by_amphur')}}",
                data: {amphur_id:amphur_id,_token:"{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                beforeSend: function(res){
                    $('select[name=district_id]').attr('disabled','disabled');
                    $('select[name=district_id]').find('option').remove().end().append(
                        '<option value="">-</option>'
                    );
                    $('input[name=zip_code]').val('');
                },
                success: function(res){
                    if(res.status == 'success'){
                        $('select[name=district_id]').removeAttr('disabled');
                        $.each(res.data, function(index, item){
                            var selected = '';
                            if(district_id == item.id){
                                selected = 'selected';
                            }
                            $('select[name=district_id]').append(
                                '<option value="'+item.id+'" '+selected+'>'+item.name_th+'</option>'
                            );
                        });
                        $('input[name=zip_code]').val(res.data[0].zip_code);
                    }
                }
            });return false;
        }

        $(".btn-edit").on('click', function(){
            var supplier_id = $(this).attr('data-id');
            $.ajax({
                url: "{{url('/setting/supplier/edit')}}",
                data: {supplier_id:supplier_id,_token:"{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                beforeSend: function(res){
                    //$('#pre-loading').html(htmlPreLoading());
                },
                success: function(res){
                    //console.log(res);
                    //$('#pre-loading').html('');
                    if(res.status == 'success'){

                        $('.nav-tabs li').removeClass('active');
                        $('.nav-tabs #li-add').addClass('active');

                        $('.tab-pane').removeClass('active');
                        $('.tab-content #form').addClass('active');

                        $('input[name=supplier_name]').val(res.data.supplier_name);
                        $('input[name=supplier_name_en]').val(res.data.supplier_name_en);
                        $('input[name=supplier_tax_number]').val(res.data.supplier_tax_number);
                        $('input[name=supplier_address]').val(res.data.supplier_address);
                        $('select[name=supplier_tax_system]').val(res.data.supplier_tax_system);
                        $('textarea[name=supplier_note_payment]').val(res.data.supplier_note_payment);
                        $('input[name=zip_code]').val(res.data.zip_code);
                        $('input[name=tel]').val(res.data.tel);
                        $('input[name=tel_next]').val(res.data.tel_next);
                        $('input[name=fax]').val(res.data.fax);

                        $('input[name=contact_name]').val(res.data.contact_name);
                        $('input[name=contact_position]').val(res.data.contact_position);
                        $('input[name=contact_tel]').val(res.data.contact_tel);
                        $('input[name=contact_fax]').val(res.data.contact_fax);
                        $('input[name=contact_email]').val(res.data.contact_email);

                        $('select[name=payment_method]').val(res.data.payment_method);
                        $('input[name=payment_bank]').val(res.data.payment_bank);
                        $('input[name=payment_bank_number]').val(res.data.payment_bank_number);
                        $('select[name=payment_bank_type]').val(res.data.payment_bank_type);

                        $('input[name=payment_bank_name]').val(res.data.payment_bank_name);
                        $('input[name=payment_bank_branch]').val(res.data.payment_bank_branch);
                        $('input[name=payment_commercial_expenses]').val(res.data.payment_commercial_expenses);

                        $('input[name=action]').val('edit');
                        $('#frm').append('<input type="hidden" name="supplier_id" value="'+res.data.supplier_id+'">');
                        
                        changeProvinceGetAmphur(res.data.province_id,res.data.amphur_id);
                        changeAmphurGetDistrict(res.data.amphur_id,res.data.district_id);
                        $('select[name=province_id]').val(res.data.province_id);

                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }
                }
            });
        });

        $(".btn-del").on('click', function(){
            var supplier_id = $(this).attr('data-id');

            if(confirm('ยืนยันการลบข้อมูล?')){
                $.ajax({
                    url: "{{url('/setting/supplier/del')}}",
                    data: {supplier_id:supplier_id,_token:"{{csrf_token()}}"},
                    type: 'POST',
                    dataType: 'json',
                    beforeSend: function(res){
                        $('#pre-loading').html(htmlPreLoading());
                    },
                    success: function(res){
                        console.log(res);
                        $('#pre-loading').html('');
                        if(res.status == 'success'){

                            window.location.href='?tab=list';

                        }
                    }
                });
            }
        });

	</script>

@endsection