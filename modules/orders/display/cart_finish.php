<div id="cart_finish">
	<form action="" method="post" id="cart_finish">
	<div class="form" id="cart">
		<h2>Alıcı Kişinin</h2>
		<div class="line">
			<label for="">Adı Soyadı</label>
			<input type="text" name="name" value="<?=$_REQUEST["name"];?>" />
		</div>
		<div class="line">
			<label for="">Telefon Numarası</label>
			<input type="text" name="telephone" value="<?=$_REQUEST["telephone"];?>" />
		</div>
		<div class="line">
			<label for="">Email Adresi</label>
			<input type="text" name="email" value="<?=$_REQUEST["email"];?>" />
		</div>
		<div class="line">
			<label for="">Not</label>
			<textarea name="note"><?=$_REQUEST["note"];?></textarea>
		</div>
		<div class="line">
			<label for="">Adres</label>
			<select name="address" id="address">
				<?php
				$query = $mth->query("SELECT * FROM addresses WHERE user_id='".$online->id."'");
				while($list = $mth->assoc($query)){
				?>
				<option value="<?=$list["id"]?>"><?=$list["title"]." , ".$list["name"]?></option>
				<?php } ?>
			</select>
			<a style="color: #333; text-decoration: underline" rel="prettyPhoto" title="Adreslerim" href="display.php?dispatch=users.addresses&width=600&height=360&iframe=true">Adresleriniz</a>
		</div>
		<div class="line">
			<label for="">Ödeme Seçeneği</label>
			<select name="checkout_type">
				<option value="">Ödeme tipi seçiniz</option>
				<?php
				$query = $mth->query("SELECT * FROM checkout_types ORDER BY title");
				while($ct = $mth->assoc($query)){
				?>
				<option value="<?=$ct["id"]?>"><?=$ct["title"]?></option>
				<?php } ?>
			</select>
			<a style="color: #333; text-decoration: underline" href="?s=detail&tb=pages&id=4" class="det" target="_blank">Hesap Bilgilerimiz İçin Tıklayın.</a>
			<div class="clear"></div>
			<div id="ct" class="article"></div>
		</div>
		<div class="line">
			<input style="float: left; margin-top: 5px; margin-left: 90px;" type="checkbox" name="contract" id="contract" value="1" />
			<label for="contract" style="float: left; width: auto !important;">
				<a title="Mesafeli Satış Sözleşmesi" rel="prettyPhoto" href="display.php?dispatch=detail.detail&id=11&width=700&height=500&iframe=true">Mesafeli Satış Sözleşmesi</a>ni okudum kabul ettim.
			</label>
			<div class="clear"></div>
		</div>
		<div class="line">
			<input type="submit" name="cart_finish" value="Siparişi Tamamla" />
			<div class="clear"></div>
		</div>
	</div>
	<div class="list" id="cart">
		<h2>Sepetinizdeki Ürünler</h2>
		<table width="100%" border="1" bordercolor="#EEEEEE" class="list orders">
			<thead>
				<td>Ürün İsmi</td>
				<td align="right">Birim Fiyat</td>
				<td align="right">Toplam Fiyat</td>
				<td align="right">Adet</td>
			</thead>
		<?php
		$orders = $_SESSION["cart"][$online->id];
		$count = count($_SESSION["cart"][$online->id]);
		if($count==0) echo '<tr><td colspan="6">Henüz ürün eklenmemiş.</td></tr>';
		$total_price = 0;
		foreach($orders as $order){
			$product = $mth->ins("products","*","WHERE id='".$order["id"]."'");
			$total_price += $product["price"]*$order["number"];
			$total_number += $order["number"];
		?>
		<tr>
			<td><?=$product["title"]?></td>
			<td align="right"><?=number_format($product["price"],2);?> TL</td>
			<td align="right"><?=number_format($product["price"]*$order["number"],2);?> TL</td>
			<td align="right"><?=$order["number"]?></td>
			<input type="hidden" name="product_id[]" value="<?=$product["id"]?>" />
			<input type="hidden" name="product_price[]" value="<?=$product["price"]?>" />
			<input type="hidden" name="product_total_price[]" value="<?=$product["price"]*$order["number"]?>" />
			<input type="hidden" name="product_number[]" value="<?=$order["number"]?>" />
		</tr>
		<?php } ?>
		<tr>
			<td></td>
			<td></td>
			<td align="right"><strong><?=number_format($total_price,2);?> TL</strong></td>
			<td align="right"><strong><?=$total_number?></strong></td>
			<input type="hidden" name="total_price" value="<?=$total_price?>" />
		</tr>
		</table>	
	</div>
	</form>
	<div class="clear"></div>
	<?php
	if($_POST["cart_finish"]){
		
		if($_POST["name"]==""){
			$mth->alert('Lütfen Ad Soyad Bilgisi Giriniz.');
		}elseif($_POST["telephone"]==""){
			$mth->alert('Lütfen Telefon Bilgisi Giriniz.');			
		}elseif($_POST["email"]==""){
			$mth->alert('Lütfen Email Bilgisi Giriniz.');			
		}elseif($_POST["address"]==""){
			$mth->alert('Lütfen Adres Bilgisi Giriniz.');						
		}elseif($_POST["checkout_type"]==""){
			$mth->alert('Lütfen Ödeme Bilgisi Giriniz.');								
		}else{
		
			$order_insert = "
				INSERT INTO orders
				(user_id,name,telephone,email,address,note,total_price,date,checkout_type)
				VALUES
				(
				'".$online->id."',
				'".$_POST["name"]."',
				'".$_POST["telephone"]."',
				'".$_POST["email"]."',
				'".$_POST["address"]."',
				'".$_POST["note"]."',
				'".$_POST["total_price"]."',
				'".date("Y-m-d")."',
				'".$_POST["checkout_type"]."'			
				)
			";
			$order_insert = $mth->db_->exec($order_insert);
			$order_id = $mth->db_->lastInsertRowID();
			$products = count($_POST["product_id"]);
			for($i=0; $i<$products; $i++){
				$product_id = $_POST["product_id"][$i];	
				$product_price = $_POST["product_price"][$i];	
				$product_total_price = $_POST["product_total_price"][$i];	
				$product_number = $_POST["product_number"][$i];
				
				/* Stok işlemleri */
				$product = $mth->ins("products","*","WHERE id='".$product_id."'");
				$stock = $product["stock"];
				$new_stock = $stock - $product_number;
				$stock_update = $mth->db_->exec("UPDATE products SET stock='".$new_stock."' WHERE id='".$product["id"]."'");
				/* Stok işlemleri */
				
				if($product_id!=""){
					$oinsert = "
						INSERT INTO orders_products
						(order_id,product_id,price,total_price,number)
						VALUES
						(
						'".$order_id."',
						'".$product_id."',
						'".$product_price."',
						'".$product_total_price."',
						'".$product_number."'
						)
					";
					
					$oinsert = $mth->db_->exec($oinsert);
				}
				
			}
			
	
			include("libraries/mailer/class.phpmailer.php"); $mailer = new PHPMailer;
			include("libraries/mailer/phpmailer.lang-tr.php");
			
			$url = $site->link.'display.php?dispatch=orders.mail&id='.$order_id;
			
	
			$mailData = $mth->connectFile($url);
			
		
			$mailer->IsSMTP();
			$mailer->SMTPDebug  = 1;  
			$mailer->SMTPAuth   = true;                 
			$mailer->Host       = $site->mail_host; 
			$mailer->Username   = $site->mail_username; 
			$mailer->Password   = $site->mail_password;  
			$mailer->Port       = 25;
		
			$mailer->SetFrom($site->mail_username, 'Sipariş Bilgisi - '.$site->title);
			$mailer->AddReplyTo($site->mail_username, 'Sipariş Bilgisi - '.$site->title);	
						
			$mailer->AddAddress($_POST["email"], $_POST["name"]);
			$mailer->AddAddress($online->email, $online->name);
			$mailer->AddAddress($site->email, $site->title);		
			
			$mailer->Subject    = 'Sipariş Bilgisi - '.$site->title;
			$mailer->MsgHTML($mailData);
			
			if(!$mailer->Send()){
				echo "Mailer Error: " . $mailer->ErrorInfo;
			}
	
			if($oinsert && $order_insert){
				$mth->alert('Sipariş Başarıyla Tamamlandı.');
				$mth->parentLocation('index.php?s=display&dispatch=orders.orders');
				$_SESSION["cart"] = "";
			}
		
		}
		
	}
	?>
</div>