<?php
$robux = 9999999999;
$tix = 9999999999;
header("Content-Type: application/json");  // why
echo json_encode([
    "robux" => $robux,
    "tix" => $tix
]);
?>
