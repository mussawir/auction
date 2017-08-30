<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title>{{isset($meta['page_title'])?$meta['page_title'].' - ':''}}Practice Tabs</title>
	
	<link rel="icon" href="http://practicetab.com/dev/public/homepage/logoBlue.png" type="image/png" >
	
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{asset('public/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/css/animate.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/css/style.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/css/PopupBox.css')}}" rel="stylesheet" />
    <link href="{{asset('public/css/style-responsive.min.css')}}" rel="stylesheet" />
    <link href="{{asset('public/css/theme/default.css')}}" rel="stylesheet" id="theme" />
	<link href="{{ asset('public/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css') }}" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
    <link href="{{asset('public/plugins/fullcalendar/fullcalendar.print.css')}}" rel="stylesheet" media='print' />
    <link href="{{asset('public/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('public/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/jquery.ui.autocomplete.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/plugins/parsley/src/parsley.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/css/bwizard.min.css') }}" rel="stylesheet" />
    @yield('head')
    <!-- ================== END PAGE LEVEL STYLE ================== --> 

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="{{asset('public/plugins/pace/pace.min.js')}}"></script>
	<style>
/*========================================
    notifaction-modal-css-section
========================================*/
.empty-space-div
{
    height: 33px;
}

.opacity-0
{
   opacity: 0 !important;   
}
.opacity-1
{
   opacity: 1 !important;
   transition: 1s !important;
   transition-delay:0.5s;
      
}
.hide
{
    display: none;
}
.notification-alert-main-div
{
    
    border-radius: 10px;
    transition: 1s;
    background-color: rgba(0,0,0,1);
    background-color: transparent;
    opacity: 1;
    position: fixed;
    z-index: 1021;
    padding: 0px;
    padding: 0px 1%;
    top: 30px;
    right: 0;
}
.notification-alert-main-div-close-btn
{
   float: right;
   background-color: transparent;
   border: none;
   display: none;  
}

.noti-text-div {
    padding: 4px 6%;
    opacity: 0;
    transition: 1s;
    margin-bottom: 8px;
}		
		
    </style>
    <!-- ================== END BASE JS ================== -->
	
	<!--////////////////////////////responsive-stle-linked//////////////////////////////////////-->

<link href="{{asset('public/css/responsive.css')}}" rel="stylesheet" />
</head>
<body>
<div id="notificationDiv" class="col-sm-4 notification-alert-main-div">
  <button class="notification-alert-main-div-close-btn">&times;</button>
  <div class="empty-space-div"></div>
</div>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    @include('practitioner.header')
            <!-- end #header -->
    <!-- begin #sidebar -->
    @yield('sidebar')
    @include('layouts.mark-sidebar')
            <!-- end #sidebar -->
    <!-- begin #content -->
    <div id="content" class="content">
        @yield('content')
    </div>
    <!-- end #content -->
    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->


<script src="{{asset('public/plugins/fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('public/plugins/jquery/jquery-1.9.1.min.js')}}"></script>

<script src="{{asset('public/plugins/jquery/jquery-migrate-1.1.0.min.js')}}"></script>
<script src="{{asset('public/plugins/jquery-ui/ui/minified/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!--[if lt IE 9]>
<script src="{{asset('public/dashboard/crossbrowserjs/html5shiv.js')}}"></script>
<script src="{{asset('public/dashboard/crossbrowserjs/respond.min.js')}}"></script>
<script src="{{asset('public/dashboard/crossbrowserjs/excanvas.min.js')}}"></script>
<![endif]-->
<script src="{{asset('public/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="{{asset('public/plugins/jquery-cookie/jquery.cookie.js')}}"></script>
<!-- ================== END BASE JS ================== -->
<script type="text/javascript" src="{{asset('public/plugins/gritter/js/jquery.gritter.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/flot/jquery.flot.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/flot/jquery.flot.time.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/flot/jquery.flot.resize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/flot/jquery.flot.pie.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/sparkline/jquery.sparkline.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/dashboard.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/parsley/dist/parsley.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js')}}"></script>
<script type="text/javascript" src="{{asset('public/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/form-wysiwyg.demo.min.js')}}"></script>

