<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->make('layouts.manage-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="<?php echo e(url('/practitioner')); ?>">Dashboard</a></li>
    <li class="active">Order Details</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Orders Details <small><?php echo e($order->products_name); ?></small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-12">
        <div class="msg">
            <?php if(Session::has('success')): ?>
                <div class="alert alert-success fade in">
                    <strong>Success!</strong>
                    <strong><?php echo e(Session::pull('success')); ?></strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            <?php elseif(Session::has('error')): ?>
                <div class="alert alert-danger fade in">
                    <strong>Error!</strong>
                    <strong><?php echo e(Session::pull('error')); ?></strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            <?php endif; ?>
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
                <h4 class="panel-title"><?php echo e($order->products_name); ?></h4>
            </div>
            <div class="panel-body">
                <h3>Order Details</h3>
                <h5>Order# <?php echo e($order->order_number); ?></h5>
                <div class="row">
                    <div class="col-md-4">
                        <strong><h5>Shipping Address</h5></strong>
                        <p><?php echo e($order->shipping_address); ?></p>
                        <strong><h5>Order Status: </h5></strong>
                        <p>
                            <?php if($order->order_status == 1): ?>
                                <i class="fa fa-check-circle" style="color:green"></i> Delivered
                            <?php elseif($order->order_status == 0): ?>
                                <i class="fa fa-circle" style="color:orange"></i> Pending
                            <?php elseif($order->order_status == 2): ?>
                                <i class="fa fa-recycle" style="color:blue"></i> Processed
                            <?php elseif($order->order_status == 3): ?>
                                <i class="fa fa-times" style="color:red"></i> Cancelled
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <strong><h5>Payment Method</h5></strong>
                        <p><strong>Patient Name:</strong> <?php echo e($order->first_name); ?></p>
                        <p><strong>Card Holder Name:</strong> <?php echo e($order->card_customer_name); ?></p>
                        <p><strong>Card:</strong> <?php echo e($order->card_type); ?></p>
                        <p><strong>Card Number:</strong> <?php echo e($order->card_number); ?></p>
                    </div>
                    <div class="col-md-4">
                        <strong><h5>Order Summary</h5></strong>
                        <p><strong>Item(s) Quanitity: </strong><?php echo e($order->product_qty); ?></p>
                        <p><strong>Item(s) Subtotal:</strong> $<?php echo e($order->product_price); ?></p>
                        <p><strong>Shipping & Handling:</strong> $<?php echo e($order->shipping_amount); ?></p>
                        <p><strong>Taxes:</strong> $<?php echo e($order->product_tax); ?></p>
                        <strong><h5>Grand Total: $<?php echo e($order->product_price); ?></h5></strong>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <strong><h5>Delivered</h5></strong>
                            <p>Delivered on: <?php echo e($order->delivery_date); ?></p>
                            <div class="row">
                                <div class="col-md-2">
                                    <?php if(isset($order->image_path) && (!empty($order->image_path))): ?>
                                        <img src="<?php echo e(asset($order->image_path)); ?>" alt="<?php echo e($order->products_name); ?>"  style="width:100%;"/>
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('public/dashboard/img/no_image_64x64.jpg')); ?>" alt="<?php echo e($order->products_name); ?>" style="width:40px;float:left;"/>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-10">
                                    <p><strong>Products Name:</strong> <?php echo e($order->products_name); ?></p>

                                    <p><strong>Supplier Name:</strong>
                                        <?php /*<a href="<?php echo e(url('/patient/ecommerce/store/products/'.$order->pra_id)); ?>">*/ ?>
                                        <?php echo e($order->sup_firstname); ?> <?php echo e($order->sup_lastname); ?>

                                        <?php /*</a>*/ ?>
                                    </p>
                                    
                                    <?php /*<a href="<?php echo e(url('/patient/ecommerce/store/product/'.$order->products_id)); ?>" class="btn btn-default">Buy it Again</a>*/ ?>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo e(url('/practitioner/ecommerce/orders')); ?>" class="btn btn-success pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script type="text/javascript">

        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
                });
            }
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>