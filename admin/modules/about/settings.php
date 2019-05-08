<?php
define('module_title',			'KURUMSAL SAYFALAR');
define('module_description',	'Kurumsal sayfalarınızı bu modül sayesinde kontrol edebilirsiniz.');
define('module_big_description','Bu modül ile kurumsal ekleyebilirsiniz. Başlık zorunlu alandır, boş bırakamazsınız.');
define('module_link',			'?module=about');
define('module_keyword',		'Sayfa');
define('module_table',			'about');

$mth->thumb(200,200,module_table,"WHERE thumb='0'",'image','thumb','uploads/pictures/','uploads/pictures/thumbs/');
?>