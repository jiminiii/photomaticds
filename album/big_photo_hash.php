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
       
        <script>
            function back(){
                history.back();
            }
        </script>
        
        
    <body>
        <div id="m-container">        
          <?php require("../sidebar.php");?>
            
           
            <div id="m-content">
                <div class="head_box">
                   <?=requestValue("fname")?>
                     <hr width="100px" color=#ff3a5e>
                </div>
                
                

               
                      <div class="left">
                       <div class="b_photo"><img src="<?= ALBUM_PATH ?>/user-album/<?= $email?>/<?=$cate?>/<?=$fname?>/<?=$pname?>" class="b_photo_in" > <br><br>
                       
                        
                       추가 할 태그를 입력하세요
                       <form action="hash.php?pname=<?=$pname?>&fname=<?=$fname?>&cate=<?=$cate?>&num=<?=$num?>" method="post">
                           <input type="text" name="tagString" class="f_plus_t" style="width: 250px;font-size:20px;height:30px;color:gray;" placeholder="#태그#태그..." >
                           <input type="submit" value="추가" class="f_plus_b">
                       </form>
                        <button onclick="back()" class="f_plus_b">취소</button>
                       </div>
                       
                </div> 
                

            
                
            </div>
        </div>


    </body>
</html>