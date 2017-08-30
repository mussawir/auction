<!-- begin #sidebar -->
<?php
	use App\Models\Practitioner;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\DB;
	use App\Models\scheduler;
	$pracp = Session::get('practitioner_session');
         $pra = Practitioner::find($pracp['pra_id']);
	
	$prac = Practitioner::where('user_id', '=', Auth::user()->user_id)->first();
?>
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;">
					
					@if(isset($pra->photo) && (!empty($pra->photo)))
                            <img src="{{asset('public/practitioners/'. $pra->directory .'/'.$pra->photo)}}" alt="Profile Photo" class="img-profile" />
						
                        @else
                            <img src="{{asset('public/img/no-user.jpg')}}" alt="Profile Photo" class="img-profile" />
                        @endif
					
					</a>
                </div>
                <div class="info">
				{{ $prac->first_name}} {{ $prac->last_name }}
                    <small>Practitioner</small> 
                </div> 
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="menu">
                <a href="{{url('/practitioner')}}">
                    <i class="fa fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
			
		@if($prac->plan_type == '2')
            <li class="has-sub <?php if(isset($message))echo $message?>">
                <a href="{{url('/practitioner/message-history')}}">
                    <i class="fa fa-comment "></i>
                    <span>Communications</span>
                </a>
               <!-- <ul class="sub-menu">
                    <li class="<?php if(isset($send_message))echo $send_message ?>"><a href="{{url('/practitioner/send-message')}}"><span>New</span></a></li>
                    <li class="<?php if(isset($message_history))echo $message_history ?>"><a ><span>History</span></a></li>
                </ul>-->
            </li>
		@endif	
			
			
		@if($prac->plan_type == '2')
            <li class="has-sub {{isset($meta['cm_main_menu'])?$meta['cm_main_menu']:''}}">
                <a href="javascript:;">
                    <i class="fa fa-book"></i>
                    <span>Contact Manager</span>
                </a>
                <ul class="sub-menu">
                    <!--<li class="{{isset($meta['cg_sub_menu_new'])?$meta['cg_sub_menu_new']:''}}"><a href="{{url('/practitioner/contact-group/new')}}"> New Group</a></li>-->
                   <!-- <li class="{{isset($meta['cg_sub_menu_list'])?$meta['cg_sub_menu_list']:''}}"><a href="{{url('/practitioner/contact-group')}}">Group</a></li>-->
					<li class="menu <?php if(isset($patients_list))echo $patients_list ?> "><a href="{{url('/practitioner/patient/')}}"> <span>Contacts</span></a></li>
                    
					<!--<li class="{{isset($meta['cnt_sub_menu_new'])?$meta['cnt_sub_menu_new']:''}}"><a href="{{url('/practitioner/contact/new')}}"> New Contact</a></li>-->
                    <li class="{{isset($meta['cnt_sub_menu_list'])?$meta['cnt_sub_menu_list']:''}}"><a href="{{url('/practitioner/contact')}}">	Leads</a></li>
					<!--<li class="menu <?php if(isset($new_patient))echo $new_patient ?>"><a href="{{url('/practitioner/patient/new')}}"><i class="fa fa-user-plus"></i> <span>New Contact</span></a></li>-->
				</ul>
            </li>
		@endif
			
			
			
		@if($prac->plan_type == '2')
			<!--Start Changes Marketing made by saad-->	
			<li class="has-sub <?php if(isset($marketing_main))echo $marketing_main; ?> ">	
					<a href="javascript:;">
						<i class="fa fa-tags" aria-hidden="true"></i>
						<span>Marketing</span>
					</a>
				<ul class="sub-menu">
				<li class="has-sub <?php if(isset($template_menu))echo $template_menu;?>">
					<a href="javascript:;">
						E-Mail Marketing
					</a>
					<ul class="sub-menu">
						<!--<li class="<?php if(isset($eg_sub_menu_new))echo $eg_sub_menu_new;?>"><a href="{{url('/practitioner/email-group/new')}}"> New Email Group</a></li>-->
						<li class="<?php if(isset($eg_sub_menu_list))echo $eg_sub_menu_list;?>"><a href="{{url('/practitioner/email-group')}}">Email Group </a></li>
						<li class="<?php if(isset($compose_email))echo $compose_email;?>"><a href="{{url('/practitioner/emails/new')}}">Compose Email</a></li>
						<li class="<?php if(isset($sent_mails))echo $sent_mails;?>"><a href="{{url('/practitioner/emails/sent_list')}}">Sent Emails</a></li>
				        <!--<li class="<?php if(isset($campaign))echo $campaign;?>"><a href="{{url('/practitioner/emails/campaign')}}">Create Campaign</a></li>-->
						<li class="<?php if(isset($campaignlists))echo $campaignlists;?>"><a href="{{url('/practitioner/emails/campaignlist')}}">Campaign List</a></li>
					</ul>
				</li>
				<li class=" <?php if(isset($template_body))echo $template_body;?>">
					<a href="{{url('/practitioner/email-templates')}}"> 
						E-Mail Templates
					</a>
					<ul class="sub-menu">
					<!--<li class="<?php if(isset($new_template))echo $new_template;?>"><a href="{{url('/practitioner/email-templates/new')}}">New</a></li>
						<li class="<?php if(isset($templates))echo $templates;?>"><a href="{{url('/practitioner/email-templates/templates')}}">Templates</a></li>
						<!--<li class="<?php if(isset($template_list))echo $template_list;?>"><a href="{{url('/practitioner/email-templates')}}">List</a></li>-->
					</ul>
				</li> 
				<li class="<?php if(isset($email_analytics))echo $email_analytics;?>">
					<a href="{{url('/practitioner/emails/analytics')}}">
						Email Analytics
					</a>
					<!--<ul class="sub-menu">
						<li class="<?php if(isset($new_template))echo $new_template;?>"><a href="{{url('/practitioner/email-templates/new')}}">New</a></li>
					</ul>-->
				</li>
				</ul>
			</li>
		@endif
						<!--End Changes Marketing made by saad-->
			
		<?php $planType = $prac->plan_type; ?>
		<li class="has-sub {{isset($meta['store_main'])?$meta['store_main']:''}}">	
				<a href="javascript:;">
                    <i class="fa fa-shopping-basket"></i>
                    <span> <?php if($planType == '1') { echo 'Ecommerce'; } else { ?> Store <?php } ?></span>
                </a>
		<ul class="sub-menu">
		<?php if($planType=='2') { ?>
			<li class="{{isset($meta['pro_list'])?$meta['pro_list']:''}}">
                <a href="{{url('/practitioner/ecommerce/products')}}">
                   Store Products
                </a>
            </li>
			
			<li class="has-sub <?php if(isset($store_group))echo $store_group;?>">
					<a href="javascript:;">
						Group
					</a>
					<ul class="sub-menu">
				<li class="{{isset($meta['cm_main_menu_1'])?$meta['cm_main_menu_1']:''}}">
					<a href="{{url('/practitioner/contact-group/group/1')}}">
						Product Group
					</a>
				</li>
				<li class="{{isset($meta['cm_main_menu_2'])?$meta['cm_main_menu_2']:''}}">
					<a href="{{url('/practitioner/contact-group/group/2')}}">
						Patient Group
					</a>
				</li>
				</ul>
			</li>
			
			
			<li class="<?php if(isset($sug_menu))echo $sug_menu;?>">
                <a href="{{url('/practitioner/suggestion/products-suggestions-wizzard')}}" >
                    Recommend
                </a>
                
            </li>
			<li class="has-sub <?php if(isset($ecommerce))echo $ecommerce;?>">
                <a href="javascript:;">
                    Ecommerce
                </a>
                <ul class="sub-menu">
				<?php } ?>
                <li class="<?php if(isset($name_ecommerce))echo $name_ecommerce;?>"><a href="{{url('/practitioner/ecommerce/store-name')}}">Store Name</a></li>
                    <li class="<?php if(isset($req_ecommerce))echo $req_ecommerce;?>"><a href="{{url('/practitioner/ecommerce/req-list')}}">Request List</a></li>
