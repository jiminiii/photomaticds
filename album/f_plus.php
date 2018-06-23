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
	$result = $dao->getFileList($sort, $dir,$email,$fname,$cate);
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
            
           
            <div id="m-content">
                <div class="head_box">
                    <?=$cate?>
                     <hr width="100px" color=#ff3a5e>
                </div>
                
                <div align="center">

                <table>
                <?php $count=2; ?>
                <tr>
                  
                    <td class="left"><img src="<?= IMG_PATH ?>/f-plus.png"
                                          class="photo_image" ><br>폴더추가하기</td>
                                          
                   
                     <td class="left" ><img src="<?= IMG_PATH ?><?php 
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
                          ?>" class="photo_image"><br>
                        <form action ="add_folder.php?group=<?=$cate?>" method="post">
                            <input type="text" name="fname" class="f_plus_t" placeholder="폴더명을 입력해주세요." />
                           
                            <input type="submit" value="확인" class="f_plus_b">
                                          
                        </form>
                        
                     </td>
                    
                    
                   
                    <?php foreach ($f_list as $row) : 
                  
                    if($count %3==0 ){
                        ?></tr><tr><?php
                    }
                    ?>
                     
                       <td class="left" ><img src="<?= IMG_PATH ?><?php 
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
                          ?>" class="photo_image" onclick="location.href='<?= ALBUM_PATH ?>/photo.php?fname=<?= $row["fname"] ?>&cate=<?=$cate?>'"><br><?=$row["fname"]?> (<?= $row["fsize"]?>)</td>
                                          
                    <?php $count++; endforeach ?>
                    </tr>
                </table>
                
            </div>

            
                
            </div>
        </div>
        

    </body>
</html>