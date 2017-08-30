@extends('layouts.padash')

@section('content')

    
	<?php 
	$str1 = '';
	$str2 = '';
	if($type=='1'){
		$str1 = 'Shipping';
		$str2 = 'Address';
	}
	if($type=='2'){
		$str1 = 'Contact';
		$str2 = 'Info';
	}
	if($type == '1' || $type == '2' ){
	
	  ?>
	<a class="btn btn-success pull-right"  href="{{url('/patient/index/shipping-address/'.$type)}}" style="margin: 3px 12px;">Add New <?php echo $str1," ",$str2 ;?></a>
    
	<?php }	?>
	<!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header"><?php echo $str1; ?><small> <?php echo $str2; ?></small></h1>
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
    </div>
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
                    <h4 class="panel-title"><?php echo $str1," ",$str2 ;?> List </h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            
                            <?php if( $type == '1') {?>
							<th>Name</th>  <?php  } 
							elseif( $type == '2' ) { ?>
							<th>First Name</th>
                            <th>Last Name</th>
							<?php } ?>
                            <th>Address</th>
                            <th>Zip Code</th>
							<th>Phone</th>
							<th>Action</th>
                            
                        </tr>
                        </thead>
                        <tbody>
						<?php if(isset($shipping_list)) { ?>
                        @foreach( $shipping_list as $item  )
                            <tr>
							
							 <?php if( $type == '1') {?>
							<td> {{ $item->first_name }}</td>  <?php  } 
							elseif( $type == '2' ) { ?>
							<td> {{ $item->first_name }}</td>
                            <td> {{ $item->last_name }}</td>
							<?php } ?>
                                
                                <td>{{ $item->Address }}</td>
                                <td>{{ ($item->zip_code) }} </td>
								<td>{{ ( $item->Phone ) }} </td>
                                <td>				
									<a data-toggle="tooltip" title="Edit" href="{{url('/patient/index/shipping-edit/'.$item->s_id.'/'.$type)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
						  
									<a href="#" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="doDelete({{$item->s_id}},this);"><i class="fa fa-trash"></i></a>
								</td>
                            </tr> 
                        @endforeach 
						<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col 6 -->
    </div>
@endsection


@section('page-scripts')

    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 25,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
                });
            }
        });
        $(document).ready(function() {
            App.init();
            
            
        });
		function doDelete(id,obj){

$.ajax({
type    : 'POST',
data : {
type : 'delete',
id : id
},
async:false,
//url     : '/patient/index/shipping_save,
url: '{{ URL::to('/patient/index/shipping_save')}}',
beforeSend: function (request) {
return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
},
success: function (result) {
if(result=='success'){
//location.reload();	
var whichtr = $(obj).closest("tr");
whichtr.remove(); 
showSuccess('msg','Deleted Successfully');
}
},
error:function (error) {
 showError('msg','Some Error Occured');
}
});
}
function showError(id,msg){
	$('#'+id).html('');
	$('#'+id).show();
	$('#'+id).html('<div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">Ã—</a><strong>Error!</strong> '+msg+'.</div>').delay(1500).fadeOut();
}
function showSuccess(id,msg){
	$('#'+id).html('');
	$('#'+id).show();
	$('#'+id).html('<div class="alert alert-success"><strong>Success! </strong>'+msg+'</div>').delay(1500).fadeOut();
}
    </script>
@endsection