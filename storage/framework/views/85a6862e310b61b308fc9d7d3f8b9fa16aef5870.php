<!DOCTYPE html>

<html lang="en">

<head>

    <?php /*<meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">*/ ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="Content-Type" content="image/svg+xml, text/html; charset=UTF-8"/>

    <meta name="description" content=""/>

    <meta name="keywords" content=""/>

    <meta name="author" content="aliinfotech.com">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>
	<?php if(isset($meta['page_title'])): ?><?php echo e($meta['page_title'].' - '); ?><?php endif; ?> Practice Tabs</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo e(asset('public/js/frontbootstrap.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('public/css/frontbootstrap.min.css')); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
	
	<link rel="shortcut icon" href="http://jobslane.com.my/practicetabs-zf2/public/img/favicon.ico" type="image/vnd.microsoft.icon" />
	
	
	<link rel="stylesheet" href="<?php echo e(asset('public/css/footer.css')); ?> ">
	
	 <link rel="stylesheet" href="<?php echo e(asset('public/css/mystyle.css')); ?> ">



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
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

    

   

    <?php /* <link href="<?php echo e(elixir('css/app.css')); ?>" rel="stylesheet"> */ ?>



    









                    
    <?php echo $__env->yieldContent('content'); ?>

 <?php echo $__env->make('layouts.front-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php /* <script src="<?php echo e(elixir('js/app.js')); ?>"></script> */ ?>

<?php echo $__env->yieldContent('page-scripts'); ?>



