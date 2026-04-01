<?php
error_reporting(~E_ALL);
$this_dir = dirname(__FILE__);
$parent_dir = realpath($this_dir);
$target_path = $parent_dir . '/SavedData/';
header("content-type:text/plain");
$user = $_GET['user'];
$membership = $_GET["membership"];
$ip = $_GET['ip'];
$port = $_GET['port'];
$user = $_GET['user'];
$id = $_GET['id'];
$app = $_GET['app'];

if ($user!="") {
$file_name = $target_path."user.ini";
$fp = fopen($file_name, "w");
fwrite($fp, $user);
fclose($fp);
$file_name = $target_path."id.ini";
$fp = fopen($file_name, "w");
fwrite($fp, $id);
fclose($fp);
$file_name = $target_path."membership.ini";
$fp = fopen($file_name, "w");
fwrite($fp, $membership);
fclose($fp);
$file_name = $target_path."app.ini";
$fp = fopen($file_name, "w");
fwrite($fp, $app);
fclose($fp);
$file_name = $target_path."ip.ini";
$fp = fopen($file_name, "w");
fwrite($fp, $ip);
fclose($fp);
$file_name = $target_path."port.ini";
$fp = fopen($file_name, "w");
fwrite($fp, $port);
fclose($fp);
}

if(is_null($_GET['user']))
{
$id=file_get_contents($target_path."id.ini");
$app=file_get_contents($target_path."app.ini");
$membership=file_get_contents($target_path."membership.ini");
$ip=file_get_contents($target_path."ip.ini");
$user=file_get_contents($target_path."user.ini");
$port=file_get_contents($target_path."port.ini");
}
?>
{"jobId":"Test","status":2,"joinScriptUrl":"http://localhost/game/Join.ashx?placeid=1818&ip=<?php echo $ip ?>&port=<?php echo $port ?>&user=<?php echo $user ?>&id=<?php echo $id ?>&membership=<?php echo $membership ?>&app=<?php echo $app ?>","authenticationUrl":"http://localhost/Login/Negotiate.ashx","authenticationTicket":"1","message":null}
