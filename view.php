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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View</title>
    <link href="css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="font/font.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/modal.css" rel="stylesheet">
</head>
<body >
<?php
$file = $_GET['f'];
$rootdir = base64_decode($file);
$path = $rootdir;
$ext = strval(pathinfo($path, PATHINFO_EXTENSION));
$result = new DateTime();
$date = $result->format('H_i_s');
if($ext == 'csv' || $ext == 'xls' || $ext == 'xlsx' || $ext == 'xlsb' || $ext == 'xls' || $ext == 'xlm')
{
    $html = shell_exec('python convert_excel2html.py '.$path);
    echo $html;
}
else if($ext == 'docx'||$ext == 'doc')
{
    shell_exec('python convert_docs2pdf.py '.$file.' '.base64_encode($date));
    echo '<script>window.location.assign("'.$date.'.pdf")</script>';
}
else if($ext=='pptx'||$ext=='ppt')
{
    shell_exec('python convert_ppt2pdf.py '.$file.' '.base64_encode($date));
    echo '<script>window.location.assign("'.$date.'.pdf")</script>';
}
else if($ext == 'java'|| $ext == 'cpp' || $ext == 'py')
{
    // echo 'python compile.py '.$ext.' '.$file;
    $j = shell_exec('python compile.py '.$file);
    // print_r($j);
    echo '<p>'.$j.'</p>';
}
else if($ext == 'pdf' || $ext == 'txt')
{
    $server = $_SERVER['DOCUMENT_ROOT'];
    $base = basename($rootdir);
    copy($rootdir, "$server/gyapak/$base");
    header('Location: '.basename($rootdir));
}
else
{
    echo '<div class="center-align"style="font-size:40px;font-family:Roboto">File Format is not supported for viewing.</div>';
}
?>
<!-- <script>window.open("file:///D:/Academic/PDF/wp18272.pdf")</script> -->
</body>
</html>
