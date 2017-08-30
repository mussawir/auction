<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('layouts.mark-sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- begin page-header -->
    <h1 class="page-header">New Social Posts<small></small></h1>
    <!-- end page-header -->
    <!-- begin row -->  
    <style>
        #linkId {
            color:white;
        }
     </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#ajaxloaderImg').hide();
            //$('#file').hide();
            $('#fileLabel').hide();
            $('#toggle_link').hide();
            $('#toggle_image').hide();
			$("#link").change(function(){
				$('#imagepath').val('');
				$('#file').val('');
			});
			$('#add_url').click(function () {
                $('#toggle_link').toggle();
				$('#toggle_image').hide();
            });
			$('#add_picture').click(function () {
                $('#toggle_image').toggle();
				$('#toggle_link').hide();
            });
        });
        function uploadimage()
        {
			$('#postBtn').prop('disabled',true);
			$('#postBtn').html('').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
            var result='';
            $('#ajaxloaderImg').show();
            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: '<?php echo e(URL::to('/practitioner/social-post/uploadImage/')); ?>',
                type: "POST",
                data: form_data,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function(data){
					$('#postBtn').prop('disabled',false);
					$('#postBtn').html('').html('Post');
                    $('#ajaxloaderImg').hide();
                    $('#imagepath').val(data);
					$('#link').val('');
                },
                error: function(data){
					$('#postBtn').prop('disabled',false);
					$('#postBtn').html('').html('Post');
                    $('#ajaxloaderImg').hide();
                    result= 'error';
                }
            });
        }
        function isUrlValid(url) {
            return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
        }
        function formsubmit() {
            if(!isUrlValid($('#link').val())&&$('#link').val()!="")
            {
				showError('msg','Please Enter a Valid URL');
                return;
            }
            var checkFb = $('#check-fb').prop('checked'),checkLinked = $('#check-linked').prop('checked'),
                    checkBlog = $('#check-practice').prop('checked'),
                    checkTwitter = $('#check-twitter').prop('checked');
            $.ajax({
                type: "POST",
                url: '<?php echo e(URL::to('/practitioner/social-post/formsubmit/')); ?>',
                data: {
                    msg: $('#fb_description').val(),
                    link: $('#link').val(),
                    imagePath : $('#imagepath').val(),
                    checkTwitter : checkTwitter ? 'true' : 'false',
					checkFb : checkFb ? 'true' : 'false',
					checkLinked : checkLinked ? 'true' : 'false',
                    checkBlog : checkBlog ? 'true' : 'false',
                },
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                },
                success: function (result) {
					onPostClick();
					postOnwallFB();
                    var appender;
                    if (result == 'posted') {
                        showSuccess('msg','Posted on twitter');
						showSuccess('msg','Posted on Practicetab blog');
                    }
                    else {					
                        showError('msg','Some Error Occured in posting on twitter');
                    }
					$('#file').val('');
					$('#fb_description').val('');
					$('#link').val('');

                },
                error: function (error) {
                }
            });
        }

    </script>
	
