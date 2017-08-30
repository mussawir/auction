<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->make('layouts.mark-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style type="text/css">
        #circleG{
    width:30px;
    margin:auto;
}

.circleG{
    background-color:rgb(255,255,255);
    float:left;
    height:6px;
    margin-left:3px;
    width:6px;
    animation-name:bounce_circleG;
        -o-animation-name:bounce_circleG;
        -ms-animation-name:bounce_circleG;
        -webkit-animation-name:bounce_circleG;
        -moz-animation-name:bounce_circleG;
    animation-duration:2.24s;
        -o-animation-duration:2.24s;
        -ms-animation-duration:2.24s;
        -webkit-animation-duration:2.24s;
        -moz-animation-duration:2.24s;
    animation-iteration-count:infinite;
        -o-animation-iteration-count:infinite;
        -ms-animation-iteration-count:infinite;
        -webkit-animation-iteration-count:infinite;
        -moz-animation-iteration-count:infinite;
    animation-direction:normal;
        -o-animation-direction:normal;
        -ms-animation-direction:normal;
        -webkit-animation-direction:normal;
        -moz-animation-direction:normal;
    border-radius:4px;
        -o-border-radius:4px;
        -ms-border-radius:4px;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
}

#circleG_1{
    animation-delay:0.45s;
        -o-animation-delay:0.45s;
        -ms-animation-delay:0.45s;
        -webkit-animation-delay:0.45s;
        -moz-animation-delay:0.45s;
}

#circleG_2{
    animation-delay:1.05s;
        -o-animation-delay:1.05s;
        -ms-animation-delay:1.05s;
        -webkit-animation-delay:1.05s;
        -moz-animation-delay:1.05s;
}

#circleG_3{
    animation-delay:1.35s;
        -o-animation-delay:1.35s;
        -ms-animation-delay:1.35s;
        -webkit-animation-delay:1.35s;
        -moz-animation-delay:1.35s;
}



@keyframes  bounce_circleG{
    0%{}

    50%{
        background-color:rgb(0,0,0);
    }

    100%{}
}

@-o-keyframes bounce_circleG{
    0%{}

    50%{
        background-color:rgb(0,0,0);
    }

    100%{}
}

@-ms-keyframes bounce_circleG{
    0%{}

    50%{
        background-color:rgb(0,0,0);
    }

    100%{}
}

@-webkit-keyframes bounce_circleG{
    0%{}

    50%{
        background-color:rgb(0,0,0);
    }

    100%{}
}

@-moz-keyframes bounce_circleG{
    0%{}

    50%{
        background-color:rgb(0,0,0);
    }

    100%{}
}


    </style>

    <!-- begin page-header -->
    <h1 class="page-header">Suggestions <small>Supplement Suggestions</small></h1>
    <!-- end page-header -->

    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Group Wizards</h4>
                </div>
                <div class="panel-body">
                    <form action="<?php echo e(URL::to('/practitioner/email-group/addPatients')); ?>" method="POST" data-parsley-validate="true" name="form-wizard" id="form-wizard">
                        <div id="wizard">
                            <ol id="wizlist">
                                <li>
                                    Select Products
                                </li>
                                <span class="arrow arrowActive"></span>
                                <li>
                                    Add Contact
                                </li>
                                <span class="arrow arrowNormal"></span>
                                <li>
                                    Send
                                </li>
                                <span class="arrow arrowNormal"></span>
                                <li>
                                    Completed
                                </li>
                                <span class="arrow arrowNormal"></span>
                            </ol>
                            <ul class="pager"><li class="previous" role="button" aria-disabled="false"><a href="#" onclick="wizPrev();"> Previous</a></li><li class="next" role="button" aria-disabled="false"><a href="#" onclick="wizNext();">Next </a></li></ul>
                            <!-- begin wizard step-1 -->
                            <div class="wizard-step-1">
                                <fieldset>
                                    <legend class="pull-left width-full">Select Products For Recommendation</legend>
                                </fieldset>

                                <div class="row" id="patientTable">
                                <div class="col-md-12">
                                <div class="row"> 
                                <div class="col-md-6" style="margin-bottom: 10px;">
								<div class="col-md-9"><div class="col-md-12">
                    <div class="form-group">
                        <label style="margin-top: 6px;margin-left: -31px;" for="p-group" class="col-md-4 control-label">Select Group: </label>
                        <div class="col-md-8">
                        <select style="width: 111%;" id="p-group" class="form-control" onchange="childFormSubmit(1,this.value);">
                            <option value="">Please Select</option>
							<?php if(isset($productGroup)): ?>
							<?php foreach($productGroup as $productGroupPrint): ?>
								<option value="<?php echo e($productGroupPrint->cg_id); ?>"><?php echo e($productGroupPrint->name); ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
						</select>
                        </div>
                    </div>
                </div></div>
								<div class="col-md-3">
								<div class="btn btn-success pull-right" id="supp-loader-btn-1" style="margin-bottom:10px;"> Add to list
                                <div id="circleG">
    <div id="circleG_1" class="circleG"></div>
    <div id="circleG_2" class="circleG"></div>
    <div id="circleG_3" class="circleG"></div>
