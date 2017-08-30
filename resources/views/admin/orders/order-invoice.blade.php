@extends('layouts.adash')
@section('content')
<style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}
</style>
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Orders</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Orders<small></small></h1>
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
		<?php 
		$orderId = '';$cardHolder = '';
		$billingAdd ='';$billingZip='';$cardNo='';$cardyy='';$cardmm='';$cardType='';
		$ship_name = '';
			$ship_add = '';
			$ship_zip = '';
			$ship_phone = '';
			$trRows = '';
			$total = 0;
		foreach($orders as $items){
			$orderId = $items->m_id;
			$cardHolder = $items->card_name_j;
			$billingAdd = $items->billing_address_j;
			$billingZip = $items->billing_zip_j;
			$cardNo = $items->card_no_j;
			$cardyy = $items->expiration_date_yy;
			$cardmm = $items->expiration_date_mm;
			$cardType = $items->card_type_j;
			$ship_name = $items->shipping_name_j;
			$ship_add = $items->shipping_address_j;
			$ship_zip = $items->shipping_zip_j;
			$ship_phone = $items->shipping_phone_j;
			$status = '';
			if($items->order_status=='2'){$status = 'Process';}
			if($items->order_status=='1'){$status =  'Shippied';}
			if($items->order_status=='0'){$status =  'New';}
			$trRows.='<tr>
			<td> '.$items->order_id.'</td>
			<td> '.$status.'</td>
			<td> '.$items->products_name.'</td>
			<td class="text-center"> $'.$items->product_price.'</td>
			<td class="text-center"> '.$items->product_qty.'</td>
			<td class="text-right"> $'.($items->product_qty*$items->product_price).'</td>
			</tr>';
			$total += ($items->product_qty*$items->product_price);
		}
		?>
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Orders</h4>
            </div>
            <div class="panel-body">
			<div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <i class="fa fa-search-plus pull-left icon"></i>
                <h2>Invoice for purchase #{{$orderId}}</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Billing Details</div>
                        <div class="panel-body">
                            <strong>{{$cardHolder}}:</strong><br>
								{{$billingAdd}}<br>
									{{$billingZip}}<br>
                            <!--<strong>22 203</strong><br>-->
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Payment Information</div>
                        <div class="panel-body">
                            <strong>Card Name:</strong> {{$cardType}}<br>
                            <strong>Card Number:</strong> {{$cardNo}}<br>
                            <strong>Exp Date:</strong> {{$cardmm}}/20{{$cardyy}}<br>
                        </div>
                    </div>
                </div>
                <!--<div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Order Preferences</div>
                        <div class="panel-body">
                            <strong>Gift:</strong> No<br>
                            <strong>Express Delivery:</strong> Yes<br>
                            <strong>Insurance:</strong> No<br>
                            <strong>Coupon:</strong> No<br>
                        </div>
                    </div>
                </div>-->
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Shipping Address</div>
                        <div class="panel-body">
                            <strong>{{$ship_name}}:</strong><br>
								{{$ship_add}}<br>
                            {{$ship_zip}}<br>
                            {{$ship_phone}}<br>
                            <!--<strong>22 203</strong><br>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
									<td><strong>Order</strong></td>
									<td><strong>Status</strong></td>
                                    <td><strong>Item Name</strong></td>
                                    <td class="text-center"><strong>Item Price</strong></td>
                                    <td class="text-center"><strong>Item Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
							<?php print $trRows; ?>
                                <tr>
                                    <td class="highrow"></td>
									<td class="highrow"></td>
									<td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right">${{round($total,2)}}</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
									<td class="emptyrow"></td>
									<td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                    <td class="emptyrow text-right">$0</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
									<td class="emptyrow"></td>
									<td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-right">${{round($total,2)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
            
        });
    </script>
@endsection
