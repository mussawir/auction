@extends('layouts.pradash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li class="active">Product List</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Product List <small></small></h1>
<!-- end page-header -->

<style type="text/css">
    
    
.badge.badge-inverse, .label.label-inverse {
    background: #2d353c;
    display: inline-block;
}
</style>

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
                <h4 class="panel-title">Product List</h4>
            </div>
            <div class="panel-body">
                <table id="selected-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Supplier</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table1 as $item)
                        <tr id="products_{{ $item->products_id }}">
                        <td>
                                      @if(isset($item->mainImage) && (!empty($item->mainImage)))
                                            <img src="{{asset($item->mainImage)}}" alt="{{$item->mainImage}}" style="width:70px;"/>
                                        @else
                                            <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->products_name}}" />
                                        @endif
                                    </td>
                        <td style="width:20%">{{$item->products_name}}</td> 
                        <td style="width:42%">{{$item->short_description}}</td>
                            <td>{{$item->first_name.' ' . $item->last_name}}</td>
                            <td>
                            <a onclick="AddProduct('{{ $item->products_id }}');" href="javascript:;" class="btn btn-success sm"><span class="fa fa-plus"></span></a>
							<a href="{{url('/practitioner/product/details/'.$item->products_id)}}" class="btn btn-info sm" data-toggle="tooltip" title="View"><span class="fa fa-eye"></span></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
				{{$table1->links()}}
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
											<h4 class="modal-title">Add Product Details</h4>
										</div>
										<div class="modal-body">
										<div class="row">
										<div class="col-md-12">
										 <div class="col-md-3">
											<label class="control-label">Discount : </label>
											</div>
											<div class="col-md-5">
											<input type="text" class="form-control" id="pro_discount" value="0" />
											<input type="hidden" class="form-control" id="pro_id" value="0" />
</div>                                            </div>
											</div>
										</div>
										<div class="modal-footer">
											<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
											<a onclick="" href="javascript:;" class="btn btn-sm btn-success" >Add</a>
										</div>
									</div>
								</div>
							</div>  
<!-- end row -->
@endsection
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->

@endsection
@section('page-scripts')
    <script>
        $(document).ready(function() {
            var dtSupTable = $('#selected-table').DataTable({
                responsive: true,
                "aaSorting": [[1, "asc"]],
                "iDisplayLength": 25,
				"bPaginate": false,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}]
            });
        });
function AddProduct(id)
        {
          
            {

                $.ajax({
                    type: "POST",
                    data: {
                        pro_id : id,
                    },
                    url: '{{ URL::to('/practitioner/ecommerce/add-pra-product') }}',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        //$(elm).closest('tr').remove();
						$('#products_'+id).remove();
                        $('.msg').html('<div class="alert alert-success"><strong>Success! </strong>Product added to your store Successfully.</div>').show().delay(5000).hide('slow');
                        
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