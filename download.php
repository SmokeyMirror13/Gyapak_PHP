<?php
if(!isset($_COOKIE['gyapak_auth']))
{
    header("Location: auth.php");
}	
else{
    if($_COOKIE['gyapak_auth'] != base64_encode(1))
    {
        exit;
    }
}
$file = base64_decode($_GET['f']);

$rootdir = $file;
$rootdir = $rootdir;
$path=$rootdir;
$path_arr = explode('/', $path);
$result = count($path_arr);


static $bool = array(
    "Academic" => true,
    "Announcements" => true,
    "Courses" => true,
    "Documents" => true,
    "Software" => true,
    "Staff" => true,
    "AU Library"=>true,
    "SEAS Photos"=>true
);


if (!array_key_exists($path_arr[1], $bool)) {
    header("Location: 404.html"); // Redirect browser
}

$filenew = $file;
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$ext = pathinfo($file, PATHINFO_EXTENSION);
$basename = pathinfo($file, PATHINFO_BASENAME);

header("Content-type: application/".$ext);
// tell file size
header('Content-length: '.filesize($file));
// set file name
header("Content-Disposition: attachment; filename=\"$basename\"");
readfile($file);
// Exit script. So that no useless data is output.
exit;


?>
