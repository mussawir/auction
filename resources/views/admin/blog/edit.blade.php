@extends('layouts.adash')
@section('head')
<style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}

#img-upload{
    width: 100%;
}
</style>
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
	<li><a href="{{url('/admin/adminBlog')}}">Post List</a></li>
    <li class="active">Contact Dashboard</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Contact Dashboard <small>Edit Contact Dashboard</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <div class="col-md-12 msg">
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
    {!! Form::model($exercises, array('url'=>'/admin/adminBlog/update', 'method' => 'PATCH', 'id'=>'frm-contact', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}
    <!-- begin col-8 -->
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
                <h4 class="panel-title">Edit Contact Dashboard</h4>
            </div>
            <div class="panel-body">

                {!! Form::hidden('id') !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('blog_title','Title *:', array('class'=>'col-md-2 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('blog_title', null, array('class'=>'form-control', 'placeholder'=> 'Post Title', 'data-parsley-required'=>'true')) !!}
                            </div>
                            @if ($errors->has('blog_title'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('blog_title') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('post_link','Link :', array('class'=>'col-md-2 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::text('post_link', null, array('class'=>'form-control', 'placeholder'=> 'Post Link to redirect')) !!}
                            </div>
                            @if ($errors->has('post_link'))
                                <div class="text-danger">
                                    <strong>{{ $errors->first('post_link') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('type','Type *:', array('class'=>'col-md-2 control-label')) !!}
                            <div class="col-md-9">
                                <select name="type" class="form-control" id="type">
									<option value="1">For Patients</option>
									<option value="2">For Practitioners</option>
								</select>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
							<label class="col-md-2 control-label">Upload Image</label>
                            <div class="col-md-9">
                                        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="imgInp" name="image_path">
                </span>
            </span>
            <input name="image_name" type="text" class="form-control" readonly>
        </div>
		<?php if($exercises->image_path) {?>
		<img id='img-upload' name="image_upload" class="img-responsive" src="{{url('/').$exercises->image_path}}"  />
		<?php } else {?>
		<img id='img-upload' name="image_upload" class="img-responsive" />
		<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('blog_text','Detail :', array('class'=>'col-md-2 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::textarea('blog_text', null, array('class'=>'form-control', 'placeholder'=> 'Address', 'rows'=>'3')) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    {!! Form::submit('Update', array('class'=>'btn btn-success pull-right')) !!}
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 8 -->
    <!-- begin col-4 -->
    {!! Form::close() !!}
            <!-- end col 4 -->
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
    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [1]}]
                });
            }
			$('#type').val(<?php echo $exercises->type; ?>);
			FormWysihtml5.init();

            var roxyFileman = '{{asset('public/dashboard/plugins/fileman_lastest/index.html')}}';
            CKEDITOR.replace('blog_text',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                        removeDialogTabs: 'link:upload;image:upload',
                        enterMode	: Number(2)
                    })
					//FOR IMAGE
			
			$(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
		    
		    var input = $(this).parents('.input-group').find(':text'),
		        log = label;
		    
		    if( input.length ) {
		        input.val(log);
		    } else {
		        if( log ) alert(log);
		    }
	    
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        
		        reader.onload = function (e) {
		            $('#img-upload').attr('src', e.target.result);
		        }
		        
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$("#imgInp").change(function(){
		    readURL(this);
		});
        });

    </script>
@endsection