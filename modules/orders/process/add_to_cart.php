<?php
if(! $users->online($_SESSION)){
	$mth->notify("error","Üye Girişi Yapmalısınız !","Ürünü sepetinize ekleyebilmek için lütfen üye girişi yapın.");
}else{
	$product_id = (int) $_GET["product_id"];
	if($product_id){
		$product = $mth->ins("products","*","WHERE id='".$product_id."'");
		if($product){
			if($_SESSION["cart"][$online->id][$product["id"]]){
				$mth->notify("error","Bu ürün zaten sepetinizde mevcut !","Bu ürün zaten sepetinizde mevcut !");
			}else if($product["stock"]<=0 && $product["stock_finish"]==0){
				$mth->notify("error","Bu ürünün stokları tükenmiştir.","Lütfen daha sonra tekrar deneyin.");
			}else{
				$_SESSION["cart"][$online->id][$product["id"]]["id"] = $product["id"];
				$_SESSION["cart"][$online->id][$product["id"]]["number"] = 1;
				$mth->notify("success","Ürün sepete eklendi.","Bizi tercih ettiğiniz için teşekkür ederiz.");
			}
		}
	}
}
?>