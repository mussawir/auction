
@extends('layouts.supdash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li class="active">Brand List</li>
</ol>
<a href="{{url('/supplier/product/brands/new')}}" class="btn btn-success pull-right" style="margin-right: 15px;border-radius:0;"><i class="fa fa-plus"></i> Add Brand</a>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Brand List<small></small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->

        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Brand List</h4>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="sel-table" class="table table-striped table-hover">
                            <thead>
                            <tr>       
								<th>Brand Image</th>
                                <th>Brand Name</th>
                                <th>Brand Description</th>
								<th>created_at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($table1 as $item)
                                <tr>
                                    <td>
                                        @if(isset($item->image_path) && (!empty($item->image_path)))
                                            <img src="{{asset($item->image_path)}}" alt="{{$item->image_path}}" style="width:70px;"/>
                                        @else
                                            <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->brandName}}" />
                                        @endif
                                    </td>
                                    <td>{{$item->brandName}}</td>
                                    <td>{{$item->brandDescriptiion}}</td>
									<td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{url('/supplier/brands/edit/'.$item->id)}}" class="btn btn-success" data-toggle="tooltip" title="Edit"><span class="fa fa-pencil"></span></a>
                                       
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end col 6 -->

<!-- end row -->
@endsection
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->

@endsection
@section('page-scripts')
    <script type="text/javascript">
        $('#sel-table').DataTable({
            responsive: true,
            "aaSorting": [[3, "desc"]],
            "iDisplayLength": 25,
			"columnDefs": [
            {
                "targets": [3],
                "visible": false,
            }]
        });
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip();
        });


        
    </script>
@endsection