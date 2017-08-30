@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Suppliers Products</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">{{ $supplier->first_name }} {{ $supplier->last_name }}'s Products <small></small></h1>
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
                <h4 class="panel-title">Suppliers Products</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Cost</th>
                        <th>Product MAP</th>
                        <th>Supplier Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                @if(isset($item->image_path) && (!empty($item->image_path)))
                                    <img src="{{asset($item->image_path)}}" alt="{{$item->products_name}}" class="img-responsive" style="max-height: 64px;" />
                                @else
                                    <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->products_name}}" />
                                @endif
                            </td>
                            <td>{{$item->products_name}} </td>
                            <td>${{$item->price}}</td>
                            <td>${{$item->map}}</td>
                            <td>{{ $supplier->first_name }} {{ $supplier->last_name }}</td>
                            <td>
                                {{--<a href="{{url('/admin/supplier/edit/'.$item->supplier_id)}}"><i class="fa fa-pencil"></i> Edit</a> |--}}
                                {{--<a id="delete_{{$item->supplier_id}}" href="javascript:void(0);" onclick="doDelete('{{$item->cat_id}}', this);"><i class="fa fa-trash-o"></i> Delete</a>--}}
                                <a href="{{url('/admin/supplier/product/details/'.$item->products_id)}}" class="btn btn-success" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                <a id="set_profit" onclick="$('#pra_profit').val('10');$('#pro_id').val({{$item->products_id}})" data-toggle="modal"  href="#modal-without-animation" class="btn btn-primary" data-toggle="tooltip" title="Set Profit"><i class="fa fa-money"></i></a>
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
<div class="modal in" id="modal-without-animation" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Set Practitioner Profit</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2" style="margin-top:8px">
                            <label class="control-label">Profit % : </label>
                        </div>
                        <div class="col-md-5">
                            <input type="number" step="any" class="form-control" id="pra_profit" value="0" placeholder="%"/>
                            <input type="hidden" class="form-control" id="pro_id" value="0" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                <a onclick="SetProfit();" href="javascript:;" class="btn btn-sm btn-success" >Set Profit</a>
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
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
                });
            }
        });

        function SetProfit()
        {
            var pro_id = $('#pro_id').val();
            var profitz = $('#pra_profit').val();
            {

                $.ajax({
                    type: "POST",
                    data: {
                        pro_id : pro_id,
                        profitz : profitz
                    },
                    async:false,
                    url: '{{ URL::to('/admin/supplier/add-pra-profit') }}',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        //$(elm).closest('tr').remove();
                        $('.msg').html('<div class="alert alert-success"><strong>Success! </strong>Profit has been set successfully.</div>').show().delay(5000).hide('slow');
                        $('#modal-without-animation').modal('toggle');
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }
        function doDelete(id, elm)
        {
            //var q = confirm("Are you sure you want to delete this manufacturer?");
            // if (q == true)
            {

                $.ajax({
                    type: "DELETE",
                    url: '{{ URL::to('/admin/supplier/destroy') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        /*if (result.status == 'success') {
                         $(elm).closest('tr').fadeOut();
                         $('.msg').html('<div class="alert alert-success"><strong>Manufacturer deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                         } else {
                         $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                         }*/
                        location.reload(true);
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }
    </script>
@endsection