</div></div><input id="supp-btn-1" type="button" onclick="addSuppementsList()" class = "btn btn-success pull-right" value="Add to list" />
</div>
                                </div>
                                </div>
                                    

                                </div>
                                    <!-- begin col-6 -->
                                    <div class="col-md-6">
                                        <div>
                                            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                                                <div class="panel-heading">
                                                    <div class="panel-heading-btn">
                                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                                    </div>
                                                    <h4 class="panel-title">Select Products</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <table id="data-table" class="table table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Supplier</th>
															<th>Category</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <!--<?php foreach($products as $item): ?>
                                                           <tr>
                                                            
                                                                <td>
                                                                <?php if(isset($item->mainImage) && (!empty($item->mainImage))): ?>
																	<img src="<?php echo e(asset($item->mainImage)); ?>" alt="<?php echo e($item->products_name); ?>" style="    width: 50px;"/>
																<?php else: ?>
																	<img src="<?php echo e(asset('public/dashboard/img/no_image_64x64.jpg')); ?>" alt="<?php echo e($item->products_name); ?>" />
																<?php endif; ?>
                                                                </td>
                                                                <td><?php echo e($item->products_name); ?></td>
                                                                <td><?php echo e($item->supplier_name); ?></td>
																 <td><?php echo e($item->cat_name); ?></td>
                                                                <td>
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" name="pro_id[]" data-parsley-required="true" value="<?php echo e($item->products_id); ?>" <?php echo e(in_array($item->products_id, $pro_ids)? 'checked="checked"' : ''); ?>>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>-->
                                                        </tbody>
                                                    </table>
                                                    <hr/>
                                                    <div class="row">
                                                    <div class="col-md-9"></div>
                                                    <div class="col-md-3">
                                                    <div class="btn btn-success pull-right" id="supp-loader-btn-2"> Add to list
                                <div id="circleG">
    <div id="circleG_1" class="circleG"></div>
    <div id="circleG_2" class="circleG"></div>
    <div id="circleG_3" class="circleG"></div>
</div>
</div>
                                                        <input id="supp-btn-2" type="button" onclick="addSuppementsList()" class = "btn btn-success pull-right" value="Add to list" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end col-6 -->
                                    <!-- begin col-6 -->
                                    <div class="col-md-6">
                                        <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                                            <div class="panel-heading">
                                                <div class="panel-heading-btn">
                                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                                <h4 class="panel-title">Selected Products</h4>
                                            </div>
                                            <div class="panel-body">
                                            <div class="row">
                                                        
                                                    </div>
                                                    
                                                <table id="selected-table-sup" class="table table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                    <th style="display: none">
                                                                ID
                                                            </th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($selected_pro as $item): ?>
                                                        <tr>
                                                        <td style="display: none">
                                                                <?php echo e($item->products_id); ?>

                                                            </td>
                                                            <td>
                                                                <?php if(isset($item->mainImage) && (!empty($item->mainImage))): ?>
                                                                    <img src="<?php echo e(asset('$item->mainImage')); ?>" alt="<?php echo e($item->products_name); ?>" class="img-responsive" style="max-height: 64px;" />
                                                                <?php else: ?>
                                                                    <img src="<?php echo e(asset('public/dashboard/img/no_image_64x64.jpg')); ?>" alt="<?php echo e($item->products_name); ?>" />
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?php echo e($item->products_name); ?></td>
                                                            <td><?php echo e($item->cat_name); ?></td>
                                                            <td>
                                                                <?php /*<input type="hidden" name="pro_id[]" value="<?php echo e($item->products_id); ?>" />*/ ?>
                                                                <!--<a href="javascript:void(0);" class="text-danger" onclick="removeSupRow(this, '<?php echo e($item->products_id); ?>')"><i class="fa fa-times"></i> Remove</a>-->
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col-6 -->
                                </div>
                            </div>
                            <!-- end wizard step-1 -->
                            <!-- begin wizard step-2 -->
                            <div class="wizard-step-2">
                                <fieldset>
                                    <div id="patientTableheading">
                                        <legend class="pull-left width-full">Add Contact </legend></div>
                                    <!-- begin row -->
                                    <div class="row" id="patientTable">
                                    <div class="col-md-12">
                                <div class="row">
                                <div class="col-md-6" style="margin-bottom:10px;">
								<div class="col-md-9"><div class="col-md-12">
                    <div class="form-group">
                        <label style="margin-top: 6px;margin-left: -31px;" for="p-group" class="col-md-4 control-label">Select Group: </label>
                        <div class="col-md-8">
                        <select style="width: 111%;" id="p-group" class="form-control" onchange="childFormSubmit(2,this.value);">
                            <option value="">Please Select</option>
							<?php if(isset($patientGroup)): ?>
							<?php foreach($patientGroup as $patientGroupPrint): ?>
								<option value="<?php echo e($patientGroupPrint->cg_id); ?>"><?php echo e($patientGroupPrint->name); ?></option>
							<?php endforeach; ?>
							<?php endif; ?>
						</select>
                        </div>
                    </div>
                </div></div><div class="col-md-3">
								<div class="btn btn-success pull-right" id="patient-loader-btn-1"> Add to list
                                <div id="circleG">
    <div id="circleG_1" class="circleG"></div>
    <div id="circleG_2" class="circleG"></div>
    <div id="circleG_3" class="circleG"></div>
