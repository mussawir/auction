@extends('layouts.supdash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li class="active">Orders List</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Orders List<small></small></h1>
<!-- end page-header -->

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
                    <h4 class="panel-title"><?php if($page!='order_list_1') { echo 'Pending'; } else { echo 'Delivered'; } ?> Orders </h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Total Products</th>
                            <th>Ordered Date</th>
		
							<th>Buyer</th>
							<th>Total</th>
							<?php if($page!='order_list_1') { ?>	
                            <th>Action</th>
							<?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
						if(isset($table)) {
							foreach($table as $items) {
						?>
						<tr id="order_tr_{{$items->m_id}}">
						<td>{{$items->m_id}}</td>
						<td>{{$items->productCount}}</td>
						<td>{{$items->maxDelivery}}</td>
						
						<td>{{$items->pa_first_name.' ' . $items->pa_last_name}}</td>
						<td>{{$items->totalAmt}}</td>
						<?php if($page!='order_list_1') { ?>						
						<td> 
						<a  data-toggle="modal" data-target="#myModal" href="#" onclick="showDetail({{$items->m_id}});" target="_blank" class="btn btn-info btn-xs"><span  class="fa fa-list"></span></a>
						</td>
						<?php } ?>
						</tr>
						
								<?php $m_id_id = $items->m_id; }}?>
						
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col 6 -->
		

		       
				 <div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog">
								
								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title">Order Detail</h4>
									</div>
									
									<div class="modal-body" id="order-detail-model">
									
									</div>
									<div class="modal-footer">
									<input type="hidden" id="m_order_id_curr" value="0" />
									<!--<button onclick="orderupdate($('#m_order_id_curr').val(),this);" type="button" class="btn btn-success" data-dismiss="modal">Process</button>-->
									<?php  $val = "";
									$name = "";
										if($page == 'order_list_0' )
										{	
											$name = 'Process';
											$val = '2';						
										}
											
										elseif($page == 'order_list_2')
										{
											$name = 'Shipped';
											$val = '4';
										}
										elseif($page == 'order_list_1')
										{
											$name = 'Deliver';
											$val = '1';
										}
									?>
										<button onclick="orderupdate($('#m_order_id_curr').val(),this);" type="button" class="btn btn-success" data-dismiss="modal"><?php echo $name;?></button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								  </div>
								  
								</div>
				</div>
		
			
    </div>
@endsection
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->

@endsection
@section('page-scripts')

    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[2, "desc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}]
                });
            }
			
        });
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
		
		function showDetail(id){
			
			$.ajax({
			type    : 'GET',
			async:false,
			//url     : '/supplier/orders/list/{id}'+id,
			url: '{{ URL::to('/supplier/orders')}}'+'/'+id,
			beforeSend: function (request) {
			return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
			},
			success: function (result) {
				$('#order-detail-model').html('').html(result);
				$('#m_order_id_curr').val(id);
				//$('#data-table-ajax tbody').html('').html(result);
			},
			error:function (error) {
				
			}
			});
		}
		
		function orderupdate(id,obj){
			$.ajax({
			type    : 'POST',
			data : {
			id : id, 
			status : <?php echo $val;?>
			},
			async:false,
			url: '{{ URL::to('/supplier/orders/update')}}',
			beforeSend: function (request) {
			return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
			}, 
			success: function (result) {
			if(result=='success'){
			$('#order_tr_'+id).remove();
			showSuccess('msg','Execute Successfully');
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