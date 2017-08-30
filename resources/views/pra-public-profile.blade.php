@extends('layouts.post_header')

@section('content')


    <!--###################################search bar cloes#######################################-->
    <!--##################################cover area start########################################-->
    <div class="cover-pic">

        <img src="{{asset('public/img/img-blog-isf/add-slider.png')}}" alt="">
		
		

    </div>

    <!--##################################cover area cloes############################################-->
    <!--#####################################main wrapper start #############################-->
    <div class="container-fluid">
	<div class="wrap-main">
        <div class="wrap-inner-left col-sm-8 ">
            <div class="info-left col-sm-3 ">
                 @if(isset($pra->photo) && (!empty($pra->photo)))
                            <img src="{{asset('public/practitioners/'. $pra->directory .'/'.$pra->photo)}}" alt="Profile Photo" class="img-profile" />
						
                        @else
                            <img src="{{asset('public/img/no-user.jpg')}}" alt="Profile Photo" class="img-profile" />
                        @endif
            </div>
            <div class="info-right col-sm-9 ">
                <h2>{{$pra->first_name}} {{$pra->middle_name}} {{$pra->last_name}} <small> 
                <!-- Gender checking condition---->
				(<?php if ($pra['Gender']=="0") {
				echo "Male";}
				elseif ($pra['Gender']=="1" ){
				echo "Female";	
				}
				?>)
					
				</small></h2>
                <h3>{{$pra_profile->Type}} at <span> {{$pra->clinic_name}}</span></h3>
                <h4>{{$pra->clinic_city}}, {{$pra->clinic_state}}</h4>
                <address>{{$pra->primary_phone}}<br>
                {{$pra->clinic_street_address}} <br>
                 {{$pra_profile->website_url}}
                </address>

                <ul class="social-icon-top">
                    <li class="linkedin"><a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                    <li class="facebook"><a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li class="twitter"><a href=""><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                    <li class="google"><a href=""><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                    <li class="envelope"><a href=""><i class="fa fa-envelope" aria-hidden="true"></i></a></li>

                </ul>

            </div>

            <hr>
            <img class="add" src="{{asset('public/img/img-blog-isf/add-body.png')}}">
            <div class="sec-1 col-sm-12">

                <div class="sec-1-left col-sm-4 ">
                    <h4>PRACTICE QUICKLOOK</h4>
                    <hr>
                    <ul>
                        <li><b>Practicing for:</b> {{$pra_profile->practice_years}} years</li>
                        <li><b>Accepting new patients:</b> {{$pra_profile->accepts_new_patients}}</li>
                        <li><b>Accepts PPO</b>: {{$pra_profile->ai_ppo}}</li>
                        <li><b>Accepts HMO</b>: {{$pra_profile->ai_hmo}}</li>
                        <li><b>Medical</b>:{{$pra_profile->ai_Medical}}</li>
                        <li><b>Medicade</b>:{{$pra_profile->ai_medicaid}}</li>
						<li><b>Medicare</b>: {{$pra_profile->ai_medicare}}</li>
                        <li><b>Workman’s Comp</b>: {{$pra_profile->ai_woc}}</li>
                        <li><b>Personal Injury</b>: {{$pra_profile->ai_pi}}</li>
                        <li><b>Languages Spoken</b>:{{$pra_profile->languages_spoken}}</li>
                    </ul>


                </div>
                <div class="sec-1-right col-sm-8 ">
                    <h4>ABOUT {{$pra->first_name}} {{$pra->middle_name}} {{$pra->last_name}}</h4>

                    <p>{{$pra_profile->about}}</p>
                    <h4>SPECIALTIES</h4>
                    <p>{{$pra_profile->specialties}}
                    </p>
                </div>
            </div>

            <div class="sec-2 col-sm-12">

                <div class="sec-2-left col-sm-4 ">
				    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

                    <h4>OFFICE LOCATION</h4>
					
                    <hr>
                    <p><b>{{$pra->clinic_name}}  </b>{{$pra->clinic_street_address}} {{$pra->clinic_city}}, {{$pra->clinic_state}}</p>
                    <p><b>Phone:</b>{{$pra->primary_phone}}</p>
					
					<div id="map"></div>
					

                   <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127482.68814050722!2d101.61694842142417!3d3.1385035596317916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc49c701efeae7%3A0xf4d98e5b2f1c287d!2sKuala+Lumpur%2C+Federal+Territory+of+Kuala+Lumpur%2C+Malaysia!5e0!3m2!1sen!2s!4v1500560200755"
                        width="200" height="230" frameborder="0" style="border:0" allowfullscreen></iframe>-->


                    <a href="#">Get Directions</a>
                    <a href="#">Email for appointment details.</a>

                </div>

                <div class="sec-2-right col-sm-8 ">

                    <h4>Blog</h4>
                    <hr>
					
					 @foreach($posts as $post)
                    <div class="post-wrapper col-sm-12">
                        <div class=" blog-sec col-sm-12">

                            <div class="blog-sec-left col-sm-3">
                                 @if(isset($pra->photo) && (!empty($pra->photo)))
                            <img src="{{asset('public/practitioners/'. $pra->directory .'/'.$pra->photo)}}" alt="Profile Photo" class="img-profile" />
                        @else
                            <img src="{{asset('public/img/no-user.jpg')}}" alt="Profile Photo" class="img-profile" />
                        @endif
                            </div>

                            <div class="blog-sec-right col-sm-9 ">
							
                                <p class="post-date">{{ $post->created_at->format('m-d-Y H:i:s') }}</p>
                                <div id="showpost<?php echo $post->post_id; ?>" >
								<?php 
								$postlen = $post->contents; 
								$len = strlen($postlen);
								if($len > 200){ ?>
									
									<?php print substr($post->contents,0,200);?>
									<br>
									<input type='button' name='readmore' id="rm<?php echo $post->post_id; ?>" class='btn-readmore' value='Readmore..'>	
								<?php }  
								else if($len < 150){
									
									print $post->contents;
									
								}
								
								else if ($len < 50)
								{
									print $post->contents;
									
								}
								
								?>
								</div>
								
								
								 <div id="hidepost<?php echo $post->post_id; ?>" style="display:none;">
									<?php print $post->contents;?>
									<br>
									<input type='button' name='readless' id="rl<?php echo $post->post_id; ?>" class='btn-readmore' value='Readless..'>	
								
								</div>
								 
								 
								 
                            </div>
                        </div>

                        <div class=" social-share col-sm-12">
                            <div class=" social-share-left col-sm-6">

                                <div class="social-left-area col-sm-6">
                                    <b>See this post on:</b>
                                </div>

                                <div class=" social-right-area col-sm-6">
                                    <ul class="social-icon">
                                        <li class="linkedin"><a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                                        <li class="facebook"><a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                                        <li class="twitter"><a href=""><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                                        <li class="google"><a href=""><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                                        <li class="envelope"><a href=""><i class="fa fa-envelope" aria-hidden="true"></i></a></li>

                                    </ul>

                                </div>

                            </div>
                            <div class=" social-share-right col-sm-6">
                                <a href="#" class="share-btn">Share this post    <i class="fa fa-share-alt" aria-hidden="true"></i></a>
                            </div>

                        </div>

                    </div>
					
					<script type="text/javascript">
                    $(document).ready(function(){

	
	                $("#rm<?php echo $post->post_id; ?>").click(function(){
		            $("#showpost<?php echo $post->post_id; ?>").hide();
		            $("#hidepost<?php echo $post->post_id; ?>").show();
	
    


                    });
	
		           $("#rl<?php echo $post->post_id; ?>").click(function(){
                   $("#showpost<?php echo $post->post_id; ?>").show();
	               $("#hidepost<?php echo $post->post_id; ?>").hide();
	
                    });


	
                    });
                     </script>
					 @endforeach



                  <!--  <div class="post-wrapper col-sm-12">
                        <div class=" blog-sec col-sm-12">
						

                            <div class="blog-sec-left col-sm-3">
                                <img src="{{asset('public/img/img-blog-isf/img-1.jpg')}}" alt="profile-image">
                            </div>

                            <div class="blog-sec-right col-sm-9 ">
                                <p class="post-date">Aug 3, 2015</p>
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in
                                    culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                            </div>
                        </div>

                        <div class=" social-share col-sm-12">
                            <div class=" social-share-left col-sm-6">

                                <div class="social-left-area col-sm-6">
                                    <b>See this post on:</b>
                                </div>

                                <div class=" social-right-area col-sm-6">
                                    <ul class="social-icon">
                                        <li class="linkedin"><a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                                        <li class="facebook"><a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                                        <li class="twitter"><a href=""><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                                        <li class="google"><a href=""><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                                        <li class="envelope"><a href=""><i class="fa fa-envelope" aria-hidden="true"></i></a></li>

                                    </ul>

                                </div>

                            </div>
                            <div class=" social-share-right col-sm-6">
                                <a href="#" class="share-btn">Share this post    <i class="fa fa-share-alt" aria-hidden="true"></i></a>
                            </div>

                        </div>

                    </div>




                    <div class="post-wrapper col-sm-12">
                        <div class=" blog-sec col-sm-12">

                            <div class="blog-sec-left col-sm-3">
                                <img src="{{asset('public/img/img-blog-isf/img-1.jpg')}}" alt="profile-image">
                            </div>

                            <div class="blog-sec-right col-sm-9 ">
                                <p class="post-date">Aug 3, 2015</p>
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in
                                    culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
                            </div>
                        </div>

                        <div class=" social-share col-sm-12">
                            <div class=" social-share-left col-sm-6">

                                <div class="social-left-area col-sm-6">
                                    <b>See this post on:</b>
                                </div>

                                <div class=" social-right-area col-sm-6">
                                    <ul class="social-icon">
                                        <li class="linkedin"><a href=""><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                                        <li class="facebook"><a href=""><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                                        <li class="twitter"><a href=""><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                                        <li class="google"><a href=""><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                                        <li class="envelope"><a href=""><i class="fa fa-envelope" aria-hidden="true"></i></a></li>

                                    </ul>

                                </div>

                            </div>
                            <div class=" social-share-right col-sm-6">
                                <a href="#" class="share-btn">Share this post    <i class="fa fa-share-alt" aria-hidden="true"></i></a>
                            </div>

                        </div>

                    </div> -->

                </div>



            </div>

        </div>


        <div class="wrap-inner-right col-sm-4  ">
            <div class="btn-wrap col-sm-12">
                <div class=" btn-area-left col-sm-6">


                </div>
                <div class="btn-area-right col-sm-6">

                    <button>share <i class="fa fa-share-alt" aria-hidden="true"></i></button>



                </div>
            </div>
            <!--==========================hours of operations open=====================================-->
            <div class="open-time-wrap col-sm-12">
                <h4>HOURS OF OPERATION</h4>
                <ul>
                    <li>
                        <span class="open-days">Mon
