@extends('layouts.adash')
@section('content')
    <style>
        input[type="number"] {
            width: 163px;
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
        .error{
            border:1px solid red;
            transititon:all 0.5s linear;
        }
        .error_btn{
            background:red;
            transititon:all 0.5s linear;
        }
    </style>
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Products List</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">All Products <small></small></h1>

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
                <h4 class="panel-title">Products List</h4>
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
						<th>S. Desc</th>
						<th>L. Desc</th>
                        <th>Product Name</th>
						<th>SKU</th>
                        <th>Supplier Name</th>
                        <th>Cost $</th>
                        <th>MAP $</th>
                        <th>Prac-Cut%</th>
                        <th>Prac Profit</th>
                        <th>PT Profit</th>
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
							<td>{{ $item->short_description }}</td>
							<td>{!! $item->productDescription !!}</td>
                            <td>
                                {{ $item->products_name }}
                            </td>
							<td>
                                {{ $item->SKU }}
                            </td>
                            <td>
                                {{ $item->supplier_name }}
                            </td>
                            <td id="price_{{$item->products_id}}">
                                {{ $item->price }}
                            </td>
                            <td id="map_{{$item->products_id}}">
                                {{ $item->map }}
                            </td>
                            <td>
                                <?php $profit = isset($item->profitP) ? $item->profitP : ''; ?>
                                <input value="<?php echo $profit;?>" type="number" id="profitP_{{$item->products_id}}"><input id="btn_{{ $item->products_id }}" type="button" value="Save" onclick="SetProfit({{ $item->products_id }});">
                                <span id="error_cut_{{$item->products_id}}" style="color:red"></span>
                            </td>
                            <td id="cut_{{ $item->products_id }}">
                                <?php

                                    if($item->profitP == '0'){
                                        echo '$0';
                                    }elseif($item->profitP > 0){
                                        $results = ($item->map/100)*$item->profitP;
                                        echo '$'.round($results,2);
                                    }
                                ?>
                            </td>
                            <td id = "pt_{{$item->products_id}}">
                                <?php
                                if($item->profitP == '0'){
                                    echo '$0';
                                }elseif($item->profitP > 0){
                                $results = ($item->map/100)*$item->profitP;
                                $res = $results - ($item->map - $item->price);
                                echo '$'.round(abs($res),2);
                                }
                                ?>
                            </td>
                            <td>
                                <a href="{{url('/admin/supplier/product/details/'.$item->products_id)}}" class="btn btn-success" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
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
						{ "visible": false },
						{ "visible": false },
                        null,
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

        function SetProfit(id)
        {
            var cost = $('#price_'+id).html();
            var map = $('#map_'+id).html();
            var profitP = $('#profitP_'+id).val();
            var pra_cut = (map/100)*profitP;
            var pt_cut = (pra_cut - (map-cost));
			
            if(pra_cut > (map-cost)){
                $("#profitP_"+id).css('border','1px solid red').delay(1000).queue(function(){
                    $(this).css('border','1px solid lightgray').dequeue();
                });
                $("#btn_"+id).css({'background':'red','border':'1px solid red'}).delay(1000).queue(function(){
                    $(this).css({'background':'#00ACAC','border':'1px solid #00ACAC'}).dequeue();
                });
                $('#error_cut_'+id).html('Not Allowed').fadeIn().delay(1000).fadeOut();
                return;
            }
            {

                $.ajax({
                    type: "POST",
                    data: {
                        cost : cost,
                        map : map,
                        profitP:profitP,
						pra_cut:pra_cut,
						pt_cut:Math.abs(pt_cut), 
                        id:id
                    },
                    async:false,
                    url: '{{ URL::to('/admin/products/prac_profit') }}',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        $('#profitP_'+id).css({'border':'1px solid lightgray'});
                        $('#btn_'+id).css({'background':'#00ACAC'});
                        $('#cut_'+id).html('$'+pra_cut);
                        $('#pt_'+id).html('$'+Math.abs(pt_cut));
                        $('.msg').html('<div class="alert alert-success"><strong>Success! </strong>Prac-cut has been set successfully.</div>').show().delay(5000).hide('slow');
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