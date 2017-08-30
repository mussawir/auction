
@extends('layouts.padash')
@section('content')
<style type="text/css">

.span-counter{
	float: right;margin: 11px;background: orange;border-radius: 20px;padding: 0px 6px;color: white;font-size: 14px;
}
#new-message{
	margin-top:20px;
    border: 1px solid #eee;
    padding: 5px;
    -moz-transition: all .5s;
    -webkit-transition: all .5s;
    transition: all .5s;
}

#new-message:focus {
  border-color: #66afe9;
  outline: 0;
//  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
//  box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
} 


    #chatHistoryDiv{
        height:100%;
        /*background-color: #e7e7e7;*/
        border-right-color: #4f4f4f;
        border-right-style: solid;
        border-right-width: thin;
    }
    #person-chat
    {
        height:100%;
    }
/* Center the loader */
#ajaxloaderImg {
    margin: 0px;
    position: absolute;
    left: 41%;
    /* top: 50%; */
    /* z-index: 1; */
    /* width: 150px; */
    /* height: 150px; */
    /* margin: -75px 0 0 -75px; */
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid black;
    width: 120px;
    height: 120px;
    -webkit-animation: spin 1s linear infinite;
    animation: spin 0.5s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
img.img-flag {
    height: 25px;
    width: 25px;
    margin-right: 7px;
}
</style>

<h1 class="page-header">Communication <!---<small>Subscribed Stores</small>---></h1>
        <div class="alert alert-danger fade in" id="errorLog" style="display: none">
        </div>
        <div class="alert alert-success fade in" id="successLog" style="display: none">
        </div>
        <!-- end page-header -->
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Connect With Others</h4>
            </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div  id="chatHistoryDiv">
                        <table class="table table-hover" id="loaded_practitioner_table">
                            <tbody>
							<tr>
							<td>
							<select class="form-control select" id="pra_id">
                                @foreach($practitioners as $values)
								<?php 
								$picPath = asset('public/img/no-user.jpg');								
								if(isset($values->pra_photo) && (!empty($values->pra_photo)))
								{
									$directory = $values->pra_directory;
									if($directory!="") $directory = $directory .'/';
									$picPath = asset('public/practitioners/'.$directory.$values->pra_photo);
								}
								?>
                                <option data-image="{{$picPath}}" value="{{$values->pra_id}}">{{$values->first_name}} {{$values->last_name}}</option>
                                @endforeach
                            </select>
							</td>
							</tr>
							<?php $counter = 0; $loaded_practitioner=''; ?>
                            @foreach($messageHistory as $value)
                               <tr id="practitioners" data-grid-id="{{$value->practitioner_id}}">
							   <?php if($counter==0) { $loaded_practitioner= $value->message_history_created_at; } $counter++; ?>
                                   <td id="{{$value->practitioner_id}}">
								    <img style="height: 40px;width: 40px;" class="img-circle" src="<?php 
								   $picPath = asset('public/img/no-user.jpg');
									if(isset($value->pa_photo) && (!empty($value->pa_photo)))
									{$directory = $value->pa_directory;
										if($directory!="") $directory = $directory .'/';
										$picPath = asset('public/practitioners/'.$directory.$value->pa_photo);
									}
									echo $picPath;
								   ?>" /> 
                                      <a   style=" padding-left: 11px ;" href="#">{{$value->first_name}} {{$value->last_name}}</a>
									  <span id="counter_{{$value->practitioner_id}}" class="span-counter">{{$value->message_unseen_counter}}</span>
                                   </td>
                               </tr>
                            @endforeach
							<input type="hidden" id="loaded_practitioner" value="<?php echo $loaded_practitioner; ?>" />
                            </tbody>
                        </table>
                    </div>
                </div>
				<input type="hidden" id="selected_pra" />
                <div  class="col-md-9">
                    <!--<p align="center" id="ajaxloaderImg">  <img height="150px" width="150px" src="/dev/public/img/transparent/ajax-loader.gif" />
                    </p>-->
					<div id="ajaxloaderImg" style=" border: 5px solid #f3f3f3;border-radius: 50%;border-top: 6px solid black;width: 32px;height: 32px;     margin: 0px;position: relative; " ></div>
                    <div id="person-chat">
                        <ul class="chats">

                        </ul>
                    </div>

                </div>
				<div style="margin-top:10px;" class="col-md-9 col-md-offset-3">
				<input type="text" class="form-control" id="new-message"  placeholder="Say Something..." />
				</div>
            </div>
        </div>
        </div>
		<input type="hidden" id="base_url" value="{{url('/')}}" />
