<?php
define('module_title',			'ÜRÜNLER');
define('module_description',	'Ürünleri bu modül sayesinde düzenleyebilirsiniz.');
define('module_big_description','Bu modül ile ürün ekleyebilirsiniz. Başlık zorunlu alandır, boş bırakamazsınız.');
define('module_link',			'?module=products');
define('module_keyword',		'Ürün');
define('module_table',			'products');

$mth->thumb_resize(0,$site->product_thumb_height,module_table,"WHERE thumb='0'",'image','thumb','uploads/pictures/','uploads/pictures/thumbs/');
$mth->thumb_resize(338,0,module_table,"WHERE thumb2='0'",'image','thumb2','uploads/pictures/','uploads/pictures/thumbs2/');
?>