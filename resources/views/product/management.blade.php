@extends('layouts.master_layout')
@section('content')

    <?php use App\Components\Theme; ?>

	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">คลัง / รายการสินค้า</h4> 
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
                <div class="row">
                    <div class="p-topic">
                        <div class="col-md-7">
                            <div class="t-title">รายการสินค้า</div>
                        </div>
                        <div class="col-md-5 text-right">
                            
                            <div class="input-group">
                                <select name="search_by" class="form-control d-inline-block" style="width:150px;">

                                    @foreach (Theme::htmlDropdownSearchProduct() as $html)
                                        <option value="{{$html['value']}}" @if($html['value'] == $search_by) selected @endif>{{$html['text']}}</option>
                                    @endforeach
                                </select>
                                <input name="q" type="text" class="form-control d-inline-block" placeholder="" aria-describedby="basic-addon2" value="{{$q}}" style="width: 225px;">
                                <span class="input-group-addon g-search-multiple" id="basic-addon2">ค้นหา</span>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="scroll-h">
                    <table class="table-scroll-h">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>รหัสสินค้า</th>
                               	<th>Barcode</th>
                                <th>ชื่อสินค้า</th>
                                <th>ซัพพลายเออร์</th>
                                <th>ยี้ห้อ</th>
                                <th>ประเภท</th>
                                <th>หมวดหมู่</th>
                                <th>ราคาทุน</th>
                                <th>ราคาปกติ</th>
                                <th>ราคาขาย</th>
                                <th>แก้ไขล่าสุด</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $row => $product)
                                <tr>
                                    <td>{{ Theme::tableRow($perPage,$row) }}</td>
                                    <td>{{$product->product_id}}</td>
                                    <td>{{$product->product_barcode}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->supplier_name}}</td>
                                    <td>{{$product->brand_product_name}}</td>
                                    <td>{{$product->type_product_name}}</td>
                                    <td>{{$product->category_product_name}}</td>
                                    <td>
                                        {{Theme::numberFormat($product->product_price_cost,2)}}
                                    </td>
                                    <td>
                                        {{Theme::numberFormat($product->product_price_normal,2)}}
                                    </td>
                                    <td>
                                        {{Theme::numberFormat($product->product_price_sale,2)}}
                                    </td>
                                    <td>
                                        @if($product->product_updated_date != null)
                                            {{Theme::fullDate($product->product_updated_date)}}
                                        @else
                                            {{Theme::fullDate($product->product_created_date)}}
                                        @endif
                                    </td>
                                    <td align="center">
                                        <a href="{{url('/product/edit')}}/{{$product->product_id}}" class="btn btn-default btn-xs">
                                            แก้ไข
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $products->links() }}

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
	
	<script>
		
       $('.g-search-multiple').on('click', function(){
        var q = $('input[name=q]').val();
        var search_by = $('select[name=search_by]').val();
        window.location.href='?q='+q+'&search_by='+search_by;
       });

	</script>

@endsection