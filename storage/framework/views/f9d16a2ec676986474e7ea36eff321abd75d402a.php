<?php $__env->startSection('content'); ?>

<!-- begin page-header -->
<h1 class="page-header">Send Store Invitation<small></small></h1>
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
			<?php if(isset($_GET['type'])&&isset($_GET['type'])=='error') {?>
			<div class="alert alert-danger fade in">
                    <strong>Error!</strong>
                    <strong>Please set your store first.</strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
			<?php } ?>
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
                <h4 class="panel-title">Send Store Invitation</h4>
            </div>
            <div class="panel-body">
                <?php echo Form::open(array('url'=>'/practitioner/ecommerce/send_store_invitation', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')); ?>


               <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('templates','Name : ', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-4">
                        <input id="value" name="name" type="text" placeholder="Name" class="form-control input-sm" value="" required/>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Form::label('templates','Email Address : ', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-4">
                        <input id="value" name="email" type="email" placeholder="Email Address" class="form-control input-sm" value="" required/>
                        </div>
                    </div>

                </div>
                

                <div class="col-md-6 col-md-offset-3">

                    <?php echo Form::submit('Send Invitation', array('class'=>'btn btn-success')); ?>

                    

                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
        <!-- end panel -->


        
    </div>
    <!-- end col 6 -->
</div>

<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('bottom'); ?>
        <!-- ================== BEGIN PAGE LEVEL JS ================== -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
    <script>
        $(document).ready(function() {
            
        });

function redirectDelete()
        {
            var url = '';
            url = '<?php echo e(url("/practitioner/ecommerce/remove-store-name")); ?>';
            window.location.href=url;
        }


        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>