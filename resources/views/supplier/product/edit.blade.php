@extends('layouts.supdash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
<style>
.form-control-feedback {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 2;
    display: block;
    width: 64px;
    height: 34px;
    line-height: 34px;
    /* text-align: center; */
    pointer-events: none;
}
span#SKULoader {
    color: #00acac;
}
</style>
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/supplier/product/list')}}">Products List</a></li>
	<li><a href="{{url('/supplier/product/details')}}/{{$productId}}">View Product</a></li>
    <li class="active">Edit Product</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Edit Product <small></small></h1>
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

        <!-- begin panel -->
		@foreach($product as $item)
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Edit Product</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/supplier/product/update', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}
				<input type="hidden" name="products_id" id="products_id" value="{{$item->products_id}}"/>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Name : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-11">
                        <input data-parsley-required type="text" name="products_name" id="products_name" class="form-control" placeholder="Product Name" value="{{$item->products_name}}">
                        </div>
                    </div>
                </div>
				<div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','SKU : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-11">
						<input type="hidden" id="defaultSKU" value="{{$item->SKU}}" />
                        <!--<input data-parsley-required type="text" name="SKU" id="SKU" class="form-control" placeholder="Product SKU" value="{{$item->SKU}}">-->
						<input data-parsley-required type="text" class="form-control" name="SKU" id="SKU" placeholder="Product SKU" value="{{$item->SKU}}">
						<span id="SKULoader" class="fa-li fa fa-spinner fa-spin form-control-feedback"></span>
                        </div>
                    </div>
                </div>
				<div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Short Description : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-11">
                            <textarea data-parsley-required name="short_description" class="form-control" maxlength="30" placeholder="Write Short Description" rows="5">{{$item->short_description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Description : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-11">
                        <textarea data-parsley-required name="productDescription" id="productDescription" class="form-control" placeholder="Write Detailed Description" rows="5">{{$item->productDescription}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Price : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-2">
                        <input data-parsley-required type="text" name="price" id="price" class="form-control input-sm" placeholder="$" Onblur="StringCompare();" value="{{$item->price}}">
                        </div>
                        {!! Form::label('templates','Quantity : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-2">
                        <!--<input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity">-->
                        <input type="number" class="form-control input-sm" name="quantity" id="quantity"  placeholder="quantity" value="{{$item->quantity}}">
                        </div>
                        {!! Form::label('templates','Map : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-2">
                        <!--<input type="text" name="discount" id="discount" class="form-control" placeholder="%">-->
                        <input data-parsley-type="number" data-parsley-required  class="form-control input-sm" name="map" Onblur="StringCompare();" id="discountPer"  placeholder="%" value="{{$item->map}}">
                        </div>
                        {!! Form::label('templates','Tax : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-2">
                        <!--<input type="text" name="tax" id="tax" class="form-control" placeholder="%">-->
                        <input data-parsley-type="number" class="form-control input-sm" name="taxPer" id="taxPer"  placeholder="%" value="{{$item->taxPer}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="display:none;">
                    <div class="form-group">
                        {!! Form::label('templates','Status : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-1">
                        <input type="checkbox" class="form-control" id="status"  name="status" checked="true" value="1" onclick="$(this).val(this.checked ? 1 : 0)">
                        </div>
                        {!! Form::label('templates','Featured : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-1">
                        <input type="checkbox" class="form-control" id="featured" name="featured" onclick="$(this).val(this.checked ? 1 : 0)">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                <div class="form-group">
				<?php 
					$cat_id = $item->cat_id;
					$brand_id = $item->brand_id;
					?>
                    {!! Form::label('templates','Tags : ', array('class'=>'col-md-1 control-label')) !!}
                    <div class="col-md-5">
                    <input id="tags_1" name="tags_1" type="text" class="form-control" value="{{$item->tags}}" />
                    </div>
                    
					{!! Form::label('templates','Brand :', array('class'=>'col-md-1 control-label text-left')) !!}
                    <div class="col-md-5">
                        <select  class="form-control" id="brand_id" name="brand_id">
                                <option value=""></option>
                                <?php 
                                foreach ($brand as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value->id;?>"><?php echo $value->brandName;?></option>
                                <?php }
                                ?>
                            </select>
                    </div>
					</div>
                </div>
                <div class="col-md-12">
                 <div class="form-group">
                    {!! Form::label('templates','Category :', array('class'=>'col-md-1 control-label text-left')) !!}
                    <div class="col-md-5">
					<a href="#model-without-animation" data-toggle="modal">Update Category</a>
							<input type="hidden" id="js-checked" name="cat_id" value="<?php echo $cat_id.','; ?>" />
                    </div>
                    
                    </div>
                </div>
				<div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('templates','Main Image :', array('class'=>'col-md-1 control-label text-left')) !!}
                    <div class="col-md-2">
                        <input id="mainFiles" type="file" name="mainFiles" onchange="readURL(this);">
                    </div>
                    </div>
                </div>
				<div class="col-md-12">
				<div class="col-md-2">
				<?php if(isset($item->mainImage)) {?>
				<img height="100px" width="100px"  id="preview-main-area" src="{{url($item->mainImage)}}" />
				<?php } ?>
                </div>
				</div>
				<div class="col-md-12">
                    &nbsp;
                </div>
                <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('templates','Optional Images :', array('class'=>'col-md-1 control-label text-left')) !!}
                    <div class="col-md-2">
                        <input id="uploadfiles" type="file" name="files[]" multiple="">
                    </div>
                    </div>
                </div>
                <div class="col-md-12" id="preview-area">
				<?php $counter = 0; ?>
				@foreach ($imageTable as $imagePaths)
				<?php $counter++; ?>
				<div class="col-md-2" id="childImage_<?php echo $counter;?>" onclick="RemoveImage('{{$imagePaths->id}}',this);">
				<img height="25%" width="100%" src="{{url($imagePaths->image_path)}}" />
				</div>
				@endforeach
                </div>
                <div class="col-md-12">
                    &nbsp;
                </div>
                <div class="col-md-12">
                    {!! Form::submit('Update', array('class'=>'btn btn-success pull-right')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
		@endforeach
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
<div class="modal" id="model-without-animation" style="display: none; padding-right: 17px;">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">Category selection</h4>
										</div>
										<div class="modal-body">
										<div class="row">
										<div id="jstree2" class="demo"></div>
										
										</div>
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
										</div>
									</div>
								</div>
							</div>
        <?php 
        $AvailableTags = '';
        foreach ($AvailTags as $key => $value) {
            $AvailableTags .= $value->Flag;
            $AvailableTags .= ',';
        } 
        $AvailableTags = rtrim($AvailableTags, ",");
        $jsonData = explode(',',$AvailableTags);
        ?>
		<?php 
		$categoryData = '';
		foreach ($category as $key => $value) {
			$appender = '';
			$selectedNode = '';
			if(strpos($cat_id, "," ) !== false ) {
					$exploded = explode(",",$cat_id);
					if (in_array($value->cat_id, $exploded)) {
							$appender = ',"state" : { "checked" : true,"opened":true,"selected":true }';
						}
				}
				else if($cat_id==$value->cat_id)
				{
					$appender = ',"state" : { "checked" : true,"opened":true,"selected":true }';
				}
				else
				{
					$appender = '';
				}
			$catId = $value->parent_id=="0"?"#":$value->parent_id;
            $categoryData .= '{"id":"'.$value->cat_id.'","parent":"'.$catId.'","text" : "'.$value->cat_name.'"'.$appender.'},';
        }
		?>
<!-- end row -->
@endsection
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/form-wysiwyg.demo.min.js')}}"></script>
@endsection
@section('page-scripts')
    <script>
        function removeExistance(value,checkValue)
	{
		var result = '';
		if (value.indexOf(checkValue) >= 0)
			{
				result = value.replace(checkValue,'');
			}
			return result;
	}
		$(document).ready(function() {
			$('#SKULoader').hide();
			$('#jstree2').jstree({'plugins':["wholerow","checkbox"], 'core' : {
								'data' : [
       <?php echo $categoryData; ?>
	   ]
								,"themes":{"icons":false}
							},checkbox: {       
      three_state : false, // to avoid that fact that checking a node also check others
      whole_node : false,  // to avoid checking the box just clicking the node 
      tie_selection : false // for checking without selecting and selecting without checking
    }
								}).on("check_node.jstree uncheck_node.jstree", function(e, data) {
									var id = data.node.id;
									var nodeText = data.node.text;
									if(data.node.state.checked)
									{
										//var isNull = $('#js-checked').val() == ""?"":',';
										$('#js-checked').val(id+","+$('#js-checked').val());
									}
									var selValue = $('#js-checked').val();
									if(!data.node.state.checked)
									{
										$('#js-checked').val(removeExistance(selValue,id+','));
									}
									var lastchar = $('#js-checked').val().substr($('#js-checked').val().length - 1);
});
			$('#brand_id').val('<?php echo $brand_id; ?>');
            FormWysihtml5.init();

            var roxyFileman = '{{asset('public/plugins/fileman_lastest/index.html')}}';
            CKEDITOR.replace('productDescription',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image'
                    });
					
					//$("#preview-main-area").click( function() {$(this).remove();});
        });
        var currentavailableTags = [<?php for($i=0;$i<count($jsonData);$i++)
{
    echo '"'.$jsonData[$i].'"';
    echo ',';
}
         ?>];
$("#tags_1").tagit(
{
    availableTags: currentavailableTags,
    beforeTagAdded: function(event, ui) {
      if ($.inArray(ui.tagLabel, currentavailableTags) == -1) {
        return false;
      }
    }

});
function RemoveImage(imgId,obj)
{
	//var q = confirm("Are you sure you want to delete this contact group?");
            //if (q == true) {

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
           // }
            return false;
}

/*$("#fileinput-button").click(function(){
  $('#uploadfiles').trigger('click'); 
});*/

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
$("#SKU").change(function() {
  checkSKU();
});
function checkSKU(){

if($('#SKU').val()==''){
	
	if(!$('#SKU').hasClass('parsley-error')){
		$('#SKU').addClass('parsley-error');
	}
	if(!$('#SKU').next('ul').hasClass('filled')){
		$('#SKU').next('ul').addClass('filled').html('').html('<li class="parsley-required">This value is required.</li>');
		$('#SKU').val('');
	}
	return;
}
else{
	if($('#SKU').hasClass('parsley-error')){
		$('#SKU').removeClass('parsley-error');
	}
	if($('#SKU').next('ul').hasClass('filled')){
		$('#SKU').next('ul').removeClass('filled').html('');
	}
}
		$('#SKULoader').show();
		$.ajax({
		type    : 'POST',
		data : {
		SKU : $('#SKU').val(),
		id : $('#products_id').val()
		},
		async:false,
		url: '{{ URL::to('/supplier/product/check-sku')}}',
		beforeSend: function (request) {
		return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
		},
		success: function (result) {
		if(result=='exist'){
			if(!$('#SKU').hasClass('parsley-error')){
				$('#SKU').addClass('parsley-error');
			}
			if(!$('#SKU').next('ul').hasClass('filled')){
				$('#SKU').next('ul').addClass('filled').html('').html('<li class="parsley-required"><strong>'+$('#SKU').val()+'</strong> This value already Exist.</li>');
				$('#SKU').val($('#defaultSKU').val());
			}
		}
		else if (result=='not'){
			if($('#SKU').hasClass('parsley-error')){
				$('#SKU').removeClass('parsley-error');
			}
			if($('#SKU').next('ul').hasClass('filled')){
				$('#SKU').next('ul').removeClass('filled').html('');
			}
		}
		$('#SKULoader').hide();
		},
		error:function (error) {

			if(!$('#SKU').hasClass('parsley-error')){
				$('#SKU').addClass('parsley-error');
			}
			if(!$('#SKU').next('ul').hasClass('filled')){
				$('#SKU').next('ul').addClass('filled').html('').html('<li class="parsley-required"><strong>'+$('#SKU').val()+'</strong> This value already Exist.</li>');
				$('#SKU').val($('#defaultSKU').val());
			}
			$('#SKULoader').hide();
		}
		});
}




function StringCompare()
{
	var string1 = document.getElementById("price").value;
	var string2 = document.getElementById("discountPer").value;
	
	if(string2==''||string1==''){return;}
	if(string1 > string2)
	{
		if(!$('#discountPer').hasClass('parsley-error')){
		$('#discountPer').addClass('parsley-error');
	}
	if(!$('#discountPer').next('ul').hasClass('filled')){
		$('#discountPer').next('ul').addClass('filled').html('').html('<li class="parsley-required"> Map should be greater than equals to cost</li>');
		$('#discountPer').val('');
	}
		return false;
	}else {
			if($('#discountPer').hasClass('parsley-error')){
			$('#discountPer').removeClass('parsley-error');
		}
		if($('#discountPer').next('ul').hasClass('filled')){
			$('#discountPer').next('ul').removeClass('filled').html('');
		}
	}
	return false;
}  
    </script>
@endsection