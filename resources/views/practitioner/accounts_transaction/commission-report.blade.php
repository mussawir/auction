@extends('layouts.pradash')
@section('sidebar')
@include('layouts.manage-sidebar')
@endsection
@section('content')

<!-- begin page-header -->
<h1 class="page-header">Commission <small></small></h1>
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
                <h4 class="panel-title">Products Commssion</h4>
            </div>
            <div class="panel-body">
                <div class="row">

                    <!-- end page-header -->
                    <!-- begin col-3 -->
                    <div class="col-md-6 col-sm-6">
                        <div class="widget widget-stats bg-green">
                            <div class="stats-icon"><i class="fa fa-money"></i></div>
                            <div class="stats-info">
                                <h4>TOTAL COMMISSION</h4>
                                <p>${{ round($commission,2) }}</p>
                            </div>
                            <div class="stats-link">
                                {{--<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>--}}
                            </div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->

                    <!-- end col-3 -->
                    <!-- begin col-3 -->
                    <div class="col-md-6 col-sm-6">
                        <div class="widget widget-stats bg-purple">
                            <div class="stats-icon"><i class="fa fa-check"></i></div>
                            <div class="stats-info">
                                <h4>TOTAL PRODUCT SOLD</h4>
                                <p>{{ count($orders) }}</p>
                            </div>
                            <div class="stats-link">
                                {{--<a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>--}}
                            </div>
                        </div>
                    </div>
                    <!-- end col-3 -->
                    <!-- begin col-3 -->

                    <!-- end col-3 -->
                </div>
                <div class="row collapse" id="advanceFilter">
                    <div class="col-md-12">
                        <label class="col-md-3 control-label">Products : </label>
                        <div class="col-md-6">
                            <input type="text" id="product" name="product" class="form-control" value="{{$product}}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-3 control-label">Date : </label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="frmDate" name="frmDate" placeholder="Select Date" value="{{$fromDate}}" />
                        </div>

                        <div class="col-md-3">
                            <input type="text" id="toDate" name="toDate" class="form-control" placeholder="Select Date" value="{{$toDate}}" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-9">
                            <button class="btn btn-success pull-right" onclick="Search();">Search</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </div>
                </div>
                <table id="selected-table-commission" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Commission</th>
                        <th>Buyer</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $items)
                        <tr>
                            <td>
                                {{$items->order_number}}
                            </td>
                            <td>{{date('d-m-Y',strtotime($items->created_at))}}</td>
                            <td>
                                {{$items->products_name}}
                            </td>
                            <td>
                                ${{$items->amount}} 
                            </td> 
                            <td>
                                {{$items->buy_firstName}} {{$items->buy_lastName}}
                            </td>
                            <td> 
                                <a href="{{url('/practitioner/accounts/commission_details/'.$items->order_id)}}" class="btn btn-success"  data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr> 
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            if ($('#selected-table-commission').length !== 0) {
                $('#selected-table-commission').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
                });
            }
			<?php 
if(isset($_GET['orderNo']))
{
?>
var customSearchVar = <?php echo $_GET['orderNo']; ?>;
customSearch('selected-table-commission',customSearchVar,10);
<?php } ?>
        });
    </script>
@endsection