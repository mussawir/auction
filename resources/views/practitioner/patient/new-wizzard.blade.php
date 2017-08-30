@extends('layouts.pradash')

@section('content')


<!-- begin page-header -->
<h1 class="page-header">New Contact Details <small></small></h1>
<!-- end page-header -->
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
                    <form action="{{URL::to('/practitioner/patient/store-wizzard')}}" method="POST" data-parsley-validate="true" name="form-wizard" id="form-wizard" enctype="multipart/form-data">
                        <div id="wizard">
                            <ol id="wizlist">
                                <li>
                                    Create Contact
                                </li>
                                <span class="arrow arrowActive"></span>
                                <li>
                                    Upload Files
                                </li>
                                <span class="arrow arrowNormal"></span>
                            </ol>
                            <!-- begin wizard step-1 -->
                            <div class="wizard-step-1">
                                <fieldset>
                                    <div class="row">
    

    <!-- begin col-6 -->
    <div class="col-md-12">
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
            <div class="panel-body">
                {!! Form::open(array('url'=>'/practitioner/patient/store', 'class'=> 'form-horizontal', 'files'=>true,'data-parsley-validate' => 'true')) !!}


    <div class="col-md-12">
<div class="row"><h4>Picture</h4>
    <hr/>
</div></div>
       <div class="col-md-12">
<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            {!! Form::label('photo','Add Photo :', array('class'=>'col-md-3 control-label')) !!}
                            <div class="col-md-9">
                        {!! Form::file('photo', array('class'=>'form-control', 'accept'=>'image/*' ,'onchange'=>'readURL(this);')) !!}
                                </div>
                    </div>
                    </div>
                        </div>
<div class="col-md-6">
                    <div class="form-group">
                    <img id="blah"/>
                </div></div>
                        </div>
                        </div>
                        <div class="col-md-12">
<div class="row"><h4>Personal Information</h4>
    <hr/>
</div></div>
                        <div class="col-md-12">
<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('first_name','First Name *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('first_name', null, array('class'=>'form-control', 'placeholder'=> 'First Name', 'data-parsley-required'=>'true')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('middle_name','Middle Name *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('middle_name', null, array('class'=>'form-control', 'placeholder'=> 'Last Name', 'data-parsley-required'=>'true')) !!}
                        </div>
                    </div>
                </div>
                </div></div>
                <div class="col-md-12">
<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('last_name','Last Name *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('last_name', null, array('class'=>'form-control', 'placeholder'=> 'Last Name', 'data-parsley-required'=>'true')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('email','eMail *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=> 'eMail address', 'data-parsley-required'=>'true', 'data-parsley-type'=>'email')) !!}
                        </div>
                    </div>
                </div></div></div>
<div class="col-md-12">
<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('primary_phone','Primary Phone *:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('primary_phone', null, array('class'=>'form-control', 'placeholder'=> 'Primary Phone', 'data-parsley-required'=>'true')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('secondary_phone','Secondary Phone:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('secondary_phone', null, array('class'=>'form-control', 'placeholder'=> 'Secondary Phone')) !!}
                        </div>
                    </div>
                </div>
                </div></div>
                <div class="col-md-12">
<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('date_of_birth','Birth Date :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('date_of_birth', null, array('class'=>'form-control', 'placeholder'=> 'Birth date')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('age','Age :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('age', null, array('class'=>'form-control', 'placeholder'=> 'Age ')) !!}
                        </div>
                    </div>
                </div>
</div></div>
                <div class="col-md-12">
                <div class="row">
                    <h4>Mailing Information</h4>    <hr/></div></div>

