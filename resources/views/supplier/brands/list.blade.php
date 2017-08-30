<style type="text/css">
    
    img {
    width: 100%;
}
</style>
@extends('layouts.supdash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/supplier/product/list')}}">Products List</a></li>
    <li class="active">New Product</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">New Product <small></small></h1>
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
                <h4 class="panel-title">New Product</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/supplier/product/product-store', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}

                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Description : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-7">
                        <textarea name="productDescription" id="productDescription" class="form-control" placeholder="Write Detailed Description" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Price : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-2">
                        <input type="text" name="price" id="price" class="form-control input-sm" placeholder="$">
                        </div>
                        {!! Form::label('templates','Quantity : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-2">
                        <!--<input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity">-->
                        <input type="number" class="form-control input-sm" name="quantity" id="quantity" value="0" placeholder="quantity">
                        </div>
                        {!! Form::label('templates','Discount : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-2">
                        <!--<input type="text" name="discount" id="discount" class="form-control" placeholder="%">-->
                        <input data-parsley-type="number" class="form-control input-sm" name="discountP" id="discountP" value="0" placeholder="%">
                        </div>
                        {!! Form::label('templates','Tax : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-2">
                        <!--<input type="text" name="tax" id="tax" class="form-control" placeholder="%">-->
                        <input data-parsley-type="number" class="form-control input-sm" name="taxP" id="taxP" value="0" placeholder="%">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
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
                    {!! Form::label('templates','Tags : ', array('class'=>'col-md-1 control-label')) !!}
                    <div class="col-md-5">
                    <?php 
                    $textVal = '';
                    foreach ($preTags as $key => $value) {
                        //echo $key;
                        $textVal = $value->value;
                    }
                    ?>
                    <input id="tags_1" name="tags_1" type="text" class="form-control" value="<?php echo $textVal; ?>" />
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
        <?php 
        $AvailableTags = '';
        foreach ($AvailTags as $key => $value) {
            $AvailableTags .= $value->Flag;
            $AvailableTags .= ',';
        } 
        $AvailableTags = rtrim($AvailableTags, ",");
        $jsonData = explode(',',$AvailableTags);
        ?>
<!-- end row -->
@endsection
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->

@endsection
@section('page-scripts')
    <script>
        $(document).ready(function() {
            
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
          $('#'+imgIdd).append('<img src="' + objectUrl + '" />');
          window.URL.revokeObjectURL(fileList[i]);
        }
    
    
}


        
    </script>
@endsection