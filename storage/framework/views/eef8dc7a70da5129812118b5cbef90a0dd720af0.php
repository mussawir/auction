<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-md-12">
        <?php echo $__env->make('patient.index.admin-blog-panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="col-md-12">
	<?php /*<?php echo $__env->make('patient.index.top-ad', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
    </div>
</div>
<!-- begin row -->

<div class="row">
    <!--<div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <?php echo $__env->make('patient.index.products-panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="col-md-6">
                <?php echo $__env->make('patient.index.nutritions-panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php echo $__env->make('patient.index.exercises-panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
			<div class="col-md-6">
                <?php echo $__env->make('patient.index.supplements-panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div> -->

    <?php /*<div class="col-md-6">*/ ?>
        <?php /*<div class="row">*/ ?>
            <?php /*<div class="col-md-12">*/ ?>
                <?php /*<?php echo $__env->make('patient.index.articles-panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
            <?php /*</div>*/ ?>
            <?php /*<div class="col-md-12">*/ ?>
                <?php /*<?php echo $__env->make('patient.index.ad1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
            <?php /*</div>*/ ?>
            <?php /*<div class="col-md-12">*/ ?>
                <?php /*<?php echo $__env->make('patient.index.articles-panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>*/ ?>
            <?php /*</div>*/ ?>
        <?php /*</div>*/ ?>
        <?php /*<!-- row end -->*/ ?>

    <?php /*</div>*/ ?>
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }
        });		
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.padash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>