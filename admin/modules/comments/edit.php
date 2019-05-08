<?php
include("settings.php");
$mth->editor();
$data = $mth->ins(module_table,'*',"WHERE id='".$_GET["id"]."'");
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
		$empty = array('name');
		$mth->medit(module_table,"WHERE id='".$_GET["id"]."'",$_POST,$empty);
		$data = $mth->ins(module_table,'*',"WHERE id='".$_GET["id"]."'");
	}
	?>
	<div class="simplebox grid740">
		<div class="titleh">
			<h3><?=module_keyword?> İşlemleri</h3>
		</div>
		<div class="body">		
			<form method="post" action="">		  
				<div class="st-form-line">	
					<span class="st-labeltext">Ürün</span>	
					<a title="<?=$mth->id2t('products',$data["product_id"],'title');?>" rel="prettyPhoto" class="st-button button-red" href="display.php?module=products/edit&id=<?=$mth->id2t('products',$data["product_id"],'id');?>&width=840&height=360&iframe=true">
						<?=$mth->id2t('products',$data["product_id"],'title');?>
					</a> 
					<div class="clear"></div>
				</div>
				<div class="st-form-line">	
					<span class="st-labeltext">Adı Soyadı</span>	
					<input name="name" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["name"]?>" /> 
					<div class="clear"></div>
				</div>
				<div class="st-form-line">	
					<span class="st-labeltext">Email</span>	
					<input name="email" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["email"]?>" /> 
					<div class="clear"></div>
				</div>
				<div class="st-form-line">	
					<span class="st-labeltext">Yorum</span>
					<div class="st-formeditor">
						<textarea name="content" class="st-forminput" id="editor"><?=$data["comment"]?></textarea>
					</div>
					<div class="clear"></div>
				</div>
				<input type="hidden" name="date" value="<?=date("Y-m-d");?>" />
				<input type="submit" style="margin-right: 0; border-radius: 0; width: 100%; cursor: pointer;" value="Formu Kaydet" class="st-button" />
			</form>
		</div>
	</div>
</div>