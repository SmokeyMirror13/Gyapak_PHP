<!DOCTYPE html>
<html lang="en">
<?php
$conn = mysqli_connect("localhost", "root", "", "gyapak");
if(! $conn ) {
    die('Could not connect: ' . mysql_error());
 }
?>
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
    <link href="css/login.css" rel="stylesheet">
    <link href="icons/css/ffolders.css" rel="stylesheet">
    <link href="icons/fileicon.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


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
            <li class="bold1"><a href="http://ahduni.edu.in" target="_blank" class="waves-effect">Ahmedabad University</a></li>
            <li class="bold1"><a href="http://seas.ahduni.edu.in/" target="_blank" class="waves-effect">School Of Engineering And Applied Science</a></li>
            <li class="bold1"><a href="http://auris.ahduni.edu.in" target="_blank" class="waves-effect">AURIS</a></li>
            <li class="bold1"><a href="http://lms.ahduni.edu.in" target="_blank" class="waves-effect">LMS(Learning Management System)</a></li>
            <li class="bold1"><a href="http://uls.ahduni.edu.in" target="_blank" class="waves-effect">University Library Resource</a></li>
            <li class="bold1"><a href="about.html" target="_blank" class="waves-effect">About Us</a></li>

        </ul>
    </header>
    <main>
        <div class="wrapper fadeInDown">
            <div style="background-color:#f1eeeb;" id="formContent">
                <div class="fadeIn first">
                    <img src="res/seas.png" id="icon" alt="User Icon" />
                </div><?php
                        $otp = rand(1, 10000000);
                        if(isset($_POST['email']))
                        {
                            $email = $_POST['email'];
                            if (substr($email, -13) == "ahduni.edu.in") {
                                echo '<form action="auth.php" method="post">';
                                echo '<input type="text" id="password" class="fadeIn third" name="otp" placeholder="OTP">';
                                echo '<input type="submit"  class="fadeIn fourth" value="Authenticate">';
                                echo '</form>';
                                $tm = time() + (61*5);
                                // echo $email;
                                $mail_success = mail($email, "Gyapak Authentication", "OTP: " . $otp . "\n The OTP will expire with in 5 minutes", "From: gyapak.seas@gmail.com");
                                if($mail_success)
                                {
                                mysqli_query($conn, "INSERT INTO otp_table(expiry, otp) VALUES ({$tm}, {$otp})");
                                }
                            }
                            else
                            {
                                    echo '<a href="auth.php"><button style="margin: 10px;" class=" btn-large waves-effect ">TRY AGAIN!</button></a>';
                            }
                            
                        }
                        else {
                            echo '<form action="auth.php" method="post">';
                            echo '<input type="text" id="login" class="fadeIn second" name="email" placeholder="Ahmedabad Uni Mail ID">';
                            echo '<input type="submit"  class="fadeIn fourth" value="Send OTP">';
                            echo '</form>';
                        }
                        ?>
                        <?php
                        if(isset($_POST['otp']))
                        {
                            $result = mysqli_query($conn, "SELECT expiry from otp_table where otp = ".$_POST['otp']);
                                $row = mysqli_fetch_assoc($result);
                                    echo $row['expiry']."\n";
                                    if(time() <= $row['expiry'])
                                    {
                                        $name = "gyapak_auth";
                                        $value = base64_encode(1);
                                        $exp = time() + (24*60*60*7*365);
                                        setcookie($name, $value, $exp);
                                        header('Location: index.php');
                                    }
                            }
                    ?>

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
        $(document).ready(function() {
            Materialize.toast('This is a beta version. Contact Team Gyapak if you find any bugs. Thanks!', 3000);
        });
    </script>


</body>

</html>