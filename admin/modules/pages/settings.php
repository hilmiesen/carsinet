<?php
define('module_title',			'SABİT SAYFALAR');
define('module_description',	'Sabit sayfalarınızı bu modül sayesinde kontrol edebilirsiniz.');
define('module_big_description','Sabit sayfalarınızı bu modül sayesinde kontrol edebilirsiniz.');
define('module_link',			'?module=pages');
define('module_keyword',		'Sayfa');
define('module_table',			'pages');

$mth->thumb(200,200,module_table,"WHERE thumb='0'",'image','thumb','uploads/pictures/','uploads/pictures/thumbs/');
?>