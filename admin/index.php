<?php 
session_start();
include("class/class.admin.php"); $mth = new mth; @$mth->loginControl($_SESSION);
include("class/class.pager.php"); $pager = new pager;
$online = $mth->in('admins','*',"WHERE user='".$_SESSION["admin_user"]."' AND password='".$_SESSION["admin_password"]."'");
if($_GET["logout"]==true){	@session_destroy(); $mth->location('../index.php',1); }

$comment = $mth->in('comments','*',"WHERE statu='0'");
$site = $mth->in('site','*',"WHERE active='1'");
$message = $mth->in('messages','*',"WHERE st='0'");
$message_rows = $mth->inRows;

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
</head>

<body>
<div class="wrapper">
	<div id="header">
		<div class="logo">
			<a href="index.php">
				<h2 style="color: #FFF; font-size: 28px;"><?=admin_title?></h2>
			</a>
		</div>
		<div id="notifications">
			<a href="index.php?module=standart/general" class="qbutton-left <?php if($module=="standart/general") echo 'active'; ?>">
				<img src="img/icons/header/dashboard.png" width="16" height="15" alt="Başlangıç" />
			</a>
			<a href="?module=standart/dm" class="qbutton-normal tips <?php if($module=="standart/dm") echo 'active'; ?>" title="Dosya Merkezi">
				<img src="img/icons/header/graph.png" alt="Dosya Markezi" />
			</a>
			<a href="?module=standart/messages" class="qbutton-right <?php if($module=="standart/messages") echo 'active'; ?>">
				<img src="img/icons/header/support.png" width="19" height="13" alt="Teknik Destek" />
				<?php if($message_rows>0){ ?>
				<span title="<?=$message_rows;?> Adet onay bekleyen yorum var." class="qballon tips"><?=$message_rows;?></span>
				<?php } ?>
			</a>
			<div class="clear"></div>
		</div>
		<div id="quickmenu" style="display: none;">
			<a href="#" class="qbutton-left tips" title="Yeni Ürün Oluştur">
				<img src="img/icons/header/newpost.png" width="18" height="14" alt="new post" />
			</a>
			<a id="open-stats" href="#" class="qbutton-right tips" title="İstatistikler">
				<img src="img/icons/header/graph.png" width="17" height="15" alt="graph" />
			</a>
			<div class="clear"></div>
		</div>
		<div id="profilebox">
			<a href="#" class="display">
				<img src="img/icons/dashbutton/image.png" width="33" height="33" alt="profile"/>
				<b>Giriş Yapıldı</b>
				<span><?=$online->name_surname?></span>
			</a>
			<div class="profilemenu">
				<ul>
					<li><a target="_blank" href="../index.php">Siteye Git</a></li>
					<li><a href="?logout=true">Çıkış Yap</a></li>
				</ul>
			</div>			
		</div>
		<div class="clear"></div>
	</div>
    <div id="main">
        <div id="sidebar">
			<div id="searchbox">
				<div class="in">
					<form method="post" action="">
						<input name="search" type="text" class="input" id="textfield" onfocus="$(this).attr('class','input-hover')" onblur="$(this).attr('class','input')"  />
					</form>
				</div>
			</div>
            <div id="sidemenu">
            	<?php include("menu.php"); ?>
            </div>
        </div>
        <div id="page">
			<?php
			$getModule = $_GET["module"];
			if($getModule=="") $module = "modules/main/main.php"; else $module = "modules/".$getModule.".php";
			@include($module);
			?>
		</div>
    <div class="clear"></div>
    </div>
    <div id="footer">
    	<div class="left-column">Copyright 2013 - All rights reserved.</div>
    </div>
</div>
</body>
</html>