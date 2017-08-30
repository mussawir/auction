<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->make('layouts.mark-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 
<!-- begin page-header -->
<h1 class="page-header">Social Posts<small></small></h1>
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
                <h4 class="panel-title">Social Posts</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Date Time</th>
                        <th>Heading</th>
                        <th>Post</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                      <?php foreach($socialdata as $socialpost): ?>
                    <tbody>
                        <tr>
                            <td>
                             <?php echo e($socialpost->created_at); ?>

                            </td>
                            
                            <td> Heading</td>
                            
                            <td>
                               <?php echo e($socialpost->contents); ?>

                            </td>

                            <td>
                            
                                <a href="blog/socialedit/<?php echo e($socialpost->post_id); ?> "  ><i class="fa fa-pencil"></i> Edit</a> |
                                <a href="javascript:void(0);" onclick="doDelete('<?php echo e($socialpost->post_id); ?>', this);"><i class="fa fa-trash-o"></i> Delete</a>
            </td>

                        </tr>
                    </tbody>
                    <?php endforeach; ?>
                </table>
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


       function doDelete(id, elm)
        {
            var q = confirm("Are you sure you want to delete this manufacturer?");
            if (q == true) {

                $.ajax({
                    type: "delete",
                    url: '<?php echo e(URL::to('/practitioner/blog/destroy')); ?>/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        if (result == 'success') {
                            $(elm).closest('tr').fadeOut();
                            $('.msg').html('<div class="alert alert-success"><strong>Manufacturer deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                        } else {
                            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                        }
                        location.reload(true);
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>