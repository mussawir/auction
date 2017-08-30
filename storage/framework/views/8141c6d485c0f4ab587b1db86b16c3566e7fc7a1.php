<?php $__env->startSection('content'); ?>
<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.pradash-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

    <div class="row">
        <div class="col-md-12 msg">
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
		<?php echo $__env->make('practitioner.index.admin-blog-panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
         <!-- <div class="col-md-12" >
            <div class="row">
            <div class="col-md-6">
                <div class="panel panel-info" data-sortable-id="ui-widget-6" data-init="true">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Nutrition Suggestions
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="300px">
                            <table id="sug-data-table" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>No. of Contacts</th>
                                    <th>No. of Nutritions</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($list_nut as $item): ?>
                                    <tr>

                                        <td><?php echo e(date('m/d/Y')); ?></td>
                                        <td><span class="badge badge-danger"><?php echo e(count(json_decode($item->pa_ids))); ?></span></td>
                                        <td><span class="badge badge-danger"><?php echo e(count(json_decode($item->nut_ids))); ?></span></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='<?php echo e(url('/practitioner/suggestion/nutrition-suggestions-details/'.$item->id)); ?>'">View</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-info" data-sortable-id="ui-widget-6" data-init="true">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Supplements Suggestions
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div data-scrollbar="true" data-height="300px">
                            <table id="sug-data-table" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>No. ofContacts</th>
                                    <th>No. of Supplements</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($suggestion as $item1): ?>
                                <tr>

                                    <td><?php echo e(date('m/d/Y')); ?></td>
                                    <td><span class="badge badge-danger"><?php echo e(count(json_decode($item1->pa_ids))); ?></span></td>
                                    <td><span class="badge badge-danger"><?php echo e(count(json_decode($item1->sup_ids))); ?></span></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" onclick="window.location.href='<?php echo e(url('/practitioner/suggestion/supplement-suggestions-details/'.$item1->id)); ?>'">View</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>    
           <div class="col-md-12" >
            <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-success" data-sortable-id="ui-widget-6" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Supplement Approval Requests
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <table id="sup-data-table" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Request Title</th>
                                        <tContacter Name</th>
                                        <th>Sup #</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  $counter = 1; echo $counter;?>
                                    <?php foreach($supplement_requests as $sr): ?>
                                    <tr>
                                        <td><?php echo e($counter++); ?></td>
                                        <td><?php echo e($sr->title); ?></td>
                                        <td><?php echo e($sr->first_name.' '. $sr->last_name); ?></td>
                                        <td>
                                            <?php
                                             $sup = \App\Models\SupplementRequestDetail::where('sr_id',$sr->sr_id)->get();
                                           
										   ?>
                                            <span class='badge badge-danger'><?php echo e(count($sup)); ?></span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(url('practitioner/index/supplement-request-detail/'.$sr->sr_id)); ?>" class="btn btn-sm btn-success">View</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>

                <div class="col-md-6">
                    <div class="panel panel-warning" data-sortable-id="ui-widget-6" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Nutrition Approval Requests
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <table id="sug-data-table" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Request Title</th>
                                        <Contactber Name</th>
                                        <th>Sup #</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  $counter = 1; ?>
                                    <?php foreach($nutrition_requests as $nr): ?>
                                        <tr>
                                            <td><?php echo e($counter++); ?></td>
                                            <td><?php echo e($nr->title); ?></td>
                                            <td><?php echo e($nr->first_name.' '. $nr->last_name); ?></td>
                                            <td>
                                                <?php
                                                $nut = \App\Models\NutritionRequestDetail::where('nr_id',$nr->nr_id)->get();
                                                ?>
                                                <span class='badge badge-danger'><?php echo e(count($nut)); ?></span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(url('practitioner/index/nutrition-request-detail/'.$nr->nr_id)); ?>" class="btn btn-sm btn-success">View</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
                </div> 
                <div class="col-md-6">
            <div class="panel panel-info" data-sortable-id="ui-widget-6" data-init="true">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Suggestions
                    </h3>
                </div>
                <div class="panel-body">
                    <div data-scrollbar="true" data-height="300px">
                        <table id="sug-data-table" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Group</th>
                                <th>Heading</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo e(date('m/d/Y')); ?></td>
                                <td>Vitamins - Contact</td>
                                <td>Lorem ipsum</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(date('m/d/Y')); ?></td>
                                <td>Calcium - Contact</td>
                                <td>Lorem ipsum</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info">View</button>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo e(date('m/d/Y')); ?></td>
                                <td>Vitamin D - Contact</td>
                                <td>Lorem ipsum</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info">View</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                <div class="col-md-6">
                    <div class="panel panel-success" data-sortable-id="ui-widget-7" data-init="true">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                Exercise Approval Requests
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div data-scrollbar="true" data-height="300px">
                                <table id="exercise-data-table" class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Request Title</th>
                                        <th>Contact Name</th>
                                        <th>Exe #</th>
                                        <th>Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  $counter = 1; ?>
                                    <?php foreach($exercise_requests as $er): ?>
                                        <tr>
                                            <td><?php echo e($counter++); ?></td>
                                            <td><?php echo e($er->title); ?></td>
                                            <td><?php echo e($er->first_name.' '. $sr->last_name); ?></td>
                                            <td>
                                                <?php
                                                $exe = \App\Models\ExerciseRequestDetail::where('er_id',$er->er_id)->get();
                                                ?>
                                                <span class='badge badge-danger'><?php echo e(count($exe)); ?></span>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(url('practitioner/index/exercise-request-details/'.$er->er_id)); ?>" class="btn btn-sm btn-success">View</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script type="text/javascript">
        $(function () {
            if ($('#sug-data-table').length !== 0) {
                $('#sug-data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [3]}]
                });
            }

            if ($('#sup-data-table').length !== 0) {
                $('#sup-data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }


            if ($('#exercise-data-table').length !== 0) {
                $('#exercise-data-table').DataTable({
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
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>