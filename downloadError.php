<html>
<body>

<centre><img src="images/dno.jpg" hieght="500" width="332"></centre>

<?php

$dir = $_GET['f'];

echo "<br>Dear user we are extremely sorry but you cannot download files greater than <b>3GB</b> for now. <br>The requested file by you is of size : <b>".$dir."</b> and hence cannot be downloaded as of now.<br>This issue will soon be resolved.";

?>

<br><br><a href="index.php"><button>Back</button></a>

</body>
</html>