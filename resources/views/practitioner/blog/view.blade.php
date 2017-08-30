@extends('layouts.front')

@section('content')

<style>
.clearfix::after {
    content: "";
    clear: both ;
    display: table;
}

.readmorea,.readmorea:hover{
	text-decoration : none;
		font-size: 14px;
}
.img-view img{
  width:100% !important;
  height:auto !important;
	
}

</style>

<section>
        <div class="container">
            <div class="row">
                <div class="col-sm-8" >
                    <div class="img-view"style=" padding: 10px 20px;">
                        <h1 class="text-primary" style="margin-left: -20px;">Your Post</h1> 
                   
                        <div class="col-sm-12" style="padding: 10px 10px;    margin: 15px -20px;  background-color: #F6F7F9;"">
						<h4>{{$posts->heading}}</h4><span style="font-size: 15px; margin-bottom: 4px;"><i class="fa fa-calendar" aria-hidden="true" style="padding-right: 6px; margin-bottom: 5px;"></i>{{ $posts->created_at }}</span>
							<!--<img src="http://aliinfotech.com/eraustralia/images/user/postss/256929medical-equipment-resale.jpg" alt="" class="img-responsive" style="height:250px;width:100%;"> -->
                           <div>
                                <h2 class="text-primary"></h2>
                                <div  class="timeline-content">
<?php
                                        $type = '';
                                        $typeId = $posts->typeId; 
                                    if($posts->typeId = 0 || $posts->typeId=="")
                                        {
                                            $type = 'pinterest';
                                        }
                                        else if($typeId == 1) {$type = 'facebook'; }
                                        else if($typeId== 2) {$type = 'twitter'; }
                                        else if($typeId == 3) {$type = 'linkedin';}
                                    ?>
								<!--<span class="fa-stack fa-2x text-primary">
									<i class="fa fa-square-o fa-stack-2x"></i>
									<i class="fa fa-<?php echo $type; ?> fa-stack-1x"></i>
								</span>-->


                                    <span>
                                </span>
                                </div> 
                            </div>
                            <div >
                                
                            <div  class="timeline-content" max-width="" id="morediv<?php echo $posts->post_id; ?>">
                                     <p class="minimize">
                                 <?php print substr($posts->contents, 0, 250); 
										?></p>
							
                            </div>
							<?php 
										$len = $posts->contents;
									 $lent = strlen($len);
										if($lent > 250){
											echo '<a class="readmorea" id="readmore'.$posts->post_id.'" onclick="togglerOfSelf(\'lessdiv'.$posts->post_id.'\',\'morediv'.$posts->post_id.'\');$(this).hide();" href="javascript:void(0)"><span>'.'&nbsp;Read More'.'</span></a>';
										}
										else{}
										?>
							<div style="display:none"  class="timeline-content" id="lessdiv<?php echo $posts->post_id; ?>">
                                <p class=" minimize">
                                 <?php print $posts->contents; ?>
								<!--<a href="#"><span id="less<?php //echo $posts->posts_id; ?>">&nbsp;Less</span></a>-->
								<a class="readmorea" onclick="$('#readmore<?php echo $posts->post_id; ?>').show();togglerOfSelf('morediv<?php echo $posts->post_id; ?>','lessdiv<?php echo $posts->post_id; ?>');" href="javascript:void(0)"><span>&nbsp; Less</span></a>
								</p>
					
								
                            </div><br>
							<span class="fa-stack fa-2x text-primary">
									<i class="fa fa-square-o fa-stack-2x"></i>
									<i class="fa fa-<?php echo $type; ?> fa-stack-1x"></i>
								</span>
                            </div>
                        </div>
                    
                    </div>
					
                </div>
				
                
            </div>
        </div>
    </section>
	@section('page-scripts')
<script type="text/javascript">

function togglerOfSelf(showSpan,hideSpan){
		$('#'+showSpan).show();
		$('#'+hideSpan).hide();
	}
$(document).ready(function(){

	$("#lessdiv").hide();
    $("#more").click(function(){
        $("#lessdiv").show();
		$("#morediv").hide();
    });
	$("#less").click(function(){
        $("#lessdiv").hide();
		$("#morediv").show();
    });
	function togglerOfSelf(showSpan,hideSpan){
		$('#'+showSpan).show();
		$('#'+hideSpan).hide();
	}
});
</script>
@endsection