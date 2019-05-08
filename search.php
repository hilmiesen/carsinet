<div id="products">
	<?php
	$query = "SELECT * FROM products WHERE title LIKE '%".$_POST["search"]."%' ORDER BY id DESC";
	$result = $mth->query($query);
	if($mth->rows($result)==0) echo '<div class="error">Ürün bulunamadı.</div>';
	
	while($product = $mth->assoc($result)){
	?>
	<div class="product">
		<div class="img">
			<a href="?s=product&id=<?=$product["id"]?>" style="display: block; text-align:center">
				<img src="<?=$product["thumb"]?>" alt="<?=$product["title"]?>" height="400" style="margin: 0 auto;" />
				<div class="clear"></div>
			</a>
		</div>
		<a class="title" href="?s=product&id=<?=$product["id"]?>"><?=$product["title"]?></a>
		<span class="desc"><?=$product["description"]?></span>
		<div class="bottom">
			<div class="price">
				<?=$product["price"]?> TL
			</div>
			<div class="buttons">
				<a onclick="$.orders.add_to_cart(<?=$product["id"]?>);" class="button green">Sepete At</a>
				<a href="?s=product&id=<?=$product["id"]?>" class="button black">İncele</a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php } ?>
	<div class="clear"></div>
</div>