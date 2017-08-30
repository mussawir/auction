@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Suppliers List</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header pull-left">Suppliers List <small></small></h1>
    <select class="pull-right" name="category" id="category" class="form-control" onchange="customSearch('data-table',this.value,10)" style="width: 142px; margin-right: 20px; height: 33px; padding: 5px; border: none; background: #008a8a; color: #fff;">
        <option value="">All Suppliers</option>
        @foreach($items as $cat)
            <option value="{{ $cat->first_name  }} {{ $cat->last_name  }}">{{ $cat->first_name}} {{ $cat->last_name }}</option>
        @endforeach
    </select>
<a href="{{url('/admin/supplier/new')}}" class="btn btn-success pull-right" style="margin-right: 15px;border-radius:0;"><i class="fa fa-plus"></i> Add New Supplier</a>
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
                <h4 class="panel-title">Suppliers List </h4>
            </div>
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>

                            <td>{{$item->first_name}} {{ $item->last_name }}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->address}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{url('/admin/supplier/edit/'.$item->supplier_id)}}" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i> </a>
                                <a class="btn btn-success" href="{{url('/admin/supplier/products/'.$item->supplier_id)}}" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> </a>
                                <a class="btn btn-danger" id="delete_{{$item->supplier_id}}" href="javascript:void(0);" onclick="doDelete('{{$item->cat_id}}', this);" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i> </a>
                                {{--<a href="{{url('/admin/supplier/'.$item->supplier_id)}}"><i class="fa fa-eye"></i> View Details</a>--}}
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