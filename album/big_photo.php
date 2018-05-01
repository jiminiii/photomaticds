<?php 

    require_once("../tools.php");
	require_once("uploadDao.php");
    require_once("tagDao.php");
	$dao=new uploadDao();
    $tdao=new tagDao();
	
	$sort=isset($_REQUEST["sort"]) ? $_REQUEST["sort"] : "num";
	$dir=isset($_REQUEST["dir"]) ? $_REQUEST["dir"] : "desc";
//	$path=isset($_REQUEST["path"] ? $_REQUEST["path"]:"name"]);
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $cate=requestValue("cate");
    $num=requestValue("num");
    $pname=requestValue("pname");
	$result = $dao->getFileList($sort, $dir,$email,$fname,$cate);
    

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
                   <?=requestValue("fname")?>
                     <hr width="100px" color=#ff3a5e>
                </div>
                
                

               
                      <div class="left">
                       <div class="b_photo"><img src="<?= ALBUM_PATH ?>/user-album/<?= $email?>/<?=$cate?>/<?=$fname?>/<?=$pname?>" class="b_photo_in" > <br>
                       
                       <?php 
                           
                           $tagList=$tdao->getPhotoTagIdxList($num);
                    if($tagList!=null){
                         foreach($tagList as $t){
                        $s=$tdao->getTagString("$t[hash_index]")
                            ?><?="#".$s[0]  ?><?php
                    }
                    }
                   
                    
                           
                           
                           ?>
                       
                       
                       <br><br><img src="<?= IMG_PATH ?>/delete.png" onclick="photoDelete()">  
                       <img src="<?= IMG_PATH ?>/hash.png" class="b_photo_in" onclick="location.href='big_photo_hash.php?pname=<?=$pname?>&fname=<?=$fname?>&cate=<?=$cate?>&num=<?=$num?>'">
                       </div>
              
                </div> 
                

            
                
            </div>
        </div>
        
        <script>
            
            function photoDelete(){
                var ret = confirm("사진을 지우시겠습니까?");
                if(ret == true){
                    location.href="p_delete.php?fname=<?=$fname?>&cate=<?=$cate?>&num=<?=$num?>&pname=<?=$pname?>";
                }
                
            }
            
        </script>
    </body>
</html>