</div>
</div>
                                    <input id="patient-btn-1" type="button" onclick="addPatientsList()" class = "btn btn-success pull-right" value="Add to list" />
								</div>
                                
                                </div>
                                    

                                </div>
                                        <!-- begin col-6 -->
                                        <div class="col-md-6">
                                            <div>
                                                <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                                                    <div class="panel-heading">
                                                        <div class="panel-heading-btn">
                                                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                                        </div>
                                                        <h4 class="panel-title">Add Contacts to List</h4>
                                                    </div>
                                                    <div class="panel-body">
                                                        <table id="data-table-patient" class="table table-striped table-hover" width="100%">
                                                            <thead>
                                                            <tr>
                                                                <th>Contact</th>
                            <th></th>
                            <th>email</th>
                            <th>dob</th>
                            <th>primary_phone</th>
                            <th>mailing_street_address</th>
                            <th>billing_street_address</th>
                            
                                                            </tr>
                                                            </thead>
                                                            <tbody>
<!--<?php foreach($patients as $patient): ?>
                            <tr>
                                <td><?php echo e($patient->full_name); ?></td>
                                <td>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="pa_id[]" data-parsley-required="true" value="<?php echo e($patient->pa_id); ?>" <?php echo e(in_array($patient->pa_id, $patient_ids)? 'checked="checked"' : ''); ?>>
                                        </label>
                                    </div>
                                </td>
                                <td><?php echo e($patient->email); ?></td>
                                <td><?php echo e($patient->date_of_birth); ?></td>
                                <td><?php echo e($patient->primary_phone); ?></td>
                                <td><?php echo e($patient->mailing_street_address); ?></td>
                                <td><?php echo e($patient->billing_street_address); ?></td>
                            </tr>
                        <?php endforeach; ?>-->
                                                            </tbody>
                                                        </table>
                                                        <hr/>
                                                        <div class="row">
                                                    <div class="col-md-9"></div>
                                                    <div class="col-md-3">
                                                    <div class="btn btn-success pull-right" id="patient-loader-btn-2"> Add to list
                                <div id="circleG">
    <div id="circleG_1" class="circleG"></div>
    <div id="circleG_2" class="circleG"></div>
    <div id="circleG_3" class="circleG"></div>
</div>
</div>
                                                        <input id="patient-btn-2" type="button" onclick="addPatientsList()" class = "btn btn-success pull-right" value="Add to list" />
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- end col-6 -->
                                        <!-- begin col-6 -->
                                        <div class="col-md-6">
                                            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                                                <div class="panel-heading">
                                                    <div class="panel-heading-btn">
                                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                                    </div>
                                                    <h4 class="panel-title">Selected Contacts</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <table id="selected-table-patient" class="table table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                        <th style="display: none">
                                                                ID
                                                            </th>
                                                            <th>Contact</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
<?php foreach($selected_patients as $patient): ?>
                            <tr>
                            <td style="display: none">
                                                                <?php echo e($item->pa_id); ?>

                                                            </td>
                                <td><?php echo e($patient->full_name); ?></td>
                            </tr>
                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col-6 -->
                                    </div>
                                    <!-- end row -->
                                </fieldset>
                            </div>
                            <!-- end wizard step-2 -->
                            <!-- begin wizard step-3 -->
                            <div>
                            <div class="row">
                            <div class="row" >
                                <div class="col-md-12" id="error-log">
