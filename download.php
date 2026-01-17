<?php
if (!isset($_GET['url'])) {
  http_response_code(400);
  exit('No URL');
}

$url  = $_GET['url'];
$name = $_GET['name'] ?? 'tiktok';

$ch = curl_init($url);
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_USERAGENT => 'Mozilla/5.0',
]);
$data = curl_exec($ch);
$mime = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

if (!$data) {
  http_response_code(500);
  exit('Failed download');
}

$ext = str_contains($mime, 'audio') ? 'mp3' : 'mp4';

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$name.$ext\"");
header("Content-Length: " . strlen($data));

echo $data;
exit;
