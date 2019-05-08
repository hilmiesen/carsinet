<?php
include("class/class.site.php"); $mth = new mth;
$site = $mth->in('site','*',"WHERE active='1'");
echo $site->title;

?>