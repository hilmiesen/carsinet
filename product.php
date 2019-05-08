<?php
$product = $mth->ins('products','*',"WHERE id='".$_GET["id"]."'");
?>
<div id="product">
	<div class="product_images">
		<a rel="prettyPhoto[gal]" href="<?=$product["image"]?>" class="big_image">
			<img src="/<?=$product["thumb2"]?>" width="338" alt="" />
		</a>
		<div class="gallery">
			<?=$mth->getGallery('products-'.$product["id"],'a_img',100,"");?>
		</div>
	</div>
	<div class="product_info">
		<h1><?=$product["title"]?></h1>
		<p class="description"><?=$product["description"]?></p>
		<div class="blocks">
			<div class="cart-button">
				<a onclick="$.orders.add_to_cart(<?=$product["id"]?>);" style="cursor: pointer;">Sepete Ekle</a>
			</div>
			<div class="price"><?=$product["price"]?> TL</div>
			<div class="clear"></div>
		</div>
		<div class="article">
			<?=$product["content"]?>
		</div>
	</div>
	<div class="clear"></div>
</div>