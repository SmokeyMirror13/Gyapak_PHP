<?php
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
function is_hidden_file($fn) {

    $dir = "\"" . $fn . "\"";
    $attr = trim(shell_exec("FOR %A IN (" . $dir . ") DO @ECHO %~aA"));
    if ($attr[3] === 'h')
        return true;
    return false;
}

function human_filesize($size, $precision = 2) {
    static $units = array(' B', ' KB', ' MB', ' GB', ' TB', ' PB', ' EB', ' ZB', ' YB');
    $step = 1024;
    $i = 0;
    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }
    return round($size, $precision) . $units[$i];
}

function filesize64($file)
{
    static $iswin;
    if (!isset($iswin)) {
        $iswin = (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN');
    }

    static $exec_works;
    if (!isset($exec_works)) {
        $exec_works = (function_exists('exec') && !ini_get('safe_mode') && @exec('echo EXEC') == 'EXEC');
    }

    // try a shell command
    if ($exec_works) {
        $cmd = ($iswin) ? "for %F in (\"$file\") do @echo %~zF" : "stat -c%s \"$file\"";
        @exec($cmd, $output);
        if (is_array($output) && ctype_digit($size = trim(implode("\n", $output)))) {
            return $size;
        }
    }

    // try the Windows COM interface
    if ($iswin && class_exists("COM")) {
        try {
            $fsobj = new COM('Scripting.FileSystemObject');
            $f = $fsobj->GetFile( realpath($file) );
            $size = $f->Size;
        } catch (Exception $e) {
            $size = null;
        }
        if (ctype_digit($size)) {
            return $size;
        }
    }

    // if all else fails
    return filesize($file);
}


function php_file_tree($directory) {
	if(!is_dir($directory)){
		header("Location: 404.html"); // Redirect browser
	}
    // Get and sort directories/files
    $file = array();
    $php_file_tree = "";
    $file = scandir($directory);
    natcasesort($file);

    if (count($file) > 2) {
        $files = $dirs = array();
        foreach ($file as $this_file) {
            if (is_hidden_file("$directory/$this_file") == false) {
                if ($this_file != "." && $this_file != ".." && $this_file[0] != "." && $this_file[0] != "#") {
                    if (is_dir("$directory/$this_file")) {
                        $dirs[] = $this_file;
                    } else if ($this_file[0] != "." && $this_file[0] != "#") {
                        $files[] = $this_file;
                    }
                }
            }
        }
    }

    if (isset($dirs)) {
        foreach ($dirs as $dir) {
			$finCount = count(scandir("$directory/$dir")) - 2;
			if($finCount<0){$finCount=0;}
            $php_file_tree .= '<div class="grid"><a href="main.php?f=' . base64_encode("$directory/$dir") . '" class="waves-effect" title="' . $dir . '">
            <span class="ffolder small yellow">
                <span>' . $finCount . ' Items</span>
            </span>
            <span class="name">' . $dir . '</span>
            </a>
            </div>';
        }
    }
    
    $i = 0;
    if (isset($dirs)) {
        foreach ($files as $f) {
            $path_parts = pathinfo("$directory/$f");
            $base = $path_parts['basename'];
            if (isset($path_parts['extension'])) {
                if (file_exists('images/icons/' . $path_parts['extension'] . '.png')) {
                    $img = $path_parts['extension'];
                } else {
                    $img = 'file';
                }
            } else {
                $img = 'file';
            }
            $fl = "$directory/$f";
			$sz = filesize($fl);
			if($sz<0){
				$sz = filesize64($fl);
            }
            $modal = "'vdmodal".$i."'";
            $close = "'close".$i."'";
            // $ext = strval(pathinfo($file, PATHINFO_EXTENSION));
            // if()
            $php_file_tree .= '<button class="button" onclick="pop('.$modal.','.$close.')">
                                <div class="grid">
                                <span class="icon"><img src="images/icons/' . $img . '.png" width="70px" height="70px"></span>
                                <span class="name1">' . $f . '</span>
                                <span class="details">' . human_filesize($sz) . '</span>
                                <span class="time">' . date("d-M-Y, h:i A", filemtime($fl)) . '</span>
                                </div>
                                </button>
                                <div id="vdmodal'.$i.'" class="modal">
                                <span id="close'.$i.'" class="close">&times;</span>
                                <div class="mod-cont">
                                    <a style="margin:10%" href="view.php?f=' . base64_encode("$directory/$f") .'&amp;vod=v" class="waves-effect" title="' . $dir . '" target="_blank" ><button class="btn-large waves-light" type="Submit">View</button></a>
                                    <a href="redirect.php?f=' . base64_encode("$directory/$f") .'&amp;vod=d" title="' . $dir . '" class="waves-effect" ><button class="btn-large waves-light" type="Submit" target="_blank">Download</button></a>
                                </div>
                                </div>';
            $i = $i + 1;
        }
    }
    return $php_file_tree;
}

?>