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
$rootdir = base64_decode($_GET['f']);
$path_arr = explode('/', $rootdir);

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

if (array_key_exists($path_arr[1], $bool)) {
    if (!is_dir($rootdir)) {
        header("Location: 404.html");
    }
} else {
    header("Location: 404.html");
}

$iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootdir)
);

$totalSize = 0;
foreach ($iterator as $file) {
    $totalSize += $file->getSize();
}

human_filesize($totalSize);

function human_filesize($size, $precision = 2) {
    static $units = array(' B', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
    $step = 1024;
    $i = 0;
    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }

    if ($i >= 3) {
        if (round($size, $precision) > 1.2) {
            echo "Sorry. This folder size[" . round($size, $precision) . $units[$i] . "] is greater than current permissible zip limit of 1 GB and hence can not be downloaded via Gyapak.<br>"
            . "Please download it via directly accessing server or contact Rahulbhai.";
        }
    } else {
        echo "This folder size[" . round($size, $precision) . $units[$i] . "] is within current permissible zip limit of 1 GB."
        . "<br><br>Zipping of files intitiated. Please wait. Download will start automatically shortly.";
        header("Location: zipfolderdownload.php?f=" . base64_encode($GLOBALS['rootdir']));
    }
    //return round($size, $precision) . $units[$i];
}
?>


