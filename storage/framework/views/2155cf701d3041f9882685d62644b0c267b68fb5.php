<!DOCTYPE html>
<html lang="en">
<head>
    <?php /*<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">*/ ?>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta http-equiv="Content-Type" content="image/svg+xml, text/html; charset=UTF-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="aliinfotech.com">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php if(isset($page_title)) echo $page_title.' - ';?>Practice Tabs</title>
	
	
	
	<link rel="icon" href="http://practicetab.com/dev/public/homepage/logoBlue.png" type="image/png" >
	
	
	
    <!-- Fonts -->
    <?php /*<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">*/ ?>

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="<?php echo e(asset('public/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/animate.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/style.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/style-responsive.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/css/theme/default.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('public/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css')); ?>" rel="stylesheet">   
   <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="<?php echo e(asset('public/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/plugins/bootstrap-datepicker/css/datepicker.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/plugins/bootstrap-datepicker/css/datepicker3.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/plugins/gritter/css/jquery.gritter.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/plugins/DataTables/media/css/dataTables.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/plugins/parsley/src/parsley.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('public/plugins/jquery-tag-it/css/jquery.tagit.css')); ?>" rel="stylesheet" />
	<link href="<?php echo e(asset('public/plugins/select2/dist/css/select2.min.css')); ?>" rel="stylesheet" />
	<link href="<?php echo e(asset('public/plugins/jstree/dist/themes/default/style.min.css')); ?>" rel="stylesheet" />
	
    <!-- ================== END PAGE LEVEL STYLE ================== -->
    

    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.png')); ?>" type="image/vnd.microsoft.icon" />

    <!-- ================== BEGIN BASE JS ================== -->
    <script type="text/javascript" src="<?php echo e(asset('public/plugins/pace/pace.min.js')); ?>"></script>
    <!-- ================== END BASE JS ================== -->
	
	<!--////////////////////////////responsive-stle-linked//////////////////////////////////////-->

<link href="<?php echo e(asset('public/css/responsive.css')); ?>" rel="stylesheet" />
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
                <a href="<?php echo e(url('/supplier')); ?>" class="navbar-brand"><span class="navbar-logo"></span> Practice Tabs</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->

            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form full-width">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter keyword" />
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </li>
                <!--<li class="dropdown">
                    <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                        <i class="fa fa-bell-o"></i>
                        <span class="label">2</span>
                    </a>
                    <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                        <li class="dropdown-header">Notifications (2)</li>

                        <li class="media">
                            <a href="javascript:;">
                                <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                                <div class="media-body">
                                    <h6 class="media-heading"> New Practitioner Registered</h6>
                                    <div class="text-muted f-s-11">1 hour ago</div>
                                </div>
                            </a>
                        </li>
                        <li class="media">
                            <a href="javascript:;">
                                <div class="media-left"><i class="fa fa-plus media-object bg-green"></i></div>
                                <div class="media-body">
                                    <h6 class="media-heading"> New Contact Registered</h6>
                                    <div class="text-muted f-s-11">1 hour ago</div>
                                </div>
                            </a>
                        </li>

                        <li class="dropdown-footer text-center">
                            <a href="javascript:;">View more</a>
                        </li>
                    </ul>
                </li>-->
                <?php if(!Auth::guest()): ?>
                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo e(url('public/img/user-13.jpg')); ?>" alt="" />
                        <span class="hidden-xs">&nbsp;<?php echo e(Auth::user()->first_name . ' ' .Auth::user()->last_name); ?>&nbsp;</span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="arrow"></li>
                        <li><a href="javascript:;">Edit Profile</a></li>
                        <li><a href="<?php echo e(url('/supplier/index/change-password')); ?>">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo e(url('/logout')); ?>">Log Out</a></li>
                    </ul>
                </li>
                <?php endif; ?>
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
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <div class="image">
                        <a href="javascript:;"><img src="<?php echo e(url('public/img/user-13.jpg')); ?>" alt="" /></a>
                    </div>
                    <div class="info">
                        <?php if(Auth::check()): ?>
                            <?php echo e(Auth::user()->first_name . ' ' .Auth::user()->last_name); ?>

                        <?php endif; ?>
                        <small> Supplier</small>
                    </div>
                </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">

                <li class="has-sub <?php if(isset($db_main_menu)) echo $db_main_menu;?>">
                    <a href="<?php echo e(url('/supplier')); ?>">
                        <i class="fa fa-laptop"></i>
                        <span>Dashboard</span>
                    </a>
                    <li>
                <li class="has-sub <?php if(isset($pro_main_menu)) echo $pro_main_menu;?>">
                    <a href="<?php echo e(url('/supplier/product/list')); ?>">
                        <i class="fa fa-product-hunt"></i>
                        <span>Products</span>
                    </a>
                <li>


                <li class="has-sub <?php if(isset($tag_main_menu)) echo $tag_main_menu;?>">
                    <a href="javascript:;">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-tags"></i>
                        <span>Product Tags</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="<?php if(isset($tag_new)) echo $tag_new;?>"><a href="<?php echo e(url('/supplier/product/tags/new?flagType=TAG')); ?>">Add New / List</a></li>
                        <li class="<?php if(isset($pre_tag_list)) echo $pre_tag_list;?>"><a href="<?php echo e(url('/supplier/product/tags/predefined?flagType=TAG')); ?>">Pre-defined</a></li>
                    </ul>
                </li>

                <li class="has-sub <?php if(isset($brand_main_menu)) echo $brand_main_menu;?>">
                    <a href="<?php echo e(url('/supplier/product/brands/list')); ?>">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-tag"></i>
                        <span>Brands</span>
                    </a>
                </li>
				
				<li class="has-sub <?php if(isset($orders_main_menu)) echo $orders_main_menu;?>">
                    <a href="#">
                        <span class="badge pull-right"></span>
                        <i class="fa fa-shopping-cart"></i>
                        <span>Orders</span>
                    </a> 
                    <!--<ul class="sub-menu">
                        <li class="<?php if(isset($order_list)) echo $order_list;?>"><a href="<?php echo e(url('/supplier/orders/list')); ?>">All Orders</a></li>
						<li class="<?php if(isset($order_list_0)) echo $order_list_0;?>"><a href="<?php echo e(url('/supplier/orders/list/0')); ?>">Pending</a></li>
						<li class="<?php if(isset($order_list_1)) echo $order_list_1;?>"><a href="<?php echo e(url('/supplier/orders/list/1')); ?>">Delivered</a></li>
						<li class="<?php if(isset($order_list_2)) echo $order_list_2;?>"><a href="<?php echo e(url('/supplier/orders/list/2')); ?>">Process</a></li>
						<li class="<?php if(isset($order_list_3)) echo $order_list_3;?>"><a href="<?php echo e(url('/supplier/orders/list/3')); ?>">Cancelled</a></li>
                    </ul>-->
						<ul class="sub-menu">
                       <!-- <li class="<?php if(isset($order_list_)) echo $order_list_;?>"><a href="<?php echo e(url('/supplier/orders/list')); ?>">All Orders</a></li>
						--><li class="<?php if(isset($order_list_0)) echo $order_list_0;?>"><a href="<?php echo e(url('/supplier/orders/list/0')); ?>">New</a></li>
						<li class="<?php if(isset($order_list_2)) echo $order_list_2;?>"><a href="<?php echo e(url('/supplier/orders/process/2')); ?>">Process</a></li>
						<!--<li class="<?php if(isset($order_list_4)) echo $order_list_4;?>"><a href="<?php echo e(url('/supplier/orders/list/4')); ?>">Shipped</a></li>-->
						
						<li class="<?php if(isset($order_list_1)) echo $order_list_1;?>"><a href="<?php echo e(url('/supplier/orders/list/1')); ?>">Delivered</a></li>
						<!--<li class="<?php if(isset($order_list_3)) echo $order_list_3;?>"><a href="<?php echo e(url('/supplier/orders/list/3')); ?>">Cancelled</a></li>-->
                    </ul>
				</li> 

                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
            <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->

    <!-- begin #content -->
    <div id="content" class="content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- end #content -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->
        <!-- ================== BEGIN BASE JS ================== -->
