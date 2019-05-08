<?php 
session_start();
include("class/class.admin.php"); $mth = new mth; @$mth->loginControl($_SESSION);
include("class/class.pager.php"); $pager = new pager;
$online = $mth->in('admins','*',"WHERE user='".$_SESSION["admin_user"]."' AND password='".$_SESSION["admin_password"]."'");
if($_GET["logout"]==true){	@session_destroy(); $mth->location('../index.php',1); }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$mth->cpTitle;?></title>
	
    <link rel="stylesheet" type="text/css" href="style/reset.css" /> 
    <link rel="stylesheet" type="text/css" href="style/root.css" /> 
    <link rel="stylesheet" type="text/css" href="style/grid.css" /> 
    <link rel="stylesheet" type="text/css" href="style/typography.css" /> 
    <link rel="stylesheet" type="text/css" href="style/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="style/jquery-plugin-base.css" />
    
    <!--[if IE 7]>	  <link rel="stylesheet" type="text/css" href="style/ie7-style.css" />	<![endif]-->
    
	<script type="text/javascript" src="../libraries/editor/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="../libraries/editor/ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-settings.js"></script>
	<script type="text/javascript" src="js/toogle.js"></script>
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/raphael.js"></script>
	<script type="text/javascript" src="js/analytics.js"></script>
	<script type="text/javascript" src="js/popup.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/jquery.ui.core.js"></script>
	<script type="text/javascript" src="js/jquery.ui.mouse.js"></script>
	<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="js/jquery.ui.slider.js"></script>
	<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="js/jquery.ui.tabs.js"></script>
	<script type="text/javascript" src="js/jquery.ui.accordion.js"></script>  
	
	<style type="text/css">
		.page-title {display: none;}
	</style>
	  
</head>

<body style="background-color: #FFF;">
<div class="display" style="width: 800px; margin: 0 auto;">
	<?php
	$getModule = $_GET["module"];
	if($getModule=="") $module = "modules/main/main.php"; else $module = "modules/".$getModule.".php";
	@include($module);
	?>
</div>
</body>
</html>