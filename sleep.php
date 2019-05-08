<?php
if(isset($_GET["s"]) &&  is_numeric($_GET["s"])) $sn = $_GET["s"];
else $sn = 5;	
sleep($sn);
echo "sn: $sn . Merhaba Dunya";
?>