@endsection
@section('page-scripts')
    <script type="text/javascript">
	App.init();
        $('#ajaxloaderImg').hide();
        <?php if (isset($_GET['chat'])) {
		if($_GET['chat']!='') {
		?>
                loadChats(<?php echo $_GET['chat']; ?>,false);
				$('#pra_id').val(<?php echo $_GET['chat']; ?>);
        <?php } } ?>
$("tr#practitioners td").click(function(e){
            var pra_id = $(this).attr('id');
			$('#chatHistoryDiv').children('table').children('tbody').children('tr').removeClass('active');
			$(this).parent('tr').addClass('active');
			$('#pra_id').val(pra_id);
			$('#counter_'+pra_id).html('');
            loadChats(pra_id,false);
        });
	$("#new-message").keyup(function(e) {
	var code = e.which;
    if(code==13){
		if($('#selected_pra').val()!=''){
			sendMessage();
		}
	}
});
$('#pra_id').on('change', function() {
  loadChats(this.value,false);
})
setInterval(function(){
	if($('#selected_pra').val()!=''){
            loadChats($('#selected_pra').val(),true);
	}
 }, 2500);
function sendMessage()
        {
            if($('#new-message').val()=="") return;
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/patient/index/send-message-ajax')}}',
                data: {
                    pra_id : $('#selected_pra').val(),
                    msg_date : gettoday(),
                    message : $('#new-message').val()
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
				complete: function(){
					var found = false;
					$('#chatHistoryDiv').children('table').children('tbody').children('tr').each(function( index ) {
						if($(this).find('td').attr('id')==$('#selected_pra').val()){
							found=true;
						}
					});
					if(!found){
						var url = window.location.href.split('?')[0];
						url = url+'?chat='+$('#selected_pra').val();
						window.location.href = url;
					}
				},
                success: function (result) {
					$('#new-message').val('');
                } ,
                error:function (error) {
                    $('#new-message').val('');
					loadChats($('#selected_pra').val(),true);
                }
            });
        }
		$( document ).ready(function() {
			$("#person-chat").scroll(function(){
			   if($(this).scrollTop() < 90){
						loadChats($('#selected_pra').val(),false);
			   }
			});
		});
        function loadChats(tr_pra_id,cNew)
        {
			var msg_lastID = '';
			if($.active == 0){
			if(!cNew) {
				$('#ajaxloaderImg').show();
			}
			if($('#selected_pra').val()!=tr_pra_id){
				$('#person-chat').html('');
			}
			$('#selected_pra').val(tr_pra_id);
			if(cNew){
				msg_lastID = $('#person-chat').children('ul').children('li').last().data('id');
			}
			else {
				msg_lastID = $('#person-chat').children('ul').children('li').eq(0).data('id');
			}
            var appender = '';
            var pra_id = tr_pra_id; 
            $.ajax({
                type: "POST",
                url: '{{ URL::to('/patient/index/view-message-ajax')}}',
                data: {
                    pra_id : pra_id,
					msg_lastID : msg_lastID,
					cNew : cNew ? 'true' : 'false'
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
					if(!cNew) {
						$('#ajaxloaderImg').hide();
					}
					/*console.log(result.split('|')[0]);
					result = result.split('|')[1];*/
					if(result!='') {
						if(!cNew){
							appender='<ul class="chats">';
							appender+=result;
							appender+='</ul>';
							var old = $('.chats').html();
							$('#person-chat').html(appender);
							$('.chats').append(old);
								if(msg_lastID==''||msg_lastID==null){
									var container = $('#person-chat');
									container.slimScroll({
									 scrollTo: container[0].scrollHeight
									});
								}else {
									var container = $('#person-chat');
										container.slimScroll({
										scrollTo: $('*[data-id="'+msg_lastID+'"]').offset().top
										});
								}
							} 
							else {
								$('.chats').append(result);
								var container = $('#person-chat');
								container.slimScroll({
								 scrollTo: container[0].scrollHeight
								});
							}
					}
					/*if($('*[data-id="'+msg_lastID+'"]').length > 1){
						$('*[data-id="'+msg_lastID+'"]').eq(0).remove();
					}*/
                },
                error:function (error) {
					if(!cNew) {
						$('#ajaxloaderImg').hide();
					}
                }
            });
		}
        }  
        function gettoday()
        {
            var d = new Date();
            var curr_date = d.getDate();
            var curr_month = d.getMonth();
            var curr_year = d.getFullYear();
            //var finaleDate = curr_date + "/" + m_names[curr_month] + "/" + curr_year;
            var finaleDate = curr_year +"-"+ (curr_month+1) +"-"+ curr_date;
            return finaleDate;
        }
        function showError(result)
        {
            var append = '<strong> Error! </strong>';
            append+='<strong> '+result+' </strong>';
            append+='<span class="close" data-dismiss="alert">×</span>';
            $('#errorLog').html('');
            $('#errorLog').html(append);
            $("#errorLog").show();
            setTimeout(function () {
                $("#errorLog").hide();
            }, 2000);
        }
        function showSuccess(result)
        {
            var append = '<strong> Success! </strong>';
            append+='<strong> '+result+' </strong>';
            append+='<span class="close" data-dismiss="alert">×</span>';
            $('#successLog').html('');
            $('#successLog').html(append);
            $("#successLog").show();
            setTimeout(function () {
                $("#successLog").hide();
            }, 2000);
        }
        $(function(){
            $('#chatHistoryDiv').slimScroll({
                height: '450px'
            });
            $('#person-chat').slimScroll({
                height: '450px'
            });
        });
	
