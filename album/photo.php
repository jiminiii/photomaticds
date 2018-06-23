<?php 
    require_once("../tools.php");
	require_once("uploadDao.php");
	$dao=new uploadDao();
	
	$sort=isset($_REQUEST["sort"]) ? $_REQUEST["sort"] : "num";
	$dir=isset($_REQUEST["dir"]) ? $_REQUEST["dir"] : "desc";
//	$path=isset($_REQUEST["path"] ? $_REQUEST["path"]:"name"]);
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $cate=requestValue("cate");
	$result = $dao->getFileList($sort,$dir,$email,$fname,$cate);
    
//foreach($result as $p){
//    foreach($p as $e){
//        echo $e;}
//echo "<br/>";}
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
                   <?=$fname?> <br>

                    
                     <hr width="100px" color=#ff3a5e><br>
                       <img src="<?= IMG_PATH?>/p_plus_bt.png" onclick="location.href='p_plus.php?fname=<?= $fname ?>&cate=<?=$cate?>'" style="width:60px;height:60px;">
                </div>
                
                <div id="p_upload_b" >
                 
                </div>
                <div align="center">

                <table>
                <?php $count=1; ?>
                <tr>
                    <?php foreach ($result as $row) : 
                    if($count %4==1){
                        ?></tr><tr><?php
                    }
                    ?>
                       <td class="left"><img src="<?= ALBUM_PATH ?>/user-album/<?= $email?>/<?=$cate?>/<?=$fname?>/<?=$row["pname"]?>"
                          class="photo_image" onclick="location.href='<?= ALBUM_PATH ?>/big_photo.php?pname=<?=$row["pname"]?>&fname=<?= $row["fname"] ?>&cate=<?=$cate?>&num=<?=$row["num"]?>'"></td>
                    <?php $count++; endforeach ?>
                    </tr>
                </table> 
                </div>
            </div>
        </div>
    </body>
</html>