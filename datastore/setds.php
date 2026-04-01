<?php

error_reporting(0);
function gzfilesize($zp) {
      $gzfs = strlen($zp);
  return($gzfs);
}

$stringxd = $_GET['id'];
function uncompress($srcName, $dstName) {
    $sfp = gzopen($srcName, "rb");
    $fp = fopen($dstName, "w");

    while ($string = gzread($sfp, 4096)) {
        fwrite($fp, $string, strlen($string));
    }
    gzclose($sfp);
    fclose($fp);
}


$file_name = $_GET['key'];
$myfile = fopen("./items/".$file_name, "w");
fclose($myfile);
$myfile2 = fopen("./items/".$file_name, "w");
fclose($myfile2);
file_put_contents("./items/temp".$file_name,file_get_contents('php://input'));
file_put_contents("./items/".$file_name,file_get_contents('php://input'));
uncompress("./items/temp".$file_name,"./items/".$file_name);
unlink("./items/temp".$file_name);
header("Content-type: text/plain");
die(file_get_contents("./items/".$_GET['key']));

?>