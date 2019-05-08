<?php
include("settings.php");
$mth->editor();
$data = $_REQUEST;
?>
<div class="page-title">
	<div class="in">
		<div class="titlebar">
			<h2><?=module_title?></h2>
			<p><?=module_description?></p>
		</div>
			
		<div class="shortcuts-icons">
			<a class="shortcut tips" onclick="javascript:location.reload();" title="Sayfayı Yenile">
				<img src="img/icons/shortcut/refresh.png" width="25" height="25" alt="icon" />
			</a>
			<a class="shortcut tips" href="#" title="<?=module_big_description?>">
				<img src="img/icons/shortcut/question.png" width="25" height="25" alt="icon" />
			</a>
		</div>
		
		<div class="clear"></div>
	</div>
</div>

<div class="content">
	<?php
	if($_POST){
		$empty = array('name_surname','user','password','email');
		if($mth->madd(module_table,$_POST,$empty)) unset($data);
	}
	?>
	<div class="simplebox grid740">
		<div class="titleh">
			<h3><?=module_keyword?> İşlemleri</h3>
		</div>
		<div class="body">		
			<form method="post" action="" enctype="multipart/form-data">		  
				<div class="st-form-line">	
					<span class="st-labeltext">Adı Soyadı</span>	
					<input name="name_surname" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["name_surname"]?>" /> 
					<div class="clear"></div>
				</div>
				<div class="st-form-line">	
					<span class="st-labeltext">Email</span>	
					<input name="email" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["email"]?>" /> 
					<div class="clear"></div>
				</div>
				<div class="st-form-line">	
					<span class="st-labeltext">Kullanıcı Adı</span>	
					<input name="user" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["user"]?>" /> 
					<div class="clear"></div>
				</div>
				<div class="st-form-line">	
					<span class="st-labeltext">Şifre</span>	
					<input name="password" type="text" class="st-forminput" style="width: 210px;" value="" /> 
					<div class="clear"></div>
				</div>
				<input type="submit" style="margin-right: 0; border-radius: 0; width: 100%; cursor: pointer;" value="Formu Kaydet" class="st-button" />
			</form>
		</div>
	</div>
</div>