@extends('layouts.padash')
@section('content')

	<a class="btn btn-success pull-right" href="{{url('/patient/ecommerce/stores-list')}}" style="margin: 3px 12px;">Add New Stores</a>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Ecommerce <!---<small>Subscribed Stores</small>---></h1>
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
            <style>
                .search-item-container .item-row .item {
                    float: left;
                    width: 33.33%;
                    border: none;
                    -webkit-border-radius: 0;
                    -moz-border-radius: 0;
                    border-radius: 0;
                }
                .search-item-container .item-row .item:first-child {
                    -webkit-border-radius: 3px 0 0 0;
                    -moz-border-radius: 3px 0 0 0;
                    border-radius: 3px 0 0 0;
                }
                .search-item-container .item-row .item:last-child {
                    -webkit-border-radius: 0 3px 0 0;
                    -moz-border-radius: 0 3px 0 0;
                    border-radius: 0 3px 0 0;
                }
                .search-item-container .item-row:last-child .item:first-child {
                    -webkit-border-radius: 0 0 0 3px;
                    -moz-border-radius: 0 0 0 3px;
                    border-radius: 0 0 0 3px;
                }
                .search-item-container .item-row:last-child .item:last-child {
                    -webkit-border-radius: 0 0 3px 0;
                    -moz-border-radius: 0 0 3px 0;
                    border-radius: 0 0 3px 0;
                }
                .search-item-container .item-row + .item-row {
                    border-top: 1px solid #ccd0d4;
                }
                .search-item-container .item-row .item + .item {
                    border-left: 1px solid #ccd0d4;
                }
                .item {
                    background: #fff;
                }
                .item.item-thumbnail {
                    -webkit-border-radius: 3px;
                    -moz-border-radius: 3px;
                    border-radius: 3px;
                    border: 1px solid #c5ced4;
                    transition:all 0.5s linear;
                }
                .item.item-thumbnail a,
                .item.item-thumbnail a:hover,
                .item.item-thumbnail a:focus {
                    text-decoration: none;
                }
                .item.item-thumbnail .item-image {
                    height: 130px;
                    text-align: center;
                    padding: 15px;
                    line-height: 100px;
                    display: block;
                    position: relative;
                }
                .item.item-thumbnail .item-image .discount {
                    position: absolute;
                    bottom: 0;
                    right: 15px;
                    line-height: 20px;
                    padding: 2px 10px;
                    color: #fff;
                    background: #2d353c;
                    font-weight: 600;
                    font-size: 13px;
                }
                .item.item-thumbnail .item-image img {
                    max-width: 100%;
                    max-height: 100%;
                }
                .item.item-thumbnail .item-info {
                    padding: 15px;
                    text-align: center;
                }
                .item.item-thumbnail .item-title {
                    margin: 0 0 3px;
                }
                .item.item-thumbnail .item-title,
                .item.item-thumbnail .item-title a {
                    font-weight: 600;
                    color: #212121;
                    font-size: 14px;
                    line-height: 18px;
                    max-height: 36px;
                    overflow: hidden;
                }
                .item.item-thumbnail .item-title a:hover,
                .item.item-thumbnail .item-title a:focus {
                    color: #009688;
                }
                .item.item-thumbnail .item-desc {
                    margin: 0;
                    font-size: 12px;
                    color: #707478;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }
                .item.item-thumbnail .item-discount-price {
                    font-size: 12px;
                    color: #999;
                    text-decoration: line-through;
                }
                .item.item-thumbnail .buttons {
                    margin-top:5px;
                    transition: all 0.4s linear;
                    transform:scale(0);
                }
                .item.item-thumbnail:hover .buttons{
                    transition: all 0.4s linear;
                    transform:scale(1);
                }
                .item.item-thumbnail .item-price {
                    margin: 3px 0;
                    font-size: 16px;
                    color: #009688;
                    font-weight: 600;
                }
                .page-header-container {
                    margin:20px 0;
                    position: relative;
                    padding:20px 0;
                }
                .page-header-cover {
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    overflow: hidden;
                }
                .page-header-cover:before {
                    content: '';
                    display: block;
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(36, 42, 48, 0.8);
                }
                .page-header-cover img {
                    max-width: 100%;
                }
                .page-header-container .container {
                    position: relative;
                }
                .page-header-container .page-header {
                    border: none;
                    color: #fff;
                    margin: 0;
                    font-size: 28px;
                    padding: 0;
                    text-align: center;
                }
                .content{
                    overflow:hidden;
                }
            </style>
            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Subscribed Stores</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($stores as $item)
                            <div class="col-md-12" style="margin-bottom: 10px;">
                                <div class="item item-thumbnail">
                                    <div class="row">
                                        <div class="item-info">
                                            <div class="col-md-3" style="margin-bottom:10px;">
                                                <a href="{{url('/practitioner/'.$item->url)}}" class="item-image">
                                                    @if(isset($item->photo) && (!empty($item->photo)))
                                                        <img src='{{asset("public/practitioners/$item->directory/$item->photo")}}' alt="{{$item->first_name}}"  style="max-height: 110px;" />
                                                    @else
                                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->first_name}}" />
                                                    @endif
                                                </a>
                                                <h5 class="text-center"><strong>Practitioner: </strong>{{ $item->first_name }} {{ $item->last_name }}</h5>
                                                <h5 class="text-center"><strong>Store Name: </strong>{{ $item->value }}</h5>
                                                <a href="{{url('/patient/ecommerce/store/products/'.$item->pra_id)}}" class="btn btn-success btn-block" style="background-color: #00ACAC;    width: 172px;
    margin: auto;">Go to Store</a>
                                            </div>
                                            <div class="col-md-9">
                                                <a href="{{url('/patient/ecommerce/store/products/'.$item->pra_id)}}">
                                                    @if(isset($item->settings_image) && (!empty($item->settings_image)))
                                                        <img src='{{asset("public/practitioners/store/$item->settings_image")}}' alt="{{$item->first_name}}"  style="width:100%;" />
                                                    @else
                                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$item->first_name}}" />
                                                    @endif
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- end panel -->
        </div>
        <!-- end col 6 -->
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(array('url'=>'/patient/ecommerce/addItem', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}
                    <input type="hidden" class="form-control" id="id" name="id" >
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Request:</label>
                        <div class="col-sm-10">
                            {!! Form::text('request_msg', null, array('class'=>'form-control', 'placeholder'=> 'Enter your request', 'data-parsley-required'=>'true')) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit('Subscribe', array('class'=>'btn btn-success pull-right')) !!}
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                    </form>
                    <div class="deleteContent">
                        Are you Sure you want to delete <span class="title"></span> ?
                        <span class="hidden id"></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{ $stores->links() }}
    <!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
        $(function () {
            if ($('#dt-email-group').length !== 0) {
                $('#dt-email-group').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }
        });
        $(document).on('click', '.edit-modal', function() {
            $('#footer_action_button').text(" Subscribe");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('Edit');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('#id').val($(this).data('id'));
            $('#myModal').modal('show');
        });
    </script>
@endsection