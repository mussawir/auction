@extends('layouts.pradash')
@section('sidebar')
@include('layouts.manage-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li class="active">Order Details</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Orders Details <small>{{ $order->products_name }}</small></h1>
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
                <h4 class="panel-title">{{ $order->products_name }}</h4>
            </div>
            <div class="panel-body">
                <h3>Order Details</h3>
                <h5>Order# {{ $order->order_number }}</h5>
                <div class="row">
                    <div class="col-md-4">
                        <strong><h5>Shipping Address</h5></strong>
                        <p>{{ $order->shipping_address }}</p>
                        <strong><h5>Order Status: </h5></strong>
                        <p>
                            @if($order->order_status == 1)
                                <i class="fa fa-check-circle" style="color:green"></i> Delivered
                            @elseif($order->order_status == 0)
                                <i class="fa fa-circle" style="color:orange"></i> Pending
                            @elseif($order->order_status == 2)
                                <i class="fa fa-recycle" style="color:blue"></i> Processed
                            @elseif($order->order_status == 3)
                                <i class="fa fa-times" style="color:red"></i> Cancelled
                            @endif
                        </p>
                    </div>
                    <div class="col-md-4">
                        <strong><h5>Payment Method</h5></strong>
                        <p><strong>Patient Name:</strong> {{ $order->first_name }}</p>
                        <p><strong>Card Holder Name:</strong> {{ $order->card_customer_name }}</p>
                        <p><strong>Card:</strong> {{ $order->card_type }}</p>
                        <p><strong>Card Number:</strong> {{ $order->card_number }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong><h5>Order Summary</h5></strong>
                        <p><strong>Item(s) Quanitity: </strong>{{ $order->product_qty }}</p>
                        <p><strong>Item(s) Subtotal:</strong> ${{ $order->product_price }}</p>
                        <p><strong>Shipping & Handling:</strong> ${{ $order->shipping_amount }}</p>
                        <p><strong>Taxes:</strong> ${{ $order->product_tax }}</p>
                        <strong><h5>Grand Total: ${{ $order->product_price }}</h5></strong>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <strong><h5>Delivered</h5></strong>
                            <p>Delivered on: {{ $order->delivery_date }}</p>
                            <div class="row">
                                <div class="col-md-2">
                                    @if(isset($order->image_path) && (!empty($order->image_path)))
                                        <img src="{{asset($order->image_path)}}" alt="{{$order->products_name}}"  style="width:100%;"/>
                                    @else
                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$order->products_name}}" style="width:40px;float:left;"/>
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <p><strong>Products Name:</strong> {{ $order->products_name }}</p>

                                    <p><strong>Supplier Name:</strong>
                                        {{--<a href="{{url('/patient/ecommerce/store/products/'.$order->pra_id)}}">--}}
                                        {{ $order->sup_firstname }} {{ $order->sup_lastname }}
                                        {{--</a>--}}
                                    </p>
                                    
                                    {{--<a href="{{url('/patient/ecommerce/store/product/'.$order->products_id)}}" class="btn btn-default">Buy it Again</a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <a href="{{url('/practitioner/ecommerce/orders')}}" class="btn btn-success pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>
                </div>
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
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
                });
            }
        });

    </script>
@endsection