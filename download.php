<?php
// download.php
if (!isset($_GET['url'])) {
  http_response_code(400);
  exit('No URL');
}

$url  = $_GET['url'];
$name = $_GET['name'] ?? 'tiktok-file';

// ambil ekstensi
$ext = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
if (!$ext) $ext = 'mp4';

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$name.$ext\"");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");

readfile($url);
exit;
