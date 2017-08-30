
@extends('layouts.post_header')


<style>
.wrap-cont{
	width:80%;
	margin:2% auto;
}

.wrap-cont p{
	padding: 0 20px 0 20px;
    text-align: justify;
}



.full-blog{
	background-color: #F6F7F9;
    border-radius: 5px 28px;

}
.p-head{
	padding: 2% 0 0 2%;
    color: black;
    font-size: x-large;
    font-weight: 600;
}





</style>

@section('content')


        <div class="wrap-cont">
            <!-- begin row -->
            
                <!-- begin col-9 -->
                <div class="col-sm-9">
                    <!-- begin post-detail -->
					@foreach($posts as $post)
                    <div class="full-blog" >					   
                            <h4 class="p-head">
							{{$post->heading}}
                        </h4>
                        <div class="post-by">
                            Posted By <a href="#">
							{{$pra->first_name}}
							{{$pra->middle_name}} 
						    {{$pra->last_name}}</a> <span class="divider">|</span> 
							{{ $post->created_at }} </a>
                        </div>
                        <!-- begin post-image -->
                      <!--  <div class="post-image">
                            <img src="assets/img/post1.jpg" alt="" />
                        </div>-->
                        <!-- end post-image -->
                        <!-- begin post-desc -->
                        <div class="post-desc">
                            <p>
                             <?php print substr($post->contents,0); 
										?>
                           </P>
                        </div>
                        <!-- end post-desc -->
                        <!-- begin post-image -->
                       
                    <!-- end post-detail -->
					
					</div>
					<br>
					<br>
                       @endforeach
                    
                    
                    
                   
                <!-- end col-9 -->
				</div>
                <!-- begin col-3 -->
                <div class="col-sm-3">
                    
                    
                </div>
                <!-- end col-3 -->
          
            <!-- end row -->
        
        <!-- end container -->
    </div>
   
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('public/blog_assets/plugins/jquery/jquery-1.9.1.min.js')}}"></script>
	<script src="{{asset('public/blog_assets/plugins/jquery/jquery-migrate-1.1.0.min.js')}}
"></script>
	<script src="{{asset('public/blog_assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<!--[if lt IE 9]>
		<script src="{{asset('public/blog_assets/crossbrowserjs/html5shiv.js')}}"></script>
		<script src="{{asset('public/blog_assets/crossbrowserjs/respond.min.js')}}"></script>
		<script src="{{asset('public/blog_assets/crossbrowserjs/excanvas.min.js')}}"></script>
	<![endif]-->
	<script src="{{asset('public/blog_assets/plugins/jquery-cookie/jquery.cookie.js')}}"></script>
	<script src="{{asset('public/blog_assets/plugins/masonry/masonry.min.js')}}"></script>
	<script src="{{asset('public/blog_assets/js/apps.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
	
      <script>
	    $(document).ready(function() {
	        App.init();
	    });
	</script>

@endsection