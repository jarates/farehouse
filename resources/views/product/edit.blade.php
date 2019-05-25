@extends('layouts.master_layout')
@section('content')

    <?php use App\Components\Theme; ?>

	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">สินค้า / แก้ไขสินค้า ID = {{$product->product_id}}</h4> 
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <span class="pull-right m-l-20 hidden-xs hidden-sm">
                วันที่ {{Theme::dateToday()}}
            </span>
        </div>
        <div class="col-lg-12">
            <div class="col-form">
                
                <form id="frm" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="time" value="{{$time}}">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="row">
                                <div class="col-md-5">
                                    <label>รหัสสินค้า</label>
                                    <input type="text" onkeypress="return hasWhiteSpace()" name="product_id" class="form-control" required="" readonly="" value="{{$product->product_id}}">
                                </div>
                                <div class="col-md-5">
                                    <label>รหัส Barcode</label>
                                    <input type="text" onkeypress="return hasWhiteSpace()" name="product_barcode" class="form-control" required="" readonly="" value="{{$product->product_barcode}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label>ชื่อสินค้า</label>
                                    <input type="text" name="product_name" class="form-control" required="" value="{{$product->product_name}}">
                                </div>
                                <div class="col-md-5">
                                    <label>ชื่อผู้ส่งสินค้า (ซัพพลายเออร์)</label>
                                    <select name="supplier_id" class="form-control select2" required="">
                                        <option value="">-คลิกเพื่อค้นหาซัพพลายเออร์-</option>
                                        @foreach($suppliers as $supplier)

                                            <option value="{{$supplier->supplier_id}}" @if ($product->supplier_id == $supplier->supplier_id) selected @endif>{{$supplier->supplier_name}}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>ประเภทสินค้า</label>
                                    <select name="type_product_id" class="form-control select2" required="">
                                        <option value="">-</option>
                                        @foreach($typeproducts as $typeproduct)
                                            <option value="{{$typeproduct->type_product_id}}" @if ($product->type_product_id == $typeproduct->type_product_id) selected @endif>
                                                {{$typeproduct->type_product_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <label>หมวดหมู่สินค้า</label>
                                    <select name="category_product_id" class="form-control select2" required="">
                                        <option value="">-</option>
                                        @foreach($cateproducts as $cateproduct)
                                            <option value="{{$cateproduct->category_product_id}}" @if ($product->category_product_id == $cateproduct->category_product_id) selected @endif>
                                                {{$cateproduct->category_product_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>ยี้ห้อสินค้า</label>
                                    <select name="brand_product_id" class="form-control select2" required="">
                                        <option value="">-</option>
                                        @foreach($brandproducts as $brandproduct)
                                            <option value="{{$brandproduct->brand_product_id}}" @if ($product->brand_product_id == $brandproduct->brand_product_id) selected @endif>
                                                {{$brandproduct->brand_product_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>สี</label>
                                    <input type="text" name="product_color" class="form-control" value="{{$product->product_color}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>ราคาทุน (บาท)</label>
                                    <input step="any" type="number" name="product_price_cost" class="form-control" required="" value="{{$product->product_price_cost}}">
                                </div>
                                
                                <div class="col-md-4">
                                    <label>ราคาปกติ (บาท)</label>
                                    <input step="any" type="number" name="product_price_normal" class="form-control" required="" value="{{$product->product_price_normal}}">
                                </div>
                                <div class="col-md-4">
                                    <label>ราคาขาย (บาท)</label>
                                    <input step="any" type="number" name="product_price_sale" class="form-control" required="" value="{{$product->product_price_sale}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>ส่วนแบ่งรายได้ GP HPS</label>
                                    <div class="input-group">
                                      <input step="any" type="number" name="product_gp_hps" class="form-control" required="" value="{{$product->product_gp_hps}}">
                                      <span class="input-group-addon">%</span>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <label>GP TNEWS</label>
                                    <div class="input-group">
                                      <input step="any" type="number" name="product_gp_tnews" class="form-control" required="" value="{{$product->product_gp_tnews}}">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>GP Supplier</label>
                                    <div class="input-group">
                                      <input step="any" type="number" name="product_gp_supplier" class="form-control" required="" value="{{$product->product_gp_supplier}}">
                                      <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>อายุสินค้า (วัน)</label>
                                    <input type="number" name="product_age" class="form-control" required="" value="{{$product->product_age}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>รายละเอียดสินค้า</label>
                                    <textarea name="product_detail_full" class="form-control" rows="5">{{$product->product_detail_full}}</textarea>
                                </div>
                                
                                <div class="col-md-6">
                                    <label>รายละเอียดสินค้า (แบบย่อ)</label>
                                    <textarea name="product_detail_short" class="form-control" rows="5">{{$product->product_detail_short}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="p-small">กว้าง (เซนติเมตร)</label>
                                    <input step="any" type="number" name="product_dimension_width" class="form-control" value="{{$product->product_dimension_width}}">
                                </div>
                                
                                <div class="col-md-2">
                                    <label class="p-small">ยาว (เซนติเมตร)</label>
                                    <input step="any" type="number" name="product_dimension_length" class="form-control" value="{{$product->product_dimension_length}}">
                                </div>
                                <div class="col-md-2">
                                    <label class="p-small">สูง (เซนติเมตร)</label>
                                    <input step="any" type="number" name="product_dimension_height" class="form-control" value="{{$product->product_dimension_height}}">
                                </div>
                                <div class="col-md-3">
                                    <label class="p-small">น้ำหนักสินค้า (กิโลกรัม)</label>
                                    <input step="any" type="number" name="product_dimension_weight" class="form-control" value="{{$product->product_dimension_weight}}">
                                </div>
                                <div class="col-md-3">
                                    <label class="p-small">ปริมาณบรรจุภัณฑ์ (กรัม/กิโลกรัม)</label>
                                    <input step="any" type="number" name="product_dimension_pack_volume" class="form-control" value="{{$product->product_dimension_pack_volume}}">
                                </div>
                            </div>
                            <div class="row">

                                <span class="title-top-main">คำถามที่พบบ่อย</span>

                                <div class="content-faq">

                                    <input type="hidden" name="data_remove_faq_id" value="">

                                    @foreach($faqs as $faq)

                                    <div class="cv-pm" id="{{$faq->faq_id}}">

                                        <input type="hidden" name="faq_id[]" value="{{$faq->faq_id}}">

                                        <div class="col-md-10">
                                            <div class="alert alert-info">
                                                <div>
                                                    <label class="p-small">คำถาม</label>
                                                    <input required="" type="text" name="faq_name[]" class="form-control" value="{{$faq->faq_name}}">
                                                </div>
                                                <div>
                                                    <label class="p-small">คำตอบ</label>
                                                    <input required="" type="text" name="faq_answer_name[]" class="form-control" value="{{$faq->faq_answer_name}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:" data-id="{{$faq->faq_id}}" data-remove-id="{{$faq->faq_id}}" class="btn btn-default btn-del-faq">
                                                ลบ
                                            </a>
                                        </div>
                                    </div>

                                    @endforeach

                                </div>

                                <div class="col-md-12">
                                    <a href="javascript:" id="add-html-faq" class="btn btn-default">
                                        เพิ่มคำถาม
                                    </a>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="pull-right txt-red-small">
                                        คลิกที่รูปเพื่อลบภาพนั้น
                                    </span>
                                    <label>
                                        รูปภาพประกอบ
                                    </label>
                                    <div class="form-input-picture">
                                        
                                        <div class="preview-show">
                                            <input type="file" name="product_picture_name[]" multiple="" id="choose-file" accept="image/*">
                                            <div class="p-add" id="div-choose-file">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                            
                                        </div>
                                        <div class="pre-loading"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>หมายเหตุ</label>
                                    <textarea name="product_note" class="form-control" rows="5">{{$product->product_note}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 t-center">
                                    <button type="submit" id="btn-save" class="btn btn-default">
                                        บันทึก
                                    </button>
                                    <button type="button" onclick="javascript:window.location.reload()" class="btn btn-default">ล้างข้อมูล</button>
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

        delete_content_faq();

        getShowPictureUpload("{{$time}}","{{$product->product_id}}");

        $('#add-html-faq').on('click', function(){
            var time = Math.floor(Math.random() * 10)+'-'+Math.floor(Date.now() / 1000);
            $('.content-faq').append('{!! Theme::htmlFormFAQ("'+time+'") !!}');

            delete_content_faq();

        });

        function delete_content_faq(){

            $('.btn-del-faq').on('click', function(){
                //if(confirm('ยืนยันลบ content ใช่หรือไม่?')){
                    var faq_content_id = $(this).attr('data-id');
                    var data_remove_faq_id = $(this).attr('data-remove-id');
                    $('#'+faq_content_id).remove();

                    if(data_remove_faq_id != ''){
                        var old_data_remove_faq_id = $('input[name=data_remove_faq_id]');
                        old_data_remove_faq_id.val(old_data_remove_faq_id.val()+data_remove_faq_id+',');
                    }

                //}return false;
            });

        }

        $('#div-choose-file').on('click', function() {
            $('#choose-file').trigger('click');
        });

        $("#choose-file").on('change', function(e){
            e.preventDefault();
            var formData = new FormData($('#frm')[0]);
            $.ajax({
                url: "{{url('/product/picture/save')}}",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function(res){
                    $('.pre-loading').html('<div id="pt-uploading">กำลังอัพโหลด...</div>');
                },
                success: function(res){
                    $('.pre-loading').html('');
                    getShowPictureUpload(res.time, "{{$product->product_id}}");
                }
            });
        });

        function getShowPictureUpload(time, product_id){
            $.ajax({
                url: "{{url('/product/picture/uploadPreview')}}",
                data: {time:time,product_id:product_id,_token:"{{csrf_token()}}"},
                type: 'POST',
                dataType: 'json',
                success: function(res){
                    $('.preview-show .img').html('');
                    if(res.status == 'success'){
                        $.each(res.data, function(index, item){
                            $('.preview-show').append(
                                '<div class="img" data-id="'+item.id+'"><img src="'+item.img+'" class=""></div>'
                            );
                        });
                    }

                    $('.preview-show .img').on('click',function(){
                        if(confirm('ลบรูปนี้ใช่หรือไม่?')){

                            var id = $(this).attr('data-id');
                            $.ajax({
                                url: "{{url('/product/picture/delUploadPreview')}}",
                                data: {id:id,_token:"{{csrf_token()}}"},
                                type: 'POST',
                                dataType: 'json',
                                success: function(res){
                                    $('.preview-show .img[data-id='+id+']').remove();
                                    
                                }
                            });

                        }return false;
                    });
                    
                }
            });return false;
        }

        $(document).ready(function() {
            $('.select2').select2();
        });

        $("#frm").submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "{{url('/product/save')}}",
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
                        window.location.href="{{url('/product/management')}}";
                    }
                    console.log(res);
                }
            });return false;
        });

	</script>

@endsection