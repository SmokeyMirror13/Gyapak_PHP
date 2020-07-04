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
// Main function file
$files = glob('C:/xampp/htdocs/gyapak/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file)&&strval(pathinfo('C:/xampp/htdocs/gyapak/'.$file, PATHINFO_EXTENSION)) == 'pdf')
    unlink($file); // delete file
}
if($_SERVER['HTTP_HOST']=='103.244.122.195'){
	if(!isset($_GET['r'])){
		echo "Gyapak is coming here soon...<br>";
		echo 'Visit <a href="/result/">SEAS Result Portal</a> - Powered by Gyapak.';
		exit;	
	}	
}
error_reporting(E_ALL^E_NOTICE);
$dir = $_GET['f'];
$rootdir = base64_decode($dir);
$vod = $_GET['vod'];
$path = $rootdir;
$path_arr = explode('/', $path);
$result = count($path_arr);

static $bool = array(
    "Academic" => true,
    "Announcements" => true,
    "Courses" => true,
    "Documents" => true,
    "Software" => true,
    "Staff" => true,
    "AU Library" => true,
    "SEAS Photos" => true
);


if (array_key_exists($path_arr[1], $bool)) {
    if (!is_dir($rootdir)) {
        if (file_exists($path) && $vod=='d') {
            header("Location: redirect.php?f=" . base64_encode($path));
        }
        else if(file_exists($path) && $vod=='v')
        {
            echo $path;
            // header("Location: view.php?f=" . base64_encode($path));
        }
		else{
			header("Location: 404.html"); // Redirect browser
		}
    }
} else {
    header("Location: 404.html"); // Redirect browser
}
include("php_file_tree.php");
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta name="description" content="Gyapak is the local SEAS Server interface.">
        <title>Gyapak</title>
        <!-- Favicons-->
        <link rel="apple-touch-icon-precomposed" href="images/favicon/gyapak.png">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-TileImage" content="images/favicon/gyapak.png">
        <link rel="icon" href="images/favicon/gyapak2.png" sizes="32x32">
        <!--  Android 5 Chrome Color-->
        <meta name="theme-color" content="#3F51B5">
        <!-- CSS-->

        <link href="css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="font/font.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/modal.css" rel="stylesheet">
        <link href="icons/css/ffolders.css" rel="stylesheet">

    </head>

    <body>
        <header>
            <div class="container">
                <a href="#" data-activates="nav-mobile" class="button-collapse top-nav waves-effect waves-light circle hide-on-large-only"><i class="mdi-navigation-menu"></i></a>
            </div>
            <ul id="nav-mobile" class="side-nav fixed">
                <li class="logo">
                    <a id="logo-container" href="index.php" class="brand-logo">
                        <span style="font-size:50px;font-weight:500; color:#7f1214;">GYAPAK</span></a>
                </li>
                <!-- <li class="search">
                    <div class="search-wrapper card">
						<form action="search.php" method="post">
                        <input id="search"><i class="material-icons">search</i>
						</form>
                        <div class="search-results"></div>
                    </div>
                </li> -->
                <!-- <li class="bold"><a href="main.php?f=RDovQWNhZGVtaWM=" class="waves-effect">Academic</a></li>
                <li class="bold"><a href="main.php?f=RDovQW5ub3VuY2VtZW50cw==" class="waves-effect">Announcements</a></li>
                <li class="bold"><a href="main.php?f=RDovQ291cnNlcw==" class="waves-effect">Courses</a></li>
                <li class="bold"><a href="main.php?f=RDovRG9jdW1lbnRz" class="waves-effect">Documents</a></li>
                <li class="bold"><a href="main.php?f=RDovU29mdHdhcmU=" class="waves-effect">Software</a></li>
                <li class="bold"><a href="main.php?f=RDovU3RhZmY=" class="waves-effect">Staff</a></li>
                <li>
                    <div class="divider"></div>
                </li> -->
                <li class="bold1"><a href="http://ahduni.edu.in" target="_blank" class="waves-effect">Ahmedabad University</a></li>
                <li class="bold1"><a href="http://seas.ahduni.edu.in/" target="_blank" class="waves-effect">School Of Engineering And Applied Science</a></li>
				<li class="bold1"><a href="http://auris.ahduni.edu.in" target="_blank" class="waves-effect">AURIS</a></li>
                <li class="bold1"><a href="http://lms.ahduni.edu.in" target="_blank" class="waves-effect">LMS(Learning Management System)</a></li>
                <li class="bold1"><a href="http://uls.ahduni.edu.in" target="_blank" class="waves-effect">University Library Resource</a></li>
                <li class="bold1"><a href="about.html" target="_blank" class="waves-effect">About Us</a></li>

            </ul>
        </header>
        <main>
            <nav>
                <div class="container">


                    <?php
                    echo "<a href = \"index.php\" class=\"breadcrumb\">Gyapak</a>";
                    for ($i = 1; $i < $result; $i++) {
                        $temp = "";
                        for ($j = 0; $j <= $i; $j++) {
                            if ($j < $i) {
                                $temp .= $path_arr[$j] . "/";
                            } else {
                                $temp .= $path_arr[$j];
                            }
                        }
                        echo '<a href = "main.php?f=' . base64_encode($temp) . '" class="breadcrumb">' . $path_arr[$i] . '</a>';
                    }
//echo "<a href = \"zipfolderdownload.php?f=$rootdir\">Download This Folder</a>";
                    ?>


                </div>

            </nav>

            <div id="loadingMask">
                <div class="preloader-wrapper big active loaderdiv">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="data" style="display:none;">
                    <?php 
					if(is_dir($rootdir)){
					echo php_file_tree($rootdir);
					}
					?>
                </div>


                <div class="fixed-action-btn vertical" style="bottom: 2px; right: 5px;">
                    <?php echo '<a title="Download this folder" target="_blank" class="btn-floating btn-large waves-effect waves-light red" href="zip.php?f=' . base64_encode($rootdir) . '"><i class="material-icons">play_for_work</i></a>'; ?>
                </div>
        </main>
        <footer class="page-footer">

            <div class="footer-copyright">
                <div class="container">
                    <!-- SEAS-AU -->

                </div>
            </div>
        </footer>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="jade/lunr.min.js"></script>
    <script src="jade/search.js"></script>
    <script src="bin/materialize.js"></script>
    <script src="js/init.js"></script>

</body>
<script type="text/javascript">
    $(document).ready(function () {
        $('#loadingMask').hide();
        $('.data').fadeIn(800);
    });
</script>
<script>
function pop(vdmodal, close){
    document.getElementById(vdmodal).style.display = 'block';
    document.getElementById(close).onclick = function(){
        document.getElementById(vdmodal).style.display = 'none';
    }
}
</script>
</html>