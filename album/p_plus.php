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
            
           
            <div id="m-content" align="center">
                <div class="head_box">
                   <?=$fname?>
                     <hr width="100px" color=#ff3a5e><br>
                          <form action="add_file.php?sort=<?= $sort ?>&dir=<?= $dir ?>&fname=<?=$fname?>&cate=<?=$cate?>" enctype="multipart/form-data" method="post" onsubmit="return loading(this);">
<!--                <input type="file" name="upload"><br>-->
                <input type="file" id="file1" name="upload[]" multiple>
                <input type="submit" value="업로드"><br><div style="color:gray;font-size:20px;">(최대 8장)</div>


                </form>
                <img src="/pm_site/img/blank.jpg" id="loading">
                </div>
                
                
           
                 

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
        
         <script type="text/javascript">
            function loading(f){
                
              
                document.querySelector("#loading").setAttribute('src',"/pm_site/img/bigload.gif");
              return true;
            }
          
        </script>
    </body>
</html>