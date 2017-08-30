<?php $__env->startSection('content'); ?>
    <ol class="breadcrumb pull-right">
        <li><a href="<?php echo e(url('/patient')); ?>">Dashboard</a></li>
        <li class="active">Checkout Cart</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Checkout Cart <small></small></h1>
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
    <div class="section-container" id="checkout-cart">
        <!-- BEGIN container -->
        <!-- BEGIN checkout -->
        <div class="checkout">
            <?php echo Form::open(array('url'=>'/patient/ecommerce/save_cart', 'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')); ?>

                    <!-- BEGIN checkout-header -->
            <div class="checkout-header">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3 col-sm-3">
                        <div class="step active">
                            <div class="number">1</div>
                            <div class="info">
                                <div class="title">Delivery Options</div>
                                <?php /*<div class="desc">Lorem ipsum dolor sit amet.</div>*/ ?>
                            </div>
                        </div>
                    </div>
                    <!-- END col-3 -->
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3 col-sm-3">
                        <div class="step">
                            <div class="number">2</div>
                            <div class="info">
                                <div class="title">Shipping Address</div>
                                <?php /*<div class="desc">Vivamus eleifend euismod.</div>*/ ?>
                            </div>
                        </div>
                    </div>
                    <!-- END col-3 -->
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3 col-sm-3">
                        <div class="step">
                            <div class="number">3</div>
                            <div class="info">
                                <div class="title">Payment</div>
                                <?php /*<div class="desc">Aenean ut pretium ipsum. </div>*/ ?>
                            </div>
                        </div>
                    </div>
                    <!-- END col-3 -->
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3 col-sm-3">
                        <div class="step">
                            <div class="number">4</div>
                            <div class="info">
                                <div class="title">Complete Payment</div>
                                <?php /*<div class="desc">Curabitur interdum libero.</div>*/ ?>
                            </div>
                        </div>
                    </div>
                    <!-- END col-3 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END checkout-header -->
            <!-- BEGIN checkout-body -->
            <div class="checkout-body">
                <div class="table-responsive">
                    <?php if(count($products)): ?>
                        <table class="table table-cart" id="cart_table">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Pra.Discount</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $totalprice=0;
                            $count=0;
                            $qtyId='';
                            ?>
                            <?php foreach($products as $product): ?>
                                <?php $count++;$qtyId='#qty_'.$count; ?>
                                <tr id="calculations" class="calculations-<?php echo e($product->cart_id); ?>">
                                    <td class="cart-product">
                                        <div class="product-img">
                                            <?php if(isset($product->image_path) && (!empty($product->image_path))): ?>
                                                <img src="<?php echo e(asset($product->image_path)); ?>" alt="<?php echo e($product->products_name); ?>"/>
                                            <?php else: ?>
                                                <img src="<?php echo e(asset('public/dashboard/img/no_image_64x64.jpg')); ?>" alt="<?php echo e($product->products_name); ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-info">
                                            <?php /*<a class="productlink" href="<?php echo e(url('patient/ecommerce/store/product/'.$product->products_id)); ?>">*/ ?>
                                            <div class="title"><?php echo e($product->products_name); ?></div>
                                            <?php /*</a>*/ ?>
                                            <div class="desc">Delivers 15 days after purchase - Free</div>
                                        </div>
                                    </td>
                                    <?php 
											$discount = (($product->map-$product->pra_price)/$product->map) * 100;
											
										?>	
                                    <td  class="cart-price text-center">
									
									$<?php echo e($product->map); ?>

									
									
									</td>
                                    <td id="cart_price<?php echo '_'.$count; ?>" style="display:none;">
									$<?php echo e($product->pra_price); ?>

									</td>
									
									<td id="cart_pra_discount<?php echo '_'.$count; ?>" class="cart-price text-center"><?php if($discount > 0): ?>
									<?php echo e($discount); ?>

									<?php else: ?>
										No Discount
									<?php endif; ?></td>
                                    <td class="cart-qty text-center">
                                        <div class="cart-qty-input">
                                           <!-- <a href="#"  onclick="$('<?php echo $qtyId; ?>').val($('<?php echo $qtyId; ?>').val()!=1?parseInt($('<?php echo $qtyId; ?>').val())-1:1);calculateFinalTotal();" class="qty-control left disabled" data-click="decrease-qty" data-target="#qty"><i class="fa fa-minus"></i></a>-->
                                            <input type="hidden" value="<?php echo e($product->products_id); ?>" name="products_id[]">
                                            <input type="number" onblur="calculateFinalTotal();" onchange="calculateTotal('<?php echo str_replace("#","",$qtyId);?>');calculateFinalTotal();"  value="<?php echo e($product->qty); ?>" name="quantity[]" class="form-control" id="<?php echo str_replace("#","",$qtyId);?>" style="width:50px;" min="0"/>
                                            <!--<a href="#" onclick="$('<?php echo $qtyId; ?>').val(parseInt($('<?php echo $qtyId; ?>').val())+1);calculateFinalTotal();" class="qty-control right disabled" data-click="increase-qty" data-target="#qty"><i class="fa fa-plus"></i></a>-->
                                        </div>
                                        <div class="qty-desc">1 to max order</div>
                                    </td>
                                    <td id="cart_total<?php echo '_'.$count; ?>"  class="cart-total text-center" id="product_total">
                                        <?php
                                       $product_total = $product->pra_price * $product->qty; 
                                        $totalprice+=$product_total;
                                        ?>
                                        $<?php echo e(round($product_total)); ?>

                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" onclick="doDelete('<?php echo e($product->cart_id); ?>', '<?php echo e($product->products_id); ?>',this);" style="border: none; background-color: transparent; color: red; font-size: 15px;"><i class="fa fa-trash-o"></i> Delete</a>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                            <tr id="summary">
                                <td class="cart-summary" colspan="6">
                                    <div class="summary-container">
                                        <div class="summary-row">
                                            <div class="field">Cart Subtotal</div>
                                            <div class="value" id="cart-subtotal">
											
											$<?php echo e(round($totalprice,2)); ?></div>
                                        </div>
                                        <div class="summary-row text-danger">
                                            <div class="field">Free Shipping</div>
                                            <div class="value">$0.00</div>
                                        </div>
                                        <div class="summary-row total">
                                            <div class="field">Total</div>
                                            <div class="value" id="cart-total">$<?php echo e(round($totalprice, 2)); ?></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <div id="cart_empty">
                            <figure class="figure" style="width:300px;margin:auto;">
                                <img src="https://www.3dprintersonlinestore.com/image/catalog/pages/page-404-icon.png" alt="" class="center" style="width:200px;margin: 0 51px;" aria-readonly="true">
                                <figcaption class="figure-caption text-center"><h4>Your shopping cart is empty!</h4></figcaption>
                            </figure>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- END checkout-body -->
            <!-- BEGIN checkout-footer -->
            <div class="checkout-footer">
                <a href="<?php echo e(url('/patient/ecommerce/subscribed-stores')); ?>" class="btn btn-white btn-lg pull-left">Continue Shopping</a>
                <?php if(count($products)): ?>
                    <?php echo Form::submit('Checkout', array('class'=>'btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10','id'=>'btn_submit')); ?>

                <?php else: ?>
                    <?php echo Form::submit('Checkout', array('class'=>'btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10','disabled')); ?>

                <?php endif; ?>
            </div>
            <!-- END checkout-footer -->
            <?php echo Form::close(); ?>

        </div>
        <!-- END checkout -->
    </div>
    <!-- END container -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-scripts'); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
            calculateFinalTotal();
        });

        function calculateTotal(obj)
        {
            //cart_price_1
            //cart_total_1
            //qty_1
            //cart_pra_discount_1
            var qtyId = obj;
            var cartpriceId = qtyId.replace("qty", "cart_price");
            var carttotalId = qtyId.replace("qty", "cart_total");
            var qty = $('#'+obj).val();
			if(qty<1){
				$('#'+obj).val('1');
				qty=1;
			}
            var cartPrice = $('#'+cartpriceId).html();
            cartPrice = cartPrice.replace("$","");
            var cartTotal = (parseFloat(cartPrice)*qty);
            $('#'+carttotalId).html('');
            $('#'+carttotalId).html('$'+cartTotal.toFixed(2));
            //cartTotal = cartTotal.replace("$","");

        }
        function calculateFinalTotal()
        {
            var subtotal=0,total=0;
            //cart_table
            $('#cart_table tr').each(function (i, row) {

                // reference all the stuff you need first
                if(i==0) {}
                else
                {
                    if(row.id=="calculations")
                    {
                        var $row = $(row),
                                $cart_price = $row.find('td[id*="cart_price"]').html(),
                                $cart_total = $row.find('td[id*="cart_total"]').html(),
                                $qty = $row.find('input[id*="qty"]').val();
                        var cartTotal = $cart_total;
                        cartTotal = cartTotal.replace("$","");
                        var cartPrice = $cart_price;
                        cartPrice = cartPrice.replace("$","");
                        var QtyId = $row.find('input[id*="qty"]').attr('id');
                        calculateTotal(QtyId);
                        subtotal+=parseFloat(cartTotal);
						//var subtotal = subtotall.toFixed(2);
                    }
                }
            });
//cart-subtotal
//cart-total
            $('#cart-subtotal').html(subtotal.toFixed(2));
            $('#cart-total').html(subtotal.toFixed(2));

        }

        function doDelete(id, productId, elm)
        {
            var q = confirm("Are you sure you want to remove this product from cart?");
            if (q == true) {

                $.ajax({
                    type: "DELETE",
                    url: '<?php echo e(URL::to('/patient/ecommerce/remove_product')); ?>/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
//                        if (result.status == 'success') {
//
//                         }
                        $(".calculations-"+id).remove();
                        $('#cart-item-'+productId).remove();
                        var counter = parseInt($('#cart-counter').text());
                        var counter = counter-1;
                        $('#cart-counter').text(counter);

                        if($("tr[id*='calculations']").length == 0){
                            $("#cart_table").remove();
                            $(".table-responsive").html('<div id="cart_empty"> <figure class="figure" style="width:300px;margin:auto;"> <img src="https://www.3dprintersonlinestore.com/image/catalog/pages/page-404-icon.png" alt="" class="center" style="width:200px;margin: 0 51px;" aria-readonly="true"> <figcaption class="figure-caption text-center"><h4>Your shopping cart is empty!</h4></figcaption> </figure> </div>');
                            $('#btn_submit').attr('disabled',true);
                        }
                        if(counter==0)
                        {
                            if($('#cart-empty').length==0)
                            {
                                $('.cart-item').html('<h5 id="cart-empty" class="text-center"><i class="fa fa-shopping-cart" style="color:#00acac;"></i> Your cart is empty!</h5>');
                            }
                            else
                            {
                                $('#cart-empty').html('<i class="fa fa-shopping-cart" style="color:#00acac;"></i> Your Cart is empty');
                            }
                        }
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
<?php echo $__env->make('layouts.padash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>