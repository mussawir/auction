
@extends('layouts.padash')
@section('sidebar')
    @include('patient.patient-menu')
@endsection
@section('content')

<style type="text/css">
 
</style>
        <!-- begin breadcrumb 
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Message</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
       
        <div class="alert alert-danger fade in" id="errorLog" style="display: none">
        </div>
        <div class="alert alert-success fade in" id="successLog" style="display: none">
        </div>
        <!-- end page-header -->
        <!-- begin panel -->
		<div class="row">
		<div class="col-md-12 col-xs-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Recommendation</h4>
            </div>
        <div class="panel-body">
            <div class="row">
                <table class="table table-hover">
					<thead>
					  <tr>
						<th>Practitioner</th>
						<th>Recommendation</th>
						<th>Date</th>
						<th>Action</th>
						
					  </tr>
					</thead>
					<tbody>
					  @foreach($pro_sugest_master  as $items)
							<tr>
								<td>{{$items->first_name}} {{$items->last_name}}</td>
								<td><?php print $items->message; ?></td>
								<td>
<?php $date = date_create($items->created_at);
						echo date_format($date, 'm/d/Y'); ?>
						 </td>
								<td><a href="{{url('/patient/index/recommendation/'.$items->id)}}" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="View Details"><span class="fa fa-eye"></span></a></td>
							</tr>
								
					  @endforeach
					</tbody>
				  </table>
                
            </div>
        </div>
        </div>
		</div>
		</div>
@endsection
@section('page-scripts')
    <script type="text/javascript">
		App.init();
	</script>
@endsection
