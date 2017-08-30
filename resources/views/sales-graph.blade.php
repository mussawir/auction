<?php
$appender = '';
 if($role == 1 || $role == 2) { 
$appender = 'adash';
?>
<?php } elseif($role == 3) { 
?>
<?php 

$appender = 'pradash';
?>	
<?php } elseif($role == 6) {	 
?>
<?php

$appender = 'supdash';
?>
<?php } ?>
@extends('layouts.'.$appender)
@section('content')
@section('head')
@endsection
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{url('/admin')}}">Dashboard</a></li>
    <li class="active">Contact Dashboard List</li>
</ol>
<script src="{{ URL::asset('js/graph.js')}}"></script>



<h1 class="page-header">Contact Dashboard <small>Contact Dashboard List</small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
    <!-- begin col-6 -->
    <div class="col-md-12">
        <div class="msg">
            
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
                <h4 class="panel-title">Contact Dashboard Post List</h4>
            </div>
            <div class="panel-body">
			<!-- CODE HERE -->
			<div class="row">
			<div class="col-md-4 col-md-offset-8"> 
			<!-- Date picker -->
<div class="input-group input-daterange">
<input type="text" class="form-control" name="start" id="start_date" placeholder="Date Start">
<span class="input-group-addon">to</span>
<input type="text" class="form-control" name="end" id="end_date" placeholder="Date End">
</div>
			</div></div>
			<div class="row">
			<div class="col-md-12" ><canvas id="myChart" >
			
			</div></div>
			
			
			
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
$(function() {
var date = new Date();
var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
$('#start_date').val(getFormattedDate(firstDay));
$('#end_date').val(getFormattedDate(lastDay));
});
function getFormattedDate(date) {
  var year = date.getFullYear();
  var month = (1 + date.getMonth()).toString();
  month = month.length > 1 ? month : '0' + month;
  var day = date.getDate().toString();
  day = day.length > 1 ? day : '0' + day;
  return month + '/' + day + '/' + year;
}
function getData()
{
		$.ajax({
		type    : 'POST',
		data : {
		start_date : $('#start_date').val(),
		end_date : $('#end_date').val()
		},
		async:false,
		url: '{{ URL::to('/sales-graph-data')}}',
		beforeSend: function (request) {
		return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
		},
		success: function (result) {
		var date=[];
		var amount=[];
		var obj = jQuery.parseJSON(result);
		for(var i = 0;i<obj.length;i++){
			date.push(obj[i].data);
			amount.push(obj[i].amount);
		}
					var ctx = document.getElementById('myChart').getContext('2d');
			var myChart = new Chart(document.getElementById("myChart"), {
			  type: 'line',
			  data:  {
				labels: date,
				datasets: [{ 
					data: amount,
					label: "Amount",
					borderColor: "#3e95cd",
					fill: false
				  }
				]
			  },
			  options: {
				title: {
				  display: true,
				  text: 'Your Earning Between '+$('#start_date').val()+' - ' + $('#end_date').val()
				}
			  }
			});
		},
		error:function (error) {
			
		}
		});
}
</script>

@endsection
