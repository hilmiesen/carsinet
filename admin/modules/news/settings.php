<?php
define('module_title',			'HABERLER');
define('module_description',	'Haberler ve duyuruları bu modül sayesinde düzenleyebilirsiniz.');
define('module_big_description','Bu modül ile haber ve duyuru ekleyebilirsiniz. Başlık zorunlu alandır, boş bırakamazsınız.');
define('module_link',			'?module=news');
define('module_keyword',		'Haber');
define('module_table',			'news');

$mth->thumb(200,160,module_table,"WHERE thumb='0'",'image','thumb','uploads/pictures/','uploads/pictures/thumbs/');
?>