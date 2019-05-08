<?php
session_start();
if(! isset($_GET["s"])){
	include('class/class.site.php'); $mth = new mth;	
	include("modules/users/users.php"); $users = new users;
	$online = $mth->in('users','*',"WHERE id='".$_SESSION["userID"]."'");
	$site = $mth->in('site','*',"WHERE active='1'");
}
$dispatch = explode('.',$_GET["dispatch"]);
$module = $dispatch[0];
$file = $dispatch[1];
$inc = "modules/".$module."/process/".$file.".php";
if(file_exists($inc)){
	include($inc);
}else{
	$mth->alert('Sayfa bulunamadı.');	
}
?>