<script>
var test;
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?php 	
				foreach($select as $val){
					if($val->key=='FB_api'){
					echo $val->value;
					}
					else{	
					}
				}
					?>',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();  
	checkLoginState();
  };  
  function returnLoginStateFB(){
	  var result = '';
	  FB.getLoginStatus(function(response) {
			result = response.status;
		});
		return result;
  }
  function logoutFB(){
	  FB.logout(function(response) {
		checkLoginState();
	});
  }
  function loginFB() {
            FB.login(function(response) {
			checkLoginState();
            }, {scope: 'email,public_profile,user_friends,publish_actions'});            
        }
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    console.log(response);
		if(response.status=='connected'){
			$('#fbLinkLog').html('').append('<a id="linkId" href="#" onclick="logoutFB();"> Logout</a>');
		}
		else{
			$('#fbLinkLog').html('').append('<a id="linkId" href="#" onclick="loginFB();"> Login</a>');
		}
  });
}
function showError(id,msg){
	$('#'+id).html('');
	$('#'+id).show();
	$('#'+id).html('<div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">Ã—</a><strong>Error!</strong> '+msg+'.</div>').delay(1000).fadeOut();
}
function showSuccess(id,msg){
	$('#'+id).html('');
	$('#'+id).show();
	$('#'+id).html('<div class="alert alert-success"><strong>Success! </strong>'+msg+'</div>').delay(1000).fadeOut();
}
function postOnwallFB(){
	var checkLinked = $('#check-fb').prop('checked');
    if(!checkLinked) return;
	if(returnLoginStateFB()=='connected'){
		var hash = {link:$('#link').val(),url:$('#imagepath').val()};
		var postingMethod = false;
		var prefix = '';
		if(hash['url']=="" && hash['link']==""){
			postingMethod = true;
		}
		if(hash['link']!=""&&!postingMethod){
			hash['message'] = $('#fb_description').val();
			hash['link'] = $('#link').val();
			postingMethod = true;
			prefix = 'feed';
		}
		if(hash['url']!=""&&!postingMethod){
			hash['message'] = $('#fb_description').val();
			postingMethod = true;
			prefix = 'photos';
		}
		FB.api('/me/'+prefix, 'post', hash, function(response) {
			if (!response || response.error) {
				showError('msg','Some error occured.');
			} else {
				showSuccess('msg','Posted on your wall.');
			}
		});
	} else {
		showError('msg','Facebook Account is not logged in');
	}
}
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
    <script type="in/Login"></script>
    <script type="text/javascript" src="//platform.linkedin.com/in.js">
        api_key: 			<?php 	
				foreach($select as $val){
					if($val->key=='LIN_api'){
					echo $val->value;
					}
					else{	
					}
				}
					?>
	
        authorize: true
        onLoad: onLinkedInLoad
    </script>

    <script type="text/javascript">

        // Setup an event listener to make an API call once auth is complete
        function onLinkedInLoad() {
            if(!IN.User.isAuthorized()) {
                $('#linkedInURL').html('').append('<a id="linkId" href="#" onclick="loginLinked();"> Login</a>');
				$('.IN-widget').hide();
            }
            else
            {
                $('#linkedInURL').html('').append('<a id="linkId" href="#" onclick="logoutLinked();"> Logout</a>');
            }
            //IN.Event.on(IN, "auth", shareContent);
        }
		function loginLinked()
        {
            //$('#'+$(".IN-widget").children().children().attr("id")+"-title-text").click();
			IN.User.authorize(function() {
				onLinkedInLoad();
			});
        }
		function logoutLinked(){
			IN.User.logout(function() {
				onLinkedInLoad();
			});
		}
        // Handle the successful return from the API call
        function onSuccess(data) {
            console.log(data);
        }

        // Handle an error response from the API call
        function onError(error) {
            console.log(error);
        }
        function onPostClick()
        {
			if($('#link').val()!=''){
						bodyRequest = JSON.stringify({
				"comment": $('#fb_description').val(),
				"content": {
				  "title": $('#fb_description').val(),
				  "submittedUrl": $('#link').val(),
				},"visibility": {"code": "anyone"}});
			}
			if($('#imagepath').val()!=''){
				bodyRequest = JSON.stringify({
				"comment": $('#fb_description').val(),
				"content": {
				  "title": $('#fb_description').val(),
				  "submittedUrl": location.protocol + "//" + location.host,
				  "submittedImageUrl": $('#imagepath').val()
				},"visibility": {"code": "anyone"}});
			}
            var checkLinked = $('#check-linked').prop('checked');
            if(!checkLinked) return;
			IN.API.Raw("people/~/shares")
           .method("POST")
           .body(bodyRequest)
           .result(function(result) { console.log(result);console.log("Success") }).
           error(function(result) {
              console.log(JSON.stringify(result));
           });
        }


    </script>
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-md-12">
            <div class="msg" id="msg">
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
                    <h4 class="panel-title">Write a Social Post for all your networks</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-4">
                        <!-- begin panel -->
                        <div class="panel panel-danger" data-sortable-id="ui-widget-16">
                            <div class="panel-heading">
                                <h4 class="panel-title">Social Networks</h4>
                            </div>
                            <div class="panel-body bg-red text-white">

                                <table>
                                    <tr><td>
                                            <i class="fa fa-pinterest"></i>
                                        </td>
                                        <td>
                                            <div class="checkbox text-white">
                                                <label class="text-white">
                                                    <input id="check-practice" type="checkbox" value="" checked="checked">
                                                    Send to PRACTICE TABS
                                                </label>
                                            </div>
                                        </td></tr>

                                    <tr><td>
                                            <i class="fa fa-facebook"></i>
                                        </td>
                                        <td>
                                            <div class="checkbox text-white" id="fbLink">
                                                <label class="text-white">
                                                    <input id="check-fb"  type="checkbox">
                                                    Send to FACEBOOK
                                                </label>
												<label class="text-white" id="fbLinkLog">
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr><td>
                                            <i class="fa fa-twitter"></i>
                                        </td>
                                        <td>
                                            <div class="checkbox text-white">
                                                <label class="text-white">
                                                    <input  id="check-twitter"  type="checkbox" value="off">
                                                    Send to TWITTER
                                                </label>
                                                <label class="text-white">
                                                    <?php
												
                                                    if(isset($_SESSION['access_token']))
                                                    {
                                                    ?>
                                                        <a id="linkId" href="<?php $actual_link = "http://$_SERVER[HTTP_HOST]"; echo $actual_link.'/dev/practitioner/social-post'.'/twitterlogout' ?>">
                                                            Logout
                                                        </a>
                                                    <?php }  else {?>
                                                    <a id="linkId" href="<?php $actual_link = "http://$_SERVER[HTTP_HOST]"; echo $actual_link.'/dev/practitioner/social-post'.'/twitterlogin' ?>">
                                                    Login
                                                    </a>
                                                    <?php } ?>
                                                </label>
                                            </div>
                                        </td></tr>
                                    <tr><td>
                                            <i class="fa fa-linkedin"></i>
                                        </td>
                                        <td>
                                            <div class="checkbox text-white">
                                                <label class="text-white">
                                                    <input  id="check-linked"  type="checkbox">
                                                    Send to LINKEDIN
                                                </label>
                                                <label class="text-white" id="linkedInURL">
                                                </label>
                                            </div>
                                        </td></tr>

                                </table>


                            </div>
                        </div>
                        <!-- end panel -->

                    </div>

                    <div class="col-md-8">
                        <?php echo Form::open(array('url'=>'/admin/manufacturer/store', 'class'=> 'form-horizontal', 'files'=>true)); ?>

                        <div class="form-group">
                            <?php echo Form::label('content','Post Contents *:', array('class'=>'control-label')); ?>

                            <div >
                                <?php echo Form::textarea('fb_description', null, array('class'=>'form-control', 'placeholder'=> 'Write something interesting','id'=>'fb_description')); ?>

                            </div>
                            <?php if($errors->has('name')): ?>
                                <div class="text-danger">
                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <a href="#" class="fa fa-link" id="add_url" data-toggle="tooltip" data-placement="top" title="Add URL"></a>
                            &nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="fa fa-image" id="add_picture" data-toggle="tooltip" data-placement="top" title="Add Image"></a>
                        </div>
                        <div class="form-group" id="toggle_link">
                            <div class="col-md-4">
                                <?php echo Form::text('link', null, array('class'=>'form-control', 'placeholder'=> 'Add link','id'=>'link')); ?>

                            </div>

                        </div>
                        <div class="form-group" id="toggle_image">
                            <div class="col-md-4">
                            <input onchange="uploadimage();" type="file" name="file" id="file" />
                            <input type="hidden" id="imagepath" name="imagepath" value="" />
                            </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <?php echo Form::button('Post', array('id'=>'postBtn','class'=>'btn btn-success pull-right','onclick'=>'formsubmit();')); ?>

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
    <script type="text/javascript">
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>