<?php
$pageID = $_GET["id"];
if($pageID) $data = $mth->ins("pages","*","WHERE id='".$pageID."'");
else $data = $mth->ins("pages","*","ORDER BY title LIMIT 0,1");
?>
<div id="about">
	<div class="links">
		<?php
		$result = $mth->query("SELECT * FROM pages ORDER BY title");
		while($link = $mth->assoc($result)){
		?>
		<a href="/sayfa/<?=$link["id"]?>/<?=$mth->seoUrl($link["title"])?>.html" class="link"><?=$link["title"]?></a>
		<?php } ?>
	</div>
	<div class="detail">
		<h1 class="title"><?=$data["title"]?></h1>
		<div class="article"><?=$data["content"]?></div>
	</div>	
	<div class="clear"></div>
</div>
