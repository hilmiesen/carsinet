<?php
// print_r($sss);

function seoUrl($s) {
	$tr = array('ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','jpg','JPG','png','PNG','gif','GIF');
	$eng = array('s','s','i','i','g','g','u','u','o','o','c','c','','','','','','');
	$s = str_replace($tr,$eng,$s);
	$s = strtolower($s);
	$s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
	$s = preg_replace('/[^%a-z0-9 _-]/', '', $s);
	$s = preg_replace('/\s+/', '-', $s);
	$s = preg_replace('|-+|', '-', $s);
	$s = trim($s, '-');
	return $s;
}

function arasiniAl($veri,$baslangic,$bitis){
	$veri = explode($baslangic,$veri);
	$veri = $veri[1];
	$veri = explode($bitis,$veri);
	$veri = $veri[0];
	return $veri;
}

if(!empty($_FILES)){
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$type = strrchr($_FILES['Filedata']['name'],'.');
	$_FILES['Filedata']['name'] = seoUrl($_FILES['Filedata']['name'])."-".date('d-m-y-h-i').$type;
	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];

	move_uploaded_file($tempFile,$targetFile);

	echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);

	$gg = $_GET['gal'];
	$gGallery = arasiniAl($gg,'<s>','</s>');
	$gModule = arasiniAl($gg,'<b>','</b>');
	$gSiteFolder = arasiniAl($gg,'<c>','</c>');
	
	require($_SERVER['DOCUMENT_ROOT'].$gSiteFolder.'config.php');
	mysql_connect(dbHost,dbUser,dbPass);
	mysql_select_db(dbName);
			
	$image = str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
	$image_kes = arasiniAl($image,'/','/up');
	$image = str_replace($image_kes,'',$image);
	$image = str_replace('//','',$image);
	if($gSiteFolder=='/') $image = 'uploads/'.$image;
	$date = date('Y-m-d');
	$gallery = $gGallery;
	$module = $gModule;
	$sql = mysql_query("INSERT INTO gallery (image,date,gallery,module) VALUES ('".$image."','".$date."','".$gallery."','".$module."')");
}
?>