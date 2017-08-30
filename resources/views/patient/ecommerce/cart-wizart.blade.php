@extends('layouts.padash')

@section('content')
    <style>
        .wizard {
            margin: 20px auto;
            background: #fff;
        }

        .wizard .nav-tabs {
            position: relative;
            margin: 40px auto;
            margin-bottom: 0;
            border-bottom-color: #e0e0e0;
        }

        .wizard > div.wizard-inner {
            position: relative;
        }

        .connecting-line {
            height: 2px;
            background: #e0e0e0;
            position: absolute;
            width: 80%;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: 50%;
            z-index: 1;
        }

        .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
            color: #555555;
            cursor: default;
            border: 0;
            border-bottom-color: transparent;
        }

        span.round-tab {
            width: 70px;
            height: 70px;
            line-height: 70px;
            display: inline-block;
            border-radius: 100px;
            background: #fff;
            border: 2px solid #e0e0e0;
            z-index: 2;
            position: absolute;
            left: 0;
            text-align: center;
            font-size: 25px;
        }
        span.round-tab i{
            color:#555555;
        }
        .wizard li.active span.round-tab {
            background: #fff;
            border: 2px solid #5bc0de;

        }
        .wizard li.active span.round-tab i{
            color: #5bc0de;
        }

        span.round-tab:hover {
            color: #333;
            border: 2px solid #333;
        }

        .wizard .nav-tabs > li {
            width: 25%;
        }

        .wizard li:after {
            content: " ";
            position: absolute;
            left: 46%;
            opacity: 0;
            margin: 0 auto;
            bottom: 0px;
            border: 5px solid transparent;
            border-bottom-color: #5bc0de;
            transition: 0.1s ease-in-out;
        }

        .wizard li.active:after {
            content: " ";
            position: absolute;
            left: 46%;
            opacity: 1;
            margin: 0 auto;
            bottom: 0px;
            border: 10px solid transparent;
            border-bottom-color: #5bc0de;
        }

        .wizard .nav-tabs > li a {
            width: 70px;
            height: 70px;
            margin: 20px auto;
            border-radius: 100%;
            padding: 0;
        }

        .wizard .nav-tabs > li a:hover {
            background: transparent;
        }

        .wizard .tab-pane {
            position: relative;
            padding-top: 50px;
        }

        .wizard h3 {
            margin-top: 0;
        }

        @media( max-width : 585px ) {

            .wizard {
                width: 90%;
                height: auto !important;
            }

            span.round-tab {
                font-size: 16px;
                width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .wizard .nav-tabs > li a {
                width: 50px;
                height: 50px;
                line-height: 50px;
            }

            .wizard li.active:after {
                content: " ";
                position: absolute;
                left: 35%;
            }
        }

    </style>
    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/patient')}}">Dashboard</a></li>
        <li class="active">Orders</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Orders <small>Pending Orders</small></h1>
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
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-stuff-3">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Checkout Cart </h4>
                </div>
                <div class="panel-body">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form role="form">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="step1">
                                    <div class="checkout-body">
                                        <div class="table-responsive">
                                            @if(count($products))
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
                                                    @foreach($products as $product)
                                                        <?php $count++;$qtyId='#qty_'.$count; ?>
                                                        <tr id="calculations">
                                                            <td class="cart-product">
                                                                <div class="product-img">
                                                                    @if(isset($product->image_path) && (!empty($product->image_path)))
                                                                        <img src="{{asset($product->image_path)}}" alt="{{$product->products_name}}"/>
                                                                    @else
                                                                        <img src="{{asset('public/dashboard/img/no_image_64x64.jpg')}}" alt="{{$product->products_name}}" />
                                                                    @endif
                                                                </div>
                                                                <div class="product-info">
                                                                    {{--<a class="productlink" href="{{url('patient/ecommerce/store/product/'.$product->products_id)}}">--}}
                                                                    <div class="title">{{ $product->products_name }}</div>
                                                                    {{--</a>--}}
                                                                    <div class="desc">Delivers 15 days after purchase - Free</div>
                                                                </div>
                                                            </td>
                                                            <?php
                                                            $selling = $product->price - ($product->price * ($product->discountPer / 100)) ?>
                                                            <td id="cart_price<?php echo '_'.$count; ?>" class="cart-price text-center">${{ round($selling) }}</td>
                                                            <td id="cart_pra_discount<?php echo '_'.$count; ?>" class="cart-price text-center">{{ $product->pra_discount }}</td>
                                                            <td class="cart-qty text-center">
                                                                <div class="cart-qty-input">
                                                                    <a href="#"  onclick="$('<?php echo $qtyId; ?>').val($('<?php echo $qtyId; ?>').val()!=1?parseInt($('<?php echo $qtyId; ?>').val())-1:1);calculateFinalTotal();" class="qty-control left disabled" data-click="decrease-qty" data-target="#qty"><i class="fa fa-minus"></i></a>
                                                                    <input type="hidden" value="{{ $product->products_id }}" name="products_id[]">
                                                                    <input type="number" onblur="calculateFinalTotal();" onchange="calculateTotal('<?php echo str_replace("#","",$qtyId);?>');"  value="{{ $product->qty }}" name="quantity[]" class="form-control" id="<?php echo str_replace("#","",$qtyId);?>" style="width:50px;" min="0"/>
                                                                    <a href="#" onclick="$('<?php echo $qtyId; ?>').val(parseInt($('<?php echo $qtyId; ?>').val())+1);calculateFinalTotal();" class="qty-control right disabled" data-click="increase-qty" data-target="#qty"><i class="fa fa-plus"></i></a>
                                                                </div>
                                                                <div class="qty-desc">1 to max order</div>
                                                            </td>
                                                            <td id="cart_total<?php echo '_'.$count; ?>"  class="cart-total text-center" id="product_total">
                                                                <?php
                                                                $product_total = $selling * $product->qty;
                                                                $totalprice+=$product_total;
                                                                ?>
                                                                ${{ round($product_total) }}
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0);" onclick="doDelete('{{$product->products_id}}', this);" style="border: none; background-color: transparent; color: red; font-size: 15px;"><i class="fa fa-trash-o"></i> Delete</a>
                                                            </td>
                                                            {{--<td class="text-center">--}}
                                                            {{--{!! Form::open(array('url'=>"/patient/ecommerce/remove_product/{$product->products_id}",'method'=>'DELETE' ,'class'=> 'form-horizontal', 'files'=>true, 'data-parsley-validate' => 'true')) !!}--}}
                                                            {{--{!! Form::submit('Remove',['style'=>'border: none; background-color: transparent; color: red; font-size: 15px;']) !!}--}}
                                                            {{--{!! Form::close() !!}--}}
                                                            {{--</td>--}}
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td class="cart-summary" colspan="5">
                                                            <div class="summary-container">
                                                                <div class="summary-row">
                                                                    <div class="field">Cart Subtotal</div>
                                                                    <div class="value" id="cart-subtotal">${{ $totalprice }}</div>
                                                                </div>
                                                                <div class="summary-row text-danger">
                                                                    <div class="field">Free Shipping</div>
                                                                    <div class="value">$0.00</div>
                                                                </div>
                                                                <div class="summary-row total">
                                                                    <div class="field">Total</div>
                                                                    <div class="value" id="cart-total">${{ round($totalprice) }}</div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            @else
                                                <figure class="figure" style="width:300px;margin:auto;">
                                                    <img src="https://www.3dprintersonlinestore.com/image/catalog/pages/page-404-icon.png" alt="" class="center" style="width:200px;margin: 0 51px;" aria-readonly="true">
                                                    <figcaption class="figure-caption text-center"><h4>Your shopping cart is empty!</h4></figcaption>
                                                </figure>
                                            @endif
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step2">

                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="step3">
                                    <h3>Step 3</h3>
                                    <p>This is step 3</p>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                        <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                                        <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="complete">
                                    <h3>Complete</h3>
                                    <p>You have successfully completed all steps.</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col 6 -->
    </div>
@endsection


@section('page-scripts')

    <script type="text/javascript">

        $(document).ready(function () {
            //Initialize tooltips
            App.init();
            Dashboard.init();
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                var $target = $(e.target);

                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);

            });
            $(".prev-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);

            });
            $('#cart').submit(function(e) {
                e.preventDefault();

                alert('cart has been clicked');
            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }
        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }

    </script>

@endsection