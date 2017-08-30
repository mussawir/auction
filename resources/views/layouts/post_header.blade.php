<!DOCTYPE html>

<html lang="en">

<head>

    {{--<meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">--}}

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="image/svg+xml, text/html; charset=UTF-8"/>

    <meta name="description" content=""/>

    <meta name="keywords" content=""/>

    <meta name="author" content="aliinfotech.com">

    <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>
	@if(isset($meta['page_title'])){{$meta['page_title'].' - '}}@endif Practice Tabs</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{asset('public/js/frontbootstrap.min.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('public/css/frontbootstrap.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
	
	<link rel="shortcut icon" href="http://jobslane.com.my/practicetabs-zf2/public/img/favicon.ico" type="image/vnd.microsoft.icon" />
	
	
	<link rel="stylesheet" href="{{asset('public/css/footer.css')}} ">
	
	 <link rel="stylesheet" href="{{asset('public/css/mystyle.css')}} ">



</head>

  
	
	


	
	<body>

    <!--##################################search bar start###############################################-->
    <div class="search-bar col-sm-12">

        <div class="logo col-xs-4 col-sm-4 ">
            <img src="http://practicetab.com/dev/public/img/logoBlue.png" alt="logo">
        </div>

        <div class="sbar col-xs-4 col-sm-8 ">
            <div class="sbar-div">
                <input type="search" class="sbar-input" placeholder="Search Practioner Name,Practice,Specialty">

                <button type="submit" class="searchButton">
           <i class="fa fa-search"></i>
           </button>

            </div>
        </div>

    </div>
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    

   

    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}



    









                    
    @yield('content')

 @include('layouts.front-footer')
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

@yield('page-scripts')



