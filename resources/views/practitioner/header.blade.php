


<div id="header" class="header navbar navbar-default navbar-fixed-top">
    <!-- begin container-fluid -->
    <div class="container-fluid">
        <!-- begin mobile sidebar expand / collapse button -->
        <div class="navbar-header">
           <!-- <a href="#" class="navbar-brand" style="width: auto!important;">
                <span class="navbar-logo"></span>
            </a> -->

            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- end mobile sidebar expand / collapse button -->

        <ul class="nav navbar-nav">
            @if(Session::has('dashboard'))
            <li><a href="{{url('/practitioner')}}"><button class="btn btn-danger"><span class="fa fa-tachometer" aria-hidden="true"></span> Dashboard</button></a></li>
            @else
                <li><a href="{{url('/practitioner')}}"><button class="btn btn-default"><span class="fa fa-tachometer" aria-hidden="true"></span> Dashboard</button></a></li>
            @endif
                <!--@if(Session::has('marketing'))
                    <li><a href="{{url('practitioner/marketing')}}"><button class="btn btn-danger"><span class="fa fa-th" aria-hidden="true"></span> Marketing</button></a></li>
                @else
                    <li><a href="{{url('practitioner/marketing')}}"><button class="btn btn-default"><span class="fa fa-th" aria-hidden="true"></span> Marketing</button></a></li>
                @endif

                @if(Session::has('management'))
                    <li><a href="{{url('practitioner/management')}}"><button class="btn btn-danger"> <span class="fa fa-calendar"></span> Management</button></a></li>
                @else
                    <li><a href="{{url('practitioner/management')}}"><button class="btn btn-default"> <span class="fa fa-calendar"></span> Management</button></a></li>
                @endif -->

        </ul>

        <!-- begin header navigation right -->
        <ul class="nav navbar-nav navbar-right">
            <li>
                <form class="navbar-form full-width">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter keyword" />
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </li>
            <?php
            use App\Models\Practitioner;
            use Illuminate\Support\Facades\Auth;
            use Illuminate\Support\Facades\DB;
            use App\Models\Notification;
            $pra = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
           
            $notifications = DB::table('notifications')
                    ->where('user_id', '=', Auth::user()->user_id)
                    ->whereIn ('is_read',['0','1'])
                    ->orderBy('is_read','asc')
                    ->get();
                    
            $count = DB::table('notifications')
                    ->where('user_id', '=', Auth::user()->user_id)
                    ->where ('is_read','0')
                    ->get();
                    
            function time_elapsed_string($datetime, $full = false) {
                $now = new DateTime;
                $ago = new DateTime($datetime);
                $diff = $now->diff($ago);

                $diff->w = floor($diff->d / 7);
                $diff->d -= $diff->w * 7;

                $string = array(
                        'y' => 'year',
                        'm' => 'month',
                        'w' => 'week',
                        'd' => 'day',
                        'h' => 'hour',
                        'i' => 'minute',
                        's' => 'second',
                );
                foreach ($string as $k => &$v) {
                    if ($diff->$k) {
                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                    } else {
                        unset($string[$k]);
                    }
                }

                if (!$full)
               { $string = array_slice($string, 0, 1);
                return $string ? implode(', ', $string) . ' ago' : 'just now'; }
            }

            
                ?>
                
            <li class="dropdown" onclick="isReadNotification();">
                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                    <i class="fa fa-bell-o"></i>
                    <span class="label" id="notification-count"><?php $countresult = count($count); 
                    if($countresult > 0) {
                        echo $countresult;
                    }
                    else {
                         echo "0";
                    }
            
                    ?></span>
                </a>
                <ul class="dropdown-menu media-list pull-right animated fadeInDown" style=" max-height: 500px;  overflow-y: scroll;min-width: 300px;" >
                    <li class="dropdown-header">Notifications</li>
                    @if(count($notifications))
                        @foreach($notifications as $not)

                            <li id="notificationChild" class="media" <?php
                                                    if($not->is_read == '0'){
                                                        echo 'style="background-color:rgba(211, 211, 211, 0.42);transition:all 0.8s linear;"';
                                                    } ?>
                                    style="transition:all 0.8s linear;">
                                      
                                      
                                        @if($not->not_type == '1')
                                        <a href="{{ url("/practitioner/ecommerce/order_details/$not->not_link") }}">
                                        @endif
                                        
                                        
                                        @if($not->not_type == '1')
                                            <div class="media-left"><i class="fa fa-shopping-cart media-object bg-green"></i></div>
                                        @endif
                                        
                                        <div class="media-body">
                                            <h6 class="media-heading">{{ $not->not_details }}</h6>
                                            <div class="text-muted f-s-11">
                                                <?php echo time_elapsed_string($not->created_at); ?>
                                            </div>
                                        </div>
                                    </a>
                            </li>
                        @endforeach
                        @else
                        <li class="media" style="margin: 10px 20px;border: none;">
                            <div class="media-left"><i class="fa fa-thumbs-up media-object bg-green"></i></div>
                            <div class="media-body" >
                                <h6 class="media-heading">You have read all the notifications</h6>
                            </div>
                        </li>
                    @endif

                    {{--<li class="dropdown-footer text-center">--}}
                        {{--<a href="javascript:;">View more</a>--}}
                    {{--</li>--}}
                </ul>
            </li>
            @if (!Auth::guest())
                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <img src='{{url("public/practitioners/$practitioner_info->url/$pra->photo")}}' alt="" />
                        <span class="hidden-xs">&nbsp;{{$pra->first_name . ' ' .$pra->last_name}}&nbsp;</span> <b class="caret"></b>
						
						<?php
                         session_start();
                          $abc = json_decode($pra->user_id);

						   $_SESSION['uId'] =  $abc;    ?>
                    </a>
					
					
					
                    <ul class="dropdown-menu animated fadeInLeft">
					    <li><a href="{{url('/practitioner/account/')}}">Account</a></li>
                        <li><a href="{{url('/practitioner/profile/')}}">Profile</a></li>
                        <!--<li><a href="{{url('/practitioner/profile/payment-gateway')}}">Payment Gateway</a></li>-->
                        <!--<li><a href="{{url('/practitioner/profile/clinic')}}">Clinic</a></li>-->
					    <!--<li><a href="{{url('/practitioner/profile/working-hours')}}">Working Hours</a></li>-->
                        <li><a href="{{url('/practitioner/index/change-password')}}">Change Password</a></li>
						<?php 
                        $pra = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
						?>
						  <li><a href="{{url('/practitioner/'.$pra->url)}}">Blog</a></li>
                        <!--<li><a href="javascript:;">Other Setting</a></li>-->
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}">Log Out</a></li>
                    </ul>
                </li>
            @endif
        </ul>
        <!-- end header navigation right -->
    </div>
    <!-- end container-fluid -->
</div>