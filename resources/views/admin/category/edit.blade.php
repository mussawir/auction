@extends('layouts.adash')
@section('content')
<style>
.section-img{
	width: 100%;
    height: 50px;
}
.section-img span{	
    position: absolute;
    /* top: 0%; */
    left: 97%;
    bottom: 50%;
}
</style>
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li><a href="{{url('/admin/manufacturer')}}">Edit Category</a></li>
    <li class="active">Edit</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Product Categories <small>Edit Category</small></h1>
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
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Edit Category</h4>
            </div>
            <div class="panel-body">
                {!! Form::model($category, array('url'=>'/admin/category/update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}

                {!! Form::hidden('cat_id') !!}

                <div class="col-md-6">

                    <div class="form-group">
                        {!! Form::label('name','Upload Image :', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::file('image', array('class'=>'form-control', 'accept'=>'image/*' , 'id'=>'image' , 'onchange'=>'preview(this)')) !!}
                       <div class="section-img">
					   <span><img id="preview-img" src="{{asset('public/images/categories/'.$category->cat_image)}} " style="padding-left:10px; height: 50px; " /></span>
					   </div>
						</div>
						
						
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('name','Name *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::text('cat_name', null, array('class'=>'form-control', 'placeholder'=> 'Name', 'data-parsley-required'=>'true')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('cat_name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('sortOrder','SortOrder *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::text('sortOrder', null, array('class'=>'form-control', 'placeholder'=> 'SortOrder', 'data-parsley-required'=>'true')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('sortOrder') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
<div class="col-md-6" style="display:none">
                    <div class="form-group">
                        {!! Form::label('cat_percentage','Percentage *:', array('class'=>'col-md-4 control-label')) !!}
                        <div class="col-md-8">
                            {!! Form::text('cat_percentage', null, array('class'=>'form-control', 'placeholder'=> 'cat_percentage')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('cat_percentage') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('name','Description *:', array('class'=>'col-md-2 control-label')) !!}
                        <div class="col-md-10">
                            {!! Form::textarea('cat_desc', null, array('class'=>'form-control', 'placeholder'=> 'Description', 'data-parsley-required'=>'true')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>
<div class="col-md-12">
				<div class="col-md-2">
				{!! Form::label('parent_id','Parent Category:', array('class'=>'col-md-12 control-label')) !!}
				</div>
				<div class="col-md-10">
				<input type="hidden" id="parent_id" name="parent_id" value="0" />
                        <div class="form-group" id="dependent-dropDown">
                            <div class="col-md-3">
                                <select id="parent_id_1" name="parent_id_1"  class="form-control" onchange="getChilds('parent_id_2',$(this).val(),0);" data-parsley-required="false" multiple>
								<option value="">Please Select</option>
									
                                </select>
                            </div>
							<div class="col-md-3">
                                <select id="parent_id_2" name="parent_id_2"  class="form-control" onchange="getChilds('parent_id_3',$(this).val(),0);" data-parsley-required="false" multiple>
								<option value="">Please Select</option>
									
                                </select>
                            </div>
							<div class="col-md-3">
                                <select id="parent_id_3" name="parent_id_3"  class="form-control" onchange="getChilds('parent_id_4',$(this).val(),1);" data-parsley-required="false" multiple>
								<option value="">Please Select</option>
									
                                </select>
                            </div>
							<div class="col-md-3">
                                <select id="parent_id_4" name="parent_id_4"  class="form-control" onchange="" data-parsley-required="false" multiple>
								<option value="">Please Select</option>
									
                                </select>
                            </div>
                        </div>
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
@section('page-scripts')
    <script>
	<?php 
	  $arrCount = count($levelArr);
	  for($i=0;$i<count($levelArr);$i++)
	  { 
		$arrCount--;
	?>
  
		getChilds('parent_id_<?php echo $i+1; ?>',<?php echo $levelArr[$arrCount]; ?>,<?php echo $i==3? '1':'0';?>);
		<?php if($arrCount<3)
		{ ?>
		$('#parent_id_<?php echo $i; ?>').val(<?php echo $levelArr[$arrCount]; ?>);
	  <?php 
	  }}
	  ?>
        $(document).ready(function() {
			
		

     //$('.multiple-select2').select2(); 
//getChilds('parent_id_1',0,0);

    });
	
	function preview(input){ 
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#preview-img")
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
		}
	function addVal()
	{
		for(var i=4;i>0;i--)
	{
		var data = $('#parent_id_'+i).val();
		if(data=="")
		{
			if(i==1)
			{
				$('#parent_id').val('0');
				break;
			}
		}
		else
		{
			$('#parent_id').val($('#parent_id_'+i).val());
			break;
		}
	}
	}
	function getChilds(appnendIn,val,disable)
	{
		if(val==""&&val!="0")
		{
			$('#'+appnendIn).empty().append('<option value="" selected="selected">Please Select</option>');
			$('select#'+appnendIn).parent().nextAll('div').find('select').empty().append('<option value="" selected="selected">Please Select</option>');
			addVal();
			return;
		}
		$.ajax({
                    type: "GET",
					async: false,
                    url: '{{ URL::to('/admin/category/getChilds') }}/' + val+'/'+disable,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
						$('#parent_id').val(val);
						$('select#'+appnendIn).parent().nextAll('div').find('select').empty().append('<option value="" selected="selected">Please Select</option>');
                        $('#'+appnendIn).empty().append(result);
                    },
                    error:function (error) {
						$('#parent_id').val(val);
                    }
                });
                return false;
           // }
            return false;
	}
    </script>
@endsection