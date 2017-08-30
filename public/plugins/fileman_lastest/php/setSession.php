<?php 
session_start();
$_SESSION['MODIFIEDCKPATH'] = '/dev/public/images/Supplier/'.$_GET['path'];
header('Location: https://'.$_SERVER['HTTP_HOST'].'/dev/supplier');
?>