</span>
                        <span>{{$op_hours->monday_open}}</span>-
                        <span> {{$op_hours->monday_close}}</span></li>
						
                    <li><span class="open-days">Tues
</span>
                        <span>{{$op_hours->tuesday_open}}</span>-
                        <span> {{$op_hours->tuesday_close}}</span></li>
                    <li><span class="open-days">Wed
</span>
                        <span>{{$op_hours->wednesday_open}}</span>-
                        <span> {{$op_hours->wednesday_close}}</span></li>
                    <li><span class="open-days">Thur
</span>
                        <span>{{$op_hours->thursday_open}}</span>-
                        <span> {{$op_hours->thursday_close}}</span></li>
                    <li><span class="open-days" style="padding-right:14%">Fri
</span>
                        <span>{{$op_hours->friday_open}}</span>-
                        <span> {{$op_hours->friday_close}}</span></li>
                    <li><span class="open-days" style="padding-right:13%">Sat

</span>

                        <span>By Appointment </span></li>
                    <li><span class="open-days" style="padding-right:12%">Sun
</span>
                        <span>Closed
</span>
                    </li>
                </ul>


            </div>

            <!--==========================hours of operations cloes=====================================-->
            <div class="learn-more-sec col-sm-12 text-center">
                <p class="text-left">please fill out the following if you would like to learn more about our practice and be able to shop from our trusted online Practioners Store </p>
				
                {{ Form::open(array('url' => '/phpsendmail')) }} 
                <input type="text" name="name" required  class="inp-txt" placeholder="Name" >
                <input type="email"  name="email" required  class="inp-txt" placeholder="Email@example.com"  >
                <input type="password"  name="password" required   class="inp-txt" placeholder="Password"  >
                <button type="submit" name="submit">Submit</button>
				{{ Form::close() }}
            </div>

            <img class="sidebar-add-img" src="{{asset('public/img/img-blog-isf/add-sidebar.png')}}" alt="">

        </div>

	</div>
	
	</div>
	
        <!--###############################main wrapper cloes########################################-->
		
		

		<script>
		//make lat and lng
		$( document ).ready(function() {
	     var geocoder =  new google.maps.Geocoder();
         geocoder.geocode( { 'address': '{{$pra->clinic_street_address}} {{$pra->clinic_city}},{{$pra->clinic_state}}'}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
			  
		  var a = results[0].geometry.location.lat();
		   var b = results[0].geometry.location.lng();
		  
		  initMap(a,b);
            /* alert("location : " + results[0].geometry.location.lat() + " " +results[0].geometry.location.lng()); */
             } else {
             alert("Something got wrong " + status);
             }
             });
			 });
		
        function initMap(a,b){
			//map options
			var options ={
				zoom:10,
				center:{lat:a,lng:b}
			}
			//new map
			var map = new google.maps.Map(document.getElementById('map'), options);
			
			//Add marker 
			var marker = new google.maps.Marker({
				
				position:{lat:a,lng:b},
				map: map
				
			}); 
	
         } 		
		</script>
     <script async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCffnz-fabPu53pfytVSa34coflO3cmws8&callback=initMap">
     </script>
		
		

@endsection


