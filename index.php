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
if($_SERVER['HTTP_HOST']=='103.244.122.195'){
	if(!isset($_GET['r'])){
		echo "Gyapak is coming here soon...<br>";
		echo 'Visit <a href="/result/">SEAS Result Portal</a> - Powered by Gyapak.';
		exit;	
    }
    
}
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
        <meta name="theme-color" content="#7f1214">
        <!-- CSS-->

        <link href="css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
        <link href="font/font.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="icons/css/ffolders.css" rel="stylesheet">
        <link href="icons/fileicon.css" rel="stylesheet" >


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
                    <div class="nav">
                        <div class="col s12">
                            <center><img width="40%" src="res/seas.png"></center>
                        </div>
                    </div>
                </div>

            </nav>
            <div class="container">
                <div class="data">
                    <div class="grid"><a href="main.php?f=RDovQWNhZGVtaWM=" class="waves-effect" title="Academic">
                            <span class="ffolder small yellow">
                                <span><?php echo (count(scandir("D:/Academic")) - 2) . ' Items' ?></span></span>
                            <span class="name">Academic</span>
                        </a>
                    </div>
                    <div class="grid"><a href="main.php?f=RDovQW5ub3VuY2VtZW50cw==" class="waves-effect" title="Announcements">
                        <span class="ffolder small yellow">
                            <span><?php echo (count(scandir("D:/Announcements")) - 2) . ' Items' ?></span>
                        </span>    
                        <span class="name">Announcements</span>
                        </a>
                    </div>

                    <div class="grid"><a href="main.php?f=RDovQ291cnNlcw==" class="waves-effect" title="Courses">
                        <span class="ffolder small yellow">
                                <span><?php echo (count(scandir("D:/Courses")) - 2) . ' Items' ?></span>
                        </span>    
                        <span class="name">Courses</span>
                        </a>
                    </div>
                    <div class="grid"><a href="main.php?f=RDovRG9jdW1lbnRz" class="waves-effect" title="Documents">
                        <span class="ffolder small yellow">
                            <span><?php echo (count(scandir("D:/Documents")) - 2) . ' Items' ?></span>
                        </span>    
                        <span class="name">Documents</span>
                        </a>
                    </div>
                    <div class="grid"><a href="main.php?f=<?php echo base64_encode("D:/AU Library"); ?>" class="waves-effect" title="IET Library">
                    <span class="ffolder small yellow">
                        <span ><?php echo (count(scandir("D:/AU Library")) - 2) . ' Items' ?></span>
                    </span>
                            <span class="name">AU Library</span>
                        </a>
                    </div>
                    <div class="grid"><a href="main.php?f=<?php echo base64_encode("D:/SEAS Photos"); ?>" class="waves-effect" title="IET Photos">
                    <span class="ffolder small yellow">
                        <span ><?php echo (count(scandir("D:/SEAS Photos")) - 2) . ' Items' ?></span>
                    </span> 
                    <span class="name">SEAS Photos</span>
                        </a>
                    </div>
                    <div class="grid"><a href="main.php?f=RDovU29mdHdhcmU=" class="waves-effect" title="Software">
                    <span class="ffolder small yellow">
                        <span ><?php echo (count(scandir("D:/Software")) - 2) . ' Items' ?></span>
                </span> 
                            <span class="name">Software</span>
                        </a>
                    </div>
                    <div class="grid">
                    <a href="main.php?f=RDovU3RhZmY=" class="waves-effect" title="Staff">
                    <span class="ffolder small yellow">
                        <span ><?php echo (count(scandir("D:/Staff")) - 2) . ' Items' ?></span>
                    </span>        
                    <span class="name">Staff</span>
                        </a>
                    </div>
                </div>
        </main>
        <footer class="page-footer">

            <div class="footer-copyright">
            </div>
        </footer>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="jade/lunr.min.js"></script>
    <script src="jade/search.js"></script>
    <script src="bin/materialize.js"></script>
    <script src="js/init.js"></script>
	<script type="text/javascript">
    $(document).ready(function () {
		Materialize.toast('This is a beta version. Contact Team Gyapak if you find any bugs. Thanks!', 3000);
    });
	</script>


</body>
</html>