<?php
/*
=============================================== CONFIG ===============================================
*/
$name = "Kenssei"; // SET YOUR NAME HERE
/* FILE TYPES */
$filetypes = array(
    '.png',
    '.gif',
    '.zip',
    );
/* PUBLICITY */
$allpublic = "0"; // IF ENABLED ALL FILES WILL BE PUBLIC
/*  NOTE: THIS OPTION IS DISABLED IF ALLPUBLIC = 1*/
$public = array(
    '0',
    );
/*
=============================================== CONFIG END ===============================================
*/
/* DO NOT EDIT BELOW THIS LINE */
error_reporting(0);
?>
<html>
<head>
<title><?php echo $name;?>'s - File Dump</title>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="http://bootswatch.com/cyborg/bootstrap.min.css" rel="stylesheet">

</head>

    <div class="container">
    <div class="row">
      <div class="jumbotron">

<center><div id="header">
<h1><center><?php echo $name;?>'s File Dump</center></h1>
<br><Br>
<table class="table table-hover">
<thead>
<tr>
<th>&nbsp;</th>
<th>File Name</th>
<th>Date Created</th>
<th>File Type</th>
<th>File Size</th>
<th>Publicity</th>
</tr>
</thead>
<tbody>


<?php
    
function formatbytes($file, $type)
{
   switch($type){
      case "KB":
         $filesize = filesize($file) * .0009765625; // bytes to KB
      break;
      case "MB":
         $filesize = (filesize($file) * .0009765625) * .0009765625; // bytes to MB
      break;
      case "GB":
         $filesize = ((filesize($file) * .0009765625) * .0009765625) * .0009765625; // bytes to GB
      break;
	   case "TB":
         $filesize = (((filesize($file) * .0009765625) * .0009765625) * .0009765625) * .0009765625; // bytes to TB
      break;
   }
   if($filesize <= 0){
      return $filesize = 'Unknown file size';}
   else{return round($filesize, 2).' '.$type;}
}
foreach($filetypes as $filetype) {
$filelist[str_replace(".","",$filetype)] =  glob("*". $filetype);
foreach($filelist[str_replace(".","",$filetype)] as $result) {
      echo '<tr>';
    if(in_array($result,$public)){
    echo '<th><i class="fa fa-file"></i></th>';
    } elseif($allpublic === "1") {
    echo '<th><i class="fa fa-file"></i></th>';
    } else {
    echo '<th><i class="fa fa-file-o"></i></th>';
    };
if(in_array($result,$public)){
    echo '<th><a target="_blank"  style="text-decoration: none;" title="" href="'. $result .'">'. str_replace($filetype,"",$result),'</a></th>';
    } elseif($allpublic === "1") {
    echo '<th><a target="_blank"  style="text-decoration: none;" title="" href="'. $result .'">'. str_replace($filetype,"",$result),'</a></th>';
    } else {
    echo '<th>**********</th>';
    };
 
$filetype1 = str_replace(".","",$filetype);
    echo '<th>'. date ("F d Y H:i:s", filemtime($result)) .' GMT </th>';
    echo '<th>'. strtoupper($filetype1) .' </th>';
    echo '<th>'. formatbytes($result, "MB") .'</th>';
    if(in_array($result,$public)){
    echo '<th>Public</th>';
    } elseif($allpublic === "1") {
      echo '<th>Public</th>';   
    } else {
    echo '<th>Private</th>';
    };
      echo '</tr>';
}
}
?>


</table>
</div>
</div>
<div class="footer">
         <p>&copy; <?php echo $name;?> 2016
        <?php 
         $currentVersion = "1.1";
         $lastVersion = @json_decode(@file_get_contents(base64_decode("aHR0cHM6Ly9naXN0LmdpdGh1YnVzZXJjb250ZW50LmNvbS9rZW5zc2VpLzI1NDVjM2ZmODczNTY4Njg3MzBlYWE5Njc0NzIyZDg0L3Jhdy8zM2VlMmFlNjZiYjczYWFmYmIwODAzMGRhYmZhYWExODcyY2E1OGI4L1ZlcnNpb24=")))->filedump;
         if($lastVersion === $currentVersion) {
          echo '<br><p>Version: '. $currentVersion .' </p>';
         } else {
         echo '<br><p>Version: '. $currentVersion .' </p><p style="color:red">Your filedump script is out of date. <a href="https://github.com/kenssei/filedump">Update here!</a></p>';
         }
		 
		 
		 
          ?><span style="float:right;margin-top:-50px;">Made by <a href="https://twitter.com/kenssei">Kenssei</a>.</span></p>
        
</div>
</body>
</html>
