<?php $__env->startSection('content'); ?>

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
            top: -3px;
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
            font-size: 32px;
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
        <!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="<?php echo e(url('/admin')); ?>">Dashboard</a></li>
    <li class="active">Suppliers Products Details</li>
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
            <?php if(Session::has('success')): ?>
                <div class="alert alert-success fade in">
                    <strong>Success!</strong>
                    <strong><?php echo e(Session::pull('success')); ?></strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            <?php elseif(Session::has('error')): ?>
                <div class="alert alert-danger fade in">
                    <strong>Error!</strong>
                    <strong><?php echo e(Session::pull('error')); ?></strong>
                    <span class="close" data-dismiss="alert">×</span>
                </div>
            <?php endif; ?>
        </div>
        <!-- begin panel -->

                <div class="row">
                    <div class="product">
                        <!-- BEGIN product-detail -->

                        <!-- BEGIN product-image -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-image">
                                    <!-- BEGIN product-thumbnail -->
                                    <div class="product-thumbnail">
                                        <ul class="product-thumbnail-list">
										<?php if(isset($images)){?>
                                            <?php foreach($images as $item): ?>
                                                <li>
                                                    <a href="#" data-click="show-main-image" data-url="<?php echo e(asset($item->image_path)); ?>">
                                                        <img src="<?php echo e(asset($item->image_path)); ?>" onclick="$('#hero-main-image').attr('src',$(this).attr('src'));" alt=""/>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
										<?php } ?>
                                        </ul>
                                    </div>
                                    <!-- END product-thumbnail -->
                                    <!-- BEGIN product-main-image -->
									<?php  if(isset($product->mainImage)){ ?>
                                    <div class="product-main-image" data-id="main-image">
                                        <img src="<?php echo e(asset($product->mainImage)); ?>" id="hero-main-image" alt="" />
                                    </div>
									<?php } ?>
                                    <!-- END product-main-image -->
                                </div>
                            </div>
                            <div class="col-md-6" style="padding: 20px 30px;margin-bottom: 20px;">
                                <!-- BEGIN product-info-header -->
                                <div class="product-info-header">
                                    <h1 class="product-title"><span class="label label-success"><?php echo e($product->discountPer); ?> % OFF</span> <?php echo e($product->products_name); ?> </h1>
                                    <h6><strong>Short Description: </strong><?php echo e($product->short_description); ?></h6>

                                </div>
                                <!-- END product-info-header -->
                                <!-- BEGIN product-warranty -->
                                <?php /*<div class="product-warranty">*/ ?>
                                <?php /**/ ?>
                                <?php /*</div>*/ ?>
                                <?php if($product->quantity > 0): ?>
                                    <div class="pull-right">Availability: In stock</div>
                                <?php else: ?>
                                    <div class="pull-right">Availability: Out of stock</div>
                                    <?php endif; ?>
                                            <!-- END product-warranty -->
                                    <!-- BEGIN product-info-list -->
                                    <ul class="product-info-list">
                                        <li><i class="fa fa-circle"></i><strong>Posted at:</strong> <?php echo e($product->created_at); ?></li>
                                        <li><i class="fa fa-circle"></i><strong>Product Tags:</strong>
                                            <?php if($product->tags==null): ?>
                                                No Tags
                                            <?php else: ?>
                                                <?php
                                                $tags = explode(',',$product->tags)
                                                ?>
                                                <?php foreach($tags as $tag): ?>
                                                    <span class="label label-default" style="background-color: #00acac;color:#fff;"><?php echo e($tag); ?></span>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </li>
                                        <li><i class="fa fa-circle"></i><strong>Total Products Quantity:</strong> <?php echo e($product->quantity); ?></li>
										<li><i class="fa fa-circle"></i><strong>SKU:</strong> <?php echo e($product->SKU); ?></li>
                                        
                                        <li><i class="fa fa-circle"></i><strong>Supplier: </strong><?php echo e($product->first_name); ?> <?php echo e($product->last_name); ?></li>
                                        <li><i class="fa fa-circle"></i><strong>Products Tax:</strong>
                                            <?php if($product->taxPer == null): ?>
                                                Tax free product
                                            <?php else: ?>
                                                <?php echo e($product->taxPer); ?>%
                                            <?php endif; ?>
                                        </li>
                                    </ul>
                                    <?php /*<?php echo Form::open(array('url'=>'/patient/ecommerce/cart', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')); ?>*/ ?>
                                    <?php /*<input type="hidden" value="<?php echo e($product->products_id); ?>" name="products_id" id="products_id">*/ ?>
                                    <?php /*<input type="hidden" value="<?php echo e($store_id); ?>" name="store_id" id="store_id">*/ ?>
                                    <?php /*<div class="form-group">*/ ?>
                                    <?php /*<?php echo Form::label('quantity','Quantity *:', array('class'=>' control-label','style'=>'margin:5px 14px;')); ?>*/ ?>
                                    <?php /*<?php echo Form::number('quantity', '1', array('class'=>'form-control', 'data-parsley-required'=>'true', 'style'=>'width:60px;margin:0 14px;','min'=>'1')); ?>*/ ?>
                                    <?php /*</div>*/ ?>
                                    <div class="product-purchase-container">
                                        <div class="product-discount">
                                            <span class="discount">Original Price: $<?php echo e($product->price); ?></span>
                                        </div>
                                        <div class="product-price">
                                            <?php
                                            $selling = $product->price - ($product->price * ($product->discountPer / 100)) ?>
                                            <div class="price"> Discounted Price: $<?php echo e(round($selling)); ?></div>
                                        </div>
                                        <?php /*<?php echo Form::submit('ADD TO CART', array('class'=>'btn btn-inverse btn-lg')); ?>*/ ?>
                                        <?php /*<?php echo Form::close(); ?>*/ ?>
                                    </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12" style="padding: 0 32px 40px 32px;">
                                <h5>Product Description</h5>
                                <p>
                                    <?php $pro = $product->productDescription;  
									 echo $pro;?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php /*<div class="col-md-6">*/ ?>
                        <?php /*<h5><strong>Product Images:</strong></h5>*/ ?>
                        <?php /*<?php foreach($images as $image): ?>*/ ?>
                                <?php /*<div class="col-md-6" style="margin-bottom: 15px;">*/ ?>
                                            <?php /*<img src="<?php echo e(asset($image->image_path)); ?>" alt="Northern Lights, Norway" width="200" height="200">*/ ?>
                                <?php /*</div>*/ ?>
                        <?php /*<?php endforeach; ?>*/ ?>
                    <?php /*</div>*/ ?>
                    <?php /*<div class="col-md-6">*/ ?>
                        <?php /*<h5><strong>Product Name:</strong> <?php echo e($product->products_name); ?></h5>*/ ?>
                        <?php /*<h5><strong>Product Category:</strong> <?php echo e($product->cat_name); ?></h5>*/ ?>
                        <?php /*<h5><strong>Product Price:</strong> $<?php echo e($product->price); ?></h5>*/ ?>
                        <?php /*<h5><strong>Product Qunaity:</strong> <?php echo e($product->quantity); ?></h5>*/ ?>
                        <?php /*<h5><strong>Product Tags:</strong> <?php echo e($product->tags); ?></h5>*/ ?>
                        <?php /*<h5><strong>Product Tax Percentage</strong>: <?php echo e($product->taxPer); ?></h5>*/ ?>
                        <?php /*<h5><strong>Product Tax Amount</strong>: <?php echo e($product->taxAmount); ?></h5>*/ ?>
                        <?php /*<h5><strong>Product Description:</strong> </h5>*/ ?>
                        <?php /*<p><?php echo e($product->productDescription); ?></p>*/ ?>

                    <?php /*</div>*/ ?>
                </div>
            </div>
        </div>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <span class="close">x</span>
            <img class="modal-content" id="img01" height="600">
        </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
            alert(this.src);
            modal.style.display=  "block";
            modalImg.src = img.src;
            captionText.innerHTML = img.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>

    <script type="text/javascript">
        $(function () {
            if ($('#data-table').length !== 0) {
                $('#data-table').DataTable({
                    responsive: true,
                    "aaSorting": [[1, "asc"]],
                    "iDisplayLength": 10,
                    "aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                    "aoColumnDefs": [{'bSortable': false, 'aTargets': [0,2]}]
                });
            }
        });

        function doDelete(id, elm)
        {
            //var q = confirm("Are you sure you want to delete this manufacturer?");
            // if (q == true)
            {

                $.ajax({
                    type: "DELETE",
                    url: '<?php echo e(URL::to('/admin/supplier/destroy')); ?>/' + id,
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
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pradash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>