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
$hash = $_GET['f'];
$the_folder = base64_decode($_GET['f']);
$rootdir = $the_folder;
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


$temp = pathinfo($the_folder, PATHINFO_BASENAME);
$temp .= ".zip";
$zip_file_name = "D:/temp/" . $hash . ".zip";

if ($temp[0] == '#') {
    header("Location: error.php?f=" . $rootdir); // Redirect browser
    exit();
}

$download_file = true;
$delete_file_after_download = true;

class FlxZipArchive extends ZipArchive {

    /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  * */
    public function addDir($location, $name) {

        $this->addEmptyDir($name);

        $this->addDirDo($location, $name);
    }

// EO addDir;

    /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann
     * @access private   * */
    private function addDirDo($location, $name) {
        $name .= '/';
        $location .= '/';

        // Read all Files in Dir
        $dir = opendir($location);
        while ($file = readdir($dir)) {
            //Putting the condition here restricts hidden files and files starting with '.' and '~'...
            if ($file == '.' || $file == '..' || $file[0] == '.' || $file[0] == '~' || is_hidden_file($location . $file) || $file[0] == '#')
                continue;


            // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
            $do = (filetype($location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
    }

// EO addDirDo();
}

function is_hidden_file($fn) {

    $dir = "\"" . $fn . "\"";
    $attr = trim(shell_exec("FOR %A IN (" . $dir . ") DO @ECHO %~aA"));
    if ($attr[3] === 'h')
        return true;

    return false;
}

$za = new FlxZipArchive;
$res = $za->open($zip_file_name, ZipArchive::CREATE);

if ($res === TRUE) {
    $za->addDir($the_folder, basename($the_folder));
    $za->close();
} else {
    echo 'Could not create a zip archive';
}

if ($download_file) {
    ob_get_clean();
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);
    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename=\"$temp\"");
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: " . filesize($zip_file_name));
    readfile($zip_file_name);
}
?>