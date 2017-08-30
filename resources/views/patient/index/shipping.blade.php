@extends('layouts.padash')
@section('content')

<?php 
	$str1 = '';
	$str2 = '';
	if($type=='1'){
		$str1 = 'Shipping';
		$str2 = 'Address';
	}
	if($type=='2'){
		$str1 = 'Contact';
		$str2 = 'Info';
	}
	if($type == '1' || $type == '2' ){
	
	  ?>

	<?php }	?>
	
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><?php echo $str1; ?><small> <?php echo $str2; ?></small></h1> 
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
    <div class="panel panel-inverse" data-sortable-id="form-stuff-3"> 
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
            <h4 class="panel-title"><?php echo $str1," ",$str2 ;?></h4>
        </div>
        <div class="panel-body">
            {!! Form::open(array('url'=>'/patient/index/shipping_save', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}
			
			<input type="hidden" name="type" value="{{$type}}" />
			<?php if($type == '1' ) { ?>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('first_name','Shipping Name *:', array('class'=>'col-md-3 control-label')) !!}
                    <div class="col-md-9">
                        {!! Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=> 'Shipping Name', 'data-parsley-required'=>'true')) !!}
                    </div>
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
			<?php }
			elseif( $type == '2')
			
			{

			?>
			 <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('first_name','First Name *:', array('class'=>'col-md-3 control-label')) !!}
                    <div class="col-md-9">
                        {!! Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=> 'First Name', 'data-parsley-required'=>'true')) !!}
                    </div>
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
			
			
           <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('last_name','Last Name *:', array('class'=>'col-md-3 control-label')) !!}
                    <div class="col-md-9">
                        {!! Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=> 'Last Name', 'data-parsley-required'=>'true')) !!}
                    </div>
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
			<?php }?>

			<div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Address','Address *:', array('class'=>'col-md-3 control-label')) !!}
                    <div class="col-md-9">
                        {!! Form::text('Address', null, array('class'=>'form-control', 'placeholder'=> 'Address', 'data-parsley-required'=>'true')) !!}
                    </div>
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('Address') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('zip_code','Zip Code *:', array('class'=>'col-md-3 control-label')) !!}
                    <div class="col-md-9">
                        {!! Form::number('zip_code', null, array('class'=>'form-control', 'placeholder'=> 'Zip Code', 'data-parsley-required'=>'true')) !!}
                    </div>
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('zip_code') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
			
			<div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Phone','Phone *:', array('class'=>'col-md-3 control-label')) !!}
                    <div class="col-md-9">
                        {!! Form::text('Phone', null, array('class'=>'form-control', 'placeholder'=> 'Phone', 'data-parsley-required'=>'true')) !!}
                    </div>
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('Phone') }}</strong>
                        </div>
                    @endif
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

        });
    </script>
@endsection