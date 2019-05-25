@extends('layouts.master_layout')
@section('content')

    <?php use App\Components\Theme; ?>

    <form id="frm-import-product">
    	<div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">คลัง / รับเข้าสินค้า</h4> 
            </div>
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <span class="pull-right m-l-20 hidden-xs hidden-sm">
                    วันที่ {{Theme::dateToday()}}
                </span>
            </div>

            <div class="col-md-12">
                <div class="col-form">   
                    
                    <input type="hidden" name="action" value="add">
                    <div class="row">
                        <div class="col-md-3">
                            <label>เลขที่ใบส่งสินค้า</label>
                            <input type="text" name="invoice_number" class="form-control" required="">
                        </div>
                        <div class="col-md-3">
                            <label>ผู้ผลิต</label>
                            <select name="supplier_id" class="form-control select2" required="">
                                <option value="">--เลือกผู้ผลิต--</option>
                                @foreach($suppliers as $s)
                                    <option value="{{$s->supplier_id}}">{{$s->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>อ้างอิงเลขที่ใบสั่งของ PO</label>
                            <input type="text" name="po_number" class="form-control" required="">
                        </div>
                        <div class="col-md-3">
                            <label>สถานะ</label>
                            <div>
                                <label>
                                    <input type="radio" name="acceptance_status" value="open" required="">
                                    เปิด
                                </label>
                                <label>
                                    <input type="radio" name="acceptance_status" value="close" required="">
                                    ปิด
                                </label>
                                <label>
                                    <input type="radio" name="acceptance_status" value="cancel" required="">
                                    ยกเลิก
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label>พนักงานขาย</label>
                            <input type="text" name="sale_person" class="form-control" required="">
                        </div>
                        <div class="col-md-3">
                            <label>วันที่ครบกำหนดชำระ</label>
                            <input type="date" name="due_date_pay" class="form-control" required="">
                        </div>
                        <div class="col-md-3">
                            <label></label>
                            <div>
                                <label>
                                    <input type="checkbox" name="use_sum_vat" value="1">
                                    ราคารวม Vat
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label>รหัส Barcode</label>
                            <input type="text" name="barcode" class="form-control" required="">
                        </div>
                        <div class="col-md-2">
                            <label>ระบุจำนวน (ต่อหน่วย)</label>
                            <input type="number" name="amount" class="form-control" required="" value="1">
                        </div>
                        <div class="col-md-2">
                            <label>Lot Number</label>
                            <input type="text" name="lot_number" class="form-control" required="">
                        </div>
                        <div class="col-md-2">
                            <label>วันที่หมดอายุ</label>
                            <input type="date" name="expire_date" class="form-control" required="">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="btn-import" class="btn btn-default mt-5">นำเข้ารายการ</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="t-title">รายการสินค้านำเข้า</div>
                        </div>
                        <div class="col-md-5 text-right">
                                
                               
                                
                        </div>
                    </div>
                    <div class="scroll-v">
                        
                        <form id="frm-import-product-list">
                            <table class="table" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัสสินค้า</th>
                                        <th>Barcode</th>
                                        <th>ชื่อสินค้า</th>
                                        <th>ซัพพลายเออร์</th>
                                        <th>จำนวน</th>
                                        <th>ราคาต้นทุน/หน่วย</th>
                                        <th>ราคารวม</th>
                                        <th>วันหมดอายุ</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="import-list-data"></tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" rowspan="6">
                                            <label>หมายเหตุ</label>
                                            <textarea name="acceptance_note" rows="7" class="form-control"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right">
                                            รวม
                                        </td>
                                        <td><span id="ans_total">0.00</span></td>
                                        <td>บาท</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right">
                                            ส่วนลด
                                        </td>
                                        <td>
                                            <input type="number" name="ans_discount" id="ans_discount" step="any" class="cs-w20">
                                        </td>
                                        <td>บาท</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right">
                                            รวมเป็นเงินก่อนภาษี
                                        </td>
                                        <td><span id="ans_total_before_vat">0.00</span></td>
                                        <td>บาท</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right">
                                            ภาษีมูลค่าเพิ่ม
                                        </td>
                                        <td><span id="ans_total_vat">0.00</span></td>
                                        <td>บาท</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="right">
                                            รวมเป็นเงินทั้งสิ้น
                                        </td>
                                        <td><span id="ans_sum_total">0.00</span></td>
                                        <td>บาท</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                        </form>

                        <div class="row">
                            <div class="col-lg-12 text-right mr20">
                                <a href="javascript:" class="btn btn-default">พิมพ์</a>
                                <button type="button" id="btn-save" class="btn btn-default">บันทึก</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('scripts')
	
	<script>

        $("#btn-save").on('click', function(){
            $.ajax({
                url: "{{url('/product/acceptance-import-list-product/save')}}",
                data: $("#frm-import-product").serialize(),
                type: 'POST',
                dataType: 'json',
                beforeSend: function(res){
                    $("#btn-save").attr('disabled','disabled');
                },
                success: function(res){
                    $("#btn-save").removeAttr('disabled');
                    if(res.status == 'success'){
                        window.location.href="{{url('/product/acceptance/list')}}";
                    }else{
                        alert(res.status);
                        return false;
                    }
                }
            }); return false;
        });

        $(document).ready(function() {
            $('.select2').select2();
        });

        $("input[name=use_sum_vat]").click(function() {

            check_vat();
            cal_ans_sum_total();

        });

        function check_vat(){

            var ans_total = parseFloat($('#ans_total').html());
            var cal_vat = ((ans_total * 7) / 100);

            if($("input[name=use_sum_vat]").prop('checked')==true){
                $("#ans_total_vat").html(cal_vat.toFixed(2));
            }else{
                $("#ans_total_vat").html('0.00');
            }
        }

        function cal_ans_total(){
            var ans_total = 0.00;
            $(".td-price-total").each(function(){
                var total = parseFloat($(this).html());
                ans_total += total;
            });
            $("#ans_total").html(ans_total.toFixed(2));
        }

        $("#ans_discount").on('keyup', function(){
            cal_discount();
            cal_ans_sum_total();
        });

        function cal_discount(){
            var ans_total = parseFloat($("#ans_total").html());
            var ans_discount = $("#ans_discount").val();
            var new_ans_discount = ans_total - ans_discount;
            $("#ans_total_before_vat").html(new_ans_discount.toFixed(2));
        }

        function cal_ans_sum_total(){
            var ans_total_before_vat = parseFloat($("#ans_total_before_vat").html());
            var ans_total_vat = parseFloat($("#ans_total_vat").html());
            var new_ans_sum_total = ans_total_before_vat + ans_total_vat;
            $("#ans_sum_total").html(new_ans_sum_total.toFixed(2));
        }
        
		
        $("#frm-import-product").submit(function(){

            $.ajax({
                url: "{{url('product/acceptance-import-list-product')}}",
                data: $(this).serialize(),
                type: 'POST',
                dataType: 'json',
                beforeSend: function(res){
                    $("#btn-import").attr('disabled','disabled');
                },
                success: function(res){
                    $("#btn-import").removeAttr('disabled');
                    if(res.status == 'error'){
                        alert(res.msg);
                    }else{

                        //console.log(res);

                        var tr = '';
                        tr += '<tr row-id="'+res.data.product_id+'">';

                            tr += '<td class="no-row"></td>';
                            tr += '<td class="product-id">'+res.data.product_id+'</td>';
                            tr += '<td>'+res.data.product_barcode+'</td>';
                            tr += '<td>'+res.data.product_name+'</td>';
                            tr += '<td>'+res.data.supplier_name+'</td>';
                            tr += '<td class="td-amount"><input onkeypress="return isNumberKey(event)" class="input20 input-amount" name="item_acceptance_item_amount[]" id="acceptance_amount_'+res.data.product_id+'" type="text" value="'+res.data.amount+'" data-row-id="'+res.data.product_id+'"></td>';
                            tr += '<td class="td-price-cost">'+res.data.product_price_cost+'</td>';
                            tr += '<td class="td-price-total">'+res.data.total_price+'</td>';
                            tr += '<td>'+res.data.expire_date+'</td>';
                            tr += '<td><a href="javascript:" data-row-id="'+res.data.product_id+'" class="ap-close">x</a></td>';
                            //hidden field
                            tr += '<input type="hidden" name="item_product_id[]" value="'+res.data.product_id+'"><input type="hidden" name="item_product_barcode[]" value="'+res.data.product_barcode+'"><input type="hidden" name="item_supplier_id[]" value="'+res.data.supplier_id+'"><input type="hidden" name="item_acceptance_item_price_cost[]" value="'+res.data.product_price_cost+'"><input type="hidden" name="item_acceptance_item_expire_date[]" value="'+res.data.expire_date+'">';
                        tr += '</tr>';

                        var chk = chk_row_data(res.data.product_id);

                        if(chk == false){
                            $('#import-list-data').append(tr);

                            $('input[name=barcode]').val('');
                            $('input[name=amount]').val('1');
                            $('input[name=expire_date]').val('');
                            $('select[name=supplier_id]').val('');
                            $('select[name=supplier_id]').trigger('change');
                            cal_no_row();
                            remove_row();
                            cal_sum_byRow();
                            cal_ans_total();
                            cal_discount();
                            check_vat();
                            cal_ans_sum_total();
                        }
                        

                    }
                }
            }); return false;

        });

        function cal_no_row(){
            $('#import-list-data .no-row').each(function(index){
                $(this).html(index+1);
            });
        }

        function chk_row_data(chk_product_id){
            var status = false;
            $("#import-list-data .product-id").each(function(index){
                var product_id = $(this).text();
                if(product_id == chk_product_id){
                    status = true;
                }
            });
            return status;
        }

        function remove_row(){
            $('.ap-close').on('click', function(){
                var row_id = $(this).attr('data-row-id');
                if(confirm('ลบรายการนี้ออกจากนำเข้าสินค้าใช่หรือไม่?')){
                    $('#import-list-data tr[row-id="'+row_id+'"]').remove();
                    cal_no_row();
                    cal_ans_total();
                    cal_discount();
                    check_vat();
                    cal_ans_sum_total();
                }return false;
            });
        }

        function cal_sum_byRow(){
            $(".input-amount").keyup(function(){
                var amount = parseFloat($(this).val());

                var row_id = $(this).attr('data-row-id');
                var price_cost = parseFloat($("tr[row-id="+row_id+"] .td-price-cost").text());
                var total_price = parseFloat($("tr[row-id="+row_id+"] .td-price-total").text());
                
                var new_total_price = amount * price_cost;
                $("tr[row-id="+row_id+"] .td-price-total").html(new_total_price.toFixed(2));
                cal_ans_total();
                cal_discount();
                check_vat();
                cal_ans_sum_total();

            });
        }

        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

	</script>

@endsection