<?php
$mth->thumb(132,104,'gallery',"WHERE module='products' AND thumb='0'",'image','thumb','uploads/gallery/','uploads/gallery/thumbs/');
$mth->thumb(175,110,'gallery',"WHERE thumb='0'",'image','thumb','uploads/gallery/','uploads/gallery/thumbs/');
$site = $mth->ins('site','*',"WHERE active='1'");
?>
<!-- FILES -->
<link rel="stylesheet" href="modules/gallery/gallery.css" />
<link rel="stylesheet" href="../libraries/multiupload/uploadify.css" media="all" />
<script type="text/javascript" src="../libraries/multiupload/uploadify.js"></script>
<script type="text/javascript" src="../libraries/swfobject.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#mthGalleryUploader').uploadify({
		'uploader'     : '../libraries/multiupload/uploadify.swf',
		'script'       : '../libraries/multiupload/uploadify.php?gal=<s><?=$_GET["gallery"]?></s><b><?=$_GET["top"]?></b><c><?=$site["site_folder"]?></c>',
		'cancelImg'    : '../libraries/multiupload/images/cancel.png',
		'folder'       : '../uploads/gallery',
		'buttonText'   : 'Dosya Secin',
		'fileExt'      : '*.jpg;*.gif;*.png',
		'fileDesc'     : 'Resim Dosyaları (.JPG, .GIF, .PNG)',
		'sizeLimit'    : 2144000,
		'multi'		   : true,
		'onAllComplete': function(){location.reload();}
	});	
});
</script>
<!-- FILES -->
<div class="page-title">
	<div class="in">
		<div class="titlebar">
			<h2>GALERİ</h2>
			<p>Bu modül ile galeri oluşturabilirsiniz.</p>
		</div>
			
		<div class="shortcuts-icons">
			<a class="shortcut tips" onclick="javascript:location.reload();" title="Sayfayı Yenile">
				<img src="img/icons/shortcut/refresh.png" width="25" height="25" alt="icon" />
			</a>
			<a class="shortcut tips" href="#" title="Bu modül ile galeri oluşturabilirsiniz. Tek seferde birden fazla resim yükleyebilirsiniz.">
				<img src="img/icons/shortcut/question.png" width="25" height="25" alt="icon" />
			</a>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<div class="add_gallery" style="padding: 15px 0 0 22px; padding-bottom: 0;">
	<div class="float-left">
		<input type="file" id="mthGalleryUploader" name="mthGalleryUploader" />
	</div>
	<div class="float-left" style="position:absolute; margin-left: 122px; margin-top: -1px;">
		<a class="st-button button-green float-left" href="javascript:$('#mthGalleryUploader').uploadifyUpload();">Dosyaları Yükle</a>
	</div>
	<div class="clear"></div>
</div>

<div class="content" style="padding-top: 12px;">
	<?php
	$i = $_GET["i"]; 
	$empty = array('title');
	if($i=="delete"){
		$un = array('image','thumb');
		$mth->delete('gallery',"WHERE id='".$_GET["deleteID"]."'",$un);
	}
	
	$query = $mth->query("SELECT * FROM gallery WHERE gallery='".$_GET["gallery"]."'");
	while($gal = $mth->assoc($query)){
	?>
	<div class="get-photo">
		<div class="buttons">
			<a href="?module=gallery/gallery&gallery=<?=$_GET['gallery']?>&top=<?=$_GET['top']?>&i=delete&deleteID=<?=$gal["id"]?>" class="mini-delete"></a>
			<!-- <a href="#" class="mini-edit"></a> -->
			<div class="clear"></div>
		</div>
		<a href="../<?=$gal["image"]?>" rel="prettyPhoto" title="">
			<img src="../<?=$gal["thumb"]?>" alt=""/>
		</a>
	</div>
	<?php } ?>
	<div class="clear"></div>
</div>