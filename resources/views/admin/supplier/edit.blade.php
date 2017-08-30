@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/manufacturer')}}">Suppliers</a></li>
    <li class="active">Edit</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->

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
        <h1 class="page-header">Suppliers <small></small></h1>
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Edit Suppliers</h4>
            </div>
            <div class="panel-body">
                {!! Form::model($category, array('url'=>'/admin/supplier/update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}

                {!! Form::hidden('supplier_id') !!}
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
                        {!! Form::label('email','Email *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=> 'Email', 'data-parsley-required'=>'true','type'=>'email')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('email') }}</strong>
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
                        {!! Form::label('supplierDescription','Supplier Description *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('supplierDescription', null, array('class'=>'form-control', 'placeholder'=> 'Supplier Description', 'data-parsley-required'=>'true')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('supplierDescription') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    {!! Form::submit('Update', array('class'=>'btn btn-success pull-right')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
<!-- end row -->
@endsection