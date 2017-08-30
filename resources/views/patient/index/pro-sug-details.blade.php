@extends('layouts.padash')
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/patient')}}">Dashboard</a></li>
    <li class="active">Recommended Products Details</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Recommended Products Details<small></small></h1>
<!-- end page-header -->

    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info">
                <h3>Practitioner: {{$sup_sug_master->pra_fullname}}</h3>
                <h4>Message: {{$sup_sug_master->message}}</h4>
            </div>

            <div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Details</h4>
                </div>
                <div class="panel-body">
                    <table id="dt-sup-sug" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
								<th>Product Category</th>
								<th>Supplier</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $counter=1;?>
                            @foreach($products as $item)
                                <tr>
                                    <td>
                                        @if(isset($item->mainImage) && (!empty($item->mainImage)))
                                    <img src="{{asset($item->mainImage)}}" style="width:60px;" alt="{{$item->products_name}}"/>
									@else
										<img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->products_name}}" />
									@endif
                                    </td>
                                    <td>{{$item->products_name}}</td>
                                    <td>
                                        {{$item->short_description}}
                                    </td>
									<td>
                                        {{$item->cat_name}}
                                    </td>
									<td>
                                        {{$item->first_name}} {{$item->last_name}}
                                    </td>
                                    <td>
                                        <a href="{{url("/patient/ecommerce/store/product/$item->store_id/$item->products_id")}}" class="btn btn-success">Buy Product</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('#dt-sup-sug').length !== 0) {
                $('#dt-sup-sug').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }
            App.init();
            Dashboard.init();
        });
        function showDescription(desc)
        {
            if(desc=="")
            {
                return;
            }
            showDialouge('content','Description',desc);
        }
    </script>
@endsection