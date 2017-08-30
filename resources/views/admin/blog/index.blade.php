@extends('layouts.adash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Dashboard Posts List</li>
</ol>
<a href="{{url('/admin/adminBlog/new')}}" class="btn btn-success pull-right" style="margin-right: 15px;border-radius:0;"><i class="fa fa-plus"></i> Add Dashboard Post</a>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Dashboard Posts<small> Dashboard Posts List</small></h1>
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
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Contact Dashboard Post List</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
					<th>Post Date</th>
                        <th>Title</th>
						<th>Link</th>
						<th>For</th>
						<th></th>
                    </tr>
                    </thead>
                    <tbody>
					<?php if($adminBlog){ ?>
                    @foreach($adminBlog as $item)
                        <tr>
						<td>
						<!-- (MM/DD/YYYY) -->
						<?php 
						$date = date_create($item->created_at);
						echo date_format($date, 'm/d/Y');
						?></td>
                        <td>{{$item->blog_title}}</td>
						<td><a href="{{$item->post_link}}" target="_blank">{{$item->post_link}}</a></td>
						<td><?php echo $item->type=='1'?'Patients' : 'Practitioners'; ?></td>
                            <td>
                                <a style="margin-bottom: 2px"; data-toggle="tooltip" title="Edit" class="btn btn-success" href="{{url('/admin/adminBlog/edit/'.$item->id)}}"><i class="fa fa-pencil"></i></a>
                                <a data-toggle="tooltip" title="Delete" class="btn btn-danger" href="javascript:void(0);" onclick="doDelete('{{$item->id}}', this);"><i class="fa fa-trash-o"></i></a>
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
<!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
                });
            }
        });

        function doDelete(id, elm)
        {
            var q = confirm("Are you sure you want to delete this post?");
            if (q == true) {

                $.ajax({
                    type: "DELETE",
                    url: '{{ URL::to('/admin/adminBlog/destroy') }}/' + id,
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