<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
	font-size: 11px;
	color: #333;
	font-family: Tahoma;	
}
.article * {
	outline: 0;
	line-height: 140%;
}
.article h1, .article h2, .article h3, .article h4, .article strong, .article b {
	font-weight: bolder;	
}
.article h1, .article h2, .article h3 {
	margin: 6px 0px;
	display: block;	
}
.article h1 {
	font-size: 22px;
	line-height: 25px;
}
.article h2 {
	font-size: 18px;
	line-height: 20px;
}
.article h3 {
	font-size: 16px;
	line-height: 18px;
}
.article h4 {
	font-size: 14px;
	line-height: 16px;
}
.article p {
	font-size: 11px;
	margin: 0px 0px 10px;	
}
.article ul {
	margin: 5px 10px;
	padding: 6px;
}
.article ul li {
	list-style-type: circle;
	margin: 4px;	
}
.article a {
	text-decoration: underline;
	color: #F60;
}
.article a:hover {
	text-decoration: none;
}
.article td {
	padding: 5px;	
}
</style>
</head>

<body>
<?php
$data = $mth->ins('about',"*","WHERE id='".$_GET["id"]."'");
?>
<div class="article">
	<h1><?=$data["title"];?></h1>
	<div><?=$data["content"]?></div>
</div>

</body>
</html>