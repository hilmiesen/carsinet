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
		$empty = array('title');
		$up1 = array('file'=>'image','folder'=>'uploads/pictures/','name'=>mktime());
		if($mth->upload($up1["file"],$up1["folder"],$up1["name"])) $_POST["image"] = $mth->uploadFileName; else echo $mth->uploadError;
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
					<span class="st-labeltext">Başlık</span>	
					<input name="title" type="text" class="st-forminput" style="width: 210px;" value="<?=$data["title"]?>" /> 
					<div class="clear"></div>
				</div>
				<div class="st-form-line">	
					<span class="st-labeltext">Açıklama</span>	
					<input name="description" type="text" class="st-forminput" style="width: 510px;" value="<?=$data["description"]?>" /> 
					<div class="clear"></div>
				</div>
				<!-- div class="st-form-line">	
					<span class="st-labeltext">Resim</span>	
					<input name="image" type="file" class="uniform" value="" /> 
					<div class="clear"></div>
				</div -->
				<div class="st-form-line">	
					<span class="st-labeltext">İçerik</span>
					<div class="st-formeditor">
						<textarea name="content" class="st-forminput" id="editor"><?=$data["content"]?></textarea>
					</div>
					<div class="clear"></div>
				</div>
				<input type="hidden" name="date" value="<?=date("Y-m-d");?>" />
				<input type="submit" style="margin-right: 0; border-radius: 0; width: 100%; cursor: pointer;" value="Formu Kaydet" class="st-button" />
			</form>
		</div>
	</div>
</div>