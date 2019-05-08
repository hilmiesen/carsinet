<?php
$bugun = date("Y-m-d");
$hafta = date("Y-m-d", strtotime("-7 Days",$bugun));
$ay = date("Y-m-d", strtotime("-30 Days",$bugun));

/* Bu Gün */
$query = $mth->query("SELECT * FROM orders WHERE date='".$bugun."'");
$bugun_toplam = $mth->rows($query);
while($order = $mth->assoc($query)){
	$bugun_kazanc += $order["total_price"];
}

/* 7 Gün */
$query = $mth->query("SELECT * FROM orders WHERE date<='".$bugun."' AND date>='".$hafta."'");
$hafta_toplam = $mth->rows($query);
while($order = $mth->assoc($query)){
	$hafta_kazanc += $order["total_price"];
}

/* 30 Gün */
$query = $mth->query("SELECT * FROM orders WHERE date<='".$bugun."' AND date>='".$ay."'");
$ay_toplam = $mth->rows($query);
while($order = $mth->assoc($query)){
	$ay_kazanc += $order["total_price"];
}

/* Tamamı */
$query = $mth->query("SELECT * FROM orders");
$tamami_toplam = $mth->rows($query);
while($order = $mth->assoc($query)){
	$toplam_kazanc += $order["total_price"];
}

/* **************************************************************************************************** */

/* Bu Gün */
$query = $mth->query("SELECT * FROM users WHERE register_date='".$bugun."'");
$uye_bugun_toplam = $mth->rows($query);

/* 7 Gün */
$query = $mth->query("SELECT * FROM users WHERE register_date<='".$bugun."' AND register_date>='".$hafta."'");
$uye_hafta_toplam = $mth->rows($query);

/* 30 Gün */
$query = $mth->query("SELECT * FROM users WHERE register_date<='".$bugun."' AND register_date>='".$ay."'");
$uye_ay_toplam = $mth->rows($query);

/* Tamamı */
$query = $mth->query("SELECT * FROM users");
$uye_tamami_toplam = $mth->rows($query);


?>

<style type="text/css">
.mth td {
	padding: 5px;
	border-bottom: 1px solid #EEE;
}
.mth .last td {
	border-bottom: none;
	padding-bottom: 3px;	
}
</style>

<div id="stats">
	<div class="column">
		<b><?=number_format($bugun_kazanc,2)?> TL</b>
		Bu gün
	</div>
	<div class="column">
		<b><?=number_format($hafta_kazanc,2);?> TL</b>
		Son 7 Gün
	</div>
	<div class="column">
		<b><?=number_format($ay_kazanc,2);?> TL</b>
		Son 30 Gün
	</div>
	<div class="column last">
		<b><?=number_format($toplam_kazanc,2);?> TL</b>
		Toplam Sipariş
	</div>
</div>

<div class="page-title">
	<div class="in">
		<div class="titlebar">
			<h2>BAŞLANGIÇ</h2>
			<p>Yönetim panelinize hoşgeldiniz...</p>
		</div>
			
		<div class="shortcuts-icons">
			<a class="shortcut tips" onclick="javascript:location.reload();" title="Sayfayı Yenile">
				<img src="img/icons/shortcut/refresh.png" width="25" height="25" alt="icon" />
			</a>
			<a class="shortcut tips" href="#" title="İstatistikler ve site ile ilgili bilgileri bu sayfada bulabilirsiniz.">
				<img src="img/icons/shortcut/question.png" width="25" height="25" alt="icon" />
			</a>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
	
<div class="content">

	<div class="simplebox grid360-left">
		<div class="titleh">
			<h3>Sipariş İstatistikleri</h3>
		</div>
		<div class="body" style="padding: 6px;">
			<table width="100%" border="0" cellspacing="3" cellpadding="3" class="mth">
				<tr>
					<td>Toplam Alınan Sipariş Saysı</td>
					<td><strong><?=$tamami_toplam?></strong></td>
				</tr>
				<tr>
					<td>Son 30 Gün Alınan Sipariş Saysı</td>
					<td><strong><?=$ay_toplam?></strong></td>
				</tr>
				<tr>
					<td>Bu 7 Gün Alınan Sipariş Saysı</td>
					<td><strong><?=$hafta_toplam?></strong></td>
				</tr>
				<tr class="last">
					<td>Bugün Alınan Sipariş Saysı</td>
					<td><strong><?=$bugun_toplam?></strong></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="simplebox grid360-right">
		<div class="titleh">
			<h3>Üyelik İstatistikleri</h3>
		</div>
		<div class="body" style="padding: 6px;">
			<table width="100%" border="0" cellspacing="3" cellpadding="3" class="mth">
				<tr>
					<td>Toplam Üye Saysı</td>
					<td><strong><?=$uye_tamami_toplam?></strong></td>
				</tr>
				<tr>
					<td>Son 30 Gün Kayıt Olan Üye Saysı</td>
					<td><strong><?=$uye_ay_toplam?></strong></td>
				</tr>
				<tr>
					<td>Son 7 Gün Kayıt Olan Üye Saysı</td>
					<td><strong><?=$uye_hafta_toplam?></strong></td>
				</tr>
				<tr class="last">
					<td>Bugün Kayıt Olan Üye Saysı</td>
					<td><strong><?=$uye_bugun_toplam?></strong></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="grid740">
		<a href="?module=standart/general" class="dashbutton">
			<img src="img/icons/dashbutton/pc.png" width="33" height="32" alt="icon" />
			<b>Genel Ayarlar</b> Site genel ayarları
		</a>
		<a href="?module=standart/dm" class="dashbutton">
			<img src="img/icons/dashbutton/image.png" width="44" height="32" alt="icon" />
			<b>Dosya Merkezi</b> Dosyalar ve fotograflar
		</a>
		<a href="?module=standart/general" class="dashbutton">
			<img src="img/icons/dashbutton/inbox.png" width="44" height="32" alt="icon" />
			<b>İletişim Merkezi</b> İletişim mesajları
		</a>
		<div class="clear"></div>
	</div>
	
	<div class="clear"></div>
</div>
