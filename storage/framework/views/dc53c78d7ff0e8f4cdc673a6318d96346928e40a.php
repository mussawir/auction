<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->make('layouts.mark-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('head'); ?>
        <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->

<!-- ================== END PAGE LEVEL STYLE ================== -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- begin breadcrumb -->


<a class="btn btn-success pull-right" href="<?php echo e(url('/practitioner/emails/campaign')); ?>" style="margin: 3px 12px;"><i class="fa fa-plus"></i>  Create Campaign</a>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Email Group <small>List of campaigns</small></h1>
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
                <h4 class="panel-title">campaign List</h4>
            </div>
            <div class="panel-body">
                <table id="dt_list" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Status</th>
                        <th>Campaign Name</th>
                        <th>Starts On</th>
                        <th>Recipent Group</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $counter=1;?>
                    <?php foreach($list as $item): ?>
                        <tr>
                            <td><?php echo e($counter++); ?></td>
                            <td>
                                <?php
                                if($item->status == 0){
                                    echo ' <i class="fa fa-circle" aria-hidden="true" style="color:red"> Pending</i> ';
                                }elseif($item->status == 1){
                                    echo ' <i class="fa fa-circle" aria-hidden="true" style="color:orange"> Running</i> ';
                                }elseif($item->status == 2){
                                    echo ' <i class="fa fa-circle" aria-hidden="true" style="color:green"> Finished</i> ';
                                }
                                ?>
                            </td>
                            <td><?php echo e($item->campaign_name); ?></td>
                            <td><?php echo e($item->start_date); ?></td>
                            <td><?php echo e($item->group_name); ?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='<?php echo e(url('/practitioner/emails/campaigndetails/'.$item->cam_id)); ?>'">View</button>
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

        $(function () {
            if ($('#dt_list').length !== 0) {
                $('#dt_list').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }

            var maxHeight=22;
            var showText = "Show More";
            var hideText = "Show Less";
            $('.emailbody').each(function () {
                var text = $(this);
                if (($(this).text().length > 100) && (text.height() > maxHeight)) {
                    text.css({ 'overflow': 'hidden','height': maxHeight + 'px' });

                    var link = $('<a href="#" style="font-weight: bold;">' + showText + '</a>');
                    var linkDiv = $('<div></div>');
                    linkDiv.append(link);
                    $(this).after(linkDiv);

                    link.click(function (event) {
                        event.preventDefault();
                        if (text.height() > maxHeight) {
                            $(this).html(showText);
                            text.css('height', maxHeight + 'px');
                        } else {
                            $(this).html(hideText);
                            text.css('height', 'auto');
                        }
                    });
                }
            });
        });

        function doDelete(id, elm)
        {
            var q = confirm("Are you sure you want to delete this email template?");
            if (q == true) {

                $.ajax({
                    type: "DELETE",
                    url: '<?php echo e(url('/admin/email-templates/destroy')); ?>/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        /*if (result.status == 'success') {
                         $(elm).closest('tr').fadeOut();
                         $('.msg').html('<div class="alert alert-success"><strong>Template deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                         } else {
                         $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                         }*/
                        window.location.reload();
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