<!--                    <li class="<?php if(isset($pro_ecommerce))echo $pro_ecommerce;?>"><a href="{{url('/practitioner/ecommerce/products-add')}}">Add Products</a></li>
                    <li class="<?php if(isset($soldproducts_ecommerce))echo $soldproducts_ecommerce;?>"><a href="{{url('/practitioner/ecommerce/orders')}}">Sold Products</a></li>
	-->                <li class="<?php if(isset($meta['accounts']))echo $meta['accounts'];?>"><a href="{{url('/practitioner/accounts/commission')}}">Commission</a></li>
					<li class="<?php if(isset($send_invitation))echo $send_invitation;?>"><a href="{{url('/practitioner/ecommerce/invitations')}}">Send Invitation</a></li>
				<?php if($planType=='2'){ ?>
                </ul>
            </li>
			<?php } ?>
		</ul>
		</li>
			
			
		<li class="has-sub <?php if(isset($Social_media))echo $Social_media;?>">	
				<a href="javascript:;">
                    <i class="fa fa-briefcase" aria-hidden="true"></i>
                    <span>Social Media</span>
                </a>
				
			<ul class="sub-menu">
			<li class="has-sub <?php if(isset($social_marketing))echo $social_marketing; ?>">
                <a href="javascript:;">
                    Social Marketing
                </a>
                <ul class="sub-menu">
                    <li class="<?php if(isset($new_social_post))echo $new_social_post; ?>"><a href="{{url('/practitioner/social-post')}}">New Social Posts</a></li>
                    <li class="<?php if(isset($social_posts_list))echo $social_posts_list; ?>"><a href="{{url('/practitioner/social-posts-list')}}">Posts</a></li>
                    <li class="<?php if(isset($social_setting))echo $social_setting; ?>"><a href="{{url('/practitioner/social-posts-setting')}}">Settings</a></li> 
                </ul>
            </li>
            <li class="<?php if(isset($blogging))echo $blogging;?>">
                <a href="{{url('/practitioner/blog/')}}">
                    Blogging
                </a>
            </li>
			</ul>
		</li>	
			{{--@if($prac->plan_type == '2')--}}
			<!--<li class="has-sub {{isset($meta['cm_main_menu_2'])?$meta['cm_main_menu_2']:''}}">
                <a href="{{url('/practitioner/contact-group/group/2')}}">
                    <i class="fa fa-users"></i>
                    <span>Contact Group</span>
                </a>
            </li>-->
			{{--@endif--}}
			
			
			
			@if($prac->plan_type == '2')
            <li class="has-sub <?php if(isset($referral))echo $referral;?>">
                <a href="{{url('/practitioner/referral/resend-index')}}">
                    <span class="badge pull-right"></span>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <span>Referral Program</span>
                </a>
            <!--  <ul class="sub-menu">
			 
			 
                    <li class="<?php if(isset($new_referral))echo $new_referral;?>"><a href="{{url('/practitioner/referral/addnewreferer')}}">Add New Referrer</a>
                    <li class="<?php if(isset($manage_referral))echo $manage_referral;?>"><a href="{{url('/practitioner/referral/resend-index')}}">Resend Invitation</a></li>
                    <li class="<?php if(isset($referral_list))echo $referral_list;?>"><a href="{{url('/practitioner/referral')}}">List</a></li>
                </ul>-->
				
				
            </li>
			@endif
            
			{{--@if($prac->plan_type == '2')--}}
			<!--<li class="has-sub <?php if(isset($meta['accounts']))echo $meta['accounts'];?>">
                <a href="{{url('/practitioner/accounts/commission')}}">
                    <span class="badge pull-right"></span>
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <span>Commission</span>
                </a>
            </li>-->
			{{--@endif--}}
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>


        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>