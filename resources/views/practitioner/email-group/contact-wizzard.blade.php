@extends('layouts.pradash')

@section('sidebar')
@include('layouts.mark-sidebar')
@endsection

@section('content')
    <style type="text/css">
        .spinner {
            /*margin: 100px auto;*/
            width: 50px;
            height: 40px;
            text-align: center;
            font-size: 10px;
        }

        .spinner > div {
            background-color: #333;
            height: 100%;
            width: 6px;
            display: inline-block;

            -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
            animation: sk-stretchdelay 1.2s infinite ease-in-out;
        }

        .spinner .rect2 {
            -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s;
        }

        .spinner .rect3 {
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        .spinner .rect4 {
            -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s;
        }

        .spinner .rect5 {
            -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s;
        }

        @-webkit-keyframes sk-stretchdelay {
            0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
            20% { -webkit-transform: scaleY(1.0) }
        }

        @keyframes sk-stretchdelay {
            0%, 40%, 100% {
                transform: scaleY(0.4);
                -webkit-transform: scaleY(0.4);
            }  20% {
                   transform: scaleY(1.0);
                   -webkit-transform: scaleY(1.0);
               }
        }

    </style>

<!-- begin page-header -->
<h1 class="page-header">Email Groups Wizzard<small></small></h1>
<!-- end page-header -->

<!-- begin row -->
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
                        <form action="{{URL::to('/practitioner/email-group/addPatients')}}" method="POST" data-parsley-validate="true" name="form-wizard" id="form-wizard">
                            <div id="wizard">
                                <ol id="wizlist">
                                    <li>
                                        Group Name
                                    </li>
                                    <span class="arrow arrowActive"></span>
                                    <li>
                                        Add Member / Contact
                                    </li>
                                    <span class="arrow arrowNormal"></span>
                                    <li>
                                        Completed
                                    </li>
                                    <span class="arrow arrowNormal"></span>
                                </ol>
                                <!-- begin wizard step-1 -->
                                <div class="wizard-step-1">
                                    <fieldset>
                                        <legend class="pull-left width-full">Group Name</legend>
                                        <!-- begin row -->
                                        <div class="row">
                                            <!-- begin col-4 -->
                                            <div class="col-md-12">
                                                <div class="form-group block1">
                                                    <label>Group Name</label>
                                                    <input type="text" id="name" name="name" placeholder="Email Group" class="form-control" data-parsley-group="wizard-step-1" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email Group Description </label>
                                                    <textarea class="form-control" placeholder="Email Group Name" data-parsley-required="true" name="description" cols="50" rows="10" id="description"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>This Group would be : </label>
                                                    <select onchange="hideshowContent()" class="form-control" name="grpType" id="grpType">
                                                        <option value="1">Members Group</option>
                                                        <option value="2">Contact Group</option>
                                                        <option value="3">Both</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </fieldset>
                                </div>
                                <!-- end wizard step-1 -->
                                <!-- begin wizard step-2 -->
                                <div class="wizard-step-2">
                                    <fieldset>
                                        <div id="patientTableheading">
                                        <legend class="pull-left width-full">Add Member / Contact</legend></div>
                                        <!-- begin row -->
                                        <div class="row" id="patientTable">
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
                                                            <table id="data-table" class="table table-striped table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($patients as $item)
                                                                    <tr>
                                                                        <td>{{$item->first_name. " ". $item->last_name}}</td>
                                                                        <td>{{$item->email}}</td>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox"  data-parsley-required="true"
                                                                                           name="sup_id[]" value="{{$item->user_id}}" {{in_array($item->user_id, $pat_ids)? 'checked="checked"' : ''}}>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                            <hr/>
                                                            <div class="row">
                                                                <div class="spinner" id="patientspinner">
                                                                    <div class="rect1"></div>
                                                                    <div class="rect2"></div>
                                                                    <div class="rect3"></div>
                                                                    <div class="rect4"></div>
                                                                    <div class="rect5"></div>
                                                                </div>
                                                            <input type="button" onclick="addPatientsList()" class = "btn btn-success pull-right" value="Add to list" />
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
                                                        <table id="selected-table" class="table table-striped table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($selected_pat as $item)
                                                                <tr id="{{$item->user_id}}">
                                                                    <td>{{$item->first_name. " ". $item->last_name}}</td>
                                                                    <td>{{$item->email}}</td>
                                                                    <td>
                                                                        {{--<input type="hidden" name="sup_id[]" value="{{$item->sup_id}}" />--}}
                                                                        <a href="javascript:void(0);" class="text-danger" onclick="removeSupRow(this, '{{$item->user_id}}')"><i class="fa fa-times"></i> Remove</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col-6 -->
                                        </div>
                                        <div id="contactTableheading" style="display: none;">
                                        <legend class="pull-left width-full">Add Contact</legend></div>
                                        <div class="row" id="contactTable" style="display:none">

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
                                                            <table id="data-table-contact" class="table table-striped table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Email</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($contacts as $item)
                                                                    <tr>
                                                                        <td>{{$item->first_name. " ". $item->last_name}}</td>
                                                                        <td>{{$item->email}}</td>
                                                                        <td>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox"  data-parsley-required="true"
                                                                                           name="cnt_id[]" value="{{$item->cnt_id}}" {{in_array($item->cnt_id, $cnt_ids)? 'checked="checked"' : ''}}>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                            <hr/>
                                                            <div class="row">
                                                            <div class="spinner" id="contactspinner">
                                                                <div class="rect1"></div>
                                                                <div class="rect2"></div>
                                                                <div class="rect3"></div>
                                                                <div class="rect4"></div>
                                                                <div class="rect5"></div>
                                                            </div>
                                                            <input type="button" onclick="addContactsList()" class = "btn btn-success pull-right" value="Add to list" />
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
                                                        <table id="selected-contact-table" class="table table-striped table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($selected_cont as $item)
                                                                <tr id="{{$item->cnt_id}}">
                                                                    <td>{{$item->first_name. " ". $item->last_name}}</td>
                                                                    <td>{{$item->email}}</td>
                                                                    <td>
                                                                        {{--<input type="hidden" name="sup_id[]" value="{{$item->sup_id}}" />--}}
                                                                        <a href="javascript:void(0);" class="text-danger" onclick="removeSupRowCont(this, '{{$item->cnt_id}}')"><i class="fa fa-times"></i> Remove</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
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
                                    <div class="jumbotron m-b-0 text-center">
                                        </br>
                                        <input id="savegrp" type="button" onclick="saveGroup()" value="Save Group" class="btn btn-success btn-lg" />
                                        <div class="spinner" id="savespinner">
                                            <div class="rect1"></div>
                                            <div class="rect2"></div>
                                            <div class="rect3"></div>
                                            <div class="rect4"></div>
                                            <div class="rect5"></div>
                                        </div>
                                        </br></br></br>
                                        <p><a id="composeEmail" disabled="true" href="#" class="btn btn-danger btn-lg" role="button">Compose Email</a></p>
                                    </div>
                                </div>
                                <!-- end wizard step-3 -->
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-12 -->
        </div>
        <!-- end row -->
@endsection

@section('page-scripts')
    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }
        });
		
		
		
		$(function () {
            if ($('#data-table-contact').length !== 0) {
                $('#data-table-contact').DataTable({
                    responsive: true,
                    "aaSorting": [[0, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [2]}]
                });
            }
        });
		
		
        function removeSupRow(elm, id) {
            $.get("{{url('/practitioner/email-group/removePatients')}}", { user_id: id }, function(data) {
                $('#page-loader').removeClass('hide');
                if(data == 'success') {
                    $(elm).closest('tr').remove();
                    //window.location.reload();
                }
                $('#page-loader').addClass('hide');
            });
            return false;
        }
        function removeSupRowCont(elm, id) {
            $.get("{{url('/practitioner/email-group/removeContacts')}}", { user_id: id }, function(data) {
                $('#page-loader').removeClass('hide');
                if(data == 'success') {
                    $(elm).closest('tr').remove();

                    var rowCount = $('#selected-table tbody tr').length;
                    if (rowCount == 0) {
                        //$("#selected-table tbody").append('<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>');
                    }
                    //window.location.reload();
                }
                $('#page-loader').addClass('hide');
            });
            return false;
        }
        function hideshowContent()
        {
            var grpType = $('#grpType').val();
            if(grpType==1)
            {
                $('#patientTable').show();
                $('#contactTable').hide();
                $('#contactTableheading').hide();
                $('#patientTableheading').show();

            }
            else if(grpType==2)
            {
                $('#patientTable').hide();
                $('#contactTable').show();
                $('#contactTableheading').show();
                $('#patientTableheading').hide();
            }
            else if(grpType==3)
            {
                $('#contactTable').show();
                $('#patientTable').show();
                $('#contactTableheading').show();
                $('#patientTableheading').show();
            }
        }
