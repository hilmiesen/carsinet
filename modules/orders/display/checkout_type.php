<div style="padding: 10px;">
<?php
$ct = $mth->ins("checkout_types","*","WHERE id='".$_GET["type_id"]."'");
echo $ct["content"];
?>
</div>