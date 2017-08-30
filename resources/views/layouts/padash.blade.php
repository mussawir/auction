<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	
	
	<title>{{isset($meta['page_title'])?$meta['page_title'].' - ':''}}Practice Tabs</title>
	
	<link rel="icon" href="http://practicetab.com/dev/public/img/logoBlue.png" type="image/png" >
	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="Content-Type" content="image/svg+xml, text/html; charset=UTF-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="aliinfotech.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">

  
    <!-- Fonts -->
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">--}}

            <!-- ================== BEGIN BASE CSS STYLE ================== -->
			
			
			 <!-- ================== Select2 STYLE ================== -->

	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

	
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('public/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/style-responsive.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/theme/default.css') }}" rel="stylesheet">
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{asset('public/plugins/fullcalendar/fullcalendar.print.css')}}" rel="stylesheet" media='print' />
    <link href="{{asset('public/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('public/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet">

    <!-- ================== END PAGE LEVEL STYLE ================== -->
    <link href="{{asset('public/css/PopupBox.css')}}" rel="stylesheet" />
    <link href="{{ asset('public/css/jquery.ui.autocomplete.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/bwizard.min.css') }}" rel="stylesheet" />

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/vnd.microsoft.icon" />
	

	
		    <!-- ================== select2 JS ================== -->
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('public/plugins/fullcalendar/lib/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/plugins/pace/pace.min.js')}}"></script>
	
	 



    <!-- ================== END BASE JS ================== -->
    <style>
        .header-cart {
            color: #212121;
            padding: 14px 0px;
        }
        .header-cart .header-cart-icon {
            float: right;
            font-size: 28px;
            height: 48px;
            width: 48px;
            text-align: center;
            line-height: 48px;
            position: relative;
            margin: -18px -15px -18px 0;
        }
        .header-cart .header-cart-icon .total {
            position: absolute;
            top: 12px;
            right: 7px;
            font-size: 9px;
            background: #ff5b57;
            color: #fff;
            font-weight: bold;
            border-radius: 14px;
            line-height: 14px;
            padding-left: 4px;
            padding-right: 4px;
        }
        .header-cart .header-cart-text {
            margin-right: 35px;
            line-height: 20px;

        }
        .header-cart i {
            font-size: 23px;
            float: left;
            line-height: 1px;
            position: relative;
            top: 10px;
            left: 15px;
            margin-right: 18px;
        }
        .header-cart .total {
            font-size: 12px;
            color: #fff;
            font-weight: bold;
            background: #00acac;
            display: inline-block;
            width: 23px;
            height: 20px;
            line-height: 20px;
            text-align: center;
            border-radius: 20px;
            position: relative;
            right: 13px;
            top: -9px;
        }
        .cart-header,
        .cart-body,
        .cart-footer {
            padding: 15px;
        }
        .cart-header + .cart-body,
        .cart-body + .cart-footer {
            border-top: 1px solid #e5e5e5;
        }
        .cart-item {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        .cart-item > li {
            display: table;
            width: 100%;
        }
        .cart-item > li > div {
            display: table-cell;
            vertical-align: middle;
        }
        .cart-item > li + li {
            padding-top: 10px;
            border-top: 1px solid #e5e5e5;
            margin-top: 10px;
        }
        .cart-item > li h4 {
            font-size: 15px;
            line-height: 19px;
            margin: 3px 0;
        }
        .cart-item > li .price {
            color: #777;
            font-size: 12px;
            margin: 0;
        }
        .cart-title {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
        }
        .cart-item-image {
            float: left;
            width: 80px;
            height: 60px;
            padding: 7px;
            overflow: hidden;
            text-align: center;
            line-height: 44px;
            border: 1px solid #e5e5e5;
        }
        .cart-item-image img {
            max-width: 100%;
            max-height: 100%;
        }
        .cart-item-info {
            width: 48%;
        }
        /*.cart-item-image + .cart-item-info,*/
        /*.cart-item-info + .cart-item-close {*/
        /*padding-left: 15px;*/
        /*}*/
        .cart-item-close a {
            font-size: 18px;
            color: #999;
            height: 24px;
            width: 24px;
            text-align: center;
            line-height: 24px;
            display: block;
            text-decoration: none;
            border-radius: 24px;
            background: #f9f9f9;
            position: relative;
            right: -6px;
            top: 13px;
        }
        .cart-item-close a:hover,
        .cart-item-close a:focus {
            background: #b6c2c9;
            color: #fff;
        }
        .dropdown-menu.dropdown-menu-cart {
            left: auto;
            right: 0;
            margin-right: -142px;
            width: 360px;
        }
/*========================================
    notifaction-modal-css-section
========================================*/
.empty-space-div
{
    height: 33px;
}

.opacity-0
{
   opacity: 0 !important;   
}
.opacity-1
{
   opacity: 1 !important;
   transition: 1s !important;
   transition-delay:0.5s;
      
}
.hide
{
    display: none;
}
.notification-alert-main-div
{
    
    border-radius: 10px;
    transition: 1s;
    background-color: rgba(0,0,0,1);
    background-color: transparent;
    opacity: 1;
    position: fixed;
    z-index: 1021;
    padding: 0px;
    padding: 0px 1%;
    top: 30px;
    right: 0;
}
.notification-alert-main-div-close-btn
{
   float: right;
   background-color: transparent;
   border: none;
   display: none;  
}

.noti-text-div {
    padding: 4px 6%;
    opacity: 0;
    transition: 1s;
    margin-bottom: 8px;
}		
		
    </style>
	
	<!--////////////////////////////responsive-stle-linked//////////////////////////////////////-->

<link href="{{asset('public/css/responsive.css')}}" rel="stylesheet" />
</head>
<body>

<!--notification-modal-html-code-opne-->

<div id="notificationDiv" class="col-sm-4 notification-alert-main-div">
  <button class="notification-alert-main-div-close-btn">&times;</button>
  <div class="empty-space-div"></div>
</div>

<!--notification-modal-html-code-close-->
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="#" class="navbar-brand"><span class="navbar-logo"></span> Practice Tabs</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->

            {{--<ul class="nav navbar-nav">--}}
                    {{--<li>--}}
                        {{--<a href="{{url('patient/ecommerce')}}">--}}
                            {{--<button class="btn btn-info">--}}
                                {{--<span class="fa fa-shopping-cart" aria-hidden="true"></span>--}}
                                {{--Ecommerce--}}
                            {{--</button>--}}
                        {{--</a>--}}
                    {{--</li>--}}
            {{--</ul>--}}
            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right">
                <li style="display:none">
                    {!! Form::open(array('url'=>'/patient/ecommerce/order-tracking', 'class'=> 'navbar-form full-width', 'data-parsley-validate' => 'true')) !!}
                    {{--<form class="navbar-form full-width">--}}
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Order Tracking" name="tracking_number" required/>
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    {!! Form::close() !!}
                    {{--</form>--}}
                </li>
                <li class="dropdown">
                        <?php $cart = Session::get('cart'); ?>
                    <a href="#" class="header-cart" data-toggle="dropdown" style="padding: 14px 0px;">
                        <i class="fa fa-shopping-bag"></i>
                        <span id="cart-counter" class="total">{{ count($cart) }}</span>
                        <span class="arrow top"></span>
                    </a>

                            <div class="dropdown-menu dropdown-menu-cart p-0">
                                <div class="cart-header">
                                    <h4 class="cart-title">Shopping Bag</h4>
                                </div>
                                <div class="cart-body">
                                    <ul class="cart-item"style="overflow-y: auto;max-height: 300px;">
                                        @if(count($cart))
                                            @foreach($cart as $key=>$val)
                                                <li id="cart-item-{{$val->products_id}}">
                                                    <div class="cart-item-image">
                                                        @if(isset($val->mainImage) && (!empty($val->mainImage)))
                                                            <img src="{{asset($val->mainImage)}}" alt="{{$val->products_name}}"/>
                                                        @else
                                                            <img src="{{asset('public/img/no_image_64x64.jpg')}}" alt="{{$val->products_name}}" />
                                                        @endif
                                                    </div>
                                                    <div class="cart-item-info">
                                                        <strong><p>Product</p></strong>
                                                        <strong>{{ $val->products_name }}</strong>
                                                    </div>
                                                    <div class="cart-item-price">
                                                        <strong><p>Qty</p></strong>
                                                        <span id="cart-item-qty-{{$val->products_id}}">{{ $val->qty }}
														</span>
                                                    </div>
                                                    <div class="cart-item-close">
                                                        <a onclick="removeCart('{{$val->cart_id}}','{{$val->products_id}}');" href="#" data-title="Remove">&times;</a>
                                                    </div>
                                            @endforeach
                                        @else
                                            <h5 id="cart-empty" class="text-center"><i class="fa fa-shopping-cart" style="color:#00acac;"></i> Your cart is empty!</h5>
                                        @endif
                                    </ul>
                                </div>
                                <div class="cart-footer">
                                    <div class="row row-space-10">
                                        <div class="col-xs-6">
                                            <a href="{{url('/patient/ecommerce/checkout_cart')}}" class="btn btn-default btn-block" style="background: #00acac;">View Cart</a>
                                        </div>
                                        @if(count($cart))
                                            <div class="col-xs-6">
                                                <a href="{{url('/patient/ecommerce/checkout_info')}}"  class="btn btn-inverse btn-block" >Checkout</a>
                                            </div>
                                        @else
                                            <div class="col-xs-6">
                                                <a href="{{url('/patient/ecommerce/checkout_info')}}" class="btn btn-inverse btn-block">Checkout</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </li>
                <!--<li class="dropdown">
                    <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                        <i class="fa fa-bell-o"></i>
                        <span class="label" id="notification-count">0</span>
                    </a>
                    <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                        <li class="dropdown-header">Notifications</li>
                    <!--<li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading">Server Error Reports</h6>
                                <div class="text-muted f-s-11">3 minutes ago</div>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><img src="{{url('public/dashboard/img/user-1.jpg')}}" class="media-object" alt="" /></div>
                            <div class="media-body">
                                <h6 class="media-heading">Peter Behrouzi</h6>
                                <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                <div class="text-muted f-s-11">25 minutes ago</div>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><img src="{{url('public/dashboard/img/user-2.jpg')}}" class="media-object" alt="" /></div>
                            <div class="media-body">
                                <h6 class="media-heading">Olivia</h6>
                                <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                                <div class="text-muted f-s-11">35 minutes ago</div>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading"> New User Registered</h6>
                                <div class="text-muted f-s-11">1 hour ago</div>
                            </div>
                        </a>
                    </li>
                    <li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><i class="fa fa-envelope media-object bg-blue"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading"> New Email From John</h6>
                                <div class="text-muted f-s-11">2 hour ago</div>
                            </div>
                        </a>
                    </li>-->
                        <?php
                        /*use App\Models\Patient;
                        use Illuminate\Support\Facades\Auth;
                        use Illuminate\Support\Facades\DB;
                        use App\Models\scheduler;
                        $patient = Patient::where('user_id', '=', Auth::user()->user_id)->first();;
                        $scheduler = DB::table('scheduler')
                                ->where('pDate', '>=', date('m/d/Y'))
                                ->where('patient_id','=',$patient->first_name . ' ' . $patient->middle_name.' '.$patient->last_name)
                                ->where ('pStatus','<>','13')
                                ->get();
                        foreach ($scheduler as $schedule)
                        {
                            echo '<li class="media">';
                            echo '<a href="javascript:;">';
                            echo '<div class="media-left"><i class="fa fa-envelope media-object bg-blue"></i></div>';
                            echo '<div class="media-body">';
                            echo '<h6 class="media-heading"> Appointment Date '. $schedule->pDate  .'</h6>';
                            echo '<div class="text-muted f-s-11">'.$schedule->pDate.'</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</li>';
                        }*/
                        ?>
                        <!--<li class="dropdown-footer text-center">
                            <a href="javascript:;">View more</a>
                        </li>
                    </ul>
                </li>-->
                @if (!Auth::guest())
                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{url('public/img/user-13.jpg')}}" alt="" />
                        <span class="hidden-xs">&nbsp;{{Auth::user()->first_name . ' ' .Auth::user()->last_name}}&nbsp;</span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="arrow"></li>
                        <!--<li><a href="javascript:;">Edit Profile</a></li>
                        <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                        <li><a href="javascript:;">Calendar</a></li>
                        <li><a href="javascript:;">Setting</a></li>-->
                        <li><a href="{{url('/patient/index/change-password')}}">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}">Log Out </a></li>
                    </ul>
                </li>
                @endif
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->

    <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">

           @include('patient.patient-menu')
                    <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->

    <!-- begin #content -->
    <div id="content" class="content">
        @yield('content')
    </div>
    <!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->




