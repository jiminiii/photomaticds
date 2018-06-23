<?php
    require_once("../tools.php");
    require_once("uploadDao.php");
	$dao=new uploadDao();
	$errMsg="업로드 실패!2";
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
   
    $cate=requestValue("cate");
   
//    $pname=requestValue("pname");
//    $psize=requestValue("psize");
//    $save_name=$pname;//iconv("utf-8","cp949",$pname);
    $ver=isset($_REQUEST["ver"]) ? $_REQUEST["ver"] : "one";
	$result = $dao->getTempFileList($email,$cate);	
	$f_list=$dao->getFolderList($email,$cate);	
			
?>


<!doctype html>
<html>
    <head>
       <meta charset="utf-8">
        <title>Welcome, PhotoMatic ! </title>
    <link rel="stylesheet" type="text/css" href="../main.css">
    
    <style>
        .left_folder{
            text-align: center;
            width:150px;
            font-size: 3px;
        }
        #what{
/*    background-color:#feeeee;*/
            background-color:rgba(255,250,250,1);
    margin-left:70px;
    width:auto;
    height:160px;
    border-top-style:dotted;
            border-bottom-color: #eedddd;
            border-top-color: #eedddd;
            border-bottom-style: dotted;
            text-align: center;
          
/*    overflow-x: scroll;*/
    overflow-y:hidden;
     
            margin-bottom: 20px;
    
}
        .space{
            font-size: 1px;
        }
        .select_folder{
            width:100px;height:100px;
           
        }
        .foldertable{
            width:auto;
        }
        .textalign{
            text-align: center;
            font-size: 15px;
        }
        </style>
    </head>
    <body>
<!--
    <script>
        alert('<?=$errMsg ?>');
        history.back();
    </script>
-->
        <div id="m-container">        
          <?php require("../sidebar3.php");?>

            <div id="m-content" align="center">
                <div class="head_box2">
                   <?=$cate?> 분류 결과
                    
                     <hr width="100px" color=#ff3a5e><br>
                      <?php 
    if($ver=="one"){
          require("select_folder.php");
    }else if($ver=="two"){
       
        require("f_plus_2.php");
    }
    
  ?>
                </div>
                 
   
                

                <table>
                <?php $count=1; ?>
                <tr>
                    <?php foreach ($result as $row) : 
                    if($count %4==1){
                        ?></tr><tr><?php
                    }
                    ?>
                       <td class="left"><img src="<?= ALBUM_PATH ?>/temp_photo/<?=$row["pname"]?>"
                          class="photo_image"></td>
                    <?php $count++; endforeach ?>
                    </tr>
                </table>
                

            
               
            </div>
            
        </div>
    </body>
</html>