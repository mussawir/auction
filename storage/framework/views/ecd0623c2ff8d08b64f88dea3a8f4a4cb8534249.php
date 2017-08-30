<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->make('layouts.mark-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="<?php echo e(url('/practitioner')); ?>">Dashboard</a></li>
    <li class="active">Suggested Supplements</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Suggested Supplements <small>List of supplements suggested to contacts</small></h1>
<!-- end page-header -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse" data-sortable-id="ui-widget-7" data-init="true">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Suggestion List</h4>
            </div>
            <div class="panel-body">
                <table id="dt-sup-sug" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Message</th>
                        <th>No. of Contacts</th>
                        <th>No. of Supplements</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter=1;?>
                    <?php foreach($list as $item): ?>
                        <tr>
                            <td><?php echo e($counter++); ?></td>
                            <td><?php echo e(date('m/d/Y H:i:s', strtotime($item->created_at))); ?></td>
                            <td><?php echo e($item->message); ?></td>
                            <td><span class="badge badge-danger"><?php echo e(count(json_decode($item->pa_ids))); ?></span></td>
                            <td><span class="badge badge-danger"><?php echo e(count(json_decode($item->sup_ids))); ?></span></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='<?php echo e(url('/practitioner/suggestion/supplement-suggestions-details/'.$item->id)); ?>'">View</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('#dt-sup-sug').length !== 0) {
                $('#dt-sup-sug').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 50,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [5]}]
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>