<div class="content">
	<div class="simplebox grid740">
	<?php
	if($_POST["tags"]){
		if($_POST["tag"]!=""){
			$ex = explode(',',$_POST["tag"]);
			$product_id = $_GET["product_id"];
			for($i=0; $i<count($ex); $i++){
				if($ex[$i]!=""){
					$sql = $mth->db_->exec("INSERT INTO tags (tag,tag_seo,product_id) values ('".$ex[$i]."','".$mth->seoUrl($ex[$i])."',$product_id)");
					if($sql) $error = false; else $error = true;
				}
			}
			if(! $error){
				$mth->message('Etiketleriniz Başarıyla Eklendi','succes','div'); ;
				unset($data["tag"]);
			}else{
				$mth->message('Etiketleriniz Eklenemedi.','error','div');
			}
		}
	}
	if($_GET["tagID"]){
		$mth->delete('tags',"WHERE id='".$_GET["tagID"]."'",array());
	}
	?>
		<div class="titleh">
			<h3>Etiket Ekle</h3>
		</div>
		<div class="body">		
			<form method="post" action="" enctype="multipart/form-data">		  
				<div class="st-form-line">	
					<span class="st-labeltext">Etiketler (Virgül ile ayırınız.)</span>	
					<input name="tag" type="text" class="st-forminput" style="width: 510px;" value="<?=$data["title"]?>" /> 
					<div class="clear"></div>
				</div>
				<input type="submit" name="tags" style="margin-right: 0; border-radius: 0; width: 100%; cursor: pointer;" value="Etiketleri Ekle" class="st-button" />
			</form>
		</div>
	</div>
	<div class="simplebox grid740">
		<div class="titleh">
			<h3>Etiketler</h3>
		</div>
		<div class="body" style="padding: 12px 6px 6px">	
			<?php
			$sql = $mth->query("SELECT * FROM tags WHERE product_id='".$_GET["product_id"]."'");
			if($mth->rows($sql)==0) $mth->message('Henüz Etiket Eklenmemiş','error','div');
			while($tag = $mth->assoc($sql)){
			?>
			<div class="tag" style="float: left; width: 216px; height: 20px; line-height: 20px; margin-left: 10px; margin-bottom: 5px; padding: 5px; border: 1px solid #EEEEEE; box-shadow: 1px 1px 1px #EEE; border-radius: 4px;">
				<div class="tit" style="float: left; width: 175px;"><?=$tag["tag"];?></div>
				<div class="del" style="float: right; width: 35px;"><a style="color: #F30; font-weight: bolder;" href="?module=products/tags&product_id=<?=$_GET["product_id"]?>&tagID=<?=$tag["id"]?>">Kaldır</a></div>
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>
	</div>
</div>