</div>
<!-- end page container -->
<!-- ================== BEGIN BASE JS ================== -->
<script type="text/javascript" src="{{asset('public/plugins/jquery/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/jquery-ui/ui/minified/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!--[if lt IE 9]>
<script src="/public/dashboard/crossbrowserjs/html5shiv.js"></script>
<script src="/public/dashboard/crossbrowserjs/respond.min.js"></script>
<script src="/public/dashboard/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="{{asset('public/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/jquery-cookie/jquery.cookie.js')}}"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="{{asset('public/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/flot/jquery.flot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/flot/jquery.flot.time.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/flot/jquery.flot.resize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/flot/jquery.flot.pie.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/sparkline/jquery.sparkline.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/select2/dist/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/bwizard.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/dashboard.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/parsley/dist/parsley.js')}}"></script>
<script src="{{asset('public/js/form-wizards-validation.demo.min.js')}}"></script>
<script src="{{asset('public/js/form-wizards.demo.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/apps.js')}}"></script>


<!-- ================== END PAGE LEVEL JS ================== -->
<script src="{{asset('public/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/plugins/fullcalendar/fullcalendar.js')}}"></script>
<script src="{{asset('public/plugins/popup/jquery.bpopup.js')}}"></script>
<script src="{{asset('public//js/calendar.demo.min.js')}}"></script>
<script src="{{asset('public/plugins/datepicker/form-plugins.demo.min.js')}}"></script>

