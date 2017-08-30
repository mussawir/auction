<ul class="nav">
                <li class="has-sub <?php echo isset($PDashboard) ? $PDashboard : '';?>">
                    <a href="{{url('/patient')}}">
                        <i class="fa fa-laptop"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                {{--<li><a href="{{url('patient/index/get-appointment')}}"><i class="fa fa-calendar-o"></i> <span>Get Appointment</span></a></li>--}}
                <li class="has-sub <?php  echo isset($subscribe) ? $subscribe : '';?>"><a href="{{url('/patient/ecommerce/subscribed-stores')}}"><i class="fa fa-shopping-cart"></i> <span>Store</span></a></li>


               <!-- <li class="has-sub <?php if(isset($template_menu))echo $template_sup;?>">
                    <a href="javascript:;">
                        <i class="fa fa-medkit"></i>
                        <span>Supplement</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('/patient/index/supplement-request')}}"><span>Request Supplements</span></a></li>
                        <li><a href="{{url('/patient/index/supplement-request-list')}}"><span>Requested List</span></a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if(isset($template_menu))echo $template_nut;?>">
                    <a href="javascript:;">
                        <i class="fa fa-fire"></i>
                        <span>Nutrition</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('/patient/index/nutrition-request')}}"><span>Request Nutritions</span></a></li>
                        <li><a href="{{url('/patient/index/nutrition-request-list')}}"> <span>Requested List</span></a></li>
                    </ul>
                </li>
                <li class="has-sub <?php if(isset($template_menu))echo $template_exe;?>">
                    <a href="javascript:;">
                        <i class="fa fa-heart"></i>
                        <span>Exercise</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{url('patient/index/exercise-request')}}"><span>Request Exercises</span></a></li>
                        <li><a href="{{url('/patient/index/exercise-request-list')}}"> <span>Requested List</span></a></li>
                    </ul>
                </li> 
                <li><a href="{{url('/patient/index/send-message')}}"><i class="fa fa-comment-o"></i> <span>New Message</span></a></li>
                <li><a href="{{url('/patient/index/message-history')}}"><i class="fa fa-comments-o"></i> <span>Message History</span></a></li>-->
                <li class="<?php if(isset($message_menu))echo $message_menu;?>">
                    <a href="{{url('patient/index/message-history')}}"> 
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span onclick="">Communication</span>
                    </a>
                </li>
				<li class="<?php if(isset($rec_menu))echo $rec_menu;?>">
                    <a href="{{url('patient/index/recommendation')}}"> 
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <span onclick="">Recommendation</span>
                    </a>
                </li>
				
				<li class="has-sub <?php if(isset($order_main))echo $order_main;?>">
                    <a <a href="{{url('/patient/ecommerce/order-dashboard')}}">
                        <i class="fa fa-tasks"></i>
                        <span>Orders</span>
                    </a>
					<?php if(isset($order_main)){ ?>
                    <ul class="sub-menu">
                        <li class="<?php if(isset($order_pending))echo $order_pending;?>"><a href="{{url('/patient/ecommerce/pending_orders')}}">Pending</a></li>
                        <li class="<?php if(isset($order_fulfill))echo $order_fulfill;?>"><a href="{{url('/patient/ecommerce/completed-orders')}}">Fulfilled</a></li>
                    </ul>
					<?php } ?>
                </li>
                <!--<li><a href="{{url('/patient/ecommerce/transactions')}}"><i class="fa fa-money"></i> <span>Purchase History</span></a></li>-->
                {{--<li><a href="{{url('#')}}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>--}}

                <li class="has-sub <?php if(isset($setting_menu))echo $setting_menu;?>">
                    <a href="javascript:;">
                        <i class="fa fa-cog"></i>
                        <span>Settings</span>
                    </a>

					<ul class="sub-menu">
					
					<li class="<?php echo isset($shipping_add) ?  $shipping_add : '' ?>"><a href="{{url('patient/index/shipping-add-list/2')}}"><span>Contact</span></a></li>
                        
					<li class="<?php echo isset($contact_info) ?  $contact_info : '' ?>"><a href="{{url('patient/index/shipping-add-list/1')}}"><span>Shipping Address</span></a></li>
						
					<li class="<?php echo isset($credit_card_info) ? $credit_card_info : '' ?>"><a href="{{url('patient/index/credit-card-list')}}"><span>Credit Card</span></a></li>
                    </ul> 
				
                </li>
                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
