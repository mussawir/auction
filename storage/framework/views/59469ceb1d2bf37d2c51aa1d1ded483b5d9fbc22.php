<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->make('layouts.mark-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<!-- ================== END PAGE LEVEL STYLE ================== -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- begin breadcrumb -->

<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Email Analytics <small></small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-12">
        

        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Email Analytics</h4>
            </div>
			 <h1 class="">UNDER CONSTRUCTION</h1>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bottom'); ?>
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script type="text/javascript" src="<?php echo e(asset('public/dashboard/plugins/ckeditor/ckeditor.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/dashboard/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/dashboard/js/form-wysiwyg.demo.min.j')); ?>s"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>