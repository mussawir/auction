<?php 

session_start();
$role = isset($_GET['role']) ? $_GET['role'] : $_POST['role'];
if($role=='practitioner'){
	$path = isset($_GET['path']) ? $_GET['path'] : $_POST['path'];
	
	//$message = $_SESSION['uId'];
	
	$abc =  $_SESSION['uId'];
	
	$_SESSION['MODIFIEDCKPATH'] = "/dev/public/images/practitioners/".$abc."".$_GET['path'];

}
else {	
	$_SESSION['MODIFIEDCKPATH'] = '/dev/public/images/admin/'.$_GET['path'];
	header('Location: https://'.$_SERVER['HTTP_HOST'].'/dev/'.$role);
}
?>

