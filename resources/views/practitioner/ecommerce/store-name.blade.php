@extends('layouts.pradash')

@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')

<!-- begin page-header -->
<h1 class="page-header">Custom Store Name<small></small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-12">
        <div class="msg" id="msg">
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
			<?php if(isset($_GET['type'])&&$_GET['type']=='error') {?>
			<div class="alert alert-danger fade in">
                    <strong>Error!</strong>
                    <strong>Please set your store first.</strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
			<?php } ?>
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
                <h4 class="panel-title">Custom Store Name</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/practitioner/ecommerce/save-store-name', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true' , 'id'=>'formid')) !!}

				
				
               
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Customer Store Name : ', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-4">
                        <input id="value" name="value" type="text" class="form-control input-sm" value="<?php echo isset($StoreData) ? $StoreData->value : ""  ?>" />
                        </div>
                    </div>

                </div>
				

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Customer Store Image : ', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-4">
                          

						  {!! Form::file('logo_image', array('onchange'=>'readURL(this,\'imgId\')','class'=>'form-control', 'accept'=>'image/*', 'id'=>'file')) !!}
                        </div>
                    </div>

                </div>
				
				  <div class="col-md-12">
                    <div class="form-group">
					      {!! Form::label('templates',' Store Image Preview : ', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-4">
                   <img class="img-responsive" id="imgId" src="<?php if(isset($StoreData)) { echo url('/public/images/practitioners/').'/'.$practitioner_info->url  . '/' .$StoreData->settings_image; } ?>" />
						
                        </div>
                    </div>  

                </div>

                <div class="col-md-6 col-md-offset-3">

                    {!! Form::submit('Set Store', array('class'=>'btn btn-success')) !!}
                    <?php if($btnShow=='show') { ?>
                    {!! Form::button('Delete Last Defined', array('class'=>'btn btn-danger' , 'onclick'=>'redirectDelete();')) !!}
                    <?php } ?>

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

function redirectDelete()
        {
            var url = '';
            url = '{{url("/practitioner/ecommerce/remove-store-name")}}';
            window.location.href=url;
        }
function readURL(input,imgId) { 
if (input.files && input.files[0]) 
{ 
var reader = new FileReader(); 
reader.onload = function (e) { 
$('#'+imgId).attr('src', e.target.result); 
$('#'+imgId).show(); 
} 
reader.readAsDataURL(input.files[0]); 
return input.files[0].name; 
} else { 
$('#'+imgId).attr('src', ''); 
$('#'+imgId).hide(); 
} 
}

        
    </script>

		<script>
	var _URL = window.URL || window.webkitURL;

$("#file").change(function(e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        img.onerror = function() {
            showError("msg","not a valid file: " + file.type);
			}; 
console.log(this.width);
console.log(this.height);
        img.onload = function() {
          if(this.width < 1200 && this.height < 786){
            showError("msg","Image size should have Min 1200 width and 786 Height "+" "+"This Image Width is : "+this.width+" and height is : "+this.height+".");
			$('#formid').find('#file').val('');
			return false;
			}
		else{
            return true;
			}

        }; 
        img.src = _URL.createObjectURL(file);


    }

});
function showError(id,msg){
	$('#'+id).html('');
	$('#'+id).show();
	$('#'+id).html('<div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a><strong>Error!</strong> '+msg+'.</div>').delay(2000).fadeOut();
}
	</script>
@endsection