@extends('layouts.master_layout')
@section('content')

    <?php use App\Components\Theme; ?>

	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">จัดการข้อมูลบริษัท</h4> 
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <span class="pull-right m-l-20 hidden-xs hidden-sm">
                วันที่ {{Theme::dateToday()}}
            </span>
        </div>
        <div class="col-lg-12">
            <div class="col-form">
                
                <form id="frm">
                    <input type="hidden" name="action" value="edit">
                    <div class="row">
                        <div class="col-md-9">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <label>ชื่อ</label>
                                    <input type="text" name="name" class="form-control" required="" value="{{$info_company->name}}">
                                </div>
                                <div class="col-md-6">
                                    <label>เลขประจำตัวผู้เสียภาษีอากร</label>
                                    <input type="text" name="tax_number" class="form-control" required="" value="{{$info_company->tax_number}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>ที่อยู่บริษัท</label>
                                    <input type="text" name="address" class="form-control" required="" value="{{$info_company->address}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>จังหวัด</label>
                                    <select name="address_province_id" class="form-control" required="">
                                        <option value="">-</option>
                                        @foreach (Theme::get_province() as $province)
                                            <option value="{{$province->id}}">
                                                {{$province->name_th}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>อำเภอ</label>
                                    <select disabled="" name="address_amphur_id" class="form-control" required="">
                                        <option value="">-</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>ตำบล</label>
                                    <select disabled="" name="address_district_id" class="form-control" required="">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>รหัสไปรษณีย์</label>
                                    <input type="number" name="address_zip_code" class="form-control" required="" value="{{$info_company->address_zip_code}}">
                                </div>
                                <div class="col-md-2">
                                    <label>โทร</label>
                                    <input type="number" name="address_tel" class="form-control" required="" value="{{$info_company->address_tel}}">
                                </div>
                                <div class="col-md-2">
                                    <label>ต่อ</label>
                                    <input type="number" name="address_tel_next" class="form-control" value="{{$info_company->address_tel_next}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        ที่อยู่ส่งของ
                                        <input type="checkbox" name="use_address" class="checkbox-input" value="1" @if ($info_company->use_address == 1) checked @endif>
                                        ใช้ที่อยู่บริษัท
                                    </label>
                                    <input type="text" name="address_delivery" class="form-control" required="" value="{{$info_company->address_delivery}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>จังหวัด</label>
                                    <select name="address_delivery_province_id" class="form-control" required="">
                                        <option value="">-</option>
                                        @foreach (Theme::get_province() as $province)
                                            <option value="{{$province->id}}">
                                                {{$province->name_th}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>อำเภอ</label>
                                    <select disabled="" name="address_delivery_amphur_id" class="form-control" required="">
                                        <option value="">-</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>ตำบล</label>
                                    <select disabled="" name="address_delivery_district_id" class="form-control" required="">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>รหัสไปรษณีย์</label>
                                    <input type="number" name="address_delivery_zip_code" class="form-control" required="" value="{{$info_company->address_delivery_zip_code}}">
                                </div>
                                <div class="col-md-2">
                                    <label>โทร</label>
                                    <input type="number" name="address_delivery_tel" class="form-control" required="" value="{{$info_company->address_delivery_tel}}">
                                </div>
                                <div class="col-md-2">
                                    <label>ต่อ</label>
                                    <input type="number" name="address_delivery_tel_next" class="form-control" value="{{$info_company->address_delivery_tel_next}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="p-editor">
                                        <label><strong>แก้ไขล่าสุด</strong> {{Theme::fullDateTime($info_company->updated_date)}}</label>
                                        <label><strong>โดย</strong> {{$info_company->user_fullname}}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 t-right">
                                    <button type="submit" id="btn-save" class="btn btn-default">
                                        อัพเดทข้อมูล
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@section('scripts')
	
	<script>

        $(function(){

            $('select[name=address_province_id]').val("{{$info_company->address_province_id}}");
            changeProvinceGetAmphur("{{$info_company->address_province_id}}","{{$info_company->address_amphur_id}}",'address_amphur_id','address_district_id','address_zip_code');
            changeAmphurGetDistrict("{{$info_company->address_amphur_id}}","{{$info_company->address_district_id}}",'address_district_id','address_zip_code');



            $('select[name=address_delivery_province_id]').val("{{$info_company->address_delivery_province_id}}");
            changeProvinceGetAmphur("{{$info_company->address_delivery_province_id}}","{{$info_company->address_delivery_amphur_id}}",'address_delivery_amphur_id','address_delivery_district_id','address_delivery_zip_code');
            changeAmphurGetDistrict("{{$info_company->address_delivery_amphur_id}}","{{$info_company->address_delivery_district_id}}",'address_delivery_district_id','address_delivery_zip_code');

        });


        $('select[name=address_province_id]').on('change',function(){
            var province_id = this.value;
            
            changeProvinceGetAmphur(province_id,'','address_amphur_id','address_district_id','address_zip_code');

        });
        $('select[name=address_amphur_id]').on('change',function(){
            var amphur_id = this.value;
            
            changeAmphurGetDistrict(amphur_id,'','address_district_id','address_zip_code');

        });


        $('select[name=address_delivery_province_id]').on('change',function(){
            var province_id = this.value;
            
            changeProvinceGetAmphur(province_id,'','address_delivery_amphur_id','address_delivery_district_id','address_delivery_zip_code');

        });
        $('select[name=address_delivery_amphur_id]').on('change',function(){
            var amphur_id = this.value;
            
            changeAmphurGetDistrict(amphur_id,'','address_delivery_district_id','address_delivery_zip_code');

        });

		
        function changeProvinceGetAmphur(province_id,amphur_id=null,name_amphur_id,name_district_id,name_zip_code){
            $.ajax({
                url: "{{url('/province/get_amphur_by_province')}}",
                data: {province_id:province_id,_token:"{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                beforeSend: function(res){

                    $('select[name='+name_amphur_id+']').attr('disabled','disabled');
                    $('select[name='+name_amphur_id+']').find('option').remove().end().append(
                        '<option value="">-</option>'
                    );

                    $('select[name='+name_district_id+']').attr('disabled','disabled');
                    $('select[name='+name_district_id+']').find('option').remove().end().append(
                        '<option value="">-</option>'
                    );

                    $('input[name='+name_zip_code+']').val('');
                },
                success: function(res){
                    if(res.status == 'success'){
                        $('select[name='+name_amphur_id+']').removeAttr('disabled');
                        $.each(res.data, function(index, item){
                            var selected = '';
                            if(amphur_id == item.id){
                                selected = 'selected';
                            }
                            $('select[name='+name_amphur_id+']').append(
                                '<option value="'+item.id+'" '+selected+'>'+item.name_th+'</option>'
                            );
                        });
                    }
                }
            });return false;
        }

        
        function changeAmphurGetDistrict(amphur_id,district_id=null,name_district_id,name_zip_code){
            $.ajax({
                url: "{{url('/province/get_district_by_amphur')}}",
                data: {amphur_id:amphur_id,_token:"{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                beforeSend: function(res){
                    $('select[name='+name_district_id+']').attr('disabled','disabled');
                    $('select[name='+name_district_id+']').find('option').remove().end().append(
                        '<option value="">-</option>'
                    );
                    $('input[name='+name_zip_code+']').val('');
                },
                success: function(res){
                    if(res.status == 'success'){
                        $('select[name='+name_district_id+']').removeAttr('disabled');
                        $.each(res.data, function(index, item){
                            var selected = '';
                            if(district_id == item.id){
                                selected = 'selected';
                            }
                            $('select[name='+name_district_id+']').append(
                                '<option value="'+item.id+'" '+selected+'>'+item.name_th+'</option>'
                            );
                        });
                        $('input[name='+name_zip_code+']').val(res.data[0].zip_code);
                    }
                }
            });return false;
        }

        $("#frm").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "{{url('/setting/company/save')}}",
                data: $(this).serialize(),
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
                        window.location.reload();
                    }
                    console.log(res);
                }
            });return false;
        });

	</script>

@endsection