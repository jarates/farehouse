@extends('layouts.master_layout')
@section('content')

    <?php use App\Components\Theme; ?>

	<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">คลัง / รายการรับเข้าสินค้า</h4> 
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
                    <div class="col-form-search">
                        <div class="col-lg-12">
                            <div class="col-md-3">
                                <input type="text" name="search_keyword" class="form-control" value="{{$search_keyword}}">
                            </div>
                            <div class="col-md-2">
                                <select name="search_by_keyword" class="form-control">
                                    @foreach (Theme::htmlSearchProductAcc() as $html)
                                        <option value="{{$html['value']}}" @if($html['value'] == $search_by_keyword) selected @endif>
                                            {{$html['text']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="search_status" class="form-control">
                                    <option value="">--สถานะ--</option>
                                    @foreach (Theme::htmlSearchProductAccStatus() as $html)
                                        <option value="{{$html['value']}}" @if($html['value'] == $search_status) selected @endif>
                                            {{$html['text']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="search_date" class="form-control" value="{{$search_date}}">
                            </div>
                            <div class="col-md-2">
                                <select name="search_by_date" class="form-control">
                                    @foreach (Theme::htmlSearchProductAccDate() as $html)
                                        <option value="{{$html['value']}}" @if($html['value'] == $search_by_date) selected @endif>
                                            {{$html['text']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 mfr">
                                <button type="button" class="btn btn-default g-search-multiple">
                                    ค้นหา
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scroll-h">

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>เลขที่เอกสาร</th>
                                <th>เลขที่ใบส่งสินค้า</th>
                                <th>เลขที่ใบ PO</th>
                                <th>ครบกำหนดชำระ</th>
                                <th>พนักงานขาย</th>
                                <th>สถานะ</th>
                                <th>แก้ไขล่าสุด</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productAccs as $row => $productAcc)
                            <tr>
                                <td>{{ Theme::tableRow($perPage,$row) }}</td>
                                <td>{{$productAcc->acceptance_id}}</td>
                                <td>{{$productAcc->invoice_number}}</td>
                                <td>{{$productAcc->po_number}}</td>
                                <td>{{Theme::fullDate($productAcc->due_date_pay)}}</td>
                                <td>{{$productAcc->sale_person}}</td>
                                <td>{{Theme::statusProductAcc($productAcc->acceptance_status)}}</td>
                                <td>
                                    @if($productAcc->acceptance_date_update != null)
                                        {{Theme::fullDate($productAcc->acceptance_date_update)}}
                                    @else
                                        {{Theme::fullDate($productAcc->acceptance_date_create)}}
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-default btn-xs" href="{{url('/product/acceptance/edit/')}}/{{$productAcc->acceptance_id}}">แก้ไข</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $productAccs->links() }}

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
	
	<script>
		
        $('.g-search-multiple').on('click', function(){
            var search_keyword = $('input[name=search_keyword]').val();
            var search_by_keyword = $('select[name=search_by_keyword]').val();
            var search_status = $('select[name=search_status]').val();
            var search_date = $('input[name=search_date]').val();
            var search_by_date = $('select[name=search_by_date]').val();

            window.location.href='?search_keyword='+search_keyword+'&search_by_keyword='+search_by_keyword+'&search_status='+search_status+'&search_date='+search_date+'&search_by_date='+search_by_date;
        });

	</script>

@endsection