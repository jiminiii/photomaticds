
    <?php 

    require_once("../tools.php");
	require_once("tagDao.php");
	$dao=new tagDao();
	

    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $tag=requestValue("tagString");
    $search=false;
    if($tag!=null){
         $tag_idx=$dao->getTag($tag);
        if($tag_idx[0]!=null){
            $photo_idx=$dao->getPhotoIdx($tag_idx[0]);

            if($photo_idx!=null){
                $search=true;
                             
            }
        }
    }else{
        if($email!=null){
            header('Location: search_tag_form.php');

        }
    }
   
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
          <?php require("../sidebar_tag.php");?>
            
           
            <div id="m-content">
            
            <div id="head" style="margin-bottom:100px;">
               <h3> #<?=$tag?> 검색결과</h3>
            </div>
            
            
            
          <?php if($search==true){?>
                <table>
                <?php $count=1; ?>
                <tr>
             
                    <?php foreach ($photo_idx as $pidx) : 
                                 $row=$dao->getPhotoList($pidx["photo_index"]);
                    if($count %4==1){
                        ?></tr><tr><?php
                    }
                    ?>
                       <td class="left"><img src="<?= ALBUM_PATH ?>/user-album/<?= $row["email"]?>/<?=$row["cate"]?>/<?=$row["fname"]?>/<?=$row["pname"]?>"
                          class="photo_image" onclick="location.href='<?= ALBUM_PATH ?>/big_photo.php?pname=<?=$row["pname"]?>&fname=<?= $row["fname"] ?>&cate=<?=$row["cate"]?>&num=<?=$row["num"]?>'"></td>
                    <?php $count++; endforeach ?>
                    </tr>
                </table> 
                <?php }else{
    
    ?>
    
    조건에 맞는 사진이 없습니다
    <?php
}?>
            </div>
        </div>

</body>
</html>
