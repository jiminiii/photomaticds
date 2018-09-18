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
    $cate=requestValue("cate");
	//$result = $dao->getFileList($sort, $dir,$email,$fname);
    $f_list=$dao->getFolderList($email,$cate);
   

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
                    <?=$cate?>
                    <img src="<?= IMG_PATH ?>/set2.png" style="width:25px; height:25px;" onclick= "location.href='folder_main.php?cate=<?=$cate?>'">
                     <hr width="100px" color=#ff3a5e>
                </div>
                
                <div id="a_photo">

                <table>
                <?php $count=1; ?>
                <tr>
                  
                    <td class="left"><img src="<?= IMG_PATH ?>/f-plus.png" class="photo_image" onclick= "location.href='f_plus.php?cate=<?=$cate?>'"><br>폴더추가하기</td>
                                          
                  
                    <?php foreach ($f_list as $row) : 

                    if($count %3==0 ){
                        ?></tr><tr><?php
                    }
                    ?>
                     
                      <td class="left" ><img src="<?= IMG_PATH ?><?php 
                            $fname=$row["fname"];
                            if($cate=='human'){
                                ?>/f_human_1.png<?php
                            }else if($cate=='animal'){
                                ?>/f_animal_1.png<?php
                            }else if($cate=='landscape'){
                                ?>/f_landscape_1.png<?php
                            }else if($cate=='text'){
                                ?>/f_text_1.png<?php
                            }else if($cate=='food'){
                                ?>/f_food_1.png<?php
                            }else if($cate=='art'){
                                ?>/f_art_1.png<?php
                            }
                          
                          ?>" class="photo_image" onclick="location.href='<?= ALBUM_PATH ?>/photo.php?fname=<?= $row["fname"] ?>&cate=<?=$cate?>'"><br><?=$fname?> (<?= $row["fsize"]?>) &nbsp;&nbsp; <img src="<?= IMG_PATH ?>/f_delete.png" style="width:25px; height:25px;" onclick="folderDelete('<?= $row["fname"]?>')"></td>
                                          
                    <?php $count++; endforeach ?>
                    </tr>
                </table>
                
            </div>

            
                
            </div>
        </div>
        <script>
            
            function folderDelete(name){
                var f=name;
                var ret = confirm(f+" 폴더를 지우시겠습니까?");
                if(ret == true){
                   
                    location.href="f_delete.php?fname="+f+"&cate=<?=$cate?>";
                }
                
            }
            
        </script>

    </body>
</html>