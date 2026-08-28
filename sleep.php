<?php
$start = microtime(true);
if (isset($_GET["ms"]) && is_numeric($_GET["ms"])) {
    $ms = $_GET["ms"];
} else {
    $ms = 2000;
}
usleep($ms * 1000);
$response_time = (microtime(true) - $start) * 1000;

echo "ms: $ms . Merhaba Dunya<br><br>";
echo "Kullanımı: Gelen isteği default 2000 ms bekletir ve sonra ekrana Merhaba Dünya basar.<br>";
echo "Süreyi ms parametresi ekleyerek kontrol edebilirsiniz.<br>";
echo "Örneğin 500ms için: /sleep.php?ms=500 gibi.<br><br><br>";
echo "Response Time: " . round($response_time, 2) . " ms";

?>
