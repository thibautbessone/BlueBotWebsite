<?php
/**
 * Author: Blue
 * Version : 0.1
 */

$path = "/home/bluebot/soundboard/";
$soundName= $_GET['sound'];

header('Content-Description: File Transfer');
header('Content-Type: application/force-download');
header("Content-Disposition: attachment; filename=\"" . basename($soundName) . "\";");
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($path . $soundName));

ob_clean();
flush();
readfile($path . $soundName);
exit;
?>