<script src="{{asset('public/plugins/Autocomplete/jquery.ui.autocomplete.min.js')}}"></script>

<style>
    #element_to_pop_up {
        background-color:#fff;
        border-radius:15px;
        color:#000;
        display:none;
        padding:20px;
        width: 40%;
        min-width: 900px;
        max-height: 90vh;
    }
    .b-close{
        cursor:pointer;
        position:absolute;
        right:10px;
        top:5px;
    }


</style>
<!-- ================== END PAGE LEVEL JS ================== -->
<script  type="text/javascript">
    
$('.panel-heading-btn').children('.btn-danger').remove();
function isReadNotification()
{
	userId = '';
	//var q = confirm("Are you sure you want to delete this contact group?");
            //if (q == true) {

                $.ajax({
                    type: "GET",
                    url: '{{ URL::to('/notification/public/read') }}',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        $('#notification-count').html('0');
						$(".media").each(function(i) {
							$(this).css('background-color', '');
					});
						//$('#notificationChild').css('background-color', '');
                    },
                    error:function (error) {
                    }
                });
                return false;
           // }
            return false;
}
function removeCart(id, productId)
        {
            //var q = confirm("Are you sure you want to delete this contact group?");
            //if (q == true)
				
				{

                $.ajax({
                    type: "DELETE",
					async: false,
                    url: '{{ URL::to('/patient/ecommerce/remove_product') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        if (result == 'success') {
                            $('.msg').html('<div class="alert alert-success"><strong>Product Removed</strong></div>').show().delay(5000).hide('slow');
							var counter = parseInt($('#cart-counter').text());
							var counter = counter-1;
							$('#cart-counter').text(counter);
							$('#cart-item-'+productId).remove();
                        } 
						if (result == 'error') {
                            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                        }
                        $(".calculations-"+id).remove();

                        if($("tr[id*='calculations']").length == 0){
                            $("#cart_table").remove();
                            $(".table-responsive").html('<div id="cart_empty"> <figure class="figure" style="width:300px;margin:auto;"> <img src="https://www.3dprintersonlinestore.com/image/catalog/pages/page-404-icon.png" alt="" class="center" style="width:200px;margin: 0 51px;" aria-readonly="true"> <figcaption class="figure-caption text-center"><h4>Your shopping cart is empty!</h4></figcaption> </figure> </div>');
                            $('#btn_submit').attr('disabled',true);
                        }
						var counter = parseInt($('#cart-counter').text());
						if(counter==0)
						{
							if($('#cart-empty').length==0)
							{
								$('.cart-item').html('<h5 id="cart-empty" class="text-center"><i class="fa fa-shopping-cart" style="color:#00acac;"></i> Your cart is empty!</h5>');
							}
							else
							{
								$('#cart-empty').html('<i class="fa fa-shopping-cart" style="color:#00acac;"></i> Your Cart is empty');
							}
						}
						//$('.header-cart').click();
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }
		function AddproductToCart(obj)
		{
			var imgSrc = $(obj).parent('div').parent('div').parent('div').children('a').children('img').attr('src');
			var proName = $(obj).parent('div').parent('div').parent('div').children('div').children('h4').children('a').text();
			var proPrice = $(obj).parent('div').parent('div').parent('div').children('div').children('.item-price').text();
			$('#imagepreview').attr('src',imgSrc);
			$('#span_aj_price').text(proPrice);
			$('#span_aj_product').text(proName);
			$('#quantity').focus();
		}
        function AddProduct()
        {
            var pro_id = $('#pro_id').val();
            var quantity = $('#quantity').val();
            var pra_id = $('#pra_id').val();
			if(quantity>0)
            {

                $.ajax({
                    type: "POST",
					async: false,
                    data: {
                        pro_id : pro_id,
                        quantity : quantity,
                        pra_id: pra_id
                    },
                    url: '{{ URL::to('/patient/ecommerce/add-cart-product') }}',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        //$(elm).closest('tr').remove();
						if($("#cart-item-qty-"+$('#pro_id').val()).length == 0) {
						var imgSrc = $('#imagepreview').attr('src');
						var qty = $('#quantity').val();
						var proName = $('#span_aj_product').text();
						var counter = parseInt($('#cart-counter').text());
						var counter = counter+1;
						$('#cart-counter').text(counter);
						$('.cart-item').append('<li id="cart-item-'+$('#pro_id').val()+'"><div class="cart-item-image"><img src="'+imgSrc+'" alt="'+proName+'"></div><div class="cart-item-info"><strong><p>Product</p></strong><strong>'+proName+'</strong></div><div class="cart-item-price-'+$('#pro_id').val()+'"><strong><p>Qty</p></strong><span id="cart-item-qty-'+$('#pro_id').val()+'">'+qty+'</span></div><div class="cart-item-close"><a onclick="removeCart('+result+','+$('#pro_id').val()+');" href="#" data-title="Remove">&times;</a></div></li>');
						$('#cart-empty').html('');
						$('.cart-item').slimScroll({
							height: $('.cart-item').css('height')
						});
						}
						else
						{
							var qtyAdd= parseInt($('#cart-item-qty-'+$('#pro_id').val()).text());
							qtyAdd = (qtyAdd+parseInt($('#quantity').val()));
							$('#cart-item-qty-'+$('#pro_id').val()).text(qtyAdd);
						}
						$('#modal-without-animation').modal('toggle');
						$('.msg').html('<div class="alert alert-success"><strong>Success! </strong>Product added to your cart.</div>').show().delay(5000).hide('slow');
                    },
                    error:function (error) {
						$('#modal-without-animation').modal('toggle');
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
			else
			{
				//$('#modal-without-animation').modal('toggle');
				$('#modal-error').html('<div class="alert alert-danger"><strong>Minimum quantity required is 1</strong></div>').show().delay(5000).hide('slow');
				$('#quantity').focus();
			}
            return false;
        }
		
/*=====================================
    notification-modal-js-section
=====================================*/
$(document).ready(function(){
        
        $('.notification-alert-main-div-close-btn').click(function(){
            
           $('#notificationDiv').addClass('opacity-0');
           
             setTimeout(function(){
                
              $('#notificationDiv').addClass('opacity-0');
                   
             }, 5000); 
             
            
        });
    });
    function hardcodenotifn(textnotifn)
    {
        return textnotifn ;
        document.getElementById("newtest").innerHTML = hardcodenotifn(textnotifn);
    }
    
    var id = 10000000000;
    function noticheckfn(heading,testtoAppend)
    {
        var noticheck = 1 
        var testingVar = id--;
        if( noticheck == 1)
        {
            $("#notificationDiv").append('<div id="'+testingVar+'" class="alert alert-info alert-dismissable noti-text-div"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+heading+'</strong><p id="demo">'+testtoAppend+'</p></div>');
            
        }
        else
        {
            $("#notificationDiv").remove('<div class="alert alert-info alert-dismissable noti-text-div"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+heading+'</strong><p>'+testtoAppend+'</p></div>');
        }
        test(testingVar); 
    }
    function test(dynamicID){
        setTimeout(function(){ $('#'+dynamicID).addClass('opacity-1'); }, 500);
        setTimeout(function(){ $('#'+dynamicID).removeClass('opacity-1'); $('#'+dynamicID).addClass('opacity-0');}, 3000);
        setTimeout(function(){ $('#'+dynamicID).addClass('hide'); }, 3500);
    }
		
</script>
	

@yield('page-scripts')
</body>
</html>