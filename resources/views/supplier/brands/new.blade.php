
@extends('layouts.supdash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{ asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet">
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/supplier/product/brands/list')}}">Brands List</a></li>
    <li class="active">New Brand</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">New Brand <small></small></h1>
<!-- end page-header -->
<style type="text/css">
    
    img {
    width: 100%;
}
</style>
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
                <h4 class="panel-title">New Brand</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/supplier/product/brands/brand-store', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}

                    <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Name : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-7">
                        <input type="text" name="brandName" id="brandName" placeholder="Brand Name" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Description : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-7">
                        <textarea name="brandDescriptiion" id="brandDescriptiion" class="form-control" placeholder="Write Detailed Description" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('templates','File Upload :', array('class'=>'col-md-1 control-label text-left')) !!}
                    <div class="col-md-2">
                        <input id="uploadfiles" type="file" name="files[]" multiple="">
                    </div>
                    </div>
                </div>
                <div class="col-md-12" id="preview-area">

                </div>
                <div class="col-md-12">
                    &nbsp;
                </div>
                <div class="col-md-12">
                    {!! Form::submit('Create', array('class'=>'btn btn-success pull-right')) !!}
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
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->

@endsection
@section('page-scripts')
    <script>
        $(document).ready(function() {
            
        });
var inputLocalFont = document.getElementById("uploadfiles");
inputLocalFont.addEventListener("change",previewImages,false);

function previewImages(){
    var fileList = this.files;
    
    var anyWindow = window.URL || window.webkitURL;
var imgId ="childImage";
$('#preview-area').html('');
        for(var i = 0; i < fileList.length; i++){
          var objectUrl = anyWindow.createObjectURL(fileList[i]);
          var d = new Date();
    var n = d.valueOf();
    var number = n;
    number = number+i;
          var imgIdd = imgId + '_'+number;
          $('#preview-area').append('<div class="col-md-2" id="'+imgIdd+'">');
          $('#preview-area').append('</div>');
          $('#'+imgIdd).append('<img src="' + objectUrl + '" />');
          window.URL.revokeObjectURL(fileList[i]);
        }
    
    
}


        
    </script>
@endsection