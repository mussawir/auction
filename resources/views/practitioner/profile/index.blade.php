
@extends('layouts.pradash')
@section('sidebar')
@include('layouts.profile-sidebar')
@endsection
@section('content')

<style>

/*============================================
internal-css-for-practitioner-account-satting
=============================================*/

::-webkit-input-placeholder {
   text-transform:capitalize;
}

select.form-control {
    text-transform: capitalize;
}

.prac-profile-form-main-div-wrapper
{
    padding: 0px 0px;
}

/*section-1-css=open*/

.profile-update-form-sec-1-main-wrapper
{
    padding: 0px 0px;
}

.proflie-form-sec-1-top-heading
{
    padding: 0px 0px;
}

.profile-update-sec-1-lable p
{
    font-size: 14px;
    margin: 0px;
    text-align: left;
    padding-top: 4%;
    text-transform: capitalize;
	margin:12px 0px;
}

.profile-update-sec-1-input-outter-wrapper
{
    padding: 0px 12px;
	margin:12px 0px;
}

.form-radio-btn-main-div p {
    display: inline-block;
    font-size: 15px;
    text-transform: uppercase;
    padding-left: 10px;
    font-weight: bold;
    padding-top: 0px;
    margin: 0px;
}

.form-radio-btn-main-div p input[type='radio'] {
    width: 20px;
    height: 20px;
    position: relative;
    top: 5px;
    margin: 0px;
}

/*section-2-css-open*/


.profile-update-form-sec-2-main-wrapper
{
    padding: 0px 0px;
}

.proflie-form-sec-2-top-heading
{
    padding: 0px 0px;
}

.profile-update-sec-2-lable p
{
    font-size: 14px;
    margin: 0px;
    text-align: left;
    padding-top: 4%;
    text-transform: capitalize;
	margin:12px 0px;
}

.profile-update-sec-2-input-outter-wrapper
{
    padding: 0px 12px;
	margin:3px 0px;
}


.sec-2-start-end-lable
{
   padding-left: 16.5%;
}

.sec-2-start-end-lable p {
    text-align: center;
}
.sec-2-day-select-tag p
{
       text-align: center;
	   margin:3px  0px ;
}

.dash-sec-2 hr {
    border: 1px solid #CCD0D4;
    width: 50%;
}

/*section-3-css=open*/

.profile-update-form-sec-3-main-wrapper
{
    padding: 4% 0px 0px 0px;
}

.proflie-form-sec-3-top-heading
{
    padding: 0px 0px;
}

.profile-update-sec-3-lable {
    padding: 0px 0px;
}

.profile-update-sec-3-lable p
{
    font-size: 14px;
    margin: 0px;
    text-align: left;
    padding-top: 4%;
    text-transform: capitalize;
	margin:12px 0px;
}

.profile-update-sec-3-input-outter-wrapper
{
    padding: 0px 0% 0px 11%;
	margin:12px 0px;
}

/*section-4-css=open*/

.profile-update-form-sec-4-main-wrapper
{
    padding: 0px 0px;
}

.proflie-form-sec-4-top-heading
{
    padding: 0px 0px;
    text-transform:capitalize;
}

.profile-update-sec-4-lable p
{
    font-size: 14px;
    margin: 0px;
    text-align: left;
    padding-top: 4%;
    text-transform: capitalize;
	margin:4px 0px;
	padding-left: 35%;
}

.profile-update-sec-4-input-outter-wrapper
{
    padding: 0px 0% 0px 11%;
	margin:4px 0px;
}

/*section-5-css=open*/

.profile-update-form-sec-5-main-wrapper
{
    padding: 0px 0px;
}

.proflie-form-sec-5-top-heading
{
    padding: 0px 0px;
}

.profile-update-sec-5-lable p
{
    font-size: 14px;
    margin: 0px;
    text-align: left;
    padding-top: 4%;
    text-transform: capitalize;
	margin:12px 0px;
}

.profile-update-sec-5-input-outter-wrapper
{
    padding: 0px 0% 0 2.5%;
	margin:12px 0px;
}

.form-radio-btn-main-div p {
    display: inline-block;
    font-size: 15px;
    text-transform: uppercase;
    padding-left: 10px;
    font-weight: bold;
    padding-top: 0px;
    margin: 0px;
}


