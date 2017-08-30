@extends('layouts.pradash')

@section('sidebar')
@include('layouts.mark-sidebar')
@endsection

@section('content')


<!-- begin page-header -->
<h1 class="page-header">Social <small>Media Setting</small></h1>
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
	{!! Form::open(array('url'=>'/practitioner/social-posts-socialmediasetting', 'class'=> 'form-horizontal','data-parsley-validate' => 'true')) !!}
    <div class="row">
		<div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Socail Media Setting</h4>
            </div>
            <div class="panel-body">

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('api','API *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('api', null, array('class'=>'form-control', 'placeholder'=> 'Enter Your API ', 'data-parsley-required'=>'true' ,'required' => 'required')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
				
				<div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('social_media','Select Social Media *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('social_media', array('' => 'Select Social Network','FB_api' => 'FaceBook', 'TWIT_api' => 'Twitter' , 'LIN_api' => 'Linkedin'), null, array('class' => 'form-control' ,'required' => 'required' , 'id'=>'mylist'))  !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div> 
	
				<div class="col-md-6" style="display:none;" id="con_id">
					<div class="form-group" id="twitter-div">
                        {!! Form::label('CONSUMER_SECRET','CONSUMER SECRET *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('CONSUMER_SECRET', null, array('class'=>'form-control', 'placeholder'=> 'Enter Your API SECRET ', 'data-parsley-required'=>'true' ,'required' => 'required')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                        {!! Form::submit('Save', array('class'=>'btn btn-success pull-right')) !!}
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
	<div div class="col-md-12">
	<div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Contact Group List</h4>
            </div>
			
            <div class="panel-body">
			
                <table id="data-table" class="table table-striped table-hover"> 
				
                    <thead>
					
			
                    <tr>
                        <th>Social Network</th>
                        <th>API Key</th>
                        <th>Twitter Key</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cg_list as $item)
                        <tr>
                            <td><?php 
							if($item->key=='FB_api'){ ?>
								<i style="font-size: 23px;  color: #3b5998;"  class="fa fa-facebook-square"></i>
							<?php }if($item->key=='TWIT_api'){ ?>
								<i style="font-size: 23px;  color: #1da1f2;" class="fa fa-twitter-square"></i>
								
							<?php }if($item->key=='LIN_api'){ ?>
								<i style="font-size: 23px;  color: #0077b5;" class="fa fa-linkedin-square"></i>
							<?php }
							?>
							</td>
                            <td>{{$item->value}}</td>
                            <td><?php 
							if($item->key=='TWIT_SECRET')

									echo $item->value; 
									
									?>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
	</div>
	</div>
	
	{!! Form::close() !!}
    <!-- end col 6 -->
</div>
<!-- end row -->
@endsection
@section('page-scripts')
    <script type="text/javascript">
     $(document).ready(function() {
		 $("#twitter-div").hide();
    $("#mylist").on("change", function() {
        if ($(this).val() === "TWIT_api") {
            $("#con_id").show();
			$("#twitter-div").show();
        }
        else {
            $("#con_id").hide();
			$("#twitter-div").hide();
        }
    });
});
    </script> 
@endsection 