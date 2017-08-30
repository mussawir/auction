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
                        <!-- BEGIN checkout-header -->
                {!! Form::open(array('url'=>'/patient/ecommerce/success', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}
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
                            <div class="step ">
                                <div class="number"><i class="fa fa-check"></i></div>
                                <div class="info">
                                    <div class="title">Shipping Address</div>
                                </div>
                            </div>
                        </div>
                        <!-- END col-3 -->
                        <!-- BEGIN col-3 -->
                        <div class="col-md-3 col-sm-3">
                            <div class="step active">
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
				
                    <h4 class="checkout-title">Choose a payment method</h4>
					<?php if(count($creditCard)){ ?>
						<div class="form-group">
                            <label class="control-label col-md-4">
                                Card Info 
                            </label><?php 
							$oppAppend ='';
							?>
								@foreach($creditCard as $credit_items)
								<?php 
								$oppAppend .= '<option value="'.$credit_items->credit_id.'">'.$credit_items->cardholder_name.'</option>';
								echo '<input value="'.$credit_items->cardholder_name.'" type="hidden" id="cholder_'.$credit_items->credit_id.'" />';
								echo '<input value="'.$credit_items->card_number.'" type="hidden" id="cnumber_'.$credit_items->credit_id.'" />';
								echo '<input value="'.$credit_items->expiration_date_mm.'" type="hidden" id="cmm_'.$credit_items->credit_id.'" />';
								echo '<input value="'.$credit_items->expiration_date_yy.'" type="hidden" id="cyy_'.$credit_items->credit_id.'" />';
								echo '<input value="'.$credit_items->cvv.'" type="hidden" id="cvv_'.$credit_items->credit_id.'" />';
								?>
								@endforeach
                            <div class="col-md-4">
                                <select class="form-control" name="card_id" id="credit_drop">
								<option value=""></option>
								<?php print $oppAppend; ?>
								</select>
                            </div>
                        </div>
					<?php } ?>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Cardholder Name <span class="text-danger">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control required" id="card_customer_name" name="card_customer_name" placeholder="Card Holder Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Card Number <span class="text-danger">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control required" id="card_number" name="card_number" placeholder="Card Number" maxlength="16"/>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="col-sm-4 control-label">Payment Types <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="card_type" class="form-control">
                                <option value="">Select your card</option>
                                <option value="Visa"><i class="fa fa-cc-visa"></i> Visa</option>
                                <option value="Master Card"><i class="fa fa-cc-mastercard"></i> Mastercard</option>
                                <option value="Credit Card"><i class="fa fa-cc-discover"></i> Discover</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">Expiration Date <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <div class="width-100">
                                <div class="row row-space-0">
                                    <div class="col-xs-5">
                                        <input type="text" name="card_exp_month"   id="card_exp_month" placeholder="MM" class="form-control required p-l-5 p-r-5 text-center" maxlength="2"/>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <div class="text-muted p-t-5 m-t-2">/</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="text" name="card_exp_year"  id="card_exp_year" placeholder="YY" class="form-control required p-l-5 p-r-5 text-center" maxlength="2"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">CVV <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <div class="width-100 pull-left m-r-10">
                                <input type="text" name="card_cvc" placeholder="CVV" id="card_cvc"  class="form-control required p-l-5 p-r-5 text-center" maxlength="4"/>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END checkout-body -->
                <!-- BEGIN checkout-footer -->
                <div class="checkout-footer">
                    <a href="{{url('/patient/ecommerce/checkout_info')}}" class="btn btn-white btn-lg pull-left">Back</a>
                    <button type="submit" class="btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10">Continue</button>
                </div>
                <!-- END checkout-footer -->
                {!! Form::close() !!}
            </div>
            <!-- END checkout -->
        </div>
        <!-- END container -->
@endsection


@section('page-scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
		$('#credit_drop').on('change', function() {
			var id = this.value;
			$('#card_cvc').val($('#cvv_'+id).val());
			$('#card_exp_year').val($('#cyy_'+id).val());
			$('#card_exp_month').val($('#cmm_'+id).val());
			$('#card_customer_name').val($('#cholder_'+id).val());
			$('#card_number').val($('#cnumber_'+id).val());
			
		});
    </script>

@endsection