</div>
                            </div>
                                <div class="col-md-10" style="margin-bottom: 10px;">
            <textarea name="productDescription" id="productDescription" class="form-control" rows="3" placeholder="Enter your message" required=""></textarea>
        </div>
        <div class="col-md-2" style="margin-bottom: 10px;">
<div class="btn btn-success pull-right" id="save-grp-btn-loader"> Send
                                <div id="circleG">
    <div id="circleG_1" class="circleG"></div>
    <div id="circleG_2" class="circleG"></div>
    <div id="circleG_3" class="circleG"></div>
</div>
</div>
<input id="save-grp-btn" type="button" onclick="saveGroup()" class="btn btn-success pull-right" value="Send">
</div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <h3>Select Products</h3>
        </hr>
            <table id="selected-table-sup-last" class="table table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                    <th style="display: none">
                                                               ID
                                                            </th>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($selected_pro as $item): ?>
                                                        <tr>
                                                        <td style="display: none">
                                                                <?php echo e($item->products_id); ?>

                                                            </td>
                                                            <td>
                                                                <?php if(isset($item->main_image) && (!empty($item->main_image))): ?>
                                                                    <img src="<?php echo e(asset('public/dashboard/img/sup-img/'.$item->main_image)); ?>" alt="<?php echo e($item->products_name); ?>" class="img-responsive" style="max-height: 64px;" />
                                                                <?php else: ?>
                                                                    <img src="<?php echo e(asset('public/dashboard/img/no_image_64x64.jpg')); ?>" alt="<?php echo e($item->products_name); ?>" />
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?php echo e($item->products_name); ?></td>
                                                            <td><?php echo e($item->cat_name); ?></td>
                                                            <td>
                                                                <?php /*<input type="hidden" name="pro_id[]" value="<?php echo e($item->products_id); ?>" />*/ ?>
                                                                <!--<a href="javascript:void(0);" class="text-danger" onclick="removeSupRow(this, '<?php echo e($item->products_id); ?>')"><i class="fa fa-times"></i> Remove</a>-->
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
        </div>
        <div class="col-md-6">
        <h3>Select Contacts</h3>
        </hr>
            <table id="selected-table-patient-last" class="table table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                        <th style="display: none">
                                                                ID
                                                            </th>
                                                            <th>Contact</th>
                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
<?php foreach($selected_patients as $patient): ?>
                            <tr>
                            <td style="display: none">
                                                                <?php echo e($item->pa_id); ?>

                                                            </td>
                                <td><?php echo e($patient->full_name); ?></td>
                                <td>
                                    <?php /*<input type="hidden" name="pa_id[]" value="<?php echo e($patient->pa_id); ?>" />*/ ?>
                                    <!--<a href="javascript:void(0);" class="text-danger" onclick="removePatientRow(this, '<?php echo e($patient->pa_id); ?>')"><i class="fa fa-times"></i> Remove</a>-->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
        </div>
        <div class="row">
        <div class="col-md-12">
        <div class="col-md-10"></div>
        <div class="col-md-2">
        <!--<img src="/practicetab/public/img/transparent/ajax-loader.gif" id="send-ajax-image" height="25px" />
<input type="button" onclick="saveGroup()" class="btn btn-success pull-right" value="Send">-->
</div>
        </div>
        </div>
        </div>

                            <!-- end wizard step-3 -->
                        </div>
                        <div>
                        <div class="row" id="finalMsg"></div>
                         <div class="row" id="finalmsg2">
        <div class="col-md-6">
        <h3>Selected Products</h3> 
        </hr>
            <table id="selected-table-sup-last-comp" class="table table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th>Name</th>
                                                        <th>Category</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($selected_pro as $item): ?>
                                                        <tr>
                                                            <td>
                                                                <?php if(isset($item->main_image) && (!empty($item->main_image))): ?>
                                                                    <img src="<?php echo e(asset('public/dashboard/img/sup-img/'.$item->main_image)); ?>" alt="<?php echo e($item->products_name); ?>" class="img-responsive" style="max-height: 64px;" />
                                                                <?php else: ?>
                                                                    <img src="<?php echo e(asset('public/dashboard/img/no_image_64x64.jpg')); ?>" alt="<?php echo e($item->products_name); ?>" />
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?php echo e($item->products_name); ?></td>
                                                            <td><?php echo e($item->cat_name); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
        </div>
        <div class="col-md-6">
        <h3>Select Contacts</h3>
        </hr>
            <table id="selected-table-patient-last-comp" class="table table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Contact</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
