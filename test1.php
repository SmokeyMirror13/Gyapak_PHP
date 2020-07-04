<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="font/font.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/modal.css" rel="stylesheet">
</head>

<body>
    <div class="grid"><button onclick="pop()" title="' . $f . '" class="waves-effect">
            <span class="icon"><img src="images/icons/file.png" width="70px" height="70px"></span>
            </a>
    </div>
    <div id="vdmodal" class="modal">
        <span id="close" class="close">&times;</span>
        <div class="mod-cont">
            <a style="margin:10%" href="'.$file.'" class="waves-effect" ><button class="btn-large waves-light" type="Submit">View</button></a>
            <a href='main.php?f='.base64_encode($file).'&vod=d' class="waves-effect" ><button class="btn-large waves-light" type="Submit">Download</button></a>
        </div>
    </div>
</body>
<script>
function pop(){
    document.getElementById('vdmodal').style.display = 'block';
    document.getElementById('close').onclick = function(){
        document.getElementById('vdmodal').style.display = 'none';
    }
}
</script>
</html>