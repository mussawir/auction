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

.my-contain{
	width:98%;
	margin:70px 0 0 12px;
	padding:0 0 0 0;
	
}

.blog-text{
	width:80%;
	margin:0 auto;
	padding:0 0 40px 0;
	
}

</style>

       
         <div class="my-contain" > 
		 
		 <?php if(count($adminBlog)): ?> 
                    
         <div class="col-sm-12 bg-white" style="margin:0; padding:0;" >
               
         <?php foreach($adminBlog as $items): ?>
     
	     <a href="<?php echo e($items->post_link); ?>">
  
         <img style="width: 100%;" class="img-responsive" src="<?php echo e(url('/').$items->image_path); ?>">

	<div class="col-sm-12 text-center">
     <h4 style="color: #00ACAC;font-weight: 100;font-size: 18px;font-family: Helvetica, Arial, Sans-Serif;"><?php echo e($items->blog_title); ?></h4>
     
	 <i class="fa fa-calendar-check-o" aria-hidden="true"><span class="post-font"><?php echo e($items->created_at); ?></span></i> / 
	 <i class="fa fa-user-md" aria-hidden="true"><span class="post-font"><?php echo e($items->first_name); ?> <?php echo e($items->last_name); ?></span></i>
	</div>
    </a>
	
	<?php if(isset ($items->blog_text)): ?>
        <hr class="">
	     <div class="blog-text">
		 <?php print substr($items->blog_text,0) ?>
      	</div>
		<?php else: ?>
		<hr class="post-hr">
	    <h1 class="text-center">No Posts Yet!!</h1>
	   <?php endif; ?>
  
       <?php endforeach; ?>

</div>
					<?php else: ?>
						<h1 class="text-center">No Posts Yet!!</h1>   
					<?php endif; ?>
                   </div>
                   
<script type="text/javascript">
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<!-- panel end -->