<div id="slideshow">
	<ul>
		<li class="slider1">
			<span class="slider-text" data-unislider-settings='{ "left" : 40, "top" : "50", "width" : "960"}'>Hoşgeldiniz...</span>
			<span class="slider-text" data-unislider-settings='{ "left" : 40, "top" : "90", "width" : "960"}'>CarsiNET</span>
			<span class="slider-text" style="font-size: 40px;" data-unislider-settings='{ "left" : 40, "top" : "120", "width" : "960"}'>Yayında..</span>
		</li>
		<li class="slider2">
			<span class="slider-text" style="font-size: 40px; background: #FFF; border-radius: 5px; padding: 4px; color: #333;" data-unislider-settings='{ "left" : 40, "top" : "40"}'>Online Alışverişin keyfini yaşayın...</span>
			<span class="slider-text" style="font-size: 30px; background: #FFF; border-radius: 5px; padding: 4px; color: #333;" data-unislider-settings='{ "left" : 40, "top" : "100"}'>Tüm ürünlerde kargo bedava...</span>
			<span class="slider-text" style="font-size: 30px; background: #FFF; border-radius: 5px; padding: 4px; color: #333;" data-unislider-settings='{ "left" : 40, "top" : "150"}'>Özel indirimli ürünler satışa sunuldu...</span>
		</li>
		<li class="slider3">
			<span class="slider-text" data-unislider-settings='{ "right" : 20, "top" : "50", "width" : "940"}'>Yüksek Müşteri Memnuniyeti...</span>
			<span class="slider-text" data-unislider-settings='{ "right" : 20, "top" : "100", "width" : "940"}'>Gelişmiş Güvenlik Önlemleri...</span>
			<span class="slider-text" data-unislider-settings='{ "right" : 20, "top" : "150", "width" : "940"}'>Hızlı Sipariş Takip...</span>
		</li>
	</ul>
</div>
<div id="newsBar">
	<h2>Duyurular : </h2>
	<div class="news">
		<?php	
		$result = $mth->query("SELECT * FROM news ORDER BY id DESC");
		while($new = $mth->assoc($result)){
		?>
		<div class="new" style="width: 720px;"><?=$new["title"]?> - <?=$new["description"]?></div>
		<?php } ?>
	</div>
	<div class="socaials">
		<?php
		$query = $mth->query("SELECT * FROM social_networks ORDER BY title ASC");
		while($social = $mth->assoc($result)){
		?>
		<a target="_blank" href="/<?=$social["link"]?>"><img src="<?=$social["image"]?>" height="26" alt="" /></a>
		<?php } ?>
	</div>
	<div class="clear"></div>
</div>
<div id="products">
	<?php
	$i = 0;
	$result = $mth->query("SELECT * FROM products ORDER BY id DESC");
	while($product = $mth->assoc($result)){ $i++; 
	?>
	<div class="product product<?=$i?>">
		<div class="img">
			<a href="urun/<?=$product["id"]?>/<?=$mth->seoUrl($product["title"])?>.html" style="display: block; text-align:center">
				<img src="/<?=$product["thumb"]?>" alt="<?=$product["title"]?>" height="200" style="margin: 0 auto;" />
				<div class="clear"></div>
			</a>
		</div>
		<a class="title" href="/urun/<?=$product["id"]?>/<?=$mth->seoUrl($product["title"])?>.html"><?=$product["title"]?></a>
		<span class="desc"><?=$product["description"]?></span>
		<div class="bottom">
			<div class="price">
				<?=$product["price"]?> TL
			</div>
			<div class="buttons">
				<a onclick="$.orders.add_to_cart(<?=$product["id"]?>);" class="button green">Sepete At</a>
				<a href="/urun/<?=$product["id"]?>/<?=$mth->seoUrl($product["title"])?>.html" class="button black">İncele</a>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php if($i==3){$i=0;} } ?>
	<div class="clear"></div>
</div>