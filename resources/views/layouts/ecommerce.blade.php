<!DOCTYPE html>
<html lang="en">
<head>
    {{--<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="Content-Type" content="image/svg+xml, text/html; charset=UTF-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="aliinfotech.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Practice Tabs</title>
    <!-- Fonts -->
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">--}}

            <!-- ================== BEGIN BASE CSS STYLE ================== -->
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

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/vnd.microsoft.icon" />

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('public/plugins/fullcalendar/lib/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('public/plugins/pace/pace.min.js')}}"></script>
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
    </style>
    <!-- ================== END BASE JS ================== -->
</head>
<body>
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
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{url('patient')}}">
                        <button class="btn btn-info">
                            <span class="fa fa-tachometer" aria-hidden="true"></span>
                            Dashboard
                        </button>
                    </a>
                </li>
            </ul>
            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right">
                {{--<li>--}}
                    {{--<a href="{{url('/patient/ecommerce/checkout_cart')}}" class="header-cart" data-toggle="dropdown">--}}
                        {{--<i class="fa fa-shopping-bag"></i>--}}
                        {{--<span class="total">--}}
                            {{--2--}}
                        {{--</span>--}}
                        {{--<span class="arrow top"></span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li >
                    <?php $cart = Session::get('cart'); ?>
                    <a href="#" class="header-cart" data-toggle="dropdown" style="padding: 14px 0px;">
                        <i class="fa fa-shopping-bag"></i>
                        <span class="total">{{ count($cart) }}</span>
                        <span class="arrow top"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-cart p-0">
                        <div class="cart-header">
                            <h4 class="cart-title">Shopping Bag ({{ count($cart) }}) </h4>
                        </div>
                        <div class="cart-body">
                            <ul class="cart-item">
                                @if(count($cart))
                                    @foreach($cart as $key=>$val)
                                        <li>
                                                <div class="cart-item-image">
                                                    @if(isset($val->image_path) && (!empty($val->image_path)))
                                                        <img src="{{asset($val->image_path)}}" alt="{{$val->products_name}}"/>
                                                    @else
                                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$val->products_name}}" />
                                                    @endif
                                                </div>
                                                <div class="cart-item-info">
                                                    <strong><p>Product</p></strong>
                                                    <strong>{{ $val->products_name }}</strong>
                                                </div>
                                                <div class="cart-item-price">
                                                    <strong><p>Qty</p></strong>
                                                    {{ $val->qty }}
                                                </div>
                                            <div class="cart-item-close">
                                                <a href="#" data-toggle="tooltip" data-title="Remove">&times;</a>
                                            </div>
                                        </li>
                                    @endforeach
                                        @else
                                            <h5 class="text-center"><i class="fa fa-shopping-cart" style="color:#00acac;"></i> Your cart is empty!</h5>
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
                                        <a href="{{url('/patient/ecommerce/checkout_info')}}" class="btn btn-inverse btn-block" style="pointer-events: none;
   cursor: no-drop;">Checkout</a>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                        <i class="fa fa-bell-o"></i>
                        <span class="label">0</span>
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
                        use App\Models\Patient;
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
                        }
                        ?>
                        <li class="dropdown-footer text-center">
                            <a href="javascript:;">View more</a>
                        </li>
                    </ul>
                </li>
                @if (!Auth::guest())
                    <li class="dropdown navbar-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{url('public/img/user-13.jpg')}}" alt="" />
                            <span class="hidden-xs">&nbsp;{{Auth::user()->first_name . ' ' .Auth::user()->last_name}}&nbsp;</span> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu animated fadeInLeft">
                            <li class="arrow"></li>
                            <li><a href="javascript:;">Edit Profile</a></li>
                            <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                            <li><a href="javascript:;">Calendar</a></li>
                            <li><a href="javascript:;">Setting</a></li>
                            <li><a href="{{url('/patient/index/change-password')}}">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ url('/logout') }}">Log Out</a></li>
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

            @include('patient.ecommerce-menu')
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
<!---<script type="text/javascript" src="{{asset('public/dashboard/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>--->
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
<script type="text/javascript" src="{{asset('public/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/dashboard.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/parsley/dist/parsley.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/apps.js')}}"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<script src="{{asset('public/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/plugins/fullcalendar/fullcalendar.js')}}"></script>
<script src="{{asset('public/plugins/popup/jquery.bpopup.js')}}"></script>
<script src="{{asset('public/js/calendar.demo.min.js')}}"></script>
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
<script>
    ;(function($) {
        // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('#my-button').bind('click', function(e) {

                // Prevents the default action to be triggered.
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#element_to_pop_up').bPopup();

            });

        });

    })(jQuery);
</script>



@yield('page-scripts')
</body>
</html>