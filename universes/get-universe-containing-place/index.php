<?php
$this_dir = dirname(__FILE__);
$parent_dir = realpath($this_dir . '/../');
$target_path = $parent_dir . '/SavedAssets/';

error_reporting(0);

if(file_exists("./".$_GET["placeId"]))
{
    header("Content-type: text/plain");
    die(file_get_contents("./".$_GET['placeId']));
}
else
{
if(file_exists($target_path.$_GET["placeId"]) && file_get_contents($target_path.$_GET['placeId'])!="")
{
 header("Content-type: text/plain");
	$finished = file_get_contents($target_path.$_GET['placeId']);
    echo $finished;
}
else
{
if (strstr($_GET['placeId'],'http'))
{
$url2 = $_GET['placeId'];
Header("Location: ".$url2);
}
else
{
$stringxd = $_GET['placeId'];
if (strstr($stringxd,'1111111'))
{
$s2=explode("1111111", $stringxd)[1];
$urlxd = "https://assetdelivery.roblox.com/v1/asset/?id=".$s2."&version=1";
Header("Location: ".$urlxd);
}
else
{
$url = "https://assetdelivery.roblox.com/v1/asset/?id=".$stringxd;
Header("Location: ".$url);
}
}
}
}
?>