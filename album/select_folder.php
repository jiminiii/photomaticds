<?php 
$f_list=$dao->getFolderList($email,$cate);
$ver="two";
?>


<div id="m-folderBar">
저장할 폴더를 골라주세요<br>
<div id="what">
<div class="space"><br></div>
   
   
   <table class="foldertable">
       <tr>
          <td class="left_folder"><img src="<?= IMG_PATH ?>/f-plus.png" class="select_folder" onclick= "location.href='array_result.php?cate=<?=$cate?>&pname=<?=$pname?>&psize=<?=$psize?>&ver=<?=$ver?>'"><br><div class="textalign" >폴더추가하기</div></td>
           <?php foreach ($f_list as $row) :
                    ?>
                     
                      <td class="left_folder" ><img src="<?= IMG_PATH ?><?php 
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
                          ?>" class="select_folder" onclick="savePhoto('<?=$row["fname"]?>')"><br>
                          <div class="textalign" ><?=$row["fname"]?> (<?= $row["fsize"]?>)</div></td>
                                          
                    <?php endforeach ?>
       </tr>
   </table>
    </div>
</div>
        
        <script>
            
            function savePhoto(name){
                var f=name;
                var ret = confirm(f+"폴더에 저장하시겠습니까?");
                if(ret == true){
                    location.href="save_photo.php?fname="+f+"&cate=<?=$cate?>";
                    
                    
                }
                
            }
            
        </script>