function addPatientsList()
{
	var lastSearched = customSearch('data-table','',-1);
    $('#patientspinner').show();
    var form_data = $('#form-wizard').serializeArray();
    var appender = '';
    $.ajax({
        type: "POST",
        data: form_data,
        url: '{{ URL::to('/practitioner/email-group/addPatientsWizz') }}',
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (result) {
            $('#patientspinner').hide();
            $("#selected-table").empty();
            var mainsplit = result.split('|');
            for(var i = 0;i<mainsplit.length;i++)
            {
                var childsplit = mainsplit[i].split(',');
                appender+='<tr>';
                appender+='<td>'+childsplit[1]+'</td>';
                appender+='<td>'+childsplit[0]+'</td>';
                appender+='<td>';
                appender+='<a href="javascript:void(0);" class="text-danger" onclick="removeSupRow(this, '+childsplit[2]+')"><i class="fa fa-times"></i> Remove</a>';
                appender+='</td>';
                appender+='</tr>';
            }
            var thead = '<thead>';
            thead+='<tr>';
            thead+='<th>Name</th>';
            thead+='<th>Email</th>';
            thead+='<th></th>';
            thead+='</tr>';
            thead+='</thead>';
            $("#selected-table").append(thead);
            $("#selected-table").append(appender);
			customSearch('data-table',lastSearched,10);
            //location.reload(true);
        },
        error:function (error) {
			customSearch('data-table',lastSearched,10);
            $('#patientspinner').hide();
            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
        }
    });
}

