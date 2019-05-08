<h1>Sepetim</h1>
<?php
if($_POST["cart_update"]){
	$orders = $_SESSION["cart"][$online->id];
	foreach($orders as $order){
		$new_stock = $_POST["number_".$order["id"]];
		if($new_stock>0){
			$product = $mth->ins("products","*","WHERE id='".$order["id"]."'");
			if($product){
				$stock = $product["stock"];
				// echo $product["stock_finish"];
				if($stock<$new_stock && $product["stock_finish"]==1){
					$_SESSION["cart"][$online->id][$order["id"]]["number"] = $_POST["number_".$order["id"]];						
				}elseif($stock<$new_stock && $product["stock_finish"]==0){
					$_SESSION["cart"][$online->id][$order["id"]]["number"] = $product["stock"];
					$mth->notify("error",$product["title"],"Eklemek istediğiniz adet kadar stoğumuz bulunmamaktadır. Stoklarımızdaki miktar sepetinize eklenmiştir..");
				}else{
					$_SESSION["cart"][$online->id][$order["id"]]["number"] = $_POST["number_".$order["id"]];					
				}
			}
		}
	}
}

if($_GET["cart_delete"]){
	unset($_SESSION["cart"][$online->id][$_GET["cart_delete"]]);
}
?>
<form action="" method="post">
<table width="98%" border="1" bordercolor="#DDDDDD" class="list orders">
	<thead>
		<td width="10%">Ürün Resimi</td>
		<td width="20%">Ürün İsmi</td>
		<td width="35%">Ürün Açıklama</td>
		<td width="10%" align="right">Birim Fiyat</td>
		<td width="10%" align="right">Toplam Fiyat</td>
		<td width="5%" align="center">Adet</td>
		<td width="10%" align="center">Sil</td>
	</thead>
<?php
$orders = $_SESSION["cart"][$online->id];
$count = count($_SESSION["cart"][$online->id]);
if($count==0) echo '<tr><td colspan="6">Henüz ürün eklenmemiş.</td></tr>';
$total_price = 0;
$i = 0;
foreach($orders as $order){
	$i++;
	$product = $mth->ins("products","*","WHERE id='".$order["id"]."'");
	$total_price += $product["price"]*$order["number"];
?>
<tr>
	<td><img src="<?=$product["thumb"]?>" height="60" alt="" /></td>
	<td><?=$product["title"]?></td>
	<td><?=$product["description"]?></td>
	<td align="right"><?=number_format($product["price"],2);?> TL</td>
	<td align="right"><?=number_format($product["price"]*$order["number"],2);?> TL</td>
	<td align="center"><input class="itext" style="width: 20px; text-align: center;" type="text" name="number_<?=$product["id"]?>" value="<?=$order["number"]?>" /></td>
	<td align="center"><a href="?s=display&dispatch=orders.cart&cart_delete=<?=$product["id"]?>">Kaldır</a></td>
</tr>
<?php } ?>
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><h2><?=number_format($total_price,2);?> TL</h2></td>
	<td></td>
	<td></td>
</tr>
</table>
<?php if($i!=0){ ?>
<a style="background-color: #060; margin-right: 14px;" class="ibutton" href="?s=display&dispatch=orders.cart_finish">Siparişi Tamamla</a>
<input class="ibutton" type="submit" name="cart_update" value="Siparişi Güncelle" />
<?php } ?>
<div class="clear"></div>
</form>