<?php foreach($selected_patients as $patient): ?>
                        <tr>
                            <td><?php echo e($patient->full_name); ?></td>
                        </tr>
                    <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
        </div>   
                        </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script type="text/javascript">
        var dtSupTable = '';
        var dtPatientTable = '';
        $(function () {
			FormWysihtml5.init();

            var roxyFileman = '<?php echo e(asset('public/dashboard/plugins/fileman_lastest/index.html')); ?>';
            CKEDITOR.replace('productDescription',
                    {
                        filebrowserBrowseUrl:roxyFileman,
                        filebrowserImageBrowseUrl:roxyFileman+'?type=image'
						//, enterMode	: Number(2)
                    });
            dtSupTable = $('#data-table').DataTable({
				
                //responsive: true,
                //"aaSorting": [[1, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}],
				"language": [{"emptyTable": "No data available in table"}]
            });
            dtPatientTable = $('#data-table-patient').DataTable({
                responsive: true,
                "aaSorting": [[1, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,1]},
                {
                "aTargets": [2],
                "visible": false
            }
            ,
                {
                "aTargets": [3],
                "visible": false
            },
                {
                "aTargets": [4],
                "visible": false
            },
                {
                "aTargets": [5],
                "visible": false
            },
                {
                "aTargets": [6],
                "visible": false
            }
                ],"language": [{"emptyTable": "No data available in table"}],
            });

            $('#dt-sup-selected').DataTable({
                responsive: true,
                "aaSorting": [[1, "asc"]],
                "iDisplayLength": 10,
                "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,3]}]
            });

        }); // ready function end
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
$('#save-grp-btn-loader').hide();
$('#supp-loader-btn-2').hide();
    $('#supp-loader-btn-1').hide();
    $('#patient-loader-btn-2').hide();
$('#patient-loader-btn-1').hide();
function uncheckBoxed(tableId,checkId)
        {
tableId = '#'+tableId;
checkId = checkId+'[]';
var i = 0;
var arr = [];
            $(tableId+' > tbody > tr').each(function(){
var nutIds = $(this).find("td:first").text();
$('input[name="'+checkId+'"]').each(function(){
                var checkvalue = this.value;
if(checkvalue==nutIds){
arr[i] = checkvalue;
i++;
$(this).attr('checked', true);
}
else
{
if(jQuery.inArray( checkvalue , arr )== -1)
{
$(this).attr('checked', false);
}
}
            });
            });
        }
        function wizPrev()
        {
            $('.bwizard-buttons > li[class="previous"] > a').click();
        }
        function wizNext()
        {
            $('.bwizard-buttons > li[class="next"] > a').click();
        }
        $("#frm-suggestions").on('submit', function(e){

            var supChkCount = 0;

            // Iterate over all checkboxes in the table
            dtSupTable.$('input[name="pro_id[]"]').each(function(){
                // If checkbox doesn't exist in DOM
                if(!$.contains(document, this)){
                    // If checkbox is checked
                    if(this.checked){
                        // Create a hidden element
                        $("#frm-suggestions").append(
                                $('<input>')
                                        .attr('type', 'hidden')
                                        .attr('name', this.name)
                                        .val(this.value)
                        );
                    }
                }

                if(this.checked){
                    supChkCount = supChkCount+1;
                }
            });

            if(supChkCount==0){
                $('.msg').html('<div class="alert alert-warning"><strong>Please select at least one supplement.</strong></div>').show().delay(5000).hide('slow');
                return false;
            }
        });
        $('#wizlist > li').click(function (event) {
            if ($(event.target).closest('li').is(this)) {
                if($(this).hasClass("active"))
                {
                    $('.arrow').removeClass('arrowActive').addClass("arrowNormal");
                    $('.arrow').removeClass('arrowNotActive').addClass("arrowNormal");
                    $('.arrow').removeClass('arrowNormal').addClass("arrowNormal");
                    $(this).next('span').addClass("arrowActive");
                }
                else
                {
                    $('.arrow').removeClass('arrowActive').addClass("arrowNormal");
                    $('.arrow').removeClass('arrowNotActive').addClass("arrowNormal");
                    $('.arrow').removeClass('arrowNormal').addClass("arrowNormal");
                    $(this).next('span').addClass("arrowActive");
                }
            }
        });
        $('#wizlist > li').hover(function (event) {
            if ($(event.target).closest('li').is(this)) {
                if(!$(this).hasClass("active"))
                {
                    //$('.arrow').removeClass('arrowNormal');
                    $(this).next('span').removeClass('arrowNormal');
                    $(this).next('span').addClass("arrowNotActive");
                }
            }
        });
        $('#wizlist > li').mouseleave(function (event) {
            if ($(event.target).closest('li').is(this)) {
                if(!$(this).hasClass("active"))
                {
                    //$('.arrow').removeClass('arrowActive');
                    $(this).next('span').removeClass('arrowNotActive');
                    $(this).next('span').addClass("arrowNormal");
                }
            }
        });
        $(document).ready(function() {
            $('.bwizard-buttons > li > a').click(function (event) {
                var anchorText = $(this).text();
                if (anchorText.toLowerCase().indexOf("next") >= 0)
                {
                    if($(this).parent().hasClass('next disabled')) return;
                }
                else if (anchorText.toLowerCase().indexOf("previous") >= 0)
                {
                    if($(this).parent().hasClass('previous disabled')) return;
                }
                $('#wizlist > li').each(function( index ) {

                    
                    if($(this).hasClass("active"))
                    {
                        $('.arrow').removeClass('arrowActive').addClass("arrowNormal");
                        $('.arrow').removeClass('arrowNotActive').addClass("arrowNormal");
                        $('.arrow').removeClass('arrowNormal').addClass("arrowNormal");
                        if (anchorText.toLowerCase().indexOf("next") >= 0)
                        {
                            $(this).next().next().next().addClass("arrowActive");
                        }
                        else if (anchorText.toLowerCase().indexOf("previous") >= 0)
                        {
                            $(this).prev().prev().next().addClass("arrowActive");
                        }
                    }
                });
            });

<?php if(isset($_GET['pa_id'])) { ?>
    var getvalue = <?php echo $_GET['pa_id']; ?>;
            $('input[name="pa_id[]"]').each(function(){
                
if($(this).val()==getvalue){
$(this).prop('checked', true);
}
addPatientsList();
            });
           <?php } ?>
        });
