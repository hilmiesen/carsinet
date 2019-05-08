<?php 
session_start();
include("class/class.admin.php"); $mth = new mth;
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
    
    <!--[if IE 7]>	<link rel="stylesheet" type="text/css" href="style/ie7-style.css" />	<![endif]-->
    
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-settings.js"></script>
	<script type="text/javascript" src="js/toogle.js"></script>
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="js/raphael.js"></script>
	<script type="text/javascript" src="js/analytics.js"></script>
	<script type="text/javascript" src="js/popup.js"></script>
	<script type="text/javascript" src="js/fullcalendar.min.js"></script>
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
	<div class="loginform">
		<div class="title"> <h2 style="color: #FFF; font-size: 28px;"><?=admin_title?></h2> </div>
		<div class="body">
			<form method="post" action="login.php?login=true">
				<label class="log-lab">Kullanıcı Adı</label>
				<input name="user" type="text" class="login-input-user" id="textfield" autofocus="autofocus" />
				<label class="log-lab">Parola</label>
				<input name="password" type="password" class="login-input-pass" id="textfield" />
				<input type="submit" name="button" id="button" value="Giriş Yap" class="button"/>
			</form>
			<?php
			if($_GET["login"]==true){
				echo '<div style="margin-top:8px;">&nbsp;</div>';
				$mth->login($_POST);
			}
			?>
		</div>
	</div>
</body>
</html>