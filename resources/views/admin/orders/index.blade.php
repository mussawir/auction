@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Orders</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Orders<small></small></h1>
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
                <h4 class="panel-title">Orders</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Total Products</th>
                            <th>Ordered Date</th>
							<th>Buyer</th>
							<th>PT Profit</th>
                            <th>Action</th>
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
						<td>{{round($items->totalAmt,2)}}</td>
						<td> 
						<a data-toggle="tooltip" title="View Summary" data-target="#myModal" href="#" onclick="showDetail({{$items->m_id}});" target="_blank" class="btn btn-info "><span  class="fa fa-list"></span></a>
						<a data-toggle="tooltip" title="View " href="{{url('/admin/orders-invoice/').'/'.$items->m_id}}" target="_blank" class="btn btn-success"><span  class="fa fa-eye"></span></a>
						</td>
						</tr>
						
						<?php } } ?> 
						
                        </tbody>
                    </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
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
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								  </div>
								  
								</div>
				</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">

        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }
			$('[data-toggle="tooltip"]').tooltip(); 
        });
		function showDetail(id){
			$.ajax({
			type    : 'GET',
			async:false,
			//url     : '/supplier/orders/list/{id}'+id,
			url: '{{ URL::to('/admin/orders-details')}}'+'/'+id,
			beforeSend: function (request) {
			return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
			},
			success: function (result) {
				$('#order-detail-model').html('').html(result);
			},
			error:function (error) {
				  
			}
			});
		}
    </script>
@endsection