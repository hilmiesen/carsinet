<div id="contact" style="padding: 8px;">
	<div id="address"><?=$site->address?></div>
	<div id="contactForm">
		<form action="" method="post">
			<h2>İletişim Formu</h2>
			<div class="line">
				<strong>Adınız Soyadınız</strong>
				<p><input type="text" name="name_surname" /></p>
				<div class="clear"></div>
			</div>
			<div class="line">
				<strong>Email Adresiniz</strong>
				<p><input type="text" name="email" /></p>
				<div class="clear"></div>
		  </div>
			<div class="line">
				<strong>Telefon Numaranız</strong>
				<p><input type="text" name="telephone" /></p>
				<div class="clear"></div>
			</div>
			<div class="line">
				<strong>Konu</strong>
				<p><input type="text" name="subject" /></p>
				<div class="clear"></div>
			</div>
			<div class="line">
				<strong>Mesajınız</strong>
				<p><textarea name="message" cols="" rows=""></textarea></p>
				<div class="clear"></div>
			</div>
			<div class="line">
				<input type="hidden" name="date" value="<?=date('Y-m-d');?>" />
				<input type="submit" value="Gönder" />
				<div class="clear"></div>
			</div>
		</form>
	</div>
	<div class="clear"></div>
	<?php
	if($_POST) $mth->contact($_POST);
	?>	
</div>