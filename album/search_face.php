<?php 

    require_once("../tools.php");
	require_once("uploadDao.php");
	$dao=new uploadDao();
	
	
//	$path=isset($_REQUEST["path"] ? $_REQUEST["path"]:"name"]);
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");


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
                    인물 검색
                    
                     <hr width="100px" color=#ff3a5e>
                     
                     <br>
                     포토매틱의 앨범에서 찾고싶은 얼굴을 선택해주세요!
                </div>
                <form action="search.php" enctype="multipart/form-data" method="post" onsubmit="return loading(this);">
               <input type="file" name="upload">
                <input type="submit" value="업로드">
                </form>
                <br><br>
                <img src="/pm_site/img/blank.jpg" id="loading">
            
                
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