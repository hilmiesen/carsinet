<?php
$mth->db_->exec("UPDATE products SET thumb='0'");
$mth->db_->exec("UPDATE gallery SET thumb='0' WHERE top='products'");

$mth->thumb_resize(0,400,"products","WHERE thumb='0'",'image','thumb','uploads/pictures/','uploads/pictures/thumbs/');


?>