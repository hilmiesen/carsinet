<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="libraries/jquery.js"></script>
	<script type="text/javascript" src="libraries/mth.js"></script>
	<script type="text/javascript" src="modules/users/users.js"></script>
	<link rel="stylesheet" href="modules/users/users.css" media="all" />
</head>
<body>
	<div id="addresses">
		<a href="display.php?dispatch=users.address_add" class="new_add">Yeni Adres Ekle</a>
		<div class="clear"></div>
		<table width="98%" border="1" cellspacing="0" bordercolor="#EEE" class="list">
			<thead>
				<td>NO</td>
				<td>Adres Adı</td>
				<td>Adı Soyadı</td>
				<td>Telefon</td>
				<td>GSM</td>
				<td align="right">İşlemler</td>
			</thead>
		<?php
		$query = $mth->query("SELECT * FROM addresses WHERE user_id='".$online->id."'");
		if($mth->rows($query)==0) echo '<tr><td colspan="6">Henüz adres girilmemiş.</td></tr>';
		while($address = $mth->assoc($query)){
		?>
		<tr>
			<td>#<?=$address["id"]?></td>
			<td><?=$address["title"]?></td>
			<td><?=$address["name"]?></td>
			<td><?=$address["telephone"]?></td>
			<td><?=$address["gsm"]?></td>
			<td align="right">
				<a href="display.php?dispatch=users.address_edit&id=<?=$address["id"]?>">Düzenle</a>
				<a href="display.php?dispatch=users.addresses&delete_id=<?=$address["id"]?>">Sil</a>
			</td>
		</tr>
		<?php } ?>
		</table>
	</div>	
</body>
</html>