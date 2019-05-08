
<h1>Siparişlerim</h1>
<table width="98%" border="1" bordercolor="#DDDDDD" class="list orders">
	<thead>
		<td>NO</td>
		<td>Ad Soyad</td>
		<td>Telefon</td>
		<td>Email</td>
		<td>Adres</td>
		<td align="right">Toplam Fiyat</td>
		<td align="right">İncele</td>
	</thead>
<?php
$query = $mth->query("SELECT * FROM orders WHERE user_id='".$online->id."'");
if($mth->rows($query)==0) echo '<tr><td colspan="6">Henüz sipariş girilmemiş.</td></tr>';
while($order = $mth->assoc($query)){
	$address = $mth->ins("addresses","*","WHERE id='".$order["address"]."'");
	$total_price += $order["total_price"];
?>
<tr>
	<td>#<?=$order["id"]?></td>
	<td><?=$order["name"]?></td>
	<td><?=$order["telephone"]?></td>
	<td><?=$order["email"]?></td>
	<td><?=$address["address"]?></td>
	<td align="right"><?=number_format($order["total_price"],2);?> TL</td>
	<td align="right"><a rel="prettyPhoto" href="display.php?dispatch=orders.order_view&id=<?=$order["id"]?>&width=700&height=450&iframe=true">İncele</a></td>
</tr>
<?php } ?>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><?=number_format($total_price,2);?> TL</td>
	<td></td>
</tr>
</table>