<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="{{asset('public/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/plugins/fullcalendar/fullcalendar.js')}}"></script>
<script src="{{asset('public/plugins/popup/jquery.bpopup.js')}}"></script>
<script src="{{asset('public/js/calendar.demo.min.js')}}"></script>
<script src="{{asset('public/plugins/datepicker/form-plugins.demo.min.js')}}"></script>

<script src="{{asset('public/plugins/Autocomplete/jquery.ui.autocomplete.min.js')}}"></script>
<script src="{{asset('public/js/bwizard.js')}}"></script>
<script src="{{asset('public/js/form-wizards-validation.demo.min.js')}}"></script>

@yield('bottom');
<script src="{{asset('public/js/apps.min.js')}}"></script>
<style>

    ::-webkit-scrollbar { width: 3px; height: 3px;}
    ::-webkit-scrollbar-button {  background-color: #666; }
    ::-webkit-scrollbar-track {  background-color: #999;}
    ::-webkit-scrollbar-track-piece { background-color: #ffffff;}
    ::-webkit-scrollbar-thumb { height: 50px; background-color: #666; border-radius: 3px;}
    ::-webkit-scrollbar-corner { background-color: #999;}

    #element_to_pop_up {
        background-color:#fff;
        border-radius:15px;
        color:#000;
        display:none;
        padding:20px;
        width: 40%;
        min-width: 900px;
        max-height: 90vh;
    }
    .b-close{
        cursor:pointer;
        position:absolute;
        right:10px;
        top:5px;
    }
    .arrow {
        border-style: dashed;
        border-color: transparent;
        border-width: 0.27em;
        display: -moz-inline-box;
        display: inline-block;
        font-size: 100px;
        height: 0;
        line-height: 0;
        position: relative;
        vertical-align: middle;
        width: 0;
        background-color: #fff;
        border-left-width: 0.2em;
        border-left-style: solid;
        /* left: 0.25em; */
    }
    .arrowNormal{
        border-left-color: #f0f3f4!important;
    }
    .arrowActive{
        border-left-color: #00acac!important;
    }
    .arrowNotActive{
        border-left-color: #d3dadf!important;
    }


</style>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>
    (function($) {

        // DOM Ready
        $(function() {

            // Binding a click event
            // From jQuery v.1.7.0 use .on() instead of .bind()
            $('#my-button').bind('click', function(e) {

                // Prevents the default action to be triggered.
                e.preventDefault();

                // Triggering bPopup when click event is fired
                $('#element_to_pop_up').bPopup();

            });

        });

    })(jQuery);

    $(document).ready(function() {
       
        App.init();
        FormPlugins.init();
        FormWizardValidation.init();
        $('#calendar').fullCalendar({
            header: {
                left: 'agendaDay',
                center: 'title',
                right: 'prev,today,next '
            },
            //droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                $(this).remove();
            },
            selectable: true,
            selectHelper: true,
            eventClick: function(event, element) {
                $('#element_to_pop_up').html('');
                $('#element_to_pop_up').html(formData);
                autoComplete();
                $('#my-button').click();
                var id = event.title;
                id = id.split(')')[0];
                //event.title = id + " ) " + $('#patientname').val();
                event.title =fetchRowSchedule(parseInt(id));
                //$('#calendar').fullCalendar('updateEvent', event);

            },
            select: function(start, end) {
                var title='';
                $('#element_to_pop_up').html('');
                $('#element_to_pop_up').html(formData);
                autoComplete();
                $('#saveBtn').show();
                $('#updateBtn').hide();
                $('#my-button').click();
                $('#calendar').fullCalendar('unselect');
                var aDate;
                var test = start.toString();
                if (test.indexOf('GMT') > -1) {
                    test = test.substring(0,test.indexOf('GMT'));
                    aDate = new Date(Date.parse(test));
                    $('#pDate').val(aDate.getFullYear()+'-'+(aDate.getMonth()+1)+'-'+(aDate.getDate()));

                }
                var mins = aDate.getMinutes()=="0"?"00":aDate.getMinutes();
                var timeset = aDate.getHours()+":"+mins;
                $('#time').val(timeset);

                return;
                var eventData;

                if (title) {
                    eventData = {
                        title: title,
                        start: start,
                        end: end
                    };
                    $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                }
                $('#calendar').fullCalendar('unselect');
            },
            editable: true,
            eventLimit: true // allow "more" link when too many events
        });

        var render = '<div class="row">';
        render+='<a id="deleteDialogue" href="#modal-dialog" class="btn btn-sm btn-success" data-toggle="modal">Delete</a>';
        render+='        <div class="modal fade" id="modal-dialog">';
        render+='<div class="modal-dialog">';
        render+='<div class="modal-content">';
        render+='<div class="modal-header">';
        render+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
        render+='<h4 class="modal-title">Delete Entry</h4>';
        render+='</div>';
        render+='<div class="modal-body">';
        render+='<div class="alert alert-danger m-b-0">';
        render+='<h4><i class="fa fa-info-circle"></i> Sure you want to Delete this entry permanently?</h4>';
        render+='</div>';
        render+='</div>';
        render+='<div class="modal-footer">';
        render+='<input type="button" value="Yes" id="btnDelete" class="btn btn-sm btn-success" />';
        render+='<a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">No</a>';
        render+='</div>';
        render+='</div>';
        render+='</div>';
        render+='</div>';
        render+='</div>';
        $('#content').append(render);
        $('[id^="delete_"]').removeAttr('onclick');
        $('#deleteDialogue').hide();
		setCKEDITOR();
    });
    $('[id^="delete_"]').click(function() {
        var deleteId = $(this).attr('id').split('_')[1];
        $('#deleteDialogue').click();
//        $("#btnDelete").click(DelteDialouge(deleteId));
        $("#btnDelete").attr("onclick", "DelteDialouge("+deleteId+")");
    });
</script>
<script  type="text/javascript">
    function DelteDialouge(id)
    {
        doDelete(id,'');
        $('#deleteDialogue').click();
    }
    function readURL(input) {
console.log(input);
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $('#blah').attr('width', "200px;");
            $('#blah').attr('height', "200px;");
        }

        reader.readAsDataURL(input.files[0]);
    }
}
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
function isReadNotification()
{
	userId = '';
	//var q = confirm("Are you sure you want to delete this contact group?");
            //if (q == true) {

                $.ajax({
                    type: "GET",
                    url: '{{ URL::to('/notification/public/read') }}',
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        $('#notification-count').html('0');
						$(".media").each(function(i) {
							$(this).css('background-color', '');
					});
						//$('#notificationChild').css('background-color', '');
                    },
                    error:function (error) {
                    }
                });
                return false;
           // }
            return false;
}


		function setCKEDITOR(){
			$.ajax({
type    : 'POST',
data : {
role : 'practitioner',
path : {{Auth::user()->user_id}}
},
async:false,
//url     : '/patient/index/shipping_save,
url: '{{ URL::to('/public/plugins/fileman_lastest/php/setSessionPublic.php')}}',
beforeSend: function (request) {
return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
},
success: function (result) {
},
error:function (error) {

}
});
}

