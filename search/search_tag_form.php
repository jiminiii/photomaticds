<?php 
    require_once("../tools.php");
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
            <?php require("../sidebar_tag.php");?>
            
           
            <div id="m-content">
            <div class="form"><br><br>
            태그로 이미지를 검색해보세요!
             
             
             <form action="search_t.php" method="post">
                 <input type="text" name="tagString" class="f_plus_t" style="width: 200px;font-size:20px;height:30px;" placeholder="태그 입력">
                  <input type="submit" value="검색" class="f_plus_b">
                 
             </form>
              </div>
            </div>
        </div>
    </body>
</html>