function addContactsList()
{
	var lastSearched = customSearch('data-table-contact','',-1);
    $('#contactspinner').show();
    var form_data = $('#form-wizard').serializeArray();
    var appender = '';
    $.ajax({
        type: "POST",
        data: form_data,
        url: '{{ URL::to('/practitioner/email-group/addContactsWizz') }}',
        beforeSend: function (request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },
        success: function (result) {
            $('#contactspinner').hide();
            $("#selected-contact-table").empty();
            var mainsplit = result.split('|');
            for(var i = 0;i<mainsplit.length;i++)
            {
                var childsplit = mainsplit[i].split(',');
                appender+='<tr>';
                appender+='<td>'+childsplit[1]+'</td>';
                appender+='<td>'+childsplit[0]+'</td>';
                appender+='<td>';
                appender+='<a href="javascript:void(0);" class="text-danger" onclick="removeSupRowCont(this, '+childsplit[2]+')"><i class="fa fa-times"></i> Remove</a>';
                appender+='</td>';
                appender+='</tr>';
            }
            var thead = '<thead>';
            thead+='<tr>';
            thead+='<th>Name</th>';
            thead+='<th>Email</th>';
            thead+='<th></th>';
            thead+='</tr>';
            thead+='</thead>';
            $("#selected-contact-table").append(thead);
            $("#selected-contact-table").append(appender);
			customSearch('data-table-contact',lastSearched,10);
            //location.reload(true);
        },
        error:function (error) {
			customSearch('data-table-contact',lastSearched,10);
            $('#contactspinner').hide();
            $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
        }
    });
}

        function doDelete(id, elm)
        {
            var q = confirm("Are you sure you want to delete this email group?");
            if (q == true) {

                $.ajax({
                    type: "DELETE",
                    url: '{{ URL::to('/practitioner/email-group/destroy') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        /*if (result.status == 'success') {
                         $(elm).closest('tr').fadeOut();
                         $('.msg').html('<div class="alert alert-success"><strong>Manufacturer deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                         } else {
                         $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                         }*/
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
            $('#savespinner').hide();
            $('#contactspinner').hide();
            $('#patientspinner').hide();
            $('.bwizard-buttons > li > a').click(function (event) {
                var anchorText = $(this).text();
                if($('#name').val()=="") return;
                if (anchorText.toLowerCase().indexOf("next") >= 0)
                {
                    if($(this).parent().hasClass('next disabled')) return;
                }
                else if (anchorText.toLowerCase().indexOf("previous") >= 0)
                {
                    if($(this).parent().hasClass('previous disabled')) return;
                }
                $('#wizlist > li').each(function( index ) {
                    if($('#name').val()=="") return;
                    if(index==0) saveDetail();
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


        function saveDetail()
        {
            var form_data = $('#form-wizard').serializeArray();
            $.ajax({
                type: "POST",
                data: form_data,
                url: '{{ URL::to('/practitioner/email-group/to-contact-wiz') }}',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    //alert(result);
                },
                error:function (error) {
                    $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                }
            });
        }
        function saveGroup()
        {
            $('#savegrp').hide();
            $('#savespinner').show();
            var form_data = $('#form-wizard').serializeArray();
            $.ajax({
                type: "POST",
                data: form_data,
                url: '{{ URL::to('/practitioner/email-group/save-group-wiz') }}',
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
                    $('#savegrp').show();
                    $('#savespinner').hide();
                    if(result=="")return;
                    var _data = result.split(',');
                    var url = '{{ URL::to('/practitioner/emails/new?cg_id=') }}'+_data[1];
                    $('#composeEmail').removeClass('btn btn-danger btn-lg').addClass("btn btn-success btn-lg");
                    $('#composeEmail').attr('href',url);
                    $('#composeEmail').attr('disabled',false);
                    $('#savegrp').attr('disabled',true);
                    $('#savegrp').attr('onclick','');
                    $('#savegrp').val('Saved');
                    $('#savegrp').fadeOut();

                },
                error:function (error) {
                    $('#savegrp').show();
                    $('#savespinner').hide();
                    $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                }
            });
        }
    </script>
@endsection