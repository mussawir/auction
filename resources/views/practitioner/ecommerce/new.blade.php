@extends('layouts.pradash')
@section('head')
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<!-- ================== END PAGE LEVEL STYLE ================== -->
@endsection
@section('content')

<!-- begin page-header -->
<h1 class="page-header">Request List <small></small></h1>
<!-- end page-header -->

<style type="text/css">
    
    img {
    width: 100%;
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
                <h4 class="panel-title">Request List</h4>
            </div>
            <div class="panel-body">
                <table id="selected-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>P. Name</th>
                        <th>Request Message</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table1 as $item)
                        <tr>
                            <td>{{$item->first_name.' ' . $item->last_name}}</td>
                            <td>{{$item->request_msg}}</td>
                            <td>
                            <a class="btn btn-success btn-icon btn-circle" onclick="approve({{$item->pa_id}},this)"><i class="fa fa-check"></i></a>
                                <a class="btn btn-danger btn-icon btn-circle" onclick="reject({{$item->pa_id}},this)"><i class="fa fa-times"></i></a>
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
@section('bottom')
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->

@endsection
@section('page-scripts')
    <script>
        $(document).ready(function() {
            
        });
function approve(id, elm)
        {
          //  var q = confirm("Are you sure you want to delete this manufacturer?");
           // if (q == true) 
            {

                $.ajax({
                    type: "GET",
                    url: '{{ URL::to('/practitioner/ecommerce/approve') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        
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
function reject(id, elm)
        {
          //  var q = confirm("Are you sure you want to delete this manufacturer?");
           // if (q == true) 
            {

                $.ajax({
                    type: "GET",
                    url: '{{ URL::to('/practitioner/ecommerce/reject') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        
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