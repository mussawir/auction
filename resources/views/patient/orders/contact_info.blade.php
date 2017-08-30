@extends('layouts.padash')
@section('content')
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/patient/ecommerce')}}">Dashboard</a></li>
        <li class="active">Contact</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Profile <small>Contact</small></h1> 
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
            <h4 class="panel-title">Contact</h4>
        </div>
        <div class="panel-body">
            {!! Form::open(array('url'=>'/patient/index/shipping_save', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}


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

			<div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('address','Address *:', array('class'=>'col-md-3 control-label')) !!}
                    <div class="col-md-9">
                        {!! Form::text('address', null, array('class'=>'form-control', 'placeholder'=> 'Address', 'data-parsley-required'=>'true')) !!}
                    </div>
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('address') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            
			

           

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('zip_code','Zip Code *:', array('class'=>'col-md-3 control-label')) !!}
                    <div class="col-md-9">
                        {!! Form::text('zip_code', null, array('class'=>'form-control', 'placeholder'=> 'Zip Code', 'data-parsley-required'=>'true')) !!}
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
                    {!! Form::label('phone','Phone *:', array('class'=>'col-md-3 control-label')) !!}
                    <div class="col-md-9">
                        {!! Form::text('phone', null, array('class'=>'form-control', 'placeholder'=> 'Phone', 'data-parsley-required'=>'true')) !!}
                    </div>
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
			
            <div class="col-md-12">
			{!! Form::submit('Save', array('class'=>'btn btn-success pull-right')) !!}
			{!! Form::submit('Edit', array('class'=>'btn btn-success pull-right' , 'style'=>'margin-right: 5px;')) !!}
                
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