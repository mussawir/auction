@extends('layouts.pradash')
@section('content')
    <style>
        input[type="number"] {
            width: 104px;
            height: 25px;
            padding-right: 50px;
            border: 1px solid lightgray;
            padding-left:10px;
            transition: all 0.5s linear;
        }

        input[type="button"] {
            margin-left: -50px;
            height: 23px;
            width: 50px;
            background: #00ACAC;
            color: white;
            border: 0;
            -webkit-appearance: none;
            transition: all 0.5s linear;
        }

    </style>

    <!-- begin page-header -->
    <h1 class="page-header">Store Products <small></small></h1>

    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-md-12">
            <div class="msg">
                @if(Session::has('success'))
                    <div class="alert alert-success fade in">
                        <strong>Success!</strong>
                        <strong>{{Session::pull('success')}}</strong>
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                @elseif(Session::has('error'))
                    <div class="alert alert-danger fade in">
                        <strong>Error!</strong>
                        <strong>{{Session::pull('error')}}</strong>
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                @endif
            </div>
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Store Products</h4>
                </div>
                <div class="panel-body">
                    <select class="pull-right" name="category" id="category" class="form-control" onchange="customSearch('data-table',this.value,10)" style="width: 209px; margin-right: 20px; height: 30px; padding: 3px; border: 1px solid #ccc; border-radius: 3px; color: #000;">
                        <option value="">All Suppliers</option>
                        @foreach($items as $cat)
                            <option value="{{ $cat->first_name  }} {{ $cat->last_name  }}">{{ $cat->first_name}} {{ $cat->last_name }}</option>
                        @endforeach
                    </select>
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>C. Name</th>
                            <th style="width: 150px;">Product Name</th>
                            <th>Supplier Name</th>
                            <th>$ MAP</th>
                            <th>Discount %</th>
							<th>D/Price</th>
                            <th>Inc Price %</th>
							<th>Reg:Price</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $item)
                            <tr id="foreach">
                                <td>
                                    @if(isset($item->mainImage) && (!empty($item->mainImage)))
                                        <img src="{{asset($item->mainImage)}}" alt="{{$item->products_name}}" style="width: 65px;"/>
                                    @else
                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->products_name}}" />
                                    @endif
                                </td>
                                <td>{{ $item->cat_name }}</td>
                                <td>
                                    {{ $item->products_name }}
                                </td>
                                <td>
                                    {{ $item->supplier_name }}
                                </td>
                                <td id="map_{{$item->products_id}}">
                                    {{ $item->map }}
                                </td>
                                <td>
                                    <input value="{{ $item->discountP }}" type="number" id="discount_{{$item->products_id}}" min="0" max="100" onKeyPress="if(this.value.length==3) return false;" placeholder="%"><input id="btn_dis_{{ $item->products_id }}" type="button" value="Save" onclick="setDiscount({{ $item->products_id }});">
                                    <input value="{{ $item->profitP }}" type="hidden" id="profitP_{{$item->products_id}}">
                                    <span id="error_dis_{{$item->products_id}}"></span>
                                </td>
								<td id="discountPrice_{{ $item->products_id }}">
                                    <?php
                                    if($item->discountP == '' || $item->discountP == '0'){
                                        echo 'No Discount';
                                    }elseif($item->discountP > 0){
                                        $results = ($item->map/100)*$item->profitP;
                                        $discountedCal = ($results/100)*$item->discountP;
                                        $discountedPrice = $item->map - $discountedCal;
                                        echo '$'.round($discountedPrice,2);
                                    }
                                    ?>
                                </td>
                                <td>
                                    <input value="{{ $item->increased_percentage }}"  type="number" id="increase_{{$item->products_id}}" min="0" onKeyPress="if(this.value.length==4) return false;" placeholder="%"><input id="btn_inc_{{ $item->products_id }}" type="button" value="Save" onclick="increaePrice({{ $item->products_id }});">
                                    <span id="error_cut_{{$item->products_id}}"></span>
                                </td>
                                <td id="regPrice_{{ $item->products_id }}">
									
									<?php if($item->pra_price > $item->map) 
									{ 
										echo '$'.$item->pra_price;
									}
									else
									{
										echo 'Not increased';
									} ?>
                                </td>
                                <td>
                                    <a href="{{url('/practitioner/product/details/'.$item->products_id)}}" class="btn btn-success btn-xs" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col 6 -->
    </div>
    <!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({

                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 25,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}],
                    "columns": [
                        null,
                        { "visible": false },
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null 
                    ]

                });
            }
            $('#data-table_filter').parent('div').attr('class','col-md-7');
            $('#data-table_length').parent('div').attr('class','col-md-2');
            $('#data-table_filter').children('label').children('input').css('width','550px').attr('placeholder','Search Products & Supplier & Category');
            {{--$('#data-table_filter').parent('div').after('<div class="col-md-3"> <select class="pull-right" name="category" id="category" class="form-control" onchange="customSearch("data-table",this.value,-1)" style="width: 142px; margin-right: 20px; height: 33px; padding: 5px; border: none; background: #008a8a; color: #fff;"> <option value="">All Suppliers</option> @foreach($items as $cat) <option value="{{ $cat->first_name }} {{ $cat->last_name }}">{{ $cat->first_name}} {{ $cat->last_name }}</option> @endforeach </select> </div>');--}}

        });

        function setDiscount(id)
        {
            var map = $('#map_'+id).html();
            var profitP = $('#profitP_'+id).val();
            var discount = $('#discount_'+id).val();
            var pra_cut = (map/100)*profitP;
            var discountedCal = (pra_cut/100)*discount;
            var discountedPrice = map - discountedCal;
            if(discount > 100){
                $("#discount_"+id).css('border','1px solid red').delay(1000).queue(function(){
                    $(this).css('border','1px solid lightgray').dequeue();
                });
                $("#btn_dis_"+id).css({'background':'red','border':'1px solid red'}).delay(1000).queue(function(){
                    $(this).css({'background':'#00ACAC','border':'1px solid #00ACAC'}).dequeue();
                });
                $('#error_dis_'+id).css('color','red').html('<br>Not Possible').fadeIn().delay(1000).fadeOut();
                return;
            }

            {

                $.ajax({
                    type: "POST",
                    data: {
                        discount : discount,
                        discountedPrice : discountedPrice,
                        id:id
                    },
                    async:false,
                    url: '{{ URL::to('/practitioner/ecommerce/prac_profit') }}',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
						$('#regPrice_'+id).html('Not Increased');
                        $('#discountPrice_'+id).html('$'+discountedPrice);
                        $('#error_dis_'+id).css('color','green').html('Discount alloted!').show().delay(1000).hide('slow');
                        $('#increase_'+id).val('');
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }

        function increaePrice(id)
        {

            var increase = $('#increase_'+id).val();
            var map = parseInt($('#map_'+id).html(),10);
            var results = (map/100)*increase;
            var increasedPrice = map+results;
            if(increase == '' ){
            $("#increase_"+id).css('border','1px solid red').delay(1000).queue(function(){
                $(this).css('border','1px solid lightgray').dequeue();
            });
            $("#btn_inc_"+id).css({'background':'red','border':'1px solid red'}).delay(1000).queue(function(){
                $(this).css({'background':'#00ACAC','border':'1px solid #00ACAC'}).dequeue();
            });
            $('#error_cut_'+id).css('color','red').html('<br>Enter Amount').fadeIn().delay(1000).fadeOut();
            return;
            }
            if(increase < 0){
                $("#increase_"+id).css('border','1px solid red').delay(1000).queue(function(){
                    $(this).css('border','1px solid lightgray').dequeue();
                });
                $("#btn_inc_"+id).css({'background':'red','border':'1px solid red'}).delay(1000).queue(function(){
                    $(this).css({'background':'#00ACAC','border':'1px solid #00ACAC'}).dequeue();
                });
                $('#error_cut_'+id).css('color','red').html('<br>Enter Amount').fadeIn().delay(1000).fadeOut();
                return;
            }
            {

                $.ajax({
                    type: "POST",
                    data: {
                        increasedPrice : increasedPrice,
                        increase:increase,
                        id:id
                    },
                    async:false,
                    url: '{{ URL::to('/practitioner/ecommerce/increase_price') }}',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
						$('#regPrice_'+id).html('$'+increasedPrice);
                        $('#discount_'+id).val('0');
                        $('#discountPrice_'+id).html('No Discount');
                        $('#error_cut_'+id).css('color','green').html('Price increased!').show().delay(1000).hide('slow');
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }
    </script>
@endsection