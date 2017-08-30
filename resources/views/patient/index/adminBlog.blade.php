@extends('layouts.padash')
@section('content')
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li><a href="javascript:;">Home</a></li>
            <li class="active">Message</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Blog Post</h1>
		<?php if($adminBlog) { foreach($adminBlog as $items) { ?>
        <div class="post-detail section-container">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Sports</a></li>
                            <li class="active">Bootstrap Carousel Blog Post</li>
                        </ul>
                        <h4 class="post-title">
                            <a href="post_detail.html">Bootstrap Carousel Blog Post</a>
                        </h4>
                        <div class="post-by">
                            Posted By <a href="#">{{$items->first_name}} {{$items->last_name}}</a> <span class="divider">|</span> <?php $date = date_create($item->created_at);echo date_format($date, 'm/d/Y');?><span class="divider">
                        </div>
                        <!-- begin post-image -->
                        <div class="post-image">
                            <img src="{{url('/').$items->image_path}}" alt="">
                        </div>
                        <!-- end post-image -->
                        <!-- begin post-desc -->
                        <div class="post-desc">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed commodo eget quam sed tempor. 
                                Morbi vel libero eget urna interdum accumsan nec non nibh. Nam aliquam id ligula convallis egestas. 
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum lacinia lectus nibh, nec 
                                pellentesque lorem iaculis ut. Cras finibus arcu eget feugiat hendrerit. Suspendisse quis 
                                molestie velit. In hendrerit justo ac magna tristique viverra. Pellentesque rhoncus metus 
                                eget ex sagittis lacinia. In at dapibus erat. Phasellus imperdiet dui risus, eget efficitur 
                                tortor egestas nec. Integer fermentum sit amet mauris sollicitudin pulvinar.
                                Quisque et viverra leo. Suspendisse neque nisi, lacinia facilisis sem ac, tincidunt lacinia augue. 
                                Etiam in dapibus nisl, non blandit urna. Proin scelerisque venenatis vestibulum. 
                                Proin iaculis finibus turpis, eget rhoncus tortor tempor a.
                            </p>
                        </div>
                    </div>
		<?php break;}}?>
@endsection
@section('page-scripts')
    <script type="text/javascript">
        App.init();
		$( document ).ready(function() {
		$('.pace-done').css('background','white');
		$('body').css('background','white');
		$('.sidebar-minify-btn').click();
	});
    </script>
@endsection
