<?php
function human_filesize($size, $precision = 2) {
    static $units = array(' B',' KB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB');
    $step = 1024;
    $i = 0;
    while (($size / $step) > 0.9) {
        $size = $size / $step;
        $i++;
    }
    return round($size, $precision).$units[$i];
}


echo human_filesize(filesize('Mechanic Resurrection 2016 REAL TELESYNC READNFO x264-CPG.mkv'));

?>