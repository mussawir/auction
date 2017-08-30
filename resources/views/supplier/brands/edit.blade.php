@extends('layouts.supdash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
		
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/supplier/product/brands/list')}}">Brands List</a></li>
    <li class="active">Edit Brands</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Edit Brands {{$table1->brandName}}<small></small></h1>
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
                    <span class="close" data-dismiss="alert">�</span>
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger fade in">
                    <strong>Error!</strong>
                    <strong>{{Session::pull('error')}}</strong>
                    <span class="close" data-dismiss="alert">�</span>
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
                <h4 class="panel-title">Edit Brands</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/supplier/brand/update', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}
				<input type="hidden" name="brand_id" id="products_id" value="{{$table1->id}}"/>
                           
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Brand Name : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-11">
                        <input data-parsley-required type="text" name="brands_name" id="brands_name" class="form-control input-sm" placeholder="$" value="{{$table1->brandName}}">
						<input class="hidden" type="text" name="update" id="update" class="form-control input-sm" placeholder="$" value="update">
                        </div>
					</div>
				</div>
				
				
				<div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Brand Description : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-11">
                        <textarea data-parsley-required name="brands_description" id="brands_description" class="form-control" placeholder="Write Detailed Description" rows="5">{{$table1->brandDescriptiion}}</textarea>
                        </div>
                    </div>
                </div>
								
				<div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('templates','Main Image :', array('class'=>'col-md-1 control-label text-left')) !!}
                    <div class="col-md-2">
                        <input id="uploadfiles" type="file" name="files[]" multiple="">
                    </div>
                    </div>
                </div>
				<?php if(isset($imageTable)){?>
				
				<div class="col-md-12" id="preview-area">
				<div class="col-md-2" id="childImage_1" onclick="RemoveImage('{{$imageTable->id}}',this);">
				<img height="25%" width="100%" src="{{url($imageTable->image_path)}}" />
				</div>
                </div>
				<?PHP } ?>
			
				
					
                
            
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
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="{{asset('public/dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/form-wysiwyg.demo.min.j')}}s"></script>
@endsection
@section('page-scripts')
    <script>
	function RemoveImage(imgId,obj)
{
	var q = confirm("Are you sure you want to delete this image?");
            if (q == true) {

                $.ajax({
                    type: "GET",
                    url: '{{ URL::to('/imageTable/destroy') }}/' + imgId,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        $(obj).remove();
                    },
                    error:function (error) {
                    }
                });
                return false;
            }
            return false;
}



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
          $('#'+imgIdd).append('<img height="25%" width="100%" src="' + objectUrl + '" />');
          window.URL.revokeObjectURL(fileList[i]);
        }
}


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview-main-area').attr('src', e.target.result);
            $('#preview-main-area').attr('width', "100px;");
            $('#preview-main-area').attr('height', "100px;");
        }

        reader.readAsDataURL(input.files[0]);
    }
}
    </script>
@endsection