<div class="col-md-12">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('mailing_street_address','Street Address :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('mailing_street_address', null, array('class'=>'form-control', 'placeholder'=> 'Street address')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('mailing_zip','ZIP :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('mailing_zip', null, array('class'=>'form-control', 'placeholder'=> 'ZIP')) !!}
                        </div>
                    </div>
                </div>
                </div></div>
                <div class="col-md-12">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('mailing_city','City :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('mailing_city', null, array('class'=>'form-control', 'placeholder'=> 'City/Town Name')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('mailing_state','State :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('mailling_state',array(
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
),null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div></div></div>
                <div class="col-md-12">
                <div class="row">
                    <h4>Billing Information</h4>    <hr/></div></div>

<div class="col-md-12">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('billing_street_address','Street Address :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('billing_street_address', null, array('class'=>'form-control', 'placeholder'=> 'Street address')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('billing_zip','ZIP :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('billing_zip', null, array('class'=>'form-control', 'placeholder'=> 'ZIP')) !!}
                        </div>
                    </div>
                </div>
                                </div>
                </div>
                <div class="col-md-12">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('billing_city','City :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('billing_city', null, array('class'=>'form-control', 'placeholder'=> 'City/Town Name')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('billing_state','State :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('billing_state',array(
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
             ),null, array('class'=>'form-control')) !!}

                        </div>
                    </div>
                </div>
</div>
                </div>
                <div class="col-md-12">
                <div class="row">
                    <h4>Credit Card Information</h4>    <hr/></div></div>
<div class="col-md-12">
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('cc_type','Card Type:', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::select('cc_type',array(
""=>"Select",
"visa"=>"Visa",
"mastercard"=>"Mastercard",
"discovery"=>"Discovery",
"maestro"=>"Maestro",
),null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('cc_number','Card Number :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('cc_number', null, array('class'=>'form-control', 'placeholder'=> 'Card Number')) !!}
                        </div>
                    </div>
                </div>
                </div></div>
                <div class="col-md-12">
                <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('cc_month','Expiry Month :', array('class'=>'col-md-6 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::select('cc_month',array(
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
      ),null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('cc_year','Expiry Year :', array('class'=>'col-md-6 control-label')) !!}
                        <div class="col-md-6">
                            {!! Form::select('cc_year',array(
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
      ), null, array('class'=>'form-control')) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('cvv','CVV :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::text('cvv', null, array('class'=>'form-control', 'placeholder'=> 'CVV Number')) !!}
                        </div>
                    </div>
                </div>
                </div></div>
                <div class="col-md-12">
                <div class="row">
                    <h4>Additional Information</h4>    <hr/></div></div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('notes','Notes :', array('class'=>'col-md-3 control-label')) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('notes', null, array('class'=>'form-control', 'placeholder'=> 'Add Notes')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                        
                    </div>
                
            </div>
    </div>
    <!-- end col 6 -->
</div>
                                </fieldset>
                            </div>
                            <!-- end wizard step-1 -->
                            <!-- begin wizard step-2 -->
                            <div class="wizard-step-2">
                                <fieldset>
                                    <div id="patientTableheading">
                                        <legend class="pull-left width-full">Upload Files</legend></div>
                                    <!-- begin row -->

                                        <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="files[]" class="col-md-3 control-label">Upload Files :</label>
                            <div class="col-md-9">
                                <input class="form-control" accept="*" multiple="multiple" name="files[]" type="file" id="files[]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                <div class="form-group">
                <div class="form-group">
                {!! Form::hidden('pa_id') !!}
                    <input class="btn btn-success pull-right" type="button" value="Upload">
</div>                    </div>
                </div>

<div class="row"><div class="col-md-12">
                                        {!! Form::submit('Save', array('class'=>'btn btn-success pull-right','id'=>'formSubmit')) !!}
</div>                                        </div>
                                    <!-- end row -->
                                </fieldset>
                            </div>
                            <!-- end wizard step-2 -->
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- end panel -->
        </div>
<!-- begin row -->
</form></div></div></div>
<!-- end row -->
@endsection

@section('page-scripts')

    <script language="JavaScript/text">
    
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
        });
     $('#formSubmit').hide();
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
        



       
    </script>
@endsection
