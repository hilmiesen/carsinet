<?php
include("settings.php");
$mth->editor();
$data = $mth->ins('site','*',"WHERE active='1'");;
?>
<div class="page-title">
	<div class="in">
		<div class="titlebar">
			<h2>Site Genel Ayarlar</h2>
			<p>Sitenizin başlığı ve açıklamasını girebileceğiniz alan...</p>
		</div>
			
		<div class="shortcuts-icons">
			<a class="shortcut tips" onclick="javascript:location.reload();" title="Sayfayı Yenile">
				<img src="img/icons/shortcut/refresh.png" width="25" height="25" alt="icon" />
			</a>
			<a class="shortcut tips" href="#" title="Sitenizin başlığı, açıklaması gibi genel bilgilerinizi girebileceğiniz alan.">
				<img src="img/icons/shortcut/question.png" width="25" height="25" alt="icon" />
			</a>
		</div>
		
		<div class="clear"></div>
	</div>
</div>

<div class="content">
	<?php
	if($_POST){
		$empty = array('title');
		if($mth->medit('site',"WHERE active='1'",$_POST,$empty)){
			header("Location:?module=standart/general&map=1");	
		}
	}
	?>
	<form method="post" action="">		  
	<div class="simplebox grid740">
		<div class="titleh">
			<h3>Site Genel Ayarları</h3>
		</div>
		<div class="body">		
			<div class="st-form-line">	
				<span class="st-labeltext">Site Başlık</span>	
				<input name="title" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["title"]?>" /> 
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Site Açıklama</span>	
				<input name="description" type="text" class="st-forminput" style="width: 510px;" value="<?=$data["description"]?>" /> 
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Site Anahtar Kelimeler</span>	
				<input name="keywords" type="text" class="st-forminput" style="width: 510px;" value="<?=$data["keywords"]?>" /> 
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Site Link</span>	
				<input name="link" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["link"]?>" /> 
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Site Dizin</span>	
				<input name="site_folder" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["site_folder"]?>" /> 
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">İletişim Mail Adresi</span>	
				<input name="email" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["email"]?>" /> 
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">İletişim Bilgileri</span>	
				<div class="st-formeditor">
					<textarea name="address" id="editor"><?=$data["address"]?></textarea>
				</div>
				<div class="clear"></div>
			</div>
		</div>		
	</div>
	<div class="simplebox grid740">
		<div class="titleh">
			<h3>Site Tasarım Ayarları</h3>
		</div>
		<div class="body">		
			<div class="st-form-line">	
				<span class="st-labeltext">Site Logo</span>	
				<input name="site_logo" type="text" class="st-forminput" style="width: 310px;" value="<?=$data["site_logo"]?>" />  (66px yükseklik ideal yüksekliktir.)
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Footer Logo</span>	
				<input name="footer_logo" type="text" class="st-forminput" style="width: 310px;" value="<?=$data["footer_logo"]?>" />  (200x90px ideal boyutlardır.)
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Ürün Thumb Boyutları</span>	
				<input name="product_thumb_width" type="text" class="st-forminput" style="width: 110px;" value="<?=$data["product_thumb_width"]?>" />  <input name="product_thumb_height" type="text" class="st-forminput" style="width: 110px;" value="<?=$data["product_thumb_height"]?>" />
				(Genişlik/Yükseklik)
				<div class="clear"></div>
			</div>
		</div>		
	</div>
	<div class="simplebox grid740">
		<div class="titleh">
			<h3>Site Mail Ayarları (SMTP üzerinden mail gönderebilmek içindir)</h3>
		</div>
		<div class="body">		
			<div class="st-form-line">	
				<span class="st-labeltext">Mail Hosting</span>	
				<input name="mail_host" type="text" class="st-forminput" style="width: 310px;" value="<?=$data["mail_host"]?>" />
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Mail Username</span>	
				<input name="mail_username" type="text" class="st-forminput" style="width: 310px;" value="<?=$data["mail_username"]?>" />
				<div class="clear"></div>
			</div>
			<div class="st-form-line">	
				<span class="st-labeltext">Mail Şifresi</span>	
				<input name="mail_password" type="text" class="st-forminput" style="width: 310px;" value="<?=$data["mail_password"]?>" />
				<div class="clear"></div>
			</div>
		</div>		
	</div>
	<input type="submit" style="margin-right: 0; border-radius: 0; width: 100%; cursor: pointer;" value="Formu Kaydet" class="st-button" />
	</form>

</div>