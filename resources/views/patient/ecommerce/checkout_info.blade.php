@extends('layouts.padash')
@section('content')

    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/patient')}}">Dashboard</a></li>
        <li class="active">Checkout</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Checkout <small>Shipping Address</small></h1>
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
    <div class="section-container" id="checkout-info">
        <!-- BEGIN container -->
            <!-- BEGIN checkout -->
            <div class="checkout">
                {!! Form::model($info, array('url'=>'/patient/ecommerce/save_shipping', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}
                    <!-- BEGIN checkout-header -->
                    <div class="checkout-header">
                        <!-- BEGIN row -->
                        <div class="row">
                            <!-- BEGIN col-3 -->
                            <div class="col-md-3 col-sm-3">
                                <div class="step">
                                        <div class="number"><i class="fa fa-check"></i></div>
                                        <div class="info">
                                            <div class="title">Delivery Options</div>
                                        </div>
                                </div>
                            </div>
                            <!-- END col-3 -->
                            <!-- BEGIN col-3 -->
                            <div class="col-md-3 col-sm-3">
                                <div class="step active">
                                        <div class="number">2</div>
                                        <div class="info">
                                            <div class="title">Shipping Address</div>
                                        </div>
                                </div>
                            </div>
                            <!-- END col-3 -->
                            <!-- BEGIN col-3 -->
                            <div class="col-md-3 col-sm-3">
                                <div class="step">
                                        <div class="number">3</div>
                                        <div class="info">
                                            <div class="title">Payment</div>
                                        </div>
                                </div>
                            </div>
                            <!-- END col-3 -->
                            <!-- BEGIN col-3 -->
                            <div class="col-md-3 col-sm-3">
                                <div class="step">
                                        <div class="number">4</div>
                                        <div class="info">
                                            <div class="title">Complete Payment</div>
                                        </div>
                                </div>
                            </div>
                            <!-- END col-3 -->
                        </div>
                        <!-- END row -->
                    </div>
                    <!-- END checkout-header -->
                    <!-- BEGIN checkout-body -->
                    <div class="checkout-body">
					<?php if(count($shippingAdd)){ ?>
						<div class="form-group">
                            <label class="control-label col-md-4">
                                Shipping Info <span class="text-danger">*</span>
                            </label>
							<?php 
							$oppAppend ='';
							?>
								@foreach($shippingAdd as $shipping_items)
								<?php 
								$oppAppend .= '<option value="'.$shipping_items->s_id.'">'.$shipping_items->Address.'</option>';
								echo '<input value="'.$shipping_items->first_name.'" type="hidden" id="first_'.$shipping_items->s_id.'" />';
								echo '<input value="'.$shipping_items->Phone.'" type="hidden" id="phone_'.$shipping_items->s_id.'" />';
								echo '<input value="'.$shipping_items->zip_code.'" type="hidden" id="zip_'.$shipping_items->s_id.'" />';
								echo '<input value="'.$shipping_items->Address.'" type="hidden" id="address_'.$shipping_items->s_id.'" />';
								?>
								@endforeach
                            <div class="col-md-4">
                                <select class="form-control" name="ship_id" id="shippingInfo_drop">
								<option value=""></option>
								<?php print $oppAppend; ?>
								</select>
                            </div>
                        </div>
					<?php } ?>
                        <div class="form-group">
                            <label class="control-label col-md-4">
                                Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4">
                                {!! Form::text('first_name', null, array('id'=>'first_name','class'=>'form-control', 'placeholder'=> 'First Name', 'data-parsley-required'=>'true')) !!}
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label class="control-label col-md-4">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4">
							{--{!! Form::text('last_name', null, array('id'=>'last_name','class'=>'form-control', 'placeholder'=> 'Last Name', 'data-parsley-required'=>'true')) !!} --}
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label class="control-label col-md-4">
                                Zip Code <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4">
                                {!! Form::text('zip_code', null, array('id'=>'zip_code','class'=>'form-control', 'placeholder'=> 'Phone', 'data-parsley-required'=>'true')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">
                                Primary Phone <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4">
                                {!! Form::text('Phone', null, array('id'=>'Phone','class'=>'form-control', 'placeholder'=> 'Phone', 'data-parsley-required'=>'true')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">
                                Street Address <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4">
                                {!! Form::text('Address', null, array('id'=>'Address','class'=>'form-control', 'placeholder'=> 'Address', 'data-parsley-required'=>'true')) !!}
                            </div>
                        </div>
                        <hr />
                        <div class="m-b-5"><b>Shipping Policy</b></div>
                        <ul class="checkout-info-list">
                            <li>Signature may be required for delivery</li>
                            <li>We do not ship to P.O. boxes</li>
                            <li>Delivery estimates below include item preparation and shipping time</li>
                            <li>We do not ship directly to APO/FPO addresses.</li>
                        </ul>
                    </div>
                    <!-- END checkout-body -->
                    <!-- BEGIN checkout-footer -->
                    <div class="checkout-footer">
                        <a href="{{url('/patient/ecommerce/checkout_cart')}}" class="btn btn-white btn-lg pull-left">Back</a>
                        <button type="submit" class="btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10">Continue</button>
                    </div>
                    <!-- END checkout-footer -->
                </form>
            </div>
            <!-- END checkout -->

        <!-- END container -->
    </div>
@endsection


@section('page-scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
		$('#shippingInfo_drop').on('change', function() {
			var id = this.value;
			$('#first_name').val($('#first_'+id).val());
			$('#Address').val($('#address_'+id).val());
			$('#zip_code').val($('#zip_'+id).val());
			$('#Phone').val($('#phone_'+id).val());
			
		});
    </script>

@endsection