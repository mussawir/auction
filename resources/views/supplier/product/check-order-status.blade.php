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

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-12">
        <div class="msg">
			<div id="sucessbody" class="alert alert-dismissable alert-success" style="display: none">
            </div>
        </div>
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Orders List</h4>
            </div>
            <div class="panel-body">
			<div class="row">
					<div class="col-md-12">
					<button onclick="updateOrder();" type="button" class="btn btn-success pull-right">Update</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
				</div>
                <table id="selected-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>OrdersId</th>
						<th>Date</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Seller</th>
                        <th>Buyer</th>
						<th>Status</th>
						<th>statusText</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table1 as $item)
                        <tr>
                        <td>{{$item->order_id}}</td>
						<td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                        <td>{{$item->products_name}}</td>
                        <td>{{$item->product_qty}}</td>
						<td>${{$item->product_price}}</td>
						<td>{{$item->pra_first_name.' ' . $item->pra_last_name}}</td>
						<td>{{$item->pa_first_name.' ' . $item->pa_last_name}}</td>
						<td>
						<select class="form-control" id="order_status_<?php echo $item->order_id; ?>" name="order_status_<?php echo $item->order_id; ?>" <?php echo $item->order_status ==1 ? 'disabled':'';?><?php echo $item->order_status ==3 ? 'disabled':''?> >
                                            <option value="0" <?php echo $item->order_status ==0 ?'Selected="selected"' : '';?>>Pending</option>
                                            <option value="1" <?php echo $item->order_status ==1 ?'Selected="selected"' : '';?>>Delivered</option>
                                            <option value="2" <?php echo $item->order_status ==2 ?'Selected="selected"' : '';?>>Process</option>
                                            <option value="3" <?php echo $item->order_status ==3 ?'Selected="selected"' : '';?>>Cancelled</option>
                                        </select></td>
						<td><?php echo $item->order_status ==0 ? 'Pending':''; ?>
						<?php echo $item->order_status ==1 ? 'Delivered':''; ?>
						<?php echo $item->order_status ==2 ? 'Process':''; ?>
						<?php echo $item->order_status ==3 ? 'Cancelled':''; ?></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
				<div class="row">
					<div class="col-md-12">
					&nbsp;&nbsp;&nbsp;&nbsp;
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					<button onclick="updateOrder();" type="button" class="btn btn-success pull-right">Update</button>
					</div>
				</div>
            </div>
        </div>
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
            $('#selected-table').DataTable({
                responsive: true,
                "aaSorting": [[0, "asc"]],
                "iDisplayLength": 50,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,8]}
				,{ "bVisible": false, "aTargets": [8] }
				,{ "bSearchable": false, "aTargets": [7] }
				]
            });
        });
        function updateOrder()
		{
			var lastSearch = customSearch('selected-table','',-1);
			var form_data = new FormData();
			$("select[id^='order_status']").each(function (i, el) {
			  //console.log(el.id);
			  //console.log(el.value);
			  form_data.append(el.name, el.value);
				//if(el.value==1) $('#'+el.id).attr('disabled',true);
				//if(el.value==3)$('#'+el.id).attr('disabled',true);
     });
            $.ajax({
                url: '{{ URL::to('/supplier/orders/update-status') }}',
                type: "POST",
                data: form_data,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(data){
					var appender = '<button data-dismiss="alert" class="close" type="button">×</button>';
                        appender += '<h4>Success</h4>';
                        appender += '<p>Status Updated Successfully</p>';
                        $('#sucessbody').html('');
                        $('#sucessbody').html(appender);
                        $("#sucessbody").show();
                        setTimeout(function () {
                            $("#sucessbody").hide();
                        }, 2000);
                    customSearch('selected-table',lastSearch,50);
					$("select[id^='order_status']").each(function (i, el) {
				if(el.value==1) {$('#'+el.id).attr('disabled',true); $('#'+el.id).parent('td').parent('tr').remove();}
				if(el.value==3){$('#'+el.id).attr('disabled',true); $('#'+el.id).parent('td').parent('tr').remove();}
     });
                },
                error: function(data){
                    customSearch('selected-table',lastSearch,50);
                }
            });
		}

        
    </script>
@endsection