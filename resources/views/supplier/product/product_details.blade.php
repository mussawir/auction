@extends('layouts.supdash')
<style>
    .section-container {
        padding: 45px 0;
    }
    .section-container:before,
    .section-container:after {
        content: '';
        display: table;
        clear: both;
    }
    .section-container.has-bg {
        position: relative;
    }
    .section-container.has-bg .cover-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
    }
    .section-container.has-bg .cover-bg img {
        max-width: 100%;
    }
    .section-container.has-bg .cover-bg:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(36, 42, 48, 0.8);
    }
    .section-container.has-bg {
        color: #fff;
    }
    .section-container.has-bg .container {
        position: relative;
        z-index: 1020;
    }
    .section-container.has-bg .breadcrumb a {
        color: #fff;
    }
    .section-title {
        font-size: 20px;
        font-weight: 600;
        margin: -5px 0 25px;
        color: #212121;
    }
    .section-title a.pull-right {
        font-size: 12px;
        font-weight: bold;
        color: #666;
        border: 1px solid #ccc;
        padding: 8px 15px;
        line-height: 16px;
        margin: -7px 0;
        border-radius: 3px;
    }
    .section-title a.pull-right:hover,
    .section-title a.pull-right:focus {
        text-decoration: none;
        background: #fff;
        color: #212121;
    }
    .section-title small {
        margin-left: 5px;
        font-weight: 400;
        font-size: 14px;
        color: #999;
    }

    .product {
        background: #fff;
        border: 1px solid #c5ced4;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
    .product:before,
    .product:after {
        content: '';
        display: table;
        clear: both;
    }
    .product-detail {
        display: table;
        width: 100%;
    }


    /* 12.2 Product Thumbnail Setting */

    .product-image,
    .product-info {
        display: table-cell;
        vertical-align: top;
    }
    .product-main-image {
        margin-left: 80px;
        padding: 20px;
        height: 400px;
        width: 450px;
        text-align: center;
    }
    .product-thumbnail {
        width: 80px;
        float: left;
        padding: 20px;
        max-height: 525px;
    }
    .product-thumbnail-list {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    .product-thumbnail-list > li a {
        display: block;
        text-decoration: none;
        border: 2px solid #9c9c9c;
        background: #fff;
        height: 40px;
        line-height: 40px;
        text-align: center;
    }
    .product-thumbnail-list > li + li {
        margin-top: 10px;
    }
    .product-thumbnail-list > li.active a {
        border-color: #212121;
    }
    .product-thumbnail-list > li a img {
        max-width: 100%;
        max-height: 100%;
        position: relative;
        
    }


    /* 12.3 Product Image Setting */

    .product-image {
        width: 530px;
    }
    .product-image img {
        max-width: 100%;
    }
    .product-main-image img {
        max-height: 100%;
    }


    /* 12.4 Product Info Setting */

    .product-info {
        padding: 20px 30px;
        margin-bottom: 20px;
    }
    .product-info-header {
        padding-bottom: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #D8E0E4;
    }
    .product-title {
        margin: 0 0 10px;
        font-size: 18px;
        font-weight: 600;
        line-height: 24px;
    }
    .product-title .label {
        padding: 5px 8px;
        font-size: 14px;
        float: left;
        margin-right: 10px;
    }


    /* 12.5 Product Availability Setting */

    .product-availability {
        font-size: 18px;
    }


    /* 12.6 Product Info List Setting */

    .product-info-list {
        color: #636363;
        list-style-type: none;
        margin: 0 0 15px;
        padding: 0 0 15px;
        line-height: 20px;
        border-bottom: 1px solid #D8E0E4;
    }
    .product-info-list > li {
        position: relative;
        padding-left: 20px;
    }
    .product-info-list > li + li {
        margin-top: 3px;
    }
    .product-info-list > li .fa {
        position: absolute;
        left: 0;
        top: 50%;
        margin-top: -10px;
        line-height: 20px;
        width: 15px;
        text-align: center;
    }
    .product-info-list > li .fa.fa-circle {
        font-size: 5px;
    }


    /* 12.7 Product Category Setting */

    .product-category {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    .product-category > li {
        display: inline;
    }
    .product-category > li + li {
        margin-left: 5px;
    }
    .product-category > li a {
        color: #707478;
    }


    /* 12.8 Product Price Setting */

    .product-price {
        margin: 0 0 15px;
    }
    .product-price:before,
    .product-price:after {
        content: '';
        display: table;
        clear: both;
    }
    .product-price .price {
        font-size: 18px;
    }


    /* 12.9 Product Warranty Setting */

    .product-warranty {
        padding-bottom: 32px;
        margin-bottom: 23px;
        border-bottom: 1px solid #D8E0E4;
        width:100%;
    }


    /* 12.10 Product Discount Setting */

    .product-discount .discount {
        font-size: 16px;
        font-weight: 600;
        text-decoration: line-through;
        color: #707478;
    }
    .product-discount .save {
        margin-left: 10px;
        color: #707478;
        position: relative;
        top: -1px;
    }


    /* 12.11 Product Social Setting */

    .product-social {
        margin: 0 0 15px;
        padding: 0 0 15px;
        border-bottom: 1px solid #D8E0E4;
    }
    .product-social:before,
    .product-social:after {
        content: '';
        display: table;
        clear: both;
    }
    .product-social ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }
    .product-social ul > li {
        float: left;
    }
    .product-social ul > li + li {
        margin-left: 10px;
    }
    .product-social ul > li > a {
        width: 30px;
        height: 30px;
        line-height: 30px;
        background: #ddd;
        color: #fff;
        display: inline-block;
        text-align: center;
        font-size: 16px;
        border-radius: 3px;
    }
    .product-social ul > li > a.facebook {
        background: #3b5998;
    }
    .product-social ul > li > a.twitter {
        background: #00aced;
    }
    .product-social ul > li > a.google-plus {
        background: #d34836;
    }
    .product-social ul > li > a.whatsapp {
        background: #6CC964;
    }
    .product-social ul > li > a.tumblr {
        background: #36465d;
    }


    /* 12.12 Product Tab Setting */

    .product-tab {
        margin-top: 40px;
    }
    .product-tab .nav.nav-tabs {
        background: #fff;
        border-bottom: 1px solid #D8E0E4;
        text-align: center;
        font-size: 16px;
    }
    .product-tab .nav.nav-tabs > li {
        float: none;
        display: inline-block;
    }
    .product-tab .nav.nav-tabs > li + li {
        margin-left: 5px;
    }
    .product-tab .nav.nav-tabs > li > a {
        position: relative;
        color: #A3A8AD;
        border: 1px solid transparent;
    }
    .product-tab .nav.nav-tabs > li > a:hover,
    .product-tab .nav.nav-tabs > li > a:focus {
        border-bottom: 1px solid #666;
        background: none;
    }
    .product-tab .nav-tabs > li.active > a,
    .product-tab .nav-tabs > li.active > a:focus,
    .product-tab .nav-tabs > li.active > a:hover {
        border-color: transparent;
        border-bottom: 1px solid #212121;
        color: #212121;
    }
    .product-tab .tab-content {
        padding: 40px;
    }

    /* 12.13 Product Desc Setting */

    .product-desc {
        padding: 20px;
    }
    .product-desc:before,
    .product-desc:after {
        content: '';
        display: table;
        clear: both;
    }
    .product-desc .image {
        float: left;
        width: 50%;
        padding-right: 40px;
    }
    .product-desc .image img {
        max-width: 100%;
    }
    .product-desc .desc {
        float: left;
        width: 50%;
        padding-left: 40px;
    }
    .product-desc .desc h4 {
        margin: 0 0 15px;
        font-size: 36px;
        font-weight: 300;
    }
    .product-desc .desc p {
        font-size: 16px;
        font-weight: normal;
        color: #929292;
        line-height: 26px;
    }
    .product-desc + .product-desc {
        margin-top: 20px;
        padding-top: 40px;
        border-top: 1px solid #D8E0E4;
    }
    .product-desc.right .image {
        float: right;
        padding-left: 20px;
        padding-right: 0;
    }
    .product-desc.right .desc {
        float: left;
        text-align: right;
        padding-right: 20px;
        padding-left: 0;
    }

</style>
@section('content')

    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/supplier')}}">Dashboard</a></li>
		<li><a href="{{url('/supplier/product/list')}}">List</a></li>
        <li class="active">Product Details</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Product Details <small></small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-md-12">
            <div class="msg">
                @if(Session::has('success'))
                    <div class="alert alert-success fade in">
                        <strong>Success!</strong>
                        <strong>{{Session::pull('success')}}</strong>
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                @elseif(Session::has('error'))
                    <div class="alert alert-danger fade in">
                        <strong>Error!</strong>
                        <strong>{{Session::pull('error')}}</strong>
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                @endif
            </div>
        </div>
		
    </div>
    <div class="product">
        <!-- BEGIN product-detail -->
        <!-- BEGIN product-image -->
        <div class="row">
            <div class="col-md-6">
                <div class="product-image">
                    <!-- BEGIN product-thumbnail -->
                    <div class="product-thumbnail">
                        <ul class="product-thumbnail-list">
						@if(isset($image))
                            @foreach($image as $item)
                                <li>
                                    <a href="#" data-click="show-main-image" data-url="{{asset($item->image_path)}}">
                                        <img src="{{asset($item->image_path)}}" alt="{{$item->products_name}}"/>
                                    </a>
									</li>
                            @endforeach
						@endif
						<li>
						<a href="#" data-click="show-main-image" data-url="{{asset($product->mainImage)}}">
                                        <img src="{{asset($product->mainImage)}}" alt="{{$product->mainImage}}"/>
                                    </a>
						</li>
                        </ul>
                    </div>
                    <!-- END product-thumbnail -->
                    <!-- BEGIN product-main-image -->
                    <div class="product-main-image" data-id="main-image">
                        <img src="{{asset($product->mainImage)}}" alt="" />
                    </div>
                    <!-- END product-main-image -->
                </div>
            </div>
            <div class="col-md-6" style="padding: 20px 30px;margin-bottom: 20px;">
                <!-- BEGIN product-info-header -->
                <div class="product-info-header">
                    <h1 class="product-title">
					<?php if($product->discountPer > 0){ ?>
					<span class="label label-success">{{ $product->discountPer }}% OFF</span>
					<?php } ?>
					{{ $product->products_name }} </h1>
                    <h6><strong>Short Description: </strong>{{ $product->short_description }}</h6>
                </div>
                <!-- END product-info-header -->
                <!-- BEGIN product-warranty -->
                {{--<div class="product-warranty">--}}
                {{----}}
                {{--</div>--}}
                @if($product->quantity > 0)
                    <div class="pull-right">Availability: In stock</div>
                @else
                    <div class="pull-right">Availability: Out of stock</div>
                    @endif
                            <!-- END product-warranty -->
                    <!-- BEGIN product-info-list -->
                    <ul class="product-info-list">
                        <li><i class="fa fa-circle"></i><strong>Posted at:</strong> {{date('d-m-Y',strtotime($product->created_at))}}</li>
                        <li><i class="fa fa-circle"></i><strong>Product Tags:</strong>
                            @if($product->tags==null)
                                No Tags
                            @else
                            <?php
                               $tags = explode(',',$product->tags)
                            ?>
                             @foreach($tags as $tag)
                                <span class="label label-default" style="background-color: #00acac;color:#fff;">{{ $tag }}</span>
                             @endforeach
                             @endif
                        </li>
                        <li><i class="fa fa-circle"></i><strong>Total Products Quantity:</strong> {{ $product->quantity }}</li>
						<li><i class="fa fa-circle"></i><strong>SKU:</strong> {{ $product->SKU }}</li>
                        <li><i class="fa fa-circle"></i><strong>Category: </strong>
						
						@if($product->cat_id == null)
                                No Category
                            @else
                            <?php
                               $cate = explode(',',$product->cat_id)
                            ?>
                             @foreach($cate as $cat)
                            <span class="label label-default" style="background-color: #00acac;color:#fff;     margin-right: 2px;"><?php   $cat;
                           $categories = DB::table('categories')->where('cat_id',$cat)->first();
                            echo $categories->cat_name;?>
							</span>
							
                             @endforeach
                             @endif
						
						
						
						
						
						
						
						
						</li>
                        <li><i class="fa fa-circle"></i><strong>Products Tax:</strong>
                            @if($product->taxPer == null)
                                Tax free product
                                @else
                                    {{ $product->taxPer }}%
                            @endif
                        </li>

                    </ul>
                    {{--{!! Form::open(array('url'=>'/patient/ecommerce/cart', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}--}}
                    {{--<input type="hidden" value="{{ $product->products_id }}" name="products_id" id="products_id">--}}
                    {{--<input type="hidden" value="{{ $store_id }}" name="store_id" id="store_id">--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('quantity','Quantity *:', array('class'=>' control-label','style'=>'margin:5px 14px;')) !!}--}}
                        {{--{!! Form::number('quantity', '1', array('class'=>'form-control', 'data-parsley-required'=>'true', 'style'=>'width:60px;margin:0 14px;','min'=>'1')) !!}--}}
                    {{--</div>--}}
                    <div class="product-purchase-container">
                        <div class="product-discount">
                            <span class="discount"><strong>Original Price:</strong> ${{ $product->price }}</span>
                        </div>
                        <div class="product-price">
                            <?php
                            $selling = $product->price - ($product->price * ($product->discountPer / 100)) ?>
                            <div class="price"><strong>Discounted Price:</strong> ${{ round($selling) }}</div>
                        </div>
                        {{--{!! Form::submit('ADD TO CART', array('class'=>'btn btn-inverse btn-lg')) !!}--}}
                        {{--{!! Form::close() !!}--}}
                    </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12" style="padding: 0 32px 40px 32px;">
                <h5><strong>Product Detailed Description:</strong></h5>
                
                    <?php print $product->productDescription; ?>
                
            </div>
        </div>
    </div>

    <!-- END product-tab -->


    <!-- end row -->
@endsection

@section('page-scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });
    </script>

@endsection