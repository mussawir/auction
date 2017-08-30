<?php $__env->startSection('content'); ?>
    <style>
        .search-item-container .item-row .item {
            float: left;
            width: 33.33%;
            border: none;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }
        .search-item-container .item-row .item:first-child {
            -webkit-border-radius: 3px 0 0 0;
            -moz-border-radius: 3px 0 0 0;
            border-radius: 3px 0 0 0;
        }
        .search-item-container .item-row .item:last-child {
            -webkit-border-radius: 0 3px 0 0;
            -moz-border-radius: 0 3px 0 0;
            border-radius: 0 3px 0 0;
        }
        .search-item-container .item-row:last-child .item:first-child {
            -webkit-border-radius: 0 0 0 3px;
            -moz-border-radius: 0 0 0 3px;
            border-radius: 0 0 0 3px;
        }
        .search-item-container .item-row:last-child .item:last-child {
            -webkit-border-radius: 0 0 3px 0;
            -moz-border-radius: 0 0 3px 0;
            border-radius: 0 0 3px 0;
        }
        .search-item-container .item-row + .item-row {
            border-top: 1px solid #ccd0d4;
        }
        .search-item-container .item-row .item + .item {
            border-left: 1px solid #ccd0d4;
        }
        .item {
            background: #fff;
        }
        .item.item-thumbnail {
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            border: 1px solid #c5ced4;
            transition:all 0.5s linear;
			
        }
        .item.item-thumbnail a,
        .item.item-thumbnail a:hover,
        .item.item-thumbnail a:focus {
            text-decoration: none;
        }
        .item.item-thumbnail .item-image {
            height: 130px;
            text-align: center;
            padding: 15px;
            line-height: 100px;
            display: block;
            position: relative;
        }
        .item.item-thumbnail .item-image .discount {
            position: absolute;
            bottom: 0;
            right: 15px;
            line-height: 20px;
            padding: 2px 10px;
            color: #fff;
            background: #2d353c;
            font-weight: 600;
            font-size: 13px;
        }
        .item.item-thumbnail .item-image img {
            max-width: 100%;
            max-height: 100%;
        }
        .item.item-thumbnail .item-info {
            padding: 15px;
            text-align: center;
        }
        .item.item-thumbnail .item-title {
            margin: 0 0 3px;
        }
        .item.item-thumbnail .item-title,
        .item.item-thumbnail .item-title a {
            font-weight: 600;
            color: #212121;
            font-size: 14px;
            line-height: 18px;
            max-height: 36px;
            overflow: hidden;
        }
        .item.item-thumbnail .item-title a:hover,
        .item.item-thumbnail .item-title a:focus {
            color: #009688;
        }
        .item.item-thumbnail .item-desc {
            margin: 0;
            font-size: 12px;
            color: #707478;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .item.item-thumbnail .item-discount-price {
            font-size: 12px;
            color: #999;
            text-decoration: line-through;
        }
        .item.item-thumbnail .buttons {
            margin-top:5px;
            transition: all 0.4s linear;
        }
        /*.item.item-thumbnail:hover .buttons{*/
            /*transition: all 0.4s linear;*/
            /*transform:scale(1);*/
        /*}*/
        .item.item-thumbnail .item-price {
            margin: 3px 0;
            font-size: 16px;
            color: #009688;
            font-weight: 600;
        }
        .page-header-container {
            margin:20px 0;
            position: relative;
            padding:20px 0;
        }
        .page-header-cover {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            overflow: hidden;
        }
        .page-header-cover:before {
            content: '';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(36, 42, 48, 0.8);
        }
        .page-header-cover img {
            max-width: 100%;
        }
        .page-header-container .container {
            position: relative;
        }
        .page-header-container .page-header {
            border: none;
            color: #fff;
            margin: 0;
            font-size: 28px;
            padding: 0;
            text-align: center;
        }
        .row>[class*=col-] {
            padding: 0 0px;
        }
        .row{
            margin:0 0;
        }
        .content{
            overflow:hidden;
        }
    </style>
    <ol class="breadcrumb pull-right">
        <li><a href="<?php echo e(url('/patient')); ?>">Dashboard</a></li>
        <li class="active">Products</li>
    </ol>
	<?php echo Form::open(array('url'=>"/patient/ecommerce/search_products", 'class'=> 'form-horizontal pull-right', 'style'=>'margin-right:30px;')); ?>

    <input type="hidden" name="stores_id" value="<?php echo e($store->pra_id); ?>">
    <div class="form-group">
        <label for="category" class="col-md-6 control-label" style="top: 2px;right: -21px;">Search by Category</label>
        <div class="col-md-6">
            <select name="category" id="category" class="form-control" onchange="this.form.submit()" style="width: 142px; margin-right: 20px; height: 33px; padding: 5px; border: none; background: #008a8a; color: #fff;">
                <option value="">All Products</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?php echo e($cat->cat_id); ?>"
                    <?php
                        if(isset($selected)){
                            if($selected->cat_id == $cat->cat_id){
                                echo 'selected';
                            }else{
                                echo '';
                            }
                        }
                    ?>
                    ><?php echo e($cat->cat_name); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php echo Form::close(); ?>


    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header pull-left"><?php echo e($store->first_name); ?> <?php echo e($store->last_name); ?> <small>Products</small></h1>
    <div class="row">
        <!-- begin col-6 -->
		<div class="col-md-12" style="padding:0 60px;">
			<?php echo Form::open(array('url'=>"/patient/ecommerce/search_products_name", 'class'=> 'form-horizontal')); ?>

			<input type="hidden" name="stores_id" value="<?php echo e($store->pra_id); ?>">
			<div class="form-group">
					<div class="input-group">
					  <input type="text" class="form-control" id="products_name" name="products_name" required placeholder="Search Products by Name...">
					  <span class="input-group-btn">
						<button class="btn btn-secondary" type="submit" style="background:#008a8a;color:white;">Search!</button>
					  </span>
					</div>
			</div>
			<?php echo Form::close(); ?>

		</div>
		
	</div>	
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
        </div>
    </div>
    <?php /*<div id="page-header" class="section-container page-header-container bg-black">*/ ?>
        <?php /*<!-- BEGIN page-header-cover -->*/ ?>
        <?php /*<div class="page-header-cover">*/ ?>
            <?php /*<img src="assets/img/apple-cover.jpg" alt="" />*/ ?>
        <?php /*</div>*/ ?>
        <?php /*<!-- END page-header-cover -->*/ ?>
        <?php /*<!-- BEGIN container -->*/ ?>
        <?php /*<div class="container">*/ ?>
            <?php /*<h1 class="page-header"><b><?php echo e($store->first_name); ?> <?php echo e($store->last_name); ?></b>'s Product</h1>*/ ?>
        <?php /*</div>*/ ?>
        <?php /*<!-- END container -->*/ ?>
    <?php /*</div>*/ ?>
            <div class="search-item-container">
                <?php if(isset($selected)): ?>
                        <h4>Showing Results For: <?php echo e($selected->cat_name); ?></h4>
               
				<?php elseif(isset($products_name)): ?>
                        <h4>Showing Results For: <?php echo e($products_name); ?></h4>
                <?php endif; ?>
                <!-- BEGIN item-row -->
                    <!-- BEGIN item -->
                    <div class="row">
                    <?php if(count($products)): ?>
					<?php foreach(array_chunk($products->all(), 4) as $row): ?>
					  <div class="row">
						<?php foreach($row as $item): ?>
                    <div class="col-md-3">
                        <div class="item item-thumbnail">
                            <a href="<?php echo e(url("/patient/ecommerce/store/product/$item->store_id/$item->product_id")); ?>" class="item-image">
                                <?php if(isset($item->mainImage) && (!empty($item->mainImage))): ?>
                                    <img src="<?php echo e(asset($item->mainImage)); ?>" alt="<?php echo e($item->products_name); ?>"/>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('public/dashboard/img/no_image_64x64.jpg')); ?>" alt="<?php echo e($item->products_name); ?>" />
                                <?php endif; ?>
								<?php 
									if($item->discountP > 0 ){ ?>
										<div class="discount">
										<?php 
											$discount = (($item->map-$item->pra_price)/$item->map) * 100;
											echo $discount.'%'; 
										?>	
										</div>
									<?php
									}else{
										echo '';
									}
								?>
                                
                            </a>
                            <div class="item-info">
                                <h4 class="item-title">
                                    <a href="<?php echo e(url("/patient/ecommerce/store/product/$item->store_id/$item->product_id")); ?>"><?php echo e($item->products_name); ?></a>
                                </h4>
                                <p class="item-desc"><?php echo e($item->short_description); ?></p>
                                
								<?php
								if($item->pra_price < $item->map){ ?>
								
								<div class="item-price"> 
                                    
									<?php $amount = round($item->pra_price, 2);
									?>
                                    $<?php echo e($amount); ?>  <span class="item-discount-price">$<?php echo e($item->map); ?></span>
                                </div>
                                
								<?php
								}else{ ?>
								<div class="item-price">
                                    
                                    $<?php echo e($item->pra_price); ?>

									
                                </div>
								<?php
								}
								?>
                                <div class="buttons">
                                    <a onclick="AddproductToCart(this);$('#quantity').val('1');$('#pro_id').val(<?php echo e($item->products_id); ?>);$('#pra_id').val(<?php echo e($item->store_id); ?>);" href="#modal-without-animation" class="btn btn-success btn-xs" data-toggle="modal">Add To Cart</a>
                                    <a href="<?php echo e(url("/patient/ecommerce/store/product/$item->store_id/$item->product_id")); ?>" class="btn btn-default btn-xs">View Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
					  </div>
					  <?php endforeach; ?>
					  
                    
                        <?php else: ?>
                            <h1 class="text-center"> Note: Currenty store has no products! <i class="fa fa-frown-o" aria-hidden="true"></i></h1>
                        <?php endif; ?>
                </div>
                <?php echo e($products->links()); ?>

            </div>
    <div class="modal in" id="modal-without-animation" style="display: none; padding-right: 17px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add To Cart</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
						<div id="modal-error"></div>
						<img src=""  id="imagepreview" style="width:60px;margin:20px auto;"/>
						<div class="row">
									<div class="col-md-6">
                            <h6><strong>Product : </strong><span id="span_aj_product"></span></h6>
							<h6><strong>Price : </strong><span id="span_aj_price"></span></h6>
                            <strong>Quantity: </strong><input placeholder="Qty" type="number" style="width:54px;margin-top: 10px;"  class="form-control" id="quantity" />
                        </div>
						</div>
                            <div class="col-md-3">
                                <!--<label class="control-label">Quantity : </label>-->
                            </div>
                            <div class="col-md-5">
                                <!--<input type="text" class="form-control" id="quantity" />-->
                                <input type="hidden" class="form-control" id="pro_id" value="0" />
                                <input type="hidden" class="form-control" id="pra_id">
								
                            </div>                                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                    <a onclick="AddProduct();" href="javascript:;" class="btn btn-sm btn-success" >Add</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
        <!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
			$("#products_name").autocomplete({
			 minLength:3,
			 autoFocus: true,
			 source: "<?php echo e(URL('/patient/ecommerce/getdata')); ?>" 
});
$('.cart-item').slimScroll({
							height: $('.cart-item').css('height')
						});
$('.slimScrollDiv').css('height','auto');
$('.cart-item').css('height','auto');
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.padash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>