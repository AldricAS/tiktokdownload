<?php
if(!isset($_GET['url']) || !isset($_GET['type'])){
  die("Invalid request");
}

$url = urlencode($_GET['url']);
$type = $_GET['type'];

$api = "https://www.tikwm.com/api/?url=".$url;

$json = file_get_contents($api);
$data = json_decode($json,true);

if(!$data || $data['code'] != 0){
  die("Gagal mengambil data TikTok");
}

$video = $data['data']['play'];
$audio = $data['data']['music'];
$title = preg_replace('/[^a-zA-Z0-9]/','_', $data['data']['title']);

if($type == "video"){
  header("Content-Type: application/octet-stream");
  header("Content-Disposition: attachment; filename=\"tiktok_$title.mp4\"");
  readfile($video);
  exit;
}

if($type == "audio"){
  header("Content-Type: application/octet-stream");
  header("Content-Disposition: attachment; filename=\"tiktok_$title.mp3\"");
  readfile($audio);
  exit;
}
