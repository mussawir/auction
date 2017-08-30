<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->make('layouts.mark-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="<?php echo e(asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css')); ?>" rel="stylesheet">
<!-- ================== END PAGE LEVEL STYLE ================== -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- begin breadcrumb -->

<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Compose New Email <small></small></h1>
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
                <h4 class="panel-title">Compose New Email</h4>
            </div>
            <div class="panel-body">
                <?php echo Form::open(array('url'=>'/practitioner/emails/store', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')); ?>


                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('templates','Select Template*: ', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                        <select id="templates" name="et_id" class="form-control" onchange="loadTemplate(this)" data-parsley-required="true">
                            <option value="0">Select</option>
                            <?php foreach($templates as $item): ?>
                                <option value="<?php echo e($item->et_id); ?>" data-template="<?php echo e($item->template); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('contact_groups','Contact Groups*: ', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                        <select id="contact_groups" name="cg_id" class="form-control" onchange="ajax();" data-parsley-required="true">
                            <option value="0">Select</option>
                            <?php foreach($contact_groups as $item): ?>
                                <option value="<?php echo e($item->cg_id); ?>"><?php echo e($item->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('bcc','BCC: ', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('bcc', null, array('class'=>'form-control', 'placeholder'=> 'BCC Name')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('subject','Subject*: ', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('subject', null, array('class'=>'form-control', 'placeholder'=> 'Subject')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="getemail"></div>
                </div >
                <div class="col-md-12">
                    <?php echo Form::textarea('mail_body', null, array('class'=>'ckeditor','id'=>'mail_body', 'rows'=>'20')); ?>

                </div >
                <div class="col-md-12">
                    &nbsp;
                </div>
                <div class="col-md-12">
                    <?php echo Form::submit('Send', array('class'=>'btn btn-success pull-right')); ?>

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
<script type="text/javascript" src="<?php echo e(asset('public/dashboard/plugins/ckeditor/ckeditor.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/dashboard/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/dashboard/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/dashboard/js/form-wysiwyg.demo.min.j')); ?>s"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-scripts'); ?>
    <script>
        $(document).ready(function() {
            FormWysihtml5.init();
            <?php if(isset($_GET['cg_id'])) {?>
            $("[name='cg_id']").val('<?php echo $_GET['cg_id']; ?>');
                    <?php } ?>
					console.log($_GET['cg_id']);
            var roxyFileman = '<?php echo e(asset('public/dashboard/plugins/fileman/index.html')); ?>';
            CKEDITOR.replace('mail_body',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image',
                        removeDialogTabs: 'link:upload;image:upload',
                        enterMode	: Number(2)
                    })
        });

        function loadTemplate(elm) {
            CKEDITOR.instances['mail_body'].setData($(elm).find(':selected').data('template'));
        }
        <?php /*$("#contact_groups").on('change',function(){*/ ?>
            <?php /*var dataId = {'id': $("#contact_groups").val()};*/ ?>
            <?php /*$.ajax({*/ ?>
                <?php /*type:'GET',*/ ?>
                <?php /*url:'<?php echo URL::route('findInfo'); ?>',*/ ?>
                <?php /*async:false,*/ ?>
                <?php /*dataType:'json',*/ ?>
                <?php /*data:dataId,*/ ?>
                <?php /*success:function(data){*/ ?>
                    <?php /*var obj = JSON.parse(data);*/ ?>
                    <?php /*$.each(obj, function(index, value){*/ ?>
                        <?php /*$('#getemail').append(value.data.cg_id + ": " + value.data.email + " " + value.data.egd_id + "<br />");*/ ?>
                    <?php /*})*/ ?>
                <?php /*}*/ ?>
            <?php /*});*/ ?>
        <?php /*});*/ ?>
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>