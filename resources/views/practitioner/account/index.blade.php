
<style>

/*============================================
internal-css-for-practitioner-account-satting
=============================================*/

::-webkit-input-placeholder {
   text-transform:capitalize;
}

//defoult-class

.hide-created-sec{
	display: none!important;
    height: 0px;
    width: 0px;
    transition: 0.5s;
    opacity: 0;
}

.breadcrumb li 
{
    text-transform: capitalize;
}
.page-header
{
	text-transform: capitalize;
}

.account-satting-page-sec-1-top-heading h4
{
	text-transform: capitalize;
}

.account-satting-sec-1-wrapper-dev {
    padding: 0px 0px;
}

.account-sec-1-input-outter-wrapper {
    padding: 0px 0px;
	margin:12px 0px;
}

.section-1-lable p {
    font-size: 14px;
    margin: 0px;
    text-align: left;
    padding-top: 4%;
    text-transform: capitalize;
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

/*ac-page-sec-2-css-open*/

.ac-sec-2-dropdown-wrapper-main-div {
    padding: 0px 0px;
}

.section-2-lable p {
    font-size: 14px;
    margin: 0px;
    text-align: left;
    padding-top: 4%;
    text-transform: capitalize;
	margin:12px 0px;
}

.account-satting-page-sec-2-top-heading h4
{
	text-transform: capitalize;
}

.account-satting-sec-2-wrapper-dev {
    padding: 0px 0px;
	margin:12px 0px;
}

.account-sec-2-input-outter-wrapper {
    padding: 0px 0px;
	margin:12px 0px;
}
.add-or-edit-ceardit-btn-main-div {
    padding: 0px 0px;
}

.add-or-edit-ceardit-btn-main-div {
    padding: 0px 0px;
    text-align: left;
}
.add-or-edit-ceardit-btn-main-div button {
    background-color: #00acac;
    border: none;
    border: 1px solid #00acac;
    color: #fff;
    font-size: 11px;
    border-radius: 6px;
    padding: 9px 9px;
}
.add-or-edit-ceardit-btn-main-div button:hover
{
	background-color: #008a8a;
	border: 1px solid #008a8a;
}

/*account-satting-section-3--css-open*/

.ac-sec-3-dropdown-wrapper-main-div {
    padding: 0px 0px;
}

.account-satting-page-sec-3-top-heading h4
{
	text-transform: capitalize;
}

.section-3-lable p {
    font-size: 14px;
    margin: 0px;
    text-align: left;
    padding-top: 4%;
    text-transform: capitalize;
	margin:12px 0px;
}

.account-sec-3-input-outter-wrapper {
    padding: 0px 0px;
	margin:12px 0px;
}


.add-or-edit-billing-btn-main-div {
    padding: 0px 0px;
    text-align: left;
}
.add-or-edit-billing-btn-main-div button {
    background-color: #00acac;
    border: none;
    border: 1px solid #00acac;
    color: #fff;
    font-size: 11px;
    border-radius: 6px;
    padding: 9px 9px;
}
.add-or-edit-billing-btn-main-div button:hover
{
	background-color: #008a8a;
	border: 1px solid #008a8a;
}





</style>
@extends('layouts.pradash')
@section('sidebar')
@include('layouts.profile-sidebar')
@endsection
@section('content')
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/practitioner')}}">Dashboard</a></li>
    <li><a href="{{url('/practitioner/account')}}">Update account</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Update account Details </h1>
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
                <h4 class="panel-title">Update Details</h4>
            </div>
            <div class="panel-body">
                {!! Form::model($table1, array('url'=>'/practitioner/profile/update', 'method' => 'PATCH', 'class'=> 'form-horizontal', 'id'=>'formid' , 'files'=>true ))  !!}

                {!! Form::hidden('pa_id') !!}
                {!! Form::hidden('photo') !!}

                <div class="account-satting-page-sec-1-top-heading"><!--account-satting-page-sec-1-top-heading-open-->
				
				  <h4>Practitioner Information</h4>
				
                  <hr/>
				  
                </div><!--account-satting-page-sec-1-top-heading-close-->
				
				<div class="col-md-12 account-satting-sec-1-wrapper-dev"> <!--account-satting-sec-1-wrapper-dev-open-->
				 
				 <div class="col-md-2 section-1-lable"><p>name :</p></div>
                <div class="col-md-3 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=> 'First*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-2 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('middle_name', null, array('class'=>'form-control', 'placeholder'=> 'MI')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=> 'Last*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-2 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('suffix', null, array('class'=>'form-control', 'placeholder'=> 'suffix')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-2 section-1-lable"><p>Clinic Name :</p></div>
				
				<div class="col-md-10 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_name',null, array('class'=>'form-control', 'placeholder'=> 'Office/Clinic Name *', 'required' => 'required')) !!}
							
					
                        </div>
                    </div>
                </div>
				
				<div class="col-md-2 section-1-lable"><p>Clinic Address :</p></div>
				
				<div class="col-md-10 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_street_address', null, array('class'=>'form-control clinic-address', 'placeholder'=> 'Number, Street, Suite # *', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-2 empty-div-replace-labe"><p></p></div>
				
				<div class="col-md-4 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_city', null, array('class'=>'form-control', 'placeholder'=> 'City*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-3 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_state', null, array('class'=>'form-control state', 'placeholder'=> 'State*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-3 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('clinic_zip', null, array('class'=>'form-control zip-code', 'placeholder'=> 'Zip code*', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-2 section-1-lable"><p>Email :</p></div>
				
				<div class="col-md-10 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::email('clinic_email', null, array('class'=>'form-control', 'placeholder'=> 'Office / Clinic *', 'required' => 'required')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-2 section-1-lable"><p>Account Type :</p></div>
				
				<div class="col-md-10 account-sec-1-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-3 form-radio-btn-main-div">
                        <p>{!! Form::radio('radio', 0, array('class'=>'form-control', 'placeholder'=> 'Free', 'required' => 'required')) !!}</p>
							<p>Premium</p>
                        </div>
						<div class="col-md-3 form-radio-btn-main-div dropdown-toggle">
                            <p>{!! Form::radio('radio', 1, array('class'=>'form-control', 'placeholder'=> 'Free', 'required' => 'required')) !!}</p>
							<p>Free</p>
                        </div>
                    </div>
                </div>
				
				</div><!--account-satting-sec-1-wrapper-dev-close-->
				
				<div class="col-md-12 ac-sec-2-dropdown-wrapper-main-div hide"><!--ac-sec-2-dropdown-wrapper-main-div-open-->
				
				
				
				    <div class="account-satting-page-sec-2-top-heading"><!--account-satting-page-sec-2-top-heading-open-->
				      
					  <hr/>
					  
				     <h4>Credit Card Info </h4>
				
                     <hr/>
				  
                    </div><!--account-satting-page-sec-2-top-heading-close-->
			   
				    <div class="col-md-12 account-satting-sec-2-wrapper-dev"> <!--account-satting-sec-1-wrapper-dev-open-->
				
				      <div class="col-md-2 section-2-lable"><p>type :</p></div>
				
				     <div class="col-md-10 account-sec-2-input-outter-wrapper">
                     <div class="form-group">
                        <div class="col-md-4">
                            {!! Form::select('Creatid_type',array(
                             "0"=>"Select","1"=>"one","2"=>"two","3"=>"three","4"=>"four","5"=>"five",
							 ),$table1->mailing_state, array('class'=>'form-control creatid_sec', 'placeholder'=> 'Creatid_type')) !!}
                         </div>
                      </div>
                     </div>
					 
					 <div class="col-md-2 section-2-lable"><p>number :</p></div>
				
				<div class="col-md-10 account-sec-2-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::text('number', null, array('class'=>'form-control creatid_sec pre-pakeg', 'placeholder'=> 'C/C Number')) !!}
                        </div>
                    </div>
                </div>
				
				 <div class="col-md-2 section-2-lable"><p>exp date :</p></div>
				
				     <div class="col-md-10 account-sec-2-input-outter-wrapper">
                     <div class="form-group">
                        <div class="col-md-3">
                            {!! Form::select('exp_date_month',array(
                             "1"=>"MONTH","01"=>"01","02"=>"02","03"=>"03","04"=>"04","05"=>"05","06"=>"06","07"=>"07","08"=>"08","09"=>"09","10"=>"10","11"=>"11","12"=>"12"
							 ),$table1->mailing_state, array('class'=>'form-control creatid_sec', 'placeholder'=> 'month')) !!}
                         </div>
						 
						 <div class="col-md-3">
                            {!! Form::select('exp_date_year',array(
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
							 ),$table1->mailing_state, array('class'=>'form-control creatid_sec', 'placeholder'=> 'Year')) !!}
                         </div>
                      </div>
                     </div>
					 
					 	 <div class="col-md-2 section-2-lable"><p>c.c.v :</p></div>
				
				<div class="col-md-10 account-sec-2-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-3">
                            {!! Form::text('text', null, array('class'=>'form-control creatid_sec', 'placeholder'=> 'ID')) !!}
                        </div>
                    </div>
                </div>
					  
					  
					  <div class="col-md-12 add-or-edit-ceardit-btn-main-div"><!--add-or-edit-ceardit-btn-main-div-open-->
					  
					    <button>Add/edit</button>
					  
					  </div><!--add-or-edit-ceardit-btn-main-div-close-->
				
				    </div><!--account-satting-sec-1-wrapper-dev-close-->
               
			    </div><!--ac-sec-2-dropdown-wrapper-main-div-close-->
				
			    <div class="col-md-12 ac-sec-3-dropdown-wrapper-main-div hide"><!--ac-sec-3-dropdown-wrapper-main-div-open-->
				
				 <div class="account-satting-page-sec-3-top-heading"><!--account-satting-page-sec-3-top-heading-open-->
				
				  <hr/>
				  
				  <h4>Billing Address</h4>
				
                  <hr/>
				  
                </div><!--account-satting-page-sec-3-top-heading-close-->
				
				<div class="col-md-12 account-satting-sec-3-wrapper-dev"> <!--account-satting-sec-3-wrapper-dev-open-->
				
				 <div class="col-md-2 section-3-lable"><p>name :</p></div>
                <div class="col-md-3 account-sec-3-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('billing_fo_f_name', null, array('class'=>'form-control creatid_sec', 'placeholder'=> 'First*')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-2 account-sec-3-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('billing_fo_mi_name', null, array('class'=>'form-control creatid_sec', 'placeholder'=> 'MI*')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-5 account-sec-3-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-7">
                            {!! Form::text('billing_fo_l_name', null, array('class'=>'form-control creatid_sec', 'placeholder'=> 'LAST*')) !!}
                        </div>
                    </div>
                </div>
				
				
				<div class="col-md-2 section-3-lable"><p>Address :</p></div>
				
				<div class="col-md-10 account-sec-3-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Form::text('billing_Address', null, array('class'=>'form-control creatid_sec billing-add-checking', 'placeholder'=> 'Number, Street, Suite # *')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-2 section-3-lable empty-div"><p></p></div><!--empty-div-for-replaceing-lable-->
				
				<div class="col-md-4 account-sec-3-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-10">
                            {!! Form::text('billing_City_name', null, array('class'=>'form-control creatid_sec', 'placeholder'=> 'City*')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-3 account-sec-3-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-10">
                            {!! Form::text('billing_City_state', null, array('class'=>'form-control creatid_sec', 'placeholder'=> 'state*')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-3 account-sec-3-input-outter-wrapper">
                    <div class="form-group">
                        <div class="col-md-10">
                            {!! Form::text('billing_City_zip_code', null, array('class'=>'form-control creatid_sec billing_City_zip_code', 'placeholder'=> 'zip code*')) !!}
                        </div>
                    </div>
                </div>
				
				<div class="col-md-12 add-or-edit-billing-btn-main-div"><!--add-or-edit-ceardit-btn-main-div-open-->
					  
					    <button>Add/edit</button>
					  
			    </div><!--add-or-edit-ceardit-btn-main-div-close-->
				
				
				</div><!--account-satting-sec-3-wrapper-dev-close-->
				
				
				</div><!--ac-sec-3-dropdown-wrapper-main-div-open-->

                <div class="col-md-12 ac-satting-update-btn">
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
    <script language="JavaScript/text">

    </script>
	
<script>
	var _URL = window.URL || window.webkitURL;

$("#cover_photo").change(function(e) {
    var file, img;
    if ((file = this.files[0])) {
        img = new Image();
        img.onerror = function() {
            showError("msg","not a valid file: " + file.type);
			}; 
console.log(this.width);
console.log(this.height);
        img.onload = function() {
          if(this.width < 1200 && this.height < 786){
            showError("msg","Image size should have Min 1200 width and 786 Height "+" "+"This Image Width is : "+this.width+" and height is : "+this.height+".");
			$('#formid').find('#cover_photo').val('');
			return false;
			}
		else{
            return true;
			}

        }; 
        img.src = _URL.createObjectURL(file);


    }

});
function showError(id,msg){
	$('#'+id).html('');
	$('#'+id).show();
	$('#'+id).html('<div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a><strong>Error!</strong> '+msg+'.</div>').delay(2000).fadeOut();
}



$(document).ready(function(){
	/*function-for-dropdown-creadit-card-section-open*/
     $('input[name=radio]').click('change', function() {
	    
       var check_pakeg = $('input[name=radio]:checked', '#formid').val(); 
        
		if(check_pakeg == 0)
		{
			$(".ac-sec-2-dropdown-wrapper-main-div").removeClass("hide");
			$(".ac-sec-3-dropdown-wrapper-main-div").removeClass("hide");
			$(".pre-pakeg").addClass("cell-no");
			$(".billing-add-checking").addClass("clinic-address");
			$(".billing_City_zip_code").addClass("zip-code");
			$(".creatid_sec").attr("required","required");
		}
		else
		{
			$(".ac-sec-2-dropdown-wrapper-main-div").addClass("hide");
			$(".ac-sec-3-dropdown-wrapper-main-div").addClass("hide");
			$(".pre-pakeg").removeClass("cell-no");
			$(".billing-add-checking").removeClass("clinic-address");
			$(".billing_City_zip_code").removeClass("zip-code");
			$(".creatid_sec").removeAttr("required","required");
		}
		
     });
	 /*function-for-dropdown-creadit-card-section-close*/
	 
	 $(".submit").click(function(event){
  
     var zipval = $(".zip-code").val(); // geting zip code value
	 var addresval = $(".clinic-address").val(); // geting clinic address value
	 var stateval = $(".state").val(); // geting state value
	 var cellval = $(".cell-no").val(); // geting cell no value
	 
	 var clzipcode =parseInt(zipval.length); // this varible check the lenght of zip code
	 var clcellno =parseInt(cellval.length); // this varible check the lenght of cell no code

      /*this section checking address open*/

     if(addresval == "")
	 {
		 
	   //alert("Please Enter a valid adress");
       $(".clinic-address").attr("placeholder","Please Enter a valid adress").css({"color":"#000" , "border" :"1px solid red"});
	 }
     else
	 {  
       $(".clinic-address").attr("Office/Clinic Name *").css({"color":"#000" , "border" :"1px solid #CCD0D4"});
     } 

    /*form-validation-fn-close*/		 
	 
	 
	 /*this section checking zip code open*/
	 if(isNaN(zipval) || zipval == "" || 5 > clzipcode || clzipcode > 5 )
	 {
	   //alert("Please Enter Valid ZIP Code ");
	   $(".zip-code").attr("placeholder","Please Enter Valid zip code").css({"color":"#000" , "border" :"1px solid red"});
	   
	 }
	 else
	 {
		 $(".zip-code").attr("placeholder","Zip code*").css({"color":"#000" , "border" :"1px solid #CCD0D4"});
	 }
	 
	 /*this section checking zip code close*/
	 
	  /*this section checking cell no open*/
	 
	 if(isNaN(cellval) || cellval == "" ) //clcellno > 11 || 11 > clcellno
	 {
	   //alert("Please Enter Valid cell no ");
       $(".cell-no").attr("placeholder","Please Enter Valid cell no").css({"color":"#000" , "border" :"1px solid red"});	   
	 }
	 else if(clcellno > 11 || 11 > clcellno)  
	 {   
	   //alert("Please Enter eleven digits cell no ");
       $(".cell-no").attr("placeholder","Please Enter eleven digits cell no").css({"color":"#000" , "border" :"1px solid red"});
		
	 }
	 else
	 {  
	   var a = $(".cell-no").val();
	   var b =a.replace(/(\d{3})\-?(\d{3})\-?(\d{3})(\d{1})/, "$1-$2-$3-$4");
	   $(".cell-no").val(b);
	   alert(b + 'success');
	   $(".cell-no").attr("placeholder","Clinic/Office*").css({"color":"#000" , "border" :"1px solid #CCD0D4"});
	   var b =a.replace(/(\d{3})\-?(\d{3})\-?(\d{3})(\d{1})/, "$1-$2-$3-$4");
	   
	   
	 }
      
     /*this section checking cell no close*/

      
	
    });
	 
});



</script>
@endsection
 