<?php 
    require_once("tools.php");
?>



<!doctype html>
<html>
    <head>
       <meta charset="utf-8">
        <title>Welcome, PhotoMatic ! </title>
    <link rel="stylesheet" type="text/css" href="/pm_site/main.css">
    </head>
    <body>
        <div id="m-container">        
            <?php require("sidebar3.php");?>
            
           
            <div id="m-content">
             <?php require("./album/upload_photo.php");?>
              
              
            </div>
        </div>
    </body>
</html>