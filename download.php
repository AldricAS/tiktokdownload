<?php
// ===== MODE DOWNLOAD (STREAMING) =====
if (isset($_GET['download'])) {
  if (!isset($_GET['url'])) exit('No URL');

  $url  = $_GET['url'];
  $name = $_GET['name'] ?? 'tiktok';

  header("Content-Type: application/octet-stream");
  header("Content-Disposition: attachment; filename=\"$name\"");
  header("Pragma: no-cache");
  header("Expires: 0");

  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_USERAGENT => 'Mozilla/5.0',
    CURLOPT_RETURNTRANSFER => false, // PENTING
    CURLOPT_HEADER => false,
    CURLOPT_BUFFERSIZE => 8192,
  ]);

  curl_exec($ch);
  curl_close($ch);
  exit;
}
?>
