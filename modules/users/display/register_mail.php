<?php
$user = $mth->in("users","*","WHERE id='".$_GET["id"]."'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>
<body>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr>
		<td width="13%"><img src="<?=$site->link?>temp/images/footerLogo.png" width="130" height="94" /></td>
		<td width="87%"><h2><?=$site->title?></h2></td>
	</tr>
</table>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr>
		<td colspan="2"><?=$user->name?> Web sitemize başarıyla kayıt oldunuz. <a href="<?=$site->link?>"><?=$site->link?></a></td>
	</tr>
</table>	
</body>
</html>