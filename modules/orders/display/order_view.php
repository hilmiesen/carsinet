<?php
$order = $mth->ins("orders","*","WHERE id='".$_GET["id"]."'");
$address = $mth->ins("addresses","*","WHERE id='".$order["address"]."'");
$ct = $mth->ins("checkout_types","*","WHERE id='".$order["checkout_type"]."'");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="modules/orders/orders.css" />
</head>
<body>
<div id="order_view">
	<h2>Alıcı Bilgileri</h2>
	<table width="100%" cellspacing="0" cellpadding="6" border="1" bordercolor="#EEEEEE">
		<tr>
			<td><strong>Adı Soyadı :</strong></td>
			<td><?=$order["name"]?></td>
			<td>&nbsp;</td>
			<td><strong>Telefon Numarası :</strong></td>
			<td><?=$order["telephone"]?></td>
		</tr>
		<tr>
			<td><strong>Email Adresi : </strong></td>
			<td><?=$order["email"]?></td>
			<td>&nbsp;</td>
			<td><strong>Not : </strong></td>
			<td><?=$order["note"]?></td>
		</tr>
		<tr>
			<td><strong>Adres : </strong></td>
			<td colspan="4"><?=$address["address"]?></td>
		</tr>
		<tr>
			<td><strong>Ödeme Tipi : </strong></td>
			<td colspan="4"><?=$ct["title"]?></td>
		</tr>
	</table>
	<h2>Siparişinizdeki Ürünler</h2>
	<table width="100%" cellspacing="0" cellpadding="6" border="1" bordercolor="#EEEEEE">
		<tr>
			<td><strong>Ürün</strong></td>
			<td><strong>Adet</strong></td>
			<td align="right"><strong>Birim Fiyat</strong></td>
			<td align="right"><strong>Toplam Fiyat</strong></td>
		</tr>
		<?php
		$query = $mth->query("SELECT * FROM orders_products WHERE order_id='".$order["id"]."'");
		while($op = $mth->assoc($query)){
			$product = $mth->ins("products","*","WHERE id='".$op["product_id"]."'");
			$total_price += $op["total_price"];
		?>
		<tr>
			<td><?=$product["title"]?></td>
			<td><?=$op["number"]?></td>
			<td align="right"><?=number_format($op["price"],2);?> TL</td>
			<td align="right"><?=number_format($op["total_price"],2);?> TL</td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="3"></td>
			<td align="right"><h3><?=number_format($total_price,2);?> TL</h3></td>			
		</tr>
	</table>	
</div>
</body>
</html>