</style>


        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/profile')}}">Update Profile</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Update Profile Details </h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-12">
	
	<div class="msg" id="msg">
            @if(Session::has('success'))
                <div class="alert alert-success fade in">
                    <strong>Success!</strong>
                    <strong>{{Session::pull('success')}}</strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger fade in">
                    <strong>Error!</strong>
                    <strong>{{Session::pull('error')}}</strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            @endif
			<?php if(isset($_GET['type'])&&$_GET['type']=='error') {?>
			<div class="alert alert-danger fade in">
                    <strong>Error!</strong>
                    <strong>Please set your store first.</strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
			<?php } ?>
        </div>
	
        <div class="msg">
            @if(Session::has('success'))
                <div class="alert alert-success fade in">
                    <strong>Success!</strong>
                    <strong>{{Session::pull('success')}}</strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            @elseif(Session::has('error'))
                <div class="alert alert-danger fade in">
                    <strong>Error!</strong>
                    <strong>{{Session::pull('error')}}</strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            @endif
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
                <h4 class="panel-title">Profile Setup</h4>
            </div>
            <div class="panel-body">
                {!! Form::model($table1,

				array('url'=>'/practitioner/profile/update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'id'=>'formid' , 'files'=>true ))  !!}

                {!! Form::hidden('pa_id') !!}
                {!! Form::hidden('photo') !!}
				
				<!--==============open========================-->
				
				
			<div class="col-md-12 prac-profile-form-main-div-wrapper"><!--prac-profile-form-main-div-wrapper-open-->
			
			<div class="col-md-12 profile-update-form-sec-1-main-wrapper"><!--profile-update-form-sec-1-main-wrapper-div-open-->
			
			    <div class="col-md-12 proflie-form-sec-1-top-heading"><!--proflie-form-sec-1-top-heading-div-open-->
				 
				    <h4>Practitioner Info</h4>
                    <hr/>
					
                </div><!--proflie-form-sec-1-top-heading-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>Photo :</p></div><!--input-lable-div--->
				
                <div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-1-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::file('photo', array('class'=>'form-control', 'accept'=>'image/*' ,'placeholder' => 'Upload Profile Photo')) !!}
                        </div>
                    </div>
                </div><!--input-1-sec-1-outter-wrapper-div-close-->
				
				   <div class="col-md-2 profile-update-sec-1-lable"><p>name :</p></div><!--input-lable-div--->
				
				  <div class="col-md-3 profile-update-sec-1-input-outter-wrapper"><!--input-2-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=> 'First*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div><!--input-2-sec-1-outter-wrapper-div-close-->
				
                <div class="col-md-2 profile-update-sec-1-input-outter-wrapper"><!--input-3-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('middle_name', null, array('class'=>'form-control', 'placeholder'=> 'MI')) !!}
                        </div>
                    </div>
                </div><!--input-3-sec-1-outter-wrapper-div-close-->
				
                <div class="col-md-3 profile-update-sec-1-input-outter-wrapper"><!--input-4-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=> 'Last*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div><!--input-4-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-input-outter-wrapper"><!--input-5-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('suffix', null, array('class'=>'form-control', 'placeholder'=> 'suffix')) !!}
                        </div>
                    </div>
                </div><!--input-5-sec-1-outter-wrapper-div-open-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>Clinic Name :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-6-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_name', null,
							array('class'=>'form-control ', 'placeholder'=>
							'Office/Clinic Name *', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div><!--input-6-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>Clinic Address :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-7-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_street_address', null, array('class'=>'form-control clinic-address', 'placeholder'=> 'Office/Clinic address *', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div><!--input-7-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable empty-div-replace-labe"><p></p></div><!--input-lable-empty-div--->
				
				<div class="col-md-4 profile-update-sec-1-input-outter-wrapper"><!--input-8-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_city', null, array('class'=>'form-control', 'placeholder'=> 'City*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div><!--input-8-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-3 profile-update-sec-1-input-outter-wrapper"><!--input-9-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_state', null, array('class'=>'form-control state ', 'placeholder'=> 'State*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div><!--input-8-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-3 profile-update-sec-1-input-outter-wrapper"><!--input-9-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_zip', null, array('class'=>'form-control zip-code', 'placeholder'=> 'Zip code*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div><!--input-9-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>Phone :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-10-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-5">
                            {!! Form::text('primary_phone', null, array('class'=>'form-control     cell-no', 'placeholder'=> 'Clinic/Office*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div><!--input-10-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>Email :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-11-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::email('clinic_email', null, array('class'=>'form-control', 'placeholder'=> 'Office / Clinic *', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div><!--input-11-sec-1-outter-wrapper-div-open-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>website :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-12-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('website_url',$table2['website_url'], array('class'=>'form-control',
                             'placeholder'=> ' www.Example.com'	)) !!}
                        </div>
                    </div>
                </div><!--input-12-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>Gender :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-13-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-3 form-radio-btn-main-div">
						
                        <p>
                         <input type="radio" name="Gender"  class="form-control"  value="0"
                         <?php if (isset($table1['Gender']) && $table1['Gender']=="0") echo "checked";?>  >
						   
						   </p>
							
							<p>male</p>
                        </div>
						<div class="col-md-3 form-radio-btn-main-div dropdown-toggle">
                            <p>
							
						<input type="radio" name="Gender" class="form-control" value="1"
							<?php if (isset($table1['Gender']) && $table1['Gender']=="1") echo "checked";?> >
							   
							   </p>
							<p>female</p>
							
							
							
                        </div>
                    </div>
                </div><!--input-13-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>N.P.I :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-12-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::text('N.I.P', $table2['N.I.P'], array('class'=>'form-control','placeholder'=> 'National Provider ID #*', 'required' => 'required' )) !!}
                        </div>
                    </div>
                </div><!--input-12-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>type :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-13-sec-1-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-6">
                            {!! Form::select('Type',
						     array(
                             $table2['Type'] => $table2['Type'],
							 "Anesthesiologist"=>"Anesthesiologist",
							 "Adolescent medicine specialist"=>"Adolescent medicine specialist",
							 "Cardiologist"=>"Cardiologist",
							 "Hyperbaric physician"=>"Hyperbaric physician",
							 "Neurological surgeon"=>"Neurological surgeon",
							), $table2['Type'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'Select your Designation', )) !!}
                        </div>
                    </div>
                </div><!--input-13-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>Specialty :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-14-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('specialties', $table2['specialties'], array('class'=>'form-control','placeholder'=> 'Ex: Pediatric, Geriatric, Family practice, headaches, etc.', )) !!}
                        </div>
                    </div>
                </div><!--input-14-sec-1-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-1-lable"><p>Description :</p></div><!--input-lable-div--->
				
				<div class="col-md-10 profile-update-sec-1-input-outter-wrapper"><!--input-14-sec-1-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::textarea('about', $table2['about'],  array('class'=>'form-control','placeholder'=> 'Tell people about yourself and your practice', )) !!}
                        </div>
                    </div>
                </div><!--input-14-sec-1-outter-wrapper-div-close-->
					 
				
				
		    </div><!--profile-update-form-sec-1-main-wrapper-div-close-->


            <div class="col-md-12 profile-update-form-sec-2-main-wrapper"><!--profile-update-form-sec-2-main-wrapper-div-open-->
			
			   <div class="col-md-12 proflie-form-sec-2-top-heading"><!--proflie-form-sec-2-top-heading-div-open-->
				 
				    <h4>Office Hours</h4>
                    <hr/>
					
                </div><!--proflie-form-sec-2-top-heading-div-close-->
				
				<div class="col-md-12 sec-2-start-end-lable"><!--days-tag-wrapper-open-->
				
				  <div class="col-md-3 profile-update-sec-2-lable"><p>Start</p></div>
				  <div class="col-md-1 profile-update-sec-2-lable empty-div-replace-labe"><p></p></div><!--input-lable-empty-div--->
				  <div class="col-md-3 profile-update-sec-2-lable"><p>end</p></div>
				  
				</div><!--days-tag-wrapper-close-->
				<div class="col-md-2 profile-update-sec-2-lable sec-2-day-select-tag"><p>monday</p></div><!--input-lable-div--->
				
				
				<div class="col-md-10 profile-update-sec-2-input-outter-wrapper"><!--input-1-sec-2-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-3">
                            {!! Form::select('monday_open',
							
							array(
                          $table3['monday_open'] => $table3['monday_open'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['monday_open'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
						
						<div class="col-md-1 dash-sec-2"><hr></div> 
						
						<div class="col-md-3">
                            {!! Form::select('monday_close',
							
							array(
                          $table3['monday_close'] => $table3['monday_close'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['monday_close'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
                    </div>
                </div><!--input-1-sec-2-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-2-lable sec-2-day-select-tag"><p>Tuesday</p></div><!--input-lable-div--->
				
				
				<div class="col-md-10 profile-update-sec-2-input-outter-wrapper"><!--input2-sec-2-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-3">
                              {!! Form::select('tuesday_open',
							
							array(
                          $table3['tuesday_open'] => $table3['tuesday_open'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['tuesday_open'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
						
						<div class="col-md-1 dash-sec-2"><hr></div> 
						
						<div class="col-md-3">
                            {!! Form::select('tuesday_close',
							
							array(
                          $table3['tuesday_close'] => $table3['tuesday_close'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['tuesday_close'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
                    </div>
                </div><!--input-2-sec-2-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-2-lable sec-2-day-select-tag"><p>Wednesday</p></div><!--input-lable-div--->
				
				
				<div class="col-md-10 profile-update-sec-2-input-outter-wrapper"><!--input-3-sec-2-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-3">
                                  {!! Form::select('wednesday_open',
							
							array(
                          $table3['wednesday_open'] => $table3['wednesday_open'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['wednesday_open'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
						
						<div class="col-md-1 dash-sec-2"><hr></div> 
						
						<div class="col-md-3">
                                  {!! Form::select('wednesday_close',
							
							array(
                          $table3['wednesday_close'] => $table3['wednesday_close'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['wednesday_close'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
                    </div>
                </div><!--input-3-sec-2-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-2-lable sec-2-day-select-tag"><p>Thurdsday</p></div><!--input-lable-div--->
				
				
				<div class="col-md-10 profile-update-sec-2-input-outter-wrapper"><!--input-4-sec-2-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-3">
                            {!! Form::select('thursday_open',
							
							array(
                          $table3['thursday_open'] => $table3['thursday_open'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['thursday_open'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
						
						<div class="col-md-1 dash-sec-2"><hr></div> 
						
						<div class="col-md-3">
                            {!! Form::select('thursday_close',
							
							array(
                          $table3['thursday_close'] => $table3['thursday_close'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['thursday_close'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
                    </div>
                </div><!--input-4-sec-2-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-2-lable sec-2-day-select-tag"><p>friday</p></div><!--input-lable-div--->
				
				
				<div class="col-md-10 profile-update-sec-2-input-outter-wrapper"><!--input-4-sec-2-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-3">
                             {!! Form::select('friday_open',
							
							array(
                          $table3['friday_open'] => $table3['friday_open'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['friday_open'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
						
						<div class="col-md-1 dash-sec-2"><hr></div> 
						
						<div class="col-md-3">
                            {!! Form::select('friday_close',
							
							array(
                          $table3['friday_close'] => $table3['friday_close'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['friday_close'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
                    </div>
                </div><!--input-5-sec-2-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-2-lable sec-2-day-select-tag"><p>saturday</p></div><!--input-lable-div--->
				
				
				<div class="col-md-10 profile-update-sec-2-input-outter-wrapper"><!--input-6-sec-2-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-3">
                             {!! Form::select('saturday_open',
							
							array(
                          $table3['saturday_open'] => $table3['saturday_open'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['saturday_open'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
						
						<div class="col-md-1 dash-sec-2"><hr></div> 
						
						<div class="col-md-3">
                           {!! Form::select('saturday_close',
							
							array(
                          $table3['saturday_close'] => $table3['saturday_close'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['saturday_close'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
                    </div>
                </div><!--input-6-sec-2-outter-wrapper-div-close-->
				
				<div class="col-md-2 profile-update-sec-2-lable sec-2-day-select-tag"><p>sunday</p></div><!--input-lable-div--->
				
				
				<div class="col-md-10 profile-update-sec-2-input-outter-wrapper"><!--input-7-sec-2-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-3">
                           {!! Form::select('sunday_open',
							
							array(
                          $table3['sunday_open'] => $table3['sunday_open'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['sunday_open'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
						
						<div class="col-md-1 dash-sec-2"><hr></div> 
						
						<div class="col-md-3">
                            {!! Form::select('sunday_close',
							
							array(
                          $table3['sunday_close'] => $table3['sunday_close'],
							 "6:30 am"=>"6:30 am",
							 "7:00 am"=>"7:00 am",
							 "7:30 am"=>"7:30 am",
							 "8:00 am"=>"8:00 am",
							 "8:30 am"=>"8:30 am",
							 "9:00 am"=>"9:00 am",
							 "9:30 am"=>"9:30 am",
							 "10:00 am"=>"10:00 am",
							 "10:30 am"=>"10:30 am",
							 "11:00 am"=>"11:00 am",
							 "11:30 am"=>"11:30 am",
							 "12:00 pm"=>"12:00 pm",
							 "12:30 pm"=>"12:30 pm",
							 "1:00 pm"=>"1:00 pm",
							 "1:30 pm"=>"1:30 pm",
							 "2:00 pm"=>"2:00 pm",
							 "2:30 pm"=>"2:30 pm",
							 "3:00 pm"=>"3:00 pm",
							 "3:30 pm"=>"3:30 pm",
							 "4:00 pm"=>"4:00 pm",
							 "4:30 pm"=>"4:30 pm",
							 "5:00 pm"=>"5:00 pm",
							 "5:30 pm"=>"5:30 pm",
							 "6:00 pm"=>"6:00 pm",
							 "6:30 pm"=>"6:30 pm",
							 "7:00 pm"=>"7:00 pm",
							 "7:30 pm"=>"7:30 pm",
							 "8:00 pm"=>"8:00 pm",
							 "8:30 pm"=>"8:30 pm",
							 "9:00 pm"=>"9:00 pm",
							 "9:30 pm"=>"9:30 pm",
							 
							 
							 
							 
							 
							 ), $table3['sunday_close'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'By Appointment')) !!}
                        </div>
                    </div>
                </div><!--input-7-sec-2-outter-wrapper-div-close-->
				
				

            </div><!--profile-update-form-sec-2-main-wrapper-div-close-->

            <div class="col-md-12 profile-update-form-sec-3-main-wrapper"><!--profile-update-form-sec-3-main-wrapper-div-open-->
			
			  <div class="col-md-3 profile-update-sec-3-lable"><p>Number of years in Practice</p></div><!--input-lable-div--->
				
				<div class="col-md-9 profile-update-sec-3-input-outter-wrapper"><!--input-1-sec-3-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::text('practice_years', $table2['practice_years'],  array('class'=>'form-control','placeholder'=> 'Number of years in Practice', )) !!}
                        </div>
                    </div>
                </div><!--input-1-sec-3-outter-wrapper-div-close-->
			
			
			   

            </div><!--profile-update-form-sec-3-main-wrapper-div-close-->

            <div class="col-md-12 profile-update-form-sec-4-main-wrapper"><!--profile-update-form-sec-4-main-wrapper-div-open-->
			
			    <div class="col-md-12 proflie-form-sec-4-top-heading"><!--proflie-form-sec-4-top-heading-div-open-->
				 
				    <h4>accept</h4>
                    <hr/>
					
                </div><!--proflie-form-sec-4-top-heading-div-close-->
				
				<div class="col-md-3 profile-update-sec-4-lable"><p>New Patients</p></div><!--input-lable-div--->
				  
				  <div class="col-md-9 profile-update-sec-4-input-outter-wrapper"><!--input-1-sec-4-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::select('accepts_new_patients',array(
							
                             $table2['accepts_new_patients'] => $table2['accepts_new_patients'],
							 "no"=>"no",
							 "yes"=>"yes",
							 
							 ), $table2['accepts_new_patients'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'Select yes/no')) !!}
                        </div>
                    </div>
                </div><!--input-1-sec-4-outter-wrapper-div-close-->
				
				<div class="col-md-3 profile-update-sec-4-lable"><p>P.P.O</p></div><!--input-lable-div--->
				
				<div class="col-md-9 profile-update-sec-4-input-outter-wrapper"><!--input-2-sec-4-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::select('ai_ppo',array(
							
                             $table2['ai_ppo']=>$table2['ai_ppo'],
		
							"no"=>"no",
							 "yes"=>"yes",
							 
							 ),$table2['ai_ppo'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'Select yes/no')) !!}
							 
                        </div>
                    </div>
                </div><!--input-2-sec-4-outter-wrapper-div-close-->
				
				<div class="col-md-3 profile-update-sec-4-lable"><p>H.O.M</p></div><!--input-lable-div--->
				
				<div class="col-md-9 profile-update-sec-4-input-outter-wrapper"><!--input-3-sec-4-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::select('ai_hmo',array(
							
                             $table2['ai_hmo']=>$table2['ai_hmo'],
		
							"no"=>"no",
							 "yes"=>"yes",
							 
							 ),$table2['ai_hmo'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'Select yes/no')) !!}
                        </div>
                    </div>
                </div><!--input-3-sec-4-outter-wrapper-div-close-->
				
				<div class="col-md-3 profile-update-sec-4-lable"><p>Medicare</p></div><!--input-lable-div--->
				
				<div class="col-md-9 profile-update-sec-4-input-outter-wrapper"><!--input-4-sec-4-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::select('ai_medicare',array(
							
                             $table2['ai_medicare']=>$table2['ai_medicare'],
		
							"no"=>"no",
							 "yes"=>"yes",
							 
							 ),$table2['ai_medicare'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'Select yes/no')) !!}
                        </div>
                    </div>
                </div><!--input-4-sec-4-outter-wrapper-div-close-->
				
				<div class="col-md-3 profile-update-sec-4-lable"><p>Medical</p></div><!--input-lable-div--->
				
				<div class="col-md-9 profile-update-sec-4-input-outter-wrapper"><!--input-5-sec-4-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::select('ai_Medical',array(
							
                             $table2['ai_Medical']=>$table2['ai_Medical'],
		
							"no"=>"no",
							 "yes"=>"yes",
							 
							 ),$table2['ai_Medical'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'Select yes/no')) !!}
                        </div>
                    </div>
                </div><!--input-5-sec-4-outter-wrapper-div-close-->
				
				<div class="col-md-3 profile-update-sec-4-lable"><p>Medicaid</p></div><!--input-lable-div--->
				
				<div class="col-md-9 profile-update-sec-4-input-outter-wrapper"><!--input-6-sec-4-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-4">
                             {!! Form::select('ai_medicaid',array(
							
                             $table2['ai_medicaid']=>$table2['ai_medicaid'],
		
							"no"=>"no",
							 "yes"=>"yes",
							 
							 ),$table2['ai_medicaid'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'Select yes/no')) !!}
                        </div>
                    </div>
                </div><!--input-6-sec-4-outter-wrapper-div-close-->
				
				<div class="col-md-3 profile-update-sec-4-lable"><p>Worker's Comp</p></div><!--input-lable-div--->
				
				<div class="col-md-9 profile-update-sec-4-input-outter-wrapper"><!--input-7-sec-4-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::select('ai_woc',array(
							
                             $table2['ai_woc']=>$table2['ai_woc'],
		
							"no"=>"no",
							 "yes"=>"yes",
							 
							 ),$table2['ai_woc'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'Select yes/no')) !!}
                        </div>
                    </div>
                </div><!--input-7-sec-4-outter-wrapper-div-close-->
				
				<div class="col-md-3 profile-update-sec-4-lable"><p>Personal Injury</p></div><!--input-lable-div--->
				
				<div class="col-md-9 profile-update-sec-4-input-outter-wrapper"><!--input-8-sec-4-outter-wrapper-div-open-->
                     <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::select('ai_pi',array(
							
                             $table2['ai_pi']=>$table2['ai_pi'],
		
							"no"=>"no",
							 "yes"=>"yes",
							 
							 ),$table2['ai_pi'] , array('class'=>'form-control creatid_sec', 'placeholder'=> 'Select yes/no')) !!}
                        </div>
                    </div>
                </div><!--input-8-sec-4-outter-wrapper-div-close-->
			
             
            </div><!--profile-update-form-sec-4-main-wrapper-div-close-->

            <div class="col-md-12 profile-update-form-sec-5-main-wrapper"><!--profile-update-form-sec-5-main-wrapper-div-open-->
			
			 <div class="col-md-4 profile-update-sec-3-lable"><p>Languages Spoken</p></div><!--input-lable-div--->
				
				<div class="col-md-8 profile-update-sec-5-input-outter-wrapper"><!--input-1-sec-5-outter-wrapper-div-open-->
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('languages_spoken', $table2['languages_spoken'],  array('class'=>'form-control','placeholder'=> 'English, Spanish, French, etc.', )) !!}
                        </div>
                    </div>
                </div><!--input-1-sec-5-outter-wrapper-div-close-->

            </div><!--profile-update-form-sec-5-main-wrapper-div-close-->			
			
			</div><!--prac-profile-form-main-div-wrapper-close-->	
			
			<!--==============close========================-->

                <div class="col-md-12">
                    {!! Form::submit('Update', array('class'=>'btn btn-success pull-right submit')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col 6 -->
</div>
<!-- end row -->
@endsection
@section('page-scripts')

<script type="text/javascript">
$(document).ready(function(){

 $(".submit").click(function(){
	 //alert('Isfhan');
	 var zipval = $(".zip-code").val(); // geting zip code value
	 var addresval = $(".clinic-address").val(); // geting clinic address value
	 var stateval = $(".state").val(); // geting state value
	 var cellval = $(".cell-no").val(); // geting cell no value
	// alert(stateval);
	 var clzipcode =parseInt(zipval.length); // this varible check the lenght of zip code
	 var clcellno =parseInt(cellval.length); // this varible check the lenght of cell no code
	  //alert(clcellno);
	  /*this section checking address open*/

     if(addresval == "")
	 {
		 
       $(".clinic-address").attr("placeholder","Please Enter a valid adress");
	   $(".clinic-address").css({"color":"#000" , "border" :"1px solid red"});
	   //alert("Please Enter a valid adress");
	 }
	  else
	 {  
      // $(".clinic-address").attr("Office/Clinic Name *")
	   $(".clinic-address").css({"color":"#000" , "border" :"1px solid #CCD0D4"});
     }
	 /*form-validation-fn-close*/
	 
	 /*this section checking zip code open*/
	  if(isNaN(clzipcode) || clzipcode == "" )//|| 5 > clzipcode || clzipcode > 5 )
	 {
	   
	   $(".zip-code").attr("placeholder","Please Enter Valid zip code");
	   $(".zip-code").css({"color":"#000" , "border" :"1px solid red"});
	   //alert("Please Enter Valid ZIP Code ");
	   
	 }
	 
	 else if (clzipcode < 5 || clzipcode > 5 )
	 {
		 $(".zip-code").attr("placeholder","Please Enter Five digits zip code");
	     $(".zip-code").css({"color":"#000" , "border" :"1px solid red"});
		 $(".zip-code").val("");
		 
	 }
	 
	 else
	 {
		 $(".zip-code").attr("placeholder","Zip code*");
		 $(".zip-code").css({"color":"#000" , "border" :"1px solid #CCD0D4"});
	 }
	 /*this section checking zip code close*/
	 
	 /*this section checking cell no open*/
	 
	  if(isNaN(cellval) || cellval == "" ) //clcellno > 11 || 11 > clcellno
	 {
       $(".cell-no").attr("placeholder","Please Enter Valid cell no");
	   $(".cell-no").css({"color":"#000" , "border" :"1px solid red"});

	   //alert("Please Enter Valid cell no ");	
	   
	 }
	 else if(clcellno < 10 || clcellno > 10)  
	 {   
	   //alert("Please Enter ten digits cell no ");
       $(".cell-no").attr("placeholder","Please Enter ten digits cell no");
	    $(".cell-no").css({"color":"#000" , "border" :"1px solid red"});
		$(".cell-no").val("");
		
		
	 }
	 
	 else
	 {  
	   var a = $(".cell-no").val();
	   var b =a.replace(/(\d{3})\-?(\d{3})\-?(\d{3})(\d{1})/, "($1) $2-$3$4");
	   $(".cell-no").val(b);
	   alert(b + 'success');
	   $(".cell-no").attr("placeholder","Clinic/Office*").css({"color":"#000" , "border" :"1px solid #CCD0D4"});
	   var b =a.replace(/(\d{3})\-?(\d{3})\-?(\d{3})(\d{1})/, "($1) $2-$3$4");
	   
	 }
	 /*this section checking cell no close*/
});

});
	
</script>


    
	

@endsection
 