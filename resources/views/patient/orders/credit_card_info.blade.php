@extends('layouts.padash')
@section('content')
<!-- end breadcrumb -->
    <!-- begin page-header -->
     <h1 class="page-header"><small></small></h1> 
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
                        <span class="close" data-dismiss="alert">x</span>
                    </div>
                @elseif(Session::has('error'))
                    <div class="alert alert-danger fade in">
                        <strong>Error!</strong>
                        <strong>{{Session::pull('error')}}</strong>
                        <span class="close" data-dismiss="alert">x</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title">Credit Card Info</h4>
        </div>
        <div class="panel-body">

            {!! Form::open(array('url'=>'/patient/index/credit-card-save', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}
					<h4 class="checkout-title">Choose a payment method</h4>
					<div class="form-group">
                        <label class="col-md-4 control-label">Cardholder Name <span class="text-danger">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control required" name="card_customer_name" placeholder="Card Holder Name" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Card Number <span class="text-danger">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control required" name="card_number" placeholder="Card Number" maxlength="16"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Card Type <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="card_type" class="form-control">
                                <option value="">Select your card</option>
                                <option value="0"><i class="fa fa-cc-visa"></i> Visa</option>
                                <option value="1"><i class="fa fa-cc-mastercard"></i> Mastercard</option>
                                <option value="2"><i class="fa fa-cc-discover"></i> Discover</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Expiration Date <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <div class="width-100">
                                <div class="row row-space-0">
                                    <div class="col-xs-5">
                                        <input type="text" name="card_exp_month" placeholder="MM" class="form-control required p-l-5 p-r-5 text-center" maxlength="2"/>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <div class="text-muted p-t-5 m-t-2">/</div>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="text" name="card_exp_year" placeholder="YY" class="form-control required p-l-5 p-r-5 text-center" maxlength="2"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">CVV <span class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <div class="width-100 pull-left m-r-10">
                                <input type="text" name="card_cvc" placeholder="CVV" class="form-control required p-l-5 p-r-5 text-center" maxlength="4"/>
                            </div>
                        </div>
                    </div>
					<h4 class="checkout-title">Billing Address</h4>
					<div class="form-group">
                        <label class="col-md-4 control-label">Address <span class="text-danger">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control required" name="bill_add" placeholder="Billing Address" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Zip Code <span class="text-danger">*</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control required" name="zip_code" placeholder="Zip Code" maxlength="16"/>
                        </div>
                    </div>
			
            <div class="col-md-12">
			{!! Form::submit('Save', array('class'=>'btn btn-success pull-right')) !!}
                
            </div>
            {!! Form::close() !!}
        </div>
	
		
    </div>
@endsection


@section('page-scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
    </script>

@endsection