<script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery/jquery-1.9.1.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery/jquery-migrate-1.1.0.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-ui/ui/minified/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>
<!--[if lt IE 9]>
<script src="/public/dashboard/crossbrowserjs/html5shiv.js"></script>
<script src="/public/dashboard/crossbrowserjs/respond.min.js"></script>
<script src="/public/dashboard/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php echo e(asset('public/plugins/slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-cookie/jquery.cookie.js')); ?>"></script>
<!-- ================== END BASE JS ================== -->

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="<?php echo e(asset('public/plugins/gritter/js/jquery.gritter.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/flot/jquery.flot.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/flot/jquery.flot.time.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/flot/jquery.flot.resize.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/flot/jquery.flot.pie.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/sparkline/jquery.sparkline.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/DataTables/media/js/jquery.dataTables.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/DataTables/media/js/dataTables.bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/js/dashboard.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/parsley/dist/parsley.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/jquery-tag-it/js/tag-it.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/select2/dist/js/select2.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/plugins/jstree/dist/jstree.min.js')); ?>"></script>
<!-- ================== END PAGE LEVEL JS ================== -->
<?php echo $__env->yieldContent('bottom'); ?>
<script type="text/javascript" src="<?php echo e(asset('public/js/apps.js')); ?>"></script>
<script src="<?php echo e(asset('public/plugins/datepicker/form-plugins.demo.min.js')); ?>"></script>
<script> 
$(document).ready(function(){
	$('.panel-heading-btn').children('.btn-danger').remove();
	});
	
	
    $(document).ready(function() {
        App.init();
        Dashboard.init();
		FormPlugins.init();
           });
    function customSearch(tableId,value,pagelength)
        {
            $('#'+tableId).DataTable().page.len(pagelength).draw();
            var oldVal = $('#'+tableId+'_filter').children().children().val();
            $('#'+tableId+'_filter').children().children().val(value);
 $('#'+tableId).DataTable().search(
        value
    ).draw();
 return oldVal;
        }
</script>


<?php echo $__env->yieldContent('page-scripts'); ?>
</body>
</html>