/*=====================================
    notification-modal-js-section
=====================================*/
$(document).ready(function(){
        
        $('.notification-alert-main-div-close-btn').click(function(){
            
           $('#notificationDiv').addClass('opacity-0');
           
             setTimeout(function(){
                
              $('#notificationDiv').addClass('opacity-0');
                   
             }, 5000); 
             
            
        });
    });
    function hardcodenotifn(textnotifn)
    {
        return textnotifn ;
        document.getElementById("newtest").innerHTML = hardcodenotifn(textnotifn);
    }
    
    var id = 10000000000;
    function noticheckfn(heading,testtoAppend)
    {
        var noticheck = 1 
        var testingVar = id--;
        if( noticheck == 1)
        {
            $("#notificationDiv").append('<div id="'+testingVar+'" class="alert alert-info alert-dismissable noti-text-div"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+heading+'</strong><p id="demo">'+testtoAppend+'</p></div>');
            
        }
        else
        {
            $("#notificationDiv").remove('<div class="alert alert-info alert-dismissable noti-text-div"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+heading+'</strong><p>'+testtoAppend+'</p></div>');
        }
        test(testingVar); 
    }
    function test(dynamicID){
        setTimeout(function(){ $('#'+dynamicID).addClass('opacity-1'); }, 500);
        setTimeout(function(){ $('#'+dynamicID).removeClass('opacity-1'); $('#'+dynamicID).addClass('opacity-0');}, 3000);
        setTimeout(function(){ $('#'+dynamicID).addClass('hide'); }, 3500);
    }
</script>




@yield('bottom')
@yield('page-scripts')

</body>
</html>
