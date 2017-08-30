<?php $__env->startSection('sidebar'); ?>
<?php echo $__env->make('layouts.manage-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="<?php echo e(url('/practitioner')); ?>">Dashboard</a></li>
    <li><a href="<?php echo e(url('/practitioner/patient/new')); ?>">Contact</a></li>
    <li class="active">Edit</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Edit Contact Details <small></small></h1>
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
                <h4 class="panel-title">Edit Details</h4>
            </div>
            <div class="panel-body">
                <?php echo Form::model($table1, array('url'=>'/practitioner/patient/update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')); ?>


                <?php echo Form::hidden('pa_id'); ?>

                <?php echo Form::hidden('photo'); ?>


                <div><h4>Personal Information</h4>
                    <hr/>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <?php echo Form::label('photo','Change Photo :', array('class'=>'col-md-3 control-label')); ?>

                            <div class="col-md-9">
                                <?php echo Form::file('photo', array('class'=>'form-control', 'accept'=>'image/*')); ?>

                            </div>
                        </div>
                    </div>
<div class="col-md-6 col-md-offset-3">
    <img src="<?php echo e(asset('public/images/practitioners/'.$table1->photo)); ?>" alt="<?php echo e($table1->photo); ?>" class="img-responsive" style="max-height: 64px;" />
	<!--<img src="<?php echo e(asset('public/images/'. $directory .'/'.$table1->photo)); ?>" alt="<?php echo e($table1->photo); ?>" class="img-responsive" style="max-height: 64px;" />-->

</div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('first_name','First Name *:', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=> 'First Name', 'data-parsley-required'=>'true')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('middle_name','Middle Name *:', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('middle_name', null, array('class'=>'form-control', 'placeholder'=> 'Last Name', 'data-parsley-required'=>'true')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('last_name','Last Name *:', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=> 'Last Name', 'data-parsley-required'=>'true')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('email','eMail *:', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('email', null, array('class'=>'form-control', 'placeholder'=> 'eMail address', 'data-parsley-required'=>'true', 'data-parsley-type'=>'email')); ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('primary_phone','Primary Phone *:', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('primary_phone', null, array('class'=>'form-control', 'placeholder'=> 'Primary Phone', 'data-parsley-required'=>'true')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('secondary_phone','Secondary Phone:', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('secondary_phone', null, array('class'=>'form-control', 'placeholder'=> 'Secondary Phone')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('date_of_birth','Birth Date :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('date_of_birth', null, array('class'=>'form-control', 'placeholder'=> 'Birth date')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('age','Age :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('age', null, array('class'=>'form-control', 'placeholder'=> 'Age ')); ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h4>Mailing Information</h4>    <hr/></div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('mailing_street_address','Street Address :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('mailing_street_address', null, array('class'=>'form-control', 'placeholder'=> 'Street address')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('mailing_zip','ZIP :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('mailing_zip', null, array('class'=>'form-control', 'placeholder'=> 'ZIP')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('mailing_city','City :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('mailing_city', null, array('class'=>'form-control', 'placeholder'=> 'City/Town Name')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('mailing_state','State :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::select('mailing_state',array(
""=>"Select",
"AL"=>"Alabama",
"AK"=>"Alaska",
"AZ"=>"Arizona",
"AR"=>"Arkansas",
"CA"=>"California",
"CO"=>"Colorado",
"CT"=>"Connecticut",
"DE"=>"Delaware",
"DC"=>"District Of Columbia",
"FL"=>"Florida",
"GA"=>"Georgia",
"HI"=>"Hawaii",
"ID"=>"Idaho ",
"IL"=>"Illinois",
"IN"=>"Indiana",
"IA"=>"Iowa",
"KS"=>"Kansas",
"KY"=>"Kentucky",
"LA"=>"Louisiana",
"ME"=>"Maine",
"MD"=>"Maryland",
"MA"=>"Massachusetts",
"MI"=>"Michigan",
"MN"=>"Minnesota",
"MS"=>"Mississippi",
"MO"=>"Missouri",
"MT"=>"Montana",
"NE"=>"Nebraska",
"NV"=>"Nevada",
"NH"=>"New Hampshire",
"NJ"=>"New Jersey",
"NM"=>"New Mexico",
"NY"=>"New York",
"NC"=>"North Carolina",
"ND"=>"North Dakota",
"OH"=>"Ohio",
"OK"=>"Oklahoma",
"OR"=>"Oregon",
"PA"=>"Pennsylvania",
"RI"=>"Rhode Island",
"SC"=>"South Carolina",
"SD"=>"South Dakota",
"TN"=>"Tennessee",
"TX"=>"Texas",
"UT"=>"Utah",
"VT"=>"Vermont",
"VA"=>"Virginia",
"WA"=>"Washington",
"WV"=>"West Virginia",
"WI"=>"Wisconsin",
"WY"=>"Wyoming"
),$table1->mailing_state ,array('class'=>'form-control')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Billing Information</h4>    <hr/></div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('billing_street_address','Street Address :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('billing_street_address', null, array('class'=>'form-control', 'placeholder'=> 'Street address')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('billing_zip','ZIP :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('billing_zip', null, array('class'=>'form-control', 'placeholder'=> 'ZIP')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('billing_city','City :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('billing_city', null, array('class'=>'form-control', 'placeholder'=> 'City/Town Name')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('billing_state','State :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::select('billing_state',array(
""=>"Select",
"AL"=>"Alabama",
"AK"=>"Alaska",
"AZ"=>"Arizona",
"AR"=>"Arkansas",
"CA"=>"California",
"CO"=>"Colorado",
"CT"=>"Connecticut",
"DE"=>"Delaware",
"DC"=>"District Of Columbia",
"FL"=>"Florida",
"GA"=>"Georgia",
"HI"=>"Hawaii",
"ID"=>"Idaho ",
"IL"=>"Illinois",
"IN"=>"Indiana",
"IA"=>"Iowa",
"KS"=>"Kansas",
"KY"=>"Kentucky",
"LA"=>"Louisiana",
"ME"=>"Maine",
"MD"=>"Maryland",
"MA"=>"Massachusetts",
"MI"=>"Michigan",
"MN"=>"Minnesota",
"MS"=>"Mississippi",
"MO"=>"Missouri",
"MT"=>"Montana",
"NE"=>"Nebraska",
"NV"=>"Nevada",
"NH"=>"New Hampshire",
"NJ"=>"New Jersey",
"NM"=>"New Mexico",
"NY"=>"New York",
"NC"=>"North Carolina",
"ND"=>"North Dakota",
"OH"=>"Ohio",
"OK"=>"Oklahoma",
"OR"=>"Oregon",
"PA"=>"Pennsylvania",
"RI"=>"Rhode Island",
"SC"=>"South Carolina",
"SD"=>"South Dakota",
"TN"=>"Tennessee",
"TX"=>"Texas",
"UT"=>"Utah",
"VT"=>"Vermont",
"VA"=>"Virginia",
"WA"=>"Washington",
"WV"=>"West Virginia",
"WI"=>"Wisconsin",
"WY"=>"Wyoming"
             ),$table1->billing_state , array('class'=>'form-control')); ?>


                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h4>Credit Card Information</h4>    <hr/></div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('cc_type','Card Type:', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::select('cc_type',array(
""=>"Select",
"visa"=>"Visa",
"mastercard"=>"Mastercard",
"discovery"=>"Discovery",
"maestro"=>"Maestro",
),$table1->cc_type , array('class'=>'form-control')); ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('cc_number','Card Number :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('cc_number', null, array('class'=>'form-control', 'placeholder'=> 'Card Number')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('cc_month','Expiry Month :', array('class'=>'col-md-6 control-label')); ?>

                        <div class="col-md-6">
                            <?php echo Form::select('cc_month',array(
      "" =>"Month",
"01"=>"01",
"02"=>"02",
"03"=>"03",
"04"=>"04",
"05"=>"05",
"06"=>"06",
"07"=>"07",
"08"=>"08",
"09"=>"09",
"10"=>"10",
"11"=>"11",
"12"=>"12"
      ),$table1->cc_month ,array('class'=>'form-control')); ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('cc_year','Expiry Year :', array('class'=>'col-md-6 control-label')); ?>

                        <div class="col-md-6">
                            <?php echo Form::select('cc_year',array(
    "" =>"Year",
"2016"=>"2016",
"2017"=>"2017",
"2018"=>"2018",
"2019"=>"2019",
"2020"=>"2020",
"2021"=>"2021",
"2022"=>"2022",
"2023"=>"2023",
"2024"=>"2024",
"2025"=>"2025",
"2026"=>"2026",
"2027"=>"2027",
"2028"=>"2028",
"2029"=>"2029",
"2030"=>"2030",
"2031"=>"2031",
"2032"=>"2032",
"2033"=>"2033",
"2034"=>"2034",
"2035"=>"2035",
"2036"=>"2036",
"2037"=>"2037",
"2038"=>"2038",
"2039"=>"2039"
      ),$table1->cc_year , array('class'=>'form-control')); ?>

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('cc_cvv','CVV :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::text('cc_cvv', null, array('class'=>'form-control', 'placeholder'=> 'CVV Number')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Additional Information</h4>    <hr/></div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo Form::label('notes','Notes :', array('class'=>'col-md-3 control-label')); ?>

                        <div class="col-md-9">
                            <?php echo Form::textarea('notes', null, array('class'=>'form-control', 'placeholder'=> 'Add Note')); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php echo Form::submit('Save', array('class'=>'btn btn-success pull-right')); ?>

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

<?php $__env->startSection('page-scripts'); ?>
<script language="JavaScript/text">

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>