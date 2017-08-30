<?php 
session_start();
$_SESSION['MODIFIEDCKPATH'] = '/dev/public/images/practitioners/peter222220';
header('Location: https://'.$_SERVER['HTTP_HOST'].'/dev/practitioner/blog');
?>