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
           <div class="Menu-BG">
    
    <img src="img/200-wh.png"
     srcset="img/200-wh@2x.png 2x,
             img/200-wh@3x.png 3x"
     class="_wh">
    
        <div class="PHOTOMATIC">
         PHOTOMATIC
         </div>
         
         <form action ="<?= MEMBER_PATH ?>/login.php" method="post">
                <div class="Rectangle-1">
                   <img src="img/drawable/ic_email_gray.svg" 
                   class="ic_email_wh">

                    <input type="text" name="email" class="t_emailpw" placeholder="이메일을 입력해주세요."  />
                </div>

                <div class="Rectangle"></div>

                  <div class="Rectangle-2">
                   <img src="img/drawable/ic_pass_gray.svg"
                   class="ic_pass_wh">
                      <input type="password" name="pw" class="t_emailpw" placeholder="비밀번호를 입력해주세요." />
                </div>
                <div class="Rectangle2"></div>
       
               <?php if($id):?>
<!--
                <div class="errpw">
                    비밀번호가 일치하지 않습니다.
                </div>
-->
                <?php endif ?>
        
                <input type="submit" value="Login" class="b_login">
        <!--

                <div class="findpw">
                    비밀번호 찾기
                </div>
        -->
       
               </form>
        <a href="pw.html" class="findpw" style="text-decoration:none;">비밀번호 찾기</a>
        <div class="Line"></div>
<!--
        <div class="join">
            회원가입 하기
        </div>
-->
        <a href="<?=MEMBER_PATH?>/member_join_form.php" class="join" style="text-decoration:none;" >회원가입 하기</a>
        </div>
        <div class="gradient">
        
          <img src="img/big.png"
            srcset="img/big@2x.png 2x,
            img/big@3x.png 3x"
            class="big">
            <div class="pm">
                포토매틱은 Photo 와 Automatic을 합친 것으로,<br/>
                사진을 자동으로 분류해서 정리할 수 있도록 도와줍니다

            </div>
            
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
           
           
           <img src="img/group-4.png"
     srcset="img/group-4@2x.png 2x,
             img/group-4@3x.png 3x"
     class="Group-2">
          
          <div class="g2-1">
              앨범 정리
          </div>
          
          <div class="g2-2">
              자동분류기능으로 편리하게<br/>
              앨범정리를 할 수 있습니다.
          </div>
           
           

    
    <img src="img/group-5.png"
     srcset="img/group-5@2x.png 2x,
             img/group-5@3x.png 3x"
     class="Group-3">
    
   
          <div class="g3-1">
              사진 보관
          </div>
          
          <div class="g3-2">
              어플에서 저장한 사진들을<br/>
              웹에서도 볼 수 있습니다.
          </div>
           
            </div>
       
<!--   </section>-->

  

</body>
</html>




