<style>
.post-hr{
	border-top: 1px solid #00acac;
}
.image-thumbnail-curved{
	       border-radius: 45px;
    width: 45px;
    height: 45px;
    cursor: pointer;
    /* position: absolute; */
    /* left: 18px; */
    /* top: 50px; */
    /* width: 13%; */
    margin-top: 4px;
}
.title-heading{
	       /* position: absolute; */
    font-size: 18px;
    font-weight: 700;
    /* right: 40px; */
    /* top: 206px; */
    font-family: Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;
    /* width: 80%; */
    /* right: 15px; */
    /* margin-left: 44px; */
    display: inline;
}
span.post-font {
    padding-left: 12px;
}
.col-lg-12.col-md-12 > .fa > span:hover{
    color: green;
}
.col-lg-12.col-md-12 > .fa {
    color: black;
}
</style>
</style>
                <div class="row">
				@if(count($adminBlog)) 
                    
                    <div class="col-md-12" style="margin-bottom:10px;">
                        
						
					<div class="row">
 <div class="row" style="margin: 0px 100px;background: white;">
 @foreach($adminBlog as $items)
 <a href="{{$items->post_link}}">
   <div class="col-lg-12 col-md-12"  style="padding: 0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
   <div>
     <img style="width: 100%;" class="img-responsive" src="{{url('/').$items->image_path}}">
	</div>
	<div class="col-lg-12 col-md-12 text-center">
     <h4 style="color: #00ACAC;font-weight: 100;font-size: 18px;font-family: Helvetica, Arial, Sans-Serif;">{{$items->blog_title}}</h4>
     <!--<p style="font-size:10px;margin-top:10px;"><strong>posted at:</strong> </p>-->
	 <i class="fa fa-calendar-check-o" aria-hidden="true"><span class="post-font">{{$items->created_at}}</span></i> / 
	 <i class="fa fa-user-md" aria-hidden="true"><span class="post-font">{{$items->first_name}} {{$items->last_name}}</span></i>
	</div>
</a>
	<?php if(isset($items->blog_text) && $items->blog_text!="") {?>
	<div style="margin-bottom: 20px;" class="col-lg-12 col-md-12">
	<hr class="post-hr">
	<div class="col-lg-12 col-md-12">
	<?php print $items->blog_text; ?>
	</div>
	</div>
	<?php } ?>
   </div>
  @endforeach
 </div>
</div>
						
						
                    </div>
                    
					@else
						<h1 class="text-center">No Posts Yet!!</h1>   
					@endif
                </div>
<script type="text/javascript" src="{{asset('public/plugins/jquery/jquery-1.9.1.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<!-- panel end -->