function startWorker() {
    if(typeof(Worker) !== "undefined") {
        if(typeof(w) == "undefined") {
            w = new Worker("{{asset('public/js/webworker.js')}}");
			w.postMessage($('#loaded_practitioner').val());
        }
         w.onmessage = function (event) {
			var notificationData = event.data.split('|')[0];
			if(notificationData!=''){
				noticheckfn('New Message',notificationData,'');
			}
			if(event.data.split('|')[1]!=''){
				var jsonData = event.data.split('|')[1];
				var jsonobj = $.parseJSON(jsonData);
				var appender = '';
				for(var i = 0;i<jsonobj.length;i++){
					$("table").find("[data-grid-id="+jsonobj[i].practitioner_id+"]").remove();
					//base_url
					if(i==0){
						$('#loaded_practitioner').val(jsonobj[i].message_history_created_at);
					}
					/*var addClass= '';
					if(jsonobj[i].practitioner_id == $('#selected_pra').val()){
						addClass = 'class="active"';
					}*/
					var addClass= '';
					var counter = jsonobj[i].message_unseen_counter;
					if(jsonobj[i].practitioner_id == $('#selected_pra').val()){
						addClass = 'class="active"';
						counter = '';
					}
					appender+='<tr id="practitioners" '+addClass+' data-grid-id="'+jsonobj[i].practitioner_id+'"><td id="'+jsonobj[i].practitioner_id+'">';
					var imagePath = $('#base_url').val()+'/public/img/no-user.jpg';
					if(jsonobj[i].pa_photo!='' && jsonobj[i].pa_photo!=null){
						imagePath = $('#base_url').val()+'/public/practitioners/'+jsonobj[i].pa_directory+'/'+jsonobj[i].pa_photo;
					}
					appender+='<img style="height: 40px;width: 40px;" class="img-circle" src="'+imagePath+'"> ';
                    appender+='<a style=" padding-left: 11px ;" href="#">'+jsonobj[i].first_name+' '+jsonobj[i].last_name+'</a><span id="counter_'+jsonobj[i].practitioner_id+'" class="span-counter">'+counter+'</span>';
                    appender+='</td></tr>';
				}
				$("#loaded_practitioner_table tr:first-child").after(appender);
				$("tr#practitioners td").click(function(e){
					var pra_id = $(this).attr('id');
					$('#chatHistoryDiv').children('table').children('tbody').children('tr').removeClass('active');
					$(this).parent('tr').addClass('active');
					$('#pra_id').val(pra_id);
					$('#counter_'+pra_id).html('');
					loadChats(pra_id,false);
				});
				
			}
			setTimeout(function(){ w.postMessage($('#loaded_practitioner').val()); }, 3000);
         };
    } else {
        document.getElementById("result").innerHTML = "Sorry! No Web Worker support.";
    }  
}
function stopWorker() { 
    w.terminate();
    w = undefined;
} 

$( document ).ready(function() {
    startWorker();
});


    </script>
	
	
	<script type="text/javascript">
	function formatState (state) {
  if (!state.id) { return state.text; }
  var dataImage = $(state.element).data('image');
  var $state = $(
    '<span><img src="'+dataImage+'" class="img-flag" /> ' + state.text + '</span>'
  );
  return $state;
};
  $('.select').select2({
  templateResult: formatState
});
//$('.select').select2();
</script>
@endsection
