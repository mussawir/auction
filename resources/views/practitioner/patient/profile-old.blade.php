@extends('layouts.pradash')
@section('sidebar')
    @include('layouts.manage-sidebar')
@endsection
@section('content')
    <style type="text/css">
        .divColor{
            background-color: #fff;
            border: 1px solid #d9d9d9;
        }
        .patientImage{
            width: 80px;
            height: 100px;
            margin-top: 10px;
            float: left;
        }
        .patientDetail {
            text-align: left;
            float: left;
            margin-top: 25px;
        }
        .patientDetail a {
            font-size: 26px;
            color: black;
            text-transform: capitalize;
            text-decoration: none;
        }
        #payments-title {
            padding: 0px 0px 0px 15px;
        }
        #change_img {
            display: block;
            margin-top: 10px;
            font-size: 11px;
            font-weight: 600;
        }
        .mess-btn {
            margin-top: 67px;
            text-align: right;
        }
        .mess-btn a {
            font-size: 13px;
            padding-right: 10px;
            text-decoration: none;
            text-transform: capitalize;
        }
        .btn-link{
            text-decoration: none;
        }
        #card-info {
            background: #fff;
            padding: 20px 0 0 0;

            height:140px;
        }
        .rw-card {
            line-height: 33px;
            text-align: center;
            padding: 0 5px;
            margin-top: 35px;
        }
        #content-patient-info {
            margin-top : 10px;
        }
        #profile-p .row {
            border-bottom: 1px solid #d9d9d9;
            padding-left:7px;
        }
        #profile-p {
            padding: 20px 10px;
            background: white;
            padding-bottom: 15px;
            border: 1px solid #d9d9d9;
            padding-bottom: 0px;
        }
        #payment-p {
            padding: 20px 10px;
            background: white;
            padding-bottom: 15px;
            border: 1px solid #d9d9d9;
            padding-bottom: 0px;
            margin-top: 10px;
        }
        #profile-p > div > div.col-md-12 {
            padding-bottom: 20px;
            padding-left: 5px;
        }
        #profile-p a:hover {
            text-decoration: none;
        }
        a#email-p {
            text-transform: lowercase !important;
            padding: 5px 0;
            margin: 0;
            font-size: 13px;
            font-weight: 600;
            float: left;
            text-align: left;
            line-height: 1.5;
            width: 100%;
            color: #0096BD;
            word-wrap: break-word;
        }
        .taburi {
            margin-bottom: 10px;
            background: white;
            border: 1px solid #d9d9d9;
        }
        #rand-icon {
            padding: 20px 0;
        }
        .container-tab {
            padding: 0 10px 20px 10px;
        }
        #rand-icon .col-md-4 {
            padding: 0 10px;
        }
        #rand-icon .col-md-4 {
            border-right: 1px solid #d9d9d9;
        }
        .taburi #rand-icon span {
            font-size: 1em !important;
        }
        .taburi #rand-icon span {
            margin: 0;
            padding: 0;
            text-align: center;
            font-family: montserratlight;
            color: #0096BD;
            font-size: 1.3em;
            font-weight: 700;
            width: 100%;
            /*display: inline-block;*/
            line-height: 1.2;
        }
        .taburi p, .taburi span {
            margin: 0;
            padding: 0;
            text-align: center;
            font-family: montserratlight;
            color: #0096BD;
            font-size: 1.3em;
            font-weight: 700;
            word-wrap: break-word;
        }
        .fa-4x {
            font-size: 7em;
        }
        .taburi i {
            padding: 0 0 5px 0;
        }
        #btn-paymetns {
            margin: 0px;
            padding-top: 15px;
            padding-left: 25px;
            padding-bottom: 7px;
        }
        .runtimemenu {
            position: absolute;
            z-index: 1000;
            /* left: 5px; */
            background: white;
            font-size: 13px;
            top: 30px;
            width: 80px;
        }
        .runtimesubmenu {
            border-bottom: 1px solid #d9d9d9;
            padding-top: 10px;
            padding-left: 10px;
        }
        .runtimesubmenu:hover{
            background: #efefef;
            cursor: pointer;
        }
    </style>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
        <li class="active">Contact</li>
    </ol>

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
        @foreach($table1 as $items)
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8 divColor">
                    <div class="col-md-12 col-lg-6">
                        <div style="height: 140px;">
                        <div class="patientImage">
                    @if(isset($items->photo) && (!empty($items->photo)))
                        <img src="{{asset('public/practitioners/'.$directory.'/'.$items->photo)}}" alt="{{$items->photo}}" class="img-responsive" style="max-height: 90px;" />
                    @else
                        <img src="{{asset('public/img/no_image_64x64.jpg')}}" alt="{{$items->photo}}" />
                    @endif
                        <a id="change_img" href="">Change image</a>
                        </div>
                        <div class="patientDetail">
                            <a href="" class="patientName">{{$items->first_name}} {{$items->last_name}}</a>

                        </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 pull-right-lg" style="text-transform: capitalize;">
                        <div>
                            <div class="mess-btn">
                                <a style="text-decoration:none" class="btn-link"  href="javascript:void(0);" >
                                    <i class="fa fa-print"></i>
                                    Print
                                </a>
                                <a style="text-decoration:none" class="btn-link" href="javascript:void(0);" >
                                    <i class="fa fa-envelope-o"></i>
                                    Email
                                </a>
                                <a style="text-decoration:none" class="btn-link" href="{{URL::to('practitioner/send-message')}}" >
                                    <i class="fa fa-inbox"></i>
                                    Message
                                </a>

                                <a style="text-decoration:none" class="btn-link" href="javascript:void(0);" >
                                    <i class="fa fa-comment"></i>
                                    SMS
                                </a>
                                <a style="text-decoration:none" class="btn-link" href="{{URL::to('/practitioner/patient/edit/'.$items->pa_id)}}" >
                                    <i class="fa fa-pencil-square-o"></i>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 divColor">
                    <div class="col-md-12" id="card-info">
                        <div class="row ">
                            <div class="col-xs-6 col-sm-6 col-md-6 header-btn">
                                <div class="pull-left">
                                    <i class="fa fa-credit-card fa-2x"></i>
                                    <span>Billing Info</span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="pull-right edit-btn">
                                    <i class="fa fa-pencil-square-o fa-2x"></i>
                                    <a class="btn-link" href="">Edit</a>
                                </div>
                            </div>
                        </div>

                        <div class="row row-block row-flex text-left-lg text-center-md " id="details-card">
                            <div class="col-md-12 rw-card">
                                <span>Currently no card on file.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row " id="content-patient-info">
                <div class="col-md-4 no-padding">
                    <div id="profile-p" class="divColor">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <i class="fa fa-user fa-2x"></i>
                                    <span class="info-patient">Contact Profile</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-5 text-left-lg padding-table-row">
                                    <p>Name</p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-7 text-left-lg padding-table-row">
                                    <p>{{$items->first_name}} {{$items->last_name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-5 text-left-lg padding-table-row">
                                    <p>DOB</p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-7 text-left-lg padding-table-row">
                                    <p>{{$items->date_of_birth}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-5 text-left-lg padding-table-row">
                                    <p>Phone</p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-7 text-left-lg padding-table-row">
                                    <p>{{$items->primary_phone}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-5 text-left-lg padding-table-row">
                                    <p>Email</p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-7 text-left-lg padding-table-row">
                                    <a href="mailto:{{$items->email}}" id="email-p">{{$items->email}}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-5 text-left-lg padding-table-row">
                                    <p>City, State Zip</p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-7 text-left-lg padding-table-row">
                                    <p>{{$items->billing_city}} , {{$items->billing_state}} {{$items->billing_zip}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-5 text-left-lg padding-table-row">
                                    <p>Insurance Name</p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-7 text-left-lg padding-table-row">
                                    <p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-5 text-left-lg padding-table-row">
                                    <p>ID/Claim #</p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-7 text-left-lg padding-table-row">
                                    <p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-5 text-left-lg padding-table-row">
                                    <p>Group</p>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-7 text-left-lg padding-table-row">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="payment-p" class="divColor">
                        <div class="row" id="payments-title">

                            <div class="pull-left">
                                <i class="fa fa-credit-card fa-2x"></i>
                                <span class="info-patient">Payments</span>
                            </div>
                    </div>
                            <div class="row" id="btn-paymetns">
                                <button type="button" class="btn btn-primary btn-save">Make Payment</button>
                                <button type="button" class="btn btn-primary btn-save">Setup Recurring</button>
                            </div>
<div class="row" style="margin-top: 10px" >
    <div class="col-md-12 ">
    <div class=" col-md-6 pull-left"><span>Payment History</span></div>
    <div class="col-md-6 pull-right">
        <div class="pull-right edit-btn">
            <i class="fa fa-eye fa-1x"></i>
            <a href="javascript:void(0);">View all</a>
        </div>
    </div>
        </div>
</div>
                        <div class="row" style="margin-top: 10px;">
                            <table id="data-table" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Payment Method</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                </table>

                        </div>
                        </div>
                </div>
                <div class="col-md-8 taburi">
                    <div class="col-md-12">
                        <div class="row" id="rand-icon">

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2" id="2">
                                <a onclick="showmenu(this);">
                                    <i class="fa fa-cloud-upload fa-1x"></i>
                                    <span>Upload</span>
                                </a>
                                <div  class="runtimemenu" style="display: none;">
                                    <div class="runtimesubmenu" onclick="location.href='{{URL::to('/practitioner/patient/files/'.$items->pa_id)}}'">
                                        New
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2" id="3">
                                <a onclick="showmenu(this);">
                                    <i class="fa fa-heartbeat fa-1x"></i>
                                    <span>Supplements</span>
                                </a>
                                <div  class="runtimemenu" style="display: none;">
                                    <div class="runtimesubmenu" onclick="location.href='{{URL::to('/practitioner/supplement-prescription/add-master/'.$items->pa_id)}}}'">
                                        Prescribe
                                    </div>
                                    <div class="runtimesubmenu" onclick="location.href='{{URL::to('/practitioner/suggestion/supplement-suggestions?pa_id').$items->pa_id}}'">
                                        Suggest
                                    </div>
                                    <div class="runtimesubmenu">
                                        History
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2" id="4">
                                <a onclick="showmenu(this);">
                                    <i class="fa fa-heart fa-1x"></i>
                                    <span>Exercises</span>
                                </a>
                                <div  class="runtimemenu" style="display: none;">
                                    <div class="runtimesubmenu" onclick="location.href='{{URL::to('/practitioner/exercise-prescription/add-master/'.$items->pa_id)}}'">
                                        Prescribe
                                    </div>
                                    <div class="runtimesubmenu">
                                        History
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2" id="7">
                                <a onclick="showmenu(this);">
                                    <i class="fa fa-fire fa-1x"></i>
                                    <span>Neutrition</span>
                                </a>
                                <div  class="runtimemenu" style="display: none;">
                                    <div class="runtimesubmenu" onclick="location.href='{{URL::to('/practitioner/nutrition-prescription/add-master/'.$items->pa_id)}}'">
                                        Prescribe
                                    </div>
                                    <div class="runtimesubmenu" onclick="location.href='{{URL::to('/practitioner/suggestion/nutrition-suggestions?pa_id').$items->pa_id}}'">
                                        Suggest
                                    </div>
                                    <div class="runtimesubmenu">
                                        History
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2" id="5">
                                <a onclick="showmenu(this);">
                                    <i class="fa fa-calendar fa-1x"></i>
                                    <span>Calendar</span>
                                </a>
                                <div  class="runtimemenu" style="display: none;">
                                    <div class="runtimesubmenu" onclick="location.href='{{URL::to('/practitioner/management')}}'">
                                        New
                                    </div>
                                    <div class="runtimesubmenu">
                                        History
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2" id="6">
                                <a onclick="showmenu(this);">
                                    <i class="fa fa-list-ul fa-1x"></i>
                                    <span>Message</span>
                                </a>
                                <div  class="runtimemenu" style="display: none;">
                                    <div class="runtimesubmenu" onclick="location.href='{{URL::to('/practitioner/send-message')}}'">
                                        New
                                    </div>
                                    <div class="runtimesubmenu" onclick="location.href='{{URL::to('/practitioner/message-history?chat='.$items->pa_id)}}'">
                                        History
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-2" id="1">
                                <a onclick="showmenu(this);">
                                    <i class="fa fa-line-chart fa-1x"></i>
                                    <sspan>Analytic</sspan>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 taburi">
                    <div class="col-md-12 container-tab">
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-xs-6 col-sm-6 col-md-6 header-btn">
                                <div class="pull-left">
                                    <i class="fa fa-list-ul fa-1x"></i>
                                    <span>  Notes   </span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 header-btn">
                                <div class="pull-right">
                                    <i class="fa fa-plus fa-1x"></i>
                                    <a href="#modal-dialog" style="text-decoration: none"  data-toggle="modal">Add new Note</a>
                                    |
                                    <i class="fa fa-eye fa-1x"></i>
                                    <a style="text-decoration: none" href="javascript:void(0);">View all</a>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            @if(isset($notes->note_text) && (!empty($notes->note_text)))
                            {{$notes->note_text}}
                            @endif
                            </div>
                    </div>
                </div>

                <div class="col-md-8 taburi">
                    <div class="col-md-12 container-tab">
                        <div class="row" style="margin-top: 20px;">
                        <div class="col-xs-6 col-sm-6 col-md-6 header-btn">
                            <div class="pull-left">
                                <i class="fa fa-inbox fa-1x"></i>
                                <span>  Inbox   </span>
                            </div>
                        </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 header-btn">
                                <div class="pull-right">
                                    <i class="fa fa-plus fa-1x"></i>
                                    <a style="text-decoration: none" href="javascript:void(0);">compose new message</a>
                                    |
                                    <i class="fa fa-eye fa-1x"></i>
                                    <a style="text-decoration: none" href="{{url('/practitioner/message-history?chat='.$items->pa_id)}}">View all</a>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">

                            @if(isset($message_history->message) && (!empty($message_history->message)))
                                {{$message_history->message}}
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-8 taburi pull-right">
                    <div class="col-md-12 container-tab">
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-xs-6 col-sm-6 col-md-6 header-btn">
                                <div class="pull-left">
                                    <i class="fa fa-inbox fa-1x"></i>
                                    <span>   Recommended Supplements   </span>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 header-btn">
                                <div class="pull-right">
                                    <i class="fa fa-plus fa-1x"></i>
                                    <a style="text-decoration: none" href="javascript:void(0);">New recomemndation</a>
                                    |
                                    <i class="fa fa-eye fa-1x"></i>
                                    <a style="text-decoration: none" href="javascript:void(0);">View all</a>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-4" style="   border-right: 1px solid #d9d9d9;">TEST</div>
                            <div class="col-md-8">TEST</div>
                        </div>
                    </div>
                </div>


            </div>
        @endforeach

        <!-- end col 6 -->
    </div>
    @foreach($table1 as $items)
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Note</h4>
                </div>{!! Form::open(array('url'=>'/practitioner/notes/store', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}
                <div class="modal-body">
                    <label>Notes : </label>
                    <input type="hidden" name="pa_id" value="{{$items->pa_id}}" />
                    {!! Form::textarea('mail_body', null, array('class'=>'ckeditor','id'=>'mail_body', 'rows'=>'20')) !!}
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    {!! Form::submit('Save', array('class'=>'btn btn-sm btn-success')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endforeach
    <!-- end row -->
@endsection
<script type="text/javascript" src="{{asset('public/dashboard/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{asset('public/dashboard/js/form-wysiwyg.demo.min.j')}}s"></script>
@section('page-scripts')
    <script type="text/javascript">

        function showmenu(obj)
        {
            $('.runtimemenu').each(function( index ) {
                var menuIds = $(this).parent().attr('id');
                var curId = $(obj).parent().attr('id');
                if(curId==menuIds) return; else{
                $(this).hide();}
                });
            $(obj).parent().children('.runtimemenu').slideToggle("fast");
            //$('.runtimemenu').slideToggle("fast");
        }
        $(document).ready(function() {
            FormWysihtml5.init();
            var roxyFileman = '{{asset('public/dashboard/plugins/fileman/index.html')}}';
            CKEDITOR.replace('mail_body',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                        removeDialogTabs: 'link:upload;image:upload',
                        enterMode	: Number(2)
                    })
        });
    </script>
@endsection