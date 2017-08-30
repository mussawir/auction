@extends('layouts.padash')

@section('content')

    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/patient')}}">Dashboard</a></li>
        <li class="active">Order Detail</li>
    </ol>
    <!-- end breadcrumb -->

    <!-- begin page-header -->
    <h1 class="page-header">Order Detail <small>Transaction</small></h1>
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
        </div>
    </div>
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
                    <h4 class="panel-title">Transactions </h4>
                </div>
                <div class="panel-body">
                    <h3>Order Details</h3>
                    <h5>Order# {{ $details->m_id }}</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <strong><h5>Shipping Address</h5></strong>
                            <p>{{ $details->shipping_address }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong><h5>Payment Method</h5></strong>
                            <p>Card Holder Name: {{ $details->card_customer_name }}</p>
                            <p>Card: {{ $details->card_type }}</p>
                            <p>Card Number: {{ $details->card_number }}</p>
                        </div>
                        <div class="col-md-4">
                            <strong><h5>Order Summary</h5></strong>
                            <p>Total Product(s): {{ $details->total_products }}</p>
                            <p>Total Item(s) Quantity: {{ $details->total_qty }}</p>
                            <strong><h5>Total Products(s) Total: ${{ $details->total_price }}</h5></strong>
                            {{--<p>Shipping & Handling: ${{ $order->shipping_amount }}</p>--}}
                            {{--<p>Taxes: ${{ $order->product_tax }}</p>--}}
                            {{--<strong><h5>Grand Total: ${{ $order->product_price }}</h5></strong>--}}
                        </div>
                    </div>

                </div>
            </div>
            <!-- end panel -->
        </div>
        <div class="col-md-12">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title"> Orders </h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
							<th>Product Name</th>
                            <th>Order Number</th>
                            <th>Supplier Name</th>
                            <th>Amount</th>
                            <th>Tracking Number</th>
                            <th>Delivery Date</th>
                            <th>Order Status</th>
                            <th>Order Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order as $item)
                            <tr>
                                <td>
                                    @if(isset($item->image_path) && (!empty($item->image_path)))
                                        <img src="{{asset($item->image_path)}}" alt="{{$item->products_name}}" id="product_image" style="width:40px;float:left;"/>
                                    @else
                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" id="product_image" alt="{{$item->products_name}}" style="width:40px;float:left;"/>
                                    @endif
                                </td>
								<td><strong><p style="float:left;margin-left: 10px;">{{$item->products_name}}</p></strong></td>
                                <td>{{$item->order_number}}</td>
                                <td>{{$item->sup_first}} {{ $item->sup_last }}</td>
                                <td>${{$item->product_price}}</td>
                                <td>{{$item->tracking_number}}</td>
                                <td>{{$item->delivery_date}}</td>
                                <td>
                                    @if($item->order_status == '0')
                                        <i class="fa fa-circle" style="color:orangered"></i> Pending
                                    @elseif($item->order_status == '1')
                                        <i class="fa fa-check-circle" style="color:green"></i> Delivered
                                    @elseif($item->order_status == '2')
                                        <i class="fa fa-check-spinner" style="color:cornflowerblue"></i> Processed
                                    @elseif($item->order_status == '3')
                                        <i class="fa fa-times" style="color:red"></i> Cancelled
                                    @endif
                                </td>
                                <td>
                                    <button class="edit-modal btn btn-success btn-xs"
                                            data-id="{{$item->order_number}}"
                                            data-title="{{$item->products_name}}"
                                            data-qty="{{$item->product_qty}}"
                                            data-price="${{$item->product_price}}"
                                            data-date="{{$item->delivery_date}}"
                                            data-shipping="${{$item->shipping_amount}}"
                                            data-tax="${{$item->product_tax}}"
                                            data-supplier="{{$item->sup_first}} {{ $item->sup_last }}"
                                            data-email="{{$item->sup_email}}"
                                            data-image="{{$item->image_path}}"
                                            data-store="{{$item->value}}"
                                    >
                                        <span class="fa fa-eye"></span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end col 6 -->
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                        <img src=""  id="imagepreview" style="width:60px;margin:20px auto;"/>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Order Number: </strong><h6 id="order_number"></h6>
                            <strong>Product: </strong><h6 id="title"></h6>
                            <strong>Price: </strong><h6 id="price"></h6>
                            <strong>Quantity: </strong><h6 id="qty"></h6>
                            <strong>Bought From: </strong><h6 id="store"></h6>
                        </div>
                        <div class="col-md-6">
                            <strong>Delivery Date: </strong><h6 id="date"></h6>
                            <strong>Product Tax: </strong><h6 id="tax"></h6>
                            <strong>Shipping Amount: </strong><h6 id="shipping">$</h6>
                            <strong>Supplier Name: </strong><h6 id="supplier"></h6>
                            <strong>Supplier Email: </strong><h6 id="email"></h6>
                        </div>
                    </div>
                    <div class="deleteContent">
                        Are you Sure you want to delete <span class="title"></span> ?
                        <span class="hidden id"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('page-scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
        $(document).on('click', '.edit-modal', function() {
            $('#footer_action_button').text(" Update");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('Order Details');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('#order_number').html($(this).data('id'));
            $('#price').html($(this).data('price'));
            $('#qty').html($(this).data('qty'));
            $('#title').html($(this).data('title'));
            $('#email').html($(this).data('email'));
            $('#shipping').html($(this).data('shipping'));
            $('#date').html($(this).data('date'));
            $('#supplier').html($(this).data('supplier'));
            $('#tax').html($(this).data('tax'));
            $('#store').html($(this).data('store'));
            $('#imagepreview').attr('src', $('#product_image').attr('src'));
//            $('#fid').val($(this).data('id'));
//            $('#t').val($(this).data('title'));
//            $('#d').val($(this).data('description'));
            $('#myModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'post',
                url: '/editItem',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#fid").val(),
                    'title': $('#t').val(),
                    'description': $('#d').val()
                },
                success: function(data) {
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title + "</td><td>" + data.description + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-description='" + data.description + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-description='" + data.description + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                }
            });
        });
    </script>

@endsection