function checkRows(tableId)
{
    var rowCount = $('#'+tableId+' tbody tr').length;
    return rowCount;
}



function addSuppementsList()
{
    $('#supp-btn-1').hide();
    $('#supp-btn-2').hide();
    $('#supp-loader-btn-2').show();
    $('#supp-loader-btn-1').show();
    var searchData = customSearch('data-table','',-1);
    var form_data = $('#form-wizard').serializeArray();
    var appender = '';
    $.ajax({
        type: "POST",
        data: form_data,
        url: '<?php echo e(URL::to('/practitioner/suggestion/add-pro-wizz')); ?>',
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (result) {
            $("#selected-table-sup").empty();
            $("#selected-table-sup-last").empty();
            $("#selected-table-sup-last-comp").empty();
			if(result==""){$('#supp-btn-1').show();$('#supp-btn-2').show();$('#supp-loader-btn-2').hide();$('#supp-loader-btn-1').hide();customSearch('data-table',searchData,10);return;}
            var mainsplit = result.split('|');
            for(var i = 0;i<mainsplit.length;i++)
            {
                var childsplit = mainsplit[i].split(',');
                var imgPath = '<?php echo e(asset('')); ?>';
                imgPath+= '/'+childsplit[0];
                var imgAppend = '<img src="'+imgPath+'" ';
                imgAppend += 'alt="<?php echo e($item->products_name); ?>" class="img-responsive" style="max-height: 64px;" />';
                appender+='<tr>';
                appender+='<td style="display: none">'+childsplit[3]+'</td>';
                appender+='<td>'+imgAppend+'</td>';
                appender+='<td>'+childsplit[1]+'</td>';
                appender+='<td>'+childsplit[2]+'</td>';
                //appender+='<td>';
                //appender+='<a href="javascript:void(0);" class="text-danger" onclick="removeSupRow(this, '+childsplit[3]+')"><i class="fa fa-times"></i> Remove</a>';
                //appender+='</td>';
                appender+='</tr>';
            }
            var thead = '<thead>';
            thead+='<tr>';
            thead+='<th style="display: none">ID</th>';
            thead+='<th>Image</th>';
            thead+='<th>Name</th>';
            thead+='<th>Category</th>';
            //thead+='<th></th>';
            thead+='</tr>';
            thead+='</thead>';
            $("#selected-table-sup").append(thead);
            $("#selected-table-sup").append(appender);
            $("#selected-table-sup-last").append(thead);
            $("#selected-table-sup-last").append(appender);
            $("#selected-table-sup-last-comp").append(thead);
            $("#selected-table-sup-last-comp").append(appender);
$('#supp-btn-1').show();
    $('#supp-btn-2').show();
    $('#supp-loader-btn-2').hide();
    $('#supp-loader-btn-1').hide();
    customSearch('data-table',searchData,10);
        },
        error:function (error) {
            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
$('#supp-btn-1').show();
    $('#supp-btn-2').show();
    $('#supp-loader-btn-2').hide();
    $('#supp-loader-btn-1').hide();
    customSearch('data-table',searchData,10);
        }
    });
}
        function addPatientsList()
{
    $('#patient-loader-btn-2').show();
$('#patient-loader-btn-1').show();
$('#patient-btn-2').hide();
$('#patient-btn-1').hide();
    var searchData = customSearch('data-table-patient','',-1);
    var form_data = $('#form-wizard').serializeArray();
    var appender = '';
    $.ajax({
        type: "POST",
        data: form_data,
        url: '<?php echo e(URL::to('/practitioner/suggestion/add-pro-patient-wizz')); ?>',
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (result) {
            $("#selected-table-patient").empty();
            $("#selected-table-patient-last").empty();
            $("#selected-table-patient-last-comp").empty();
            var mainsplit = result.split('|');
            for(var i = 0;i<mainsplit.length;i++)
            {
                var childsplit = mainsplit[i].split(',');
                appender+='<tr>';
                appender+='<td style="display: none">'+childsplit[1]+'</td>';
                appender+='<td>'+childsplit[0]+'</td>';
                //appender+='<td>';
                //appender+='<a href="javascript:void(0);" class="text-danger" onclick="removePatientRow(this, '+childsplit[1]+')"><i class="fa fa-times"></i> Remove</a>';
                //appender+='</td>';
                appender+='</tr>';
            }
            var thead = '<thead>';
            thead+='<tr>';
            thead+='<th style="display: none">ID</th>';
            thead+='<th>Patient</th>';
            //thead+='<th></th>';
            thead+='</tr>';
            thead+='</thead>';
            $("#selected-table-patient").append(thead);
            $("#selected-table-patient").append(appender);
            $("#selected-table-patient-last").append(thead);
            $("#selected-table-patient-last").append(appender);
            $("#selected-table-patient-last-comp").append(thead);
            $("#selected-table-patient-last-comp").append(appender);
            $('#patient-loader-btn-2').hide();
$('#patient-loader-btn-1').hide();
$('#patient-btn-2').show();
$('#patient-btn-1').show();
customSearch('data-table-patient',searchData,10);
        
        },
        error:function (error) {
            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
            $('#patient-loader-btn-2').hide();
$('#patient-loader-btn-1').hide();
$('#patient-btn-2').show();
$('#patient-btn-1').show();
customSearch('data-table-patient',searchData,10);
        }
    });
}
$('#finalmsg2').hide();
$('#finalmsg').hide();

