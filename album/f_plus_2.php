
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
          <td class="left_folder"><img src="<?= IMG_PATH ?>/f-plus.png" class="select_folder"><br><div class="textalign" >폴더추가하기</div></td>
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
                          ?>" class="select_folder"><br>
                        <form action ="add_folder.php?group=<?=$cate?>&pname=<?=$pname?>&psize=<?=$psize?>&ver=<?=$ver?>" method="post">
                            <input type="text" name="fname" class="f_plus_t2" placeholder="폴더명" />
                           
                            <input type="submit" value="확인" class="f_plus_b">
                                          
                        </form>
                        
                     </td>
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
                          ?>" class="select_folder" onclick="location.href='<?= ALBUM_PATH ?>/photo.php?fname=<?= $row["fname"] ?>&cate=<?=$cate?>'"><br>
                          <div class="textalign" ><?=$row["fname"]?> (<?= $row["fsize"]?>)</div></td>
                                          
                    <?php endforeach ?>
       </tr>
   </table>
    </div>
</div>
<script>
    function folderPlus(){
        var plusName=prompt("추가할 폴더명을 입력하세요","");
        
        if(plusName){
            $.ajax({
                type:"POST",URL:"add_plusfolder.php".data:{fname:}
            })
    
//            window.location.reload(); 
        }else if(plusName==""){
            alert("폴더명을 입력하세요.")
            folderPlus();
        }
        
    }
    
</script>