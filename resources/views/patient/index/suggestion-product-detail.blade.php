@extends('layouts.padash')

@section('content')
    <div class="msg">
        @if(Session::has('success'))
            <div class="alert alert-success">
                <strong>{{Session::pull('success')}}</strong>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger">
                <strong>{{Session::pull('error')}}</strong>
            </div>
        @endif        
    </div> 
    <!-- begin page-header -->
    <h1 class="page-header">Recommendation Details <small></small></h1>
    <!-- end page-header -->

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title"><button onclick="window.location.href='{{url('/patient/index/recommendation')}}'" type="button" class="btn btn-success btn-sm"><span class="fa fa-arrow-left"></span> Back</button>&nbsp;&nbsp;&nbsp;<b>Details</b></h4>
                </div>
                <div class="alert alert-info fade in">
                    <strong>Message:</strong>&nbsp;
                    <p><?php print $master->message; ?></p>
                </div>
                <div class="panel-body">
                    <table id="sup-data-table" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productDetail as $item)
                            <tr>
                                <td>
                                    @if(isset($item->mainImage) && (!empty($item->mainImage)))
                                        <img src="{{url('/').'/'.$item->mainImage}}" alt="{{$item->products_name}}" class="img-responsive" style="max-height: 64px;" />
                                    @else
                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->products_name}}" />
                                    @endif
                                </td>
                                <td>{{$item->products_name}}</td>
								<td><a target="_blank" href="{{url('/patient/ecommerce/store/product/'.$master->pra_id.'/'.$item->products_id)}}" class="btn btn-info btn-xs" data-toggle="tooltip" title="" data-original-title="View Details"><span class="fa fa-eye"></span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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