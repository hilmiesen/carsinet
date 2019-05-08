<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr>
		<td width="13%"><img src="<?=$site->link?>temp/images/footerLogo.png" width="130" height="94" /></td>
		<td width="87%"><h2><?=$site->title?></h2></td>
	</tr>
</table>
<?php
$product = $mth->ins("products","*","WHERE id='".$_GET["id"]."'");
?>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr>
		<td width="13%"><img src="<?=$site->link?><?=$product["image"]?>" width="200" /></td>
		<td width="87%">
			<h2><?=$product["title"]?></h2>
			<p><?=$product["description"]?></p>
			<p>Daha detaylı bilgi için ; <a href="<?=$site->link?>?s=product&id=<?=$product["id"];?>">tıkla</a></p>
		</td>
	</tr>
</table>
</body>
</html>