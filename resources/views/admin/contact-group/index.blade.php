@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Contact Management</li>
</ol>
<a href="{{url('/admin/contact-group/new')}}" class="btn btn-success pull-right" style="margin-right: 15px;border-radius:0;"><i class="fa fa-plus"></i> Add Contact Group</a>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Contact Groups <small></small></h1>
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
                <h4 class="panel-title">Contact Group List</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cg_list as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>
                                <a data-toggle="tooltip" title="Edit" class="btn btn-success" href="{{url('/admin/contact-group/edit/'.$item->ag_id)}}"><i class="fa fa-pencil"></i></a> 
                                <a data-toggle="tooltip" title="Delete" class="btn btn-danger" href="javascript:void(0);" onclick="doDelete('{{$item->ag_id}}', this);"><i class="fa fa-trash-o"></i></a>
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
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }
        });

        function doDelete(id, elm)
        {
            var q = confirm("Are you sure you want to delete this contact group?");
            if (q == true) {

                $.ajax({
                    type: "DELETE",
                    url: '{{ URL::to('/admin/contact-group/destroy') }}/' + id,
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