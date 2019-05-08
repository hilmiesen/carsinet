<?php
define('module_title',			'SOSYAL AĞLAR');
define('module_description',	'Sosyal ağlardaki linklerinizi ekleyebilir ve düzenleyebilirsiniz.');
define('module_big_description','Sosyal ağlardaki linklerinizi ekleyebilir ve düzenleyebilirsiniz.');
define('module_link',			'?module=social_networks');
define('module_keyword',		'Kayıt');
define('module_table',			'social_networks');

$mth->thumb(48,48,module_table,"WHERE thumb='0'",'image','thumb','uploads/pictures/','uploads/pictures/thumbs/');
?>