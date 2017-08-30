@extends('layouts.pradash')

@section('sidebar')
@include('layouts.mark-sidebar')
@endsection

@section('content')
<?php 
$groupType = '';
if($type==1)
{
	$groupType = 'Product';
}
elseif($type==2)
{
	$groupType = 'Patient';
}
?>

<!-- begin page-header -->
<h1 class="page-header">{{$groupType}} Groups <small>Create New {{$groupType}} Group</small></h1>
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
	</div>
	{!! Form::open(array('url'=>'/practitioner/contact-group/ecommerce-store', 'class'=> 'form-horizontal','data-parsley-validate' => 'true')) !!}
    <div class="row">
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
                <h4 class="panel-title">Create New {{$groupType}} Group</h4>
            </div>
            <div class="panel-body">
				{!! Form::hidden('type',$type) !!}
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('name','Name *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('name', null, array('class'=>'form-control', 'placeholder'=> 'Name', 'data-parsley-required'=>'true')) !!}
                        </div>
                        @if ($errors->has('name'))
                            <div class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                        @endif
                    </div>
                </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('description','Description :', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                                {!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=> 'Description', 'rows'=>'3')) !!}
                            </div>
                        </div>
					</div>
                    <div class="col-md-12">
                        {!! Form::submit('Save', array('class'=>'btn btn-success pull-right')) !!}
                    </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
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
                <h4 class="panel-title">Select {{$groupType}}</h4>
            </div>
            <div class="panel-body">
					<div class="col-md-12">
					<?php if($type==1){ ?>
						<table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
							<th>Supplier</th>
							<th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
							<td>@if(isset($item->mainImage) && (!empty($item->mainImage)))
                                            <img src="{{asset($item->mainImage)}}" alt="{{$item->mainImage}}" style="width:70px;"/>
                                        @else
                                            <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->products_name}}" />
                                        @endif</td>
							<td>{{$item->products_name}}</td>
							<td>{{$item->supplier_name}}</td>
							<td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="pa_id[]" value="{{$item->products_id}}">
                                    </label>
								</div>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
						</table>
					<?php } ?>
					<?php if($type==2){ ?>
						<table id="data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Contact Name</th>
							<th>Email</th>
							<th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
							<td>@if(isset($item->photo) && (!empty($item->photo)))
                                        <a style="text-decoration: none" href="{{url('/practitioner/patient/profile/'.$item->pa_id)}}" >
                                        <img src="{{asset('public/images/practitioners/'.$practitioner_info->url .'/' .$item->photo)}}" alt="{{$item->photo}}" class="img-responsive" style="max-height: 64px;" />
                                        </a>
                                    @else
                                        <a style="text-decoration: none" href="{{url('/practitioner/patient/profile/'.$item->pa_id)}}" >
                                        <img src="{{asset('public/img/no_image_64x64.jpg')}}" alt="{{$item->photo}}" />
                                        </a>
                                    @endif
							</td>
							<td>{{$item->first_name}} {{$item->last_name}}</td>
							<td>{{$item->email}}</td>
							<td>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="pa_id[]" data-parsley-required="true" value="{{$item->pa_id}}">
                                    </label>
								</div>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
						</table>
					<?php } ?>
					</div>
            </div>
        </div>
        <!-- end panel -->
    </div>
	</div>
	
	{!! Form::close() !!}
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
    </script>
@endsection