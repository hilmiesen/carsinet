<?php
$data = $mth->ins($_GET["tb"],"*","WHERE id='".$_GET["id"]."'");
?>
<div id="full_page_detail" class="article">
	<h1><?=$data["title"]?></h1>
	<div><?=$data["content"]?></div>
</div>