@extends('layouts.supdash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/supplier/product/tags/list')}}">Tag List</a></li>
    <li class="active">New Predefine Product Tag</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">New Predefine Product Tag<small></small></h1>
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
                <h4 class="panel-title">New Predefine Product Tag</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(array('url'=>'/supplier/product/tags/predefined/store', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}

               
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('templates','Tag : ', array('class'=>'col-md-1 control-label')) !!}
                        <div class="col-md-4">
                        <input id="value" name="value" type="text" class="form-control input-sm" value="" />
                        <input type="hidden" name="key" id="key" class="form-control" value="<?php echo $_GET["flagType"];  ?>">
                        </div>
                    </div>
                </div>
               
                
                
                <div class="col-md-12">
                    &nbsp;
                </div>
                <div class="col-md-12">
                <div class="row">
                    {!! Form::submit('Create Tag', array('class'=>'btn btn-success pull-right')) !!}
                    <?php if($btnShow=='show') { ?>
                    {!! Form::button('Delete Last Defined', array('class'=>'btn btn-danger pull-right' , 'onclick'=>'redirectDelete();')) !!}
                    <?php } ?>
                    </div>
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
$("#value").tagit(
{
 availableTags: currentavailableTags,
    beforeTagAdded: function(event, ui) {
      if ($.inArray(ui.tagLabel, currentavailableTags) == -1) {
        return false;
      }
    }
});
function redirectDelete()
        {
            var url = '';
            url = '{{url("/supplier/product/tags/predefined/delete")}}';
            window.location.href=url;
        }


        
    </script>
@endsection