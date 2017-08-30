@extends('layouts.padash')

@section('content')


    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Orders <small>Delivery / Pending Orders</small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Delivery / Pending Orders </h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Total Products</th>
                            <th>Ordered Date</th>
							<th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($table)) {
							foreach($table as $items) {
						?>
						<tr>
						<td>{{$items->m_id}}</td>
						<td>{{$items->productCount}}</td>
						<td><?php 
						$datee = date("m/d/Y", strtotime($items->created_at));
						echo $datee; ?></td>
						<td>${{$items->totalAmt}}</td>  
						<td>
<a href="#" onclick="showDetail({{$items->m_id}});" class="btn btn-info btn-xs"><span class="fa fa-eye"></span></a>
						</td>
						</tr>
						<?php }}?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col 6 -->
		
		<div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Order Detail</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table-ajax" class="table table-hover">
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Qty * Amount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end panel -->
        </div>
    </div>
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
			
			if ($('#data-table-ajax').length !== 0) {
                $('#data-table-ajax').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
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
			//url     : '/patient/ecommerce/order-dashboard-detail/'+id,
			url: '{{ URL::to('/patient/ecommerce/order-dashboard-detail')}}'+'/'+id,
			beforeSend: function (request) {
			return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
			},
			success: function (result) {
				$('#data-table-ajax tbody').html('').html(result);
			},
			error:function (error) {
				  
			}
			});
		}
    </script>

@endsection