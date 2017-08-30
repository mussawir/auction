@extends('layouts.ecommerce')
@section('content')
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/admin')}}">Dashboard</a></li>
        <li class="active">Suppliers List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Suppliers List <small></small></h1>
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
    <!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
    </script>
@endsection