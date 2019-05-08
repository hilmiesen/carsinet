<?php 
session_start();
include("class/class.site.php"); $mth = new mth;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ÜYE GİRİŞİ</title>
	
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
		<div class="title"> <h2 style="color: #FFF; font-size: 28px;">ÜYE GİRİŞİ</h2> </div>
		<div class="body">
			<form method="post" action="login.php?login=true">
				<label class="log-lab">Kullanıcı Adı</label>
				<input name="username" type="text" class="login-input-user" id="username" />
				<label class="log-lab">Parola</label>
				<input name="password" type="password" class="login-input-pass" id="password" />
				<input type="submit" name="button" id="button" value="Giriş Yap" class="button"/>
			</form>
			<?php
			if($_GET["login"]==true){
				echo '<div style="margin-top:8px;">&nbsp;</div>';
				$username = $_POST["username"];
				
				$fPassword = $_POST["password"];
				//$password = $mth->password($_POST["password"]);
				$password = $_POST["password"];
				if($username=='' or preg_match('/\'/',$username)){
					$mth->message('Kullanıcı Adı alanını Doldurunuz !','error','div');
				}elseif($fPassword==''){
					$mth->message('Parola alanını Doldurunuz !','error','div');
				}else{
					$query = $mth->query("SELECT id,username,password FROM users WHERE username='".$username."' AND password='".$password."'");
					$rows = $mth->rows($query);
					if($rows==1){
						$user = $mth->assoc($query);
						$_SESSION["userID"] = $user["id"];
						$_SESSION["userUsername"] = $user["username"];
						$_SESSION["userPassword"] = $user["password"];
						$mth->message('...Giriş Başarılı, Yönlendiriliyorsunuz...','succes','div');
						$mth->parentLocation('index.php',3,1);
						
					}else{
						
						$mth->message('<h1>Böyle bir üye bulunamadı.</h1>','error','div');	
					}
				}
			}
			?>
			
		</div>
	</div>
</body>
</html>