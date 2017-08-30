<ul class="nav">
    <li class="nav-header">Navigation</li>
    <li class="has-sub active">
        <a href="{{url('/patient')}}">
            <i class="fa fa-cart"></i>
            <span>Ecommerce</span>
        </a>
    </li>


    <li class="has-sub <?php if(isset($sug_menu))echo $sug_menu;?>">
        <a href="javascript:;">
            <i class="fa fa-shopping-cart"></i>
            <span>Stores</span>
        </a>
        <ul class="sub-menu">
            <li><a href="{{url('/patient/ecommerce/stores-list')}}">Stores List</a></li>
            <li><a href="{{url('/patient/ecommerce/subscribed-stores')}}">Subscribed Stores</a></li>
        </ul>
    </li>
    <li class="has-sub <?php if(isset($sug_menu))echo $sug_menu;?>">
        <a href="javascript:;">
            <i class="fa fa-tasks"></i>
            <span>Orders</span>
        </a>
        <ul class="sub-menu">
            <li><a href="{{url('/patient/ecommerce/pending_orders')}}">Pending Orders</a></li>
            <li><a href="{{url('/patient/ecommerce/completed-orders')}}">Completed Orders</a></li>
        </ul>
    </li>
    <li><a href="{{url('/patient/ecommerce/transactions')}}"><i class="fa fa-money"></i> <span>Purchase History</span></a></li>
    <!-- begin sidebar minify button -->
    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
    <!-- end sidebar minify button -->
</ul>
