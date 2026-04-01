<?php
$this_dir = dirname(__FILE__);
$parent_dir = realpath($this_dir . '/../');
$target_path = $parent_dir . '/SavedAssets/';

error_reporting(0);


function gzfilesize($zp) {
    return strlen($zp);
}


function uncompress($data) {
    return gzuncompress($data);
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    http_response_code(400);
    exit('Missing id parameter');
}


$local_file = "./$id";
if (file_exists($local_file)) {
    header("Content-Type: text/plain");
    readfile($local_file);
    exit;
}

$cache_file = $target_path . $id;
if (file_exists($cache_file) && filesize($cache_file) > 0) {
    header("Content-Type: text/plain");
    readfile($cache_file);
    exit;
}


if (strpos($id, 'http') === 0) {
    header("Location: $id");
    exit;
}

// Roblox asset handling. DO NOT ASK WHYYYYYYYY
if (strpos($id, '1111111') !== false) {
    $asset_id = explode('1111111', $id, 2);
    $asset_id = isset($asset_id[1]) ? $asset_id[1] : '';
} else {
    $asset_id = $id;
}

$asset_url = "https://assetdelivery.roblox.com/v1/asset/?id=$asset_id&version=1"; // let me check if it works. okay no i think so.
$audio_url = "https://api.hyra.io/audio/$id";
$content = file_get_contents($asset_url);

if ($content === false || empty($content)) {

    $content = @file_get_contents($audio_url);
    $content_type = 'audio/*';
} else {
    $content = uncompress($content);
    $content_type = 'application/zip';
}

if ($content !== false && !empty($content)) {
    @file_put_contents($cache_file, $content);
    
    header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
    header('Cache-Control: public');
    header("Content-Type: $content_type");
    header('Content-Transfer-Encoding: Binary');
    header("Content-Length: " . strlen($content));
    header('Content-Disposition: attachment; filename="' . basename($id) . '"');
    echo $content;
} else {
    http_response_code(404);
    exit('Asset not found');
}
?>
