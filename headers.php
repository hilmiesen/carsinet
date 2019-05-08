<?php
$headers = apache_request_headers();
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$proto = $_SERVER['SERVER_PROTOCOL'];

$serverip = $_SERVER['SERVER_ADDR'];

if (getenv('HTTP_CLIENT_IP')) 
{
	$sourceip = getenv('HTTP_CLIENT_IP');
}
else if (getenv('HTTP_AHMET_MEHMET')) 
{
	$sourceip = getenv('HTTP_AHMET_MEHMET');
}  
else{
	$sourceip = $_SERVER['REMOTE_ADDR'];	
}

echo "Source IP                   : $sourceip<br />\n";
echo "Destination IP(Server_Addr) : $serverip<br />\n<br />\n";

echo "$method $uri $proto <br />\n";
foreach ($headers as $header => $value) {
    echo "$header: $value <br />\n";
}
?>

