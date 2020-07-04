<html>
<body>

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
$file = $_GET['f'];

$size = filesize($file);

	$newsizemb = 0;
    if($size<1024)
    {}
    else if($size<(1024*1024))
    {}
    else if ($size<(1024*1024*1024))
    {
        $size=round($size/(1024*1024),1);
		$newsizemb = $size;
		$newmb = $size." MB";
    }
    
	
	

	if($newsizemb>3000)
	{
		header("Location: downloadError.php?f=".$newmb); 
	    exit();		
	}
	
	else
	{
		header("Location: download.php?f=".$file); 
	    exit();
	}


?>


</body>
</html>