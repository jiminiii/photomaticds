<?php

	require_once("tools.php");
	
	//사용자 아이디와 이름을 담은 세션 변수 읽기
	
	session_start_if_none();
	$id=sessionVar("uid");
	$name=sessionVar("uname");

?>




<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <title>PhotoMatic</title>
    <link rel="stylesheet" type="text/css" href="/pm_site/home.css">
</head>


  
<body>
<!--   <section class="content">-->
 
       <div id="m-container">
           <?php require("home_side.php");?>
           <div id="m-content">
               
           
<!--        <div class="gradient">-->
        
          <img src="img/big.png"
            srcset="img/big@2x.png 2x,
            img/big@3x.png 3x"
            class="big">
            <div class="pm">
                포토매틱은 Photo 와 Automatic을 합친 것으로,<br/>
                사진을 자동으로 분류해서 정리할 수 있도록 도와줍니다

            </div>
            
            
            
            <div id="char-list-box">
            <div class="char-small-box">
            <img src="img/group-2.png"
     srcset="img/group-2@2x.png 2x,
             img/group-2@3x.png 3x"
     class="Group-1">
           
           <div class="g1-1">
               사진 분류
           </div>
           <div class="g1-2">
               사진을 원하는 테마별로<br/>
               자동분류 해드립니다.
           </div>
           
                </div>
                
                 <div class="char-small-box">
           <img src="img/group-4.png"
     srcset="img/group-4@2x.png 2x,
             img/group-4@3x.png 3x"
     class="Group-1">
          
          <div class="g1-1">
              앨범 정리
          </div>
          
          <div class="g1-2">
              자동분류기능으로 편리하게<br/>
              앨범정리를 할 수 있습니다.
          </div>
           
           
                </div>
     <div class="char-small-box">
    <img src="img/group-5.png"
     srcset="img/group-5@2x.png 2x,
             img/group-5@3x.png 3x"
     class="Group-1">
    
   
          <div class="g1-1">
              사진 보관
          </div>
          
          <div class="g1-2">
              어플에서 저장한 사진들을<br/>
              웹에서도 볼 수 있습니다.
          </div>
                </div>
            </div>
<!--       </div>-->
       </div>
    </div>

  

</body>
</html>




