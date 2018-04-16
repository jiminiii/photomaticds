<?php 

    require_once("../tools.php");
	require_once("uploadDao.php");
	$dao=new uploadDao();
//	
//	$sort=isset($_REQUEST["sort"]) ? $_REQUEST["sort"] : "num";
//	$dir=isset($_REQUEST["dir"]) ? $_REQUEST["dir"] : "desc";
//	$path=isset($_REQUEST["path"] ? $_REQUEST["path"]:"name"]);
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $photo=requestValue("photo");
?>


<!doctype html>
<html>
    <head>
       <meta charset="utf-8">
        <title>Welcome, PhotoMatic ! </title>
    <link rel="stylesheet" type="text/css" href="../main.css">
    </head>
    <body>
        <div id="m-container">        
          <?php require("../sidebar.php");?>
            
           
            <div id="m-content">
                <div class="head_box">
                    인물 검색 결과
                    
                     <hr width="100px" color=#ff3a5e>
                     <br>
                        찾으려고 했던 인물<br>
               <img src="<?= ALBUM_PATH ?>/temp_photo/<?= $photo ?>" class="photo_image"><br>
                </div>
                <br><br><br><br>
                <?php
                
                $resultface=$dao->getResultFileList($email);?>
                
   
            
        
                <table>
                <?php $count=1; ?>
                <tr>
                    <?php foreach ($resultface as $row) : 
                    if($count %4==1){
                        ?></tr><tr><?php
                    }
                    ?>
                       <td class="left"><img src="<?= ALBUM_PATH ?>/user-album/<?= $email?>/human/<?=$row["fname"]?>/<?=$row["pname"]?>" class="photo_image"></td>
                    <?php $count++; endforeach ?>
                    </tr>
                </table>
               
               
               
                
            </div>
        </div>
        

    </body>
</html>