function saveGroup()
        {
            if(checkRows('selected-table-sup')<= 0|| checkRows('selected-table-patient') <=0)
            {
                $('#error-log').html('');
                var errorApp = '';
                    errorApp+='<div class="alert alert-danger fade in m-b-15">';
                               errorApp+=' <strong>Error!</strong>';
                                errorApp+=' Please Select atleast one patient and suggestion.';
                                errorApp+='<span class="close" data-dismiss="alert">×</span>';
                            errorApp+='</div>';
                $('#error-log').append(errorApp);
                $('#error-log').show().delay(5000).hide('slow');
            return;
            }
            $('#save-grp-btn').hide();
            $('#save-grp-btn-loader').show();
            var form_data = $('#form-wizard').serializeArray();
			form_data.push({name : 'ourTest', value : CKEDITOR.instances.productDescription.getData()});
			//console.log(jQuery.inArray("productDescription",form_data));
			
			// form_data.set('productDescription',CKEDITOR.instances.productDescription.getData());
            $.ajax({
                type: "POST",
                data: form_data,
                url: '<?php echo e(URL::to('/practitioner/suggestion/save-pro-wiz')); ?>',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
					$('.bwizard-buttons > li[class="next"] > a').click();
                    $('#finalMsg').html('');
                    var appender = '';
                    appender+='<div class="alert alert-success fade in m-b-15">';
                               appender+=' <strong>Success!</strong>';
                                appender+=' Products Sent to these patients Successfully.';
                                appender+='<span class="close" data-dismiss="alert">×</span>';
                            appender+='</div>';
                    $('#finalMsg').html(appender);
                    $('#finalMsg').show();//.delay(5000).hide('slow');
                    $('#finalmsg2').show();//.delay(5000).hide('slow');
                    //$("#tableID th:last-child, #tableID td:last-child").remove();
                    //$("#selected-table-patient-last-comp th:last-child, #selected-table-patient-last-comp td:last-child").remove();
                    //$("#selected-table-sup-last-comp th:last-child, #selected-table-sup-last-comp td:last-child").remove();
                    //location.reload();
                   /* $("#selected-table-sup").empty();
            $("#selected-table-sup-last").empty();
            $("#selected-table-sup-last-comp").empty();
             $("#selected-table-patient").empty();
            $("#selected-table-patient-last").empty();
            $("#selected-table-patient-last-comp").empty();*/
            $("textarea[name=productDescription]").val('');
            $('#save-grp-btn').show();
            $('#save-grp-btn-loader').hide();
                },
                error:function (error) {
                    $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    $('#send-ajax-image').hide();
                    $('#save-grp-btn').show();
            $('#save-grp-btn-loader').hide();
                }
            });
        }
		function childFormSubmit(types,cg_ids)
		{
			$.ajax({
			type    : "POST",
			data    : { type: types,cg_id:cg_ids },
			async:true,
			url     : '<?php echo e(URL::to('/practitioner/suggestion/groupData')); ?>',
			beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
			success: function (result) {
				if(types==1){
					$("#data-table").empty();
					var mainsplit = result.split('|');
					var appender;
					for(var i = 0;i<mainsplit.length;i++)
					{
						var childsplit = mainsplit[i].split(',');
						if(childsplit[1]!=""){
						if (typeof childsplit[1] === "undefined") {}else{
						appender+='<tr>';
						var imgPath = '<?php echo e(asset('')); ?>';
						imgPath+= '/'+childsplit[0];
						var imgAppend = '<img src="'+imgPath+'"';
						imgAppend += 'alt="'+childsplit[1]+'" class="img-responsive" style="max-height: 64px;" />';
						appender+='<td>'+imgAppend+'</td>';
						appender+='<td>'+childsplit[1]+'</td>';
						appender+='<td>'+childsplit[2]+'</td>';
						appender+='<td>'+childsplit[4]+'</td>';
						appender+='<td><div class="checkbox"><label><input type="checkbox" name="pro_id[]" data-parsley-required="true" value="'+childsplit[3]+'"></label></div></td>';
						appender+='</tr>';
						}
					}}
					var thead = '<thead>';
					thead+='<tr>';
					thead+='<th>Image</th>';
					thead+='<th>Name</th>';
					thead+='<th>Supplier</th>';
					thead+='<th>Category</th>';
					thead+='<th></th>';
					thead+='</tr>';
					thead+='</thead>';
					$("#data-table").append(thead);
					$("#data-table").append(appender);
				}
				if(types==2){
					$("#data-table-patient").empty();
            var mainsplit = result.split('|');
			var appender;
            for(var i = 0;i<mainsplit.length;i++)
            {
                var childsplit = mainsplit[i].split(',');
				if(childsplit[0]!=""){
                appender+='<tr>';
                //appender+='<td style="display: none">'+childsplit[1]+'</td>';
                appender+='<td>'+childsplit[0]+'</td>';
				appender+='<td><div class="checkbox"><label><input type="checkbox" name="pa_id[]" data-parsley-required="true" value="'+childsplit[1]+'"></label></div></td>';
				appender+='<td style="display:none">'+childsplit[2]+'</td>';
				appender+='<td style="display:none">'+childsplit[3]+'</td>';
				appender+='<td style="display:none">'+childsplit[4]+'</td>';
				appender+='<td style="display:none">'+childsplit[5]+'</td>';
				appender+='<td style="display:none">'+childsplit[6]+'</td>';
                appender+='</tr>';
				}
            }
            var thead = '<thead>';
            thead+='<tr>';
			thead+='<th>Patient</th>';
            thead+='<th></th>';
            thead+='<th style="display:none">email</th>';
            thead+='<th style="display:none">dob</th>';
            thead+='<th style="display:none">primary_phone</th>';
            thead+='<th style="display:none">mailing_street_address</th>';
            thead+='<th style="display:none">billing_street_address</th>';
			thead+='</tr>';
            thead+='</thead>';
            $("#data-table-patient").append(thead);
            $("#data-table-patient").append(appender);
				}
			},
			error:function (error) {
				//dtSupTable.clear().draw();
				//dtPatientTable.clear().draw();
			}
			});
			return false;
		}
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>