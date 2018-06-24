<?php 
    require_once("../tools.php");
?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>PhotoMatic</title>
    <link rel="stylesheet" type="text/css" href="<?= HOME_PATH ?>/join.css">
</head>

<body>
  <div id="j-container">        
            


         <div id="j-sidebar">
              
        </div>

        <div id="j-content">


            <img src="<?= IMG_PATH ?>/200.png"
                 srcset="<?= IMG_PATH ?>/200@2x.png 2x,
                         <?= IMG_PATH ?>/200@3x.png 3x"
                 class="lg">
                 <div class="txt1">
                     간단하게 가입하세요!
                 </div>
                 <div class="txt2">1분도 걸리지 않는 회원가입으로 포토매틱을 이용하세요.</div>


                 <form action ="<?= MEMBER_PATH ?>/member_join.php" method="post">
                  <div class="Rectangle">
                      <img src="<?= IMG_PATH ?>/ic_profile_gray.png"
                      class="ic_gray">&nbsp;&nbsp;&nbsp;

                      <input type="text" name="name" class="name" placeholder="이름을 입력해주세요."  />

                  </div>
                     <div class="line"></div>

                     <div class="Rectangle">

                     <img src="<?= IMG_PATH ?>/ic_email_gray.png"
                     class="ic_gray">&nbsp;&nbsp;&nbsp;
                    <input type="text" name="email" class="name" placeholder="이메일을 입력해주세요."  />

                       </div>
                        <div class="line"></div>
                       <div class="Rectangle">
                          <img src="<?= IMG_PATH ?>/ic_pass_gray.png"
                          class="ic_gray">&nbsp;&nbsp;&nbsp;
                          <input type="password" name="pw" class="pw"  placeholder="비밀번호를 입력해주세요."  />

                       </div>
                        <div class="line"></div>
                       <div class="Rectangle">
                        <img src="<?= IMG_PATH ?>/ic_pass_gray.png"
                          class="ic_gray">&nbsp;&nbsp;&nbsp;
                           <input type="password" name="pw2" class="pw" placeholder="비밀번호를 한 번 더 입력해주세요."  />

                      </div>
                      <div class="line"></div>
            <!--
                       <div class="err_pw">
                           비밀번호가 일치하지 않습니다
                       </div>
            -->
                        <input type="submit" value="Join" class="join">

                </form>
              
              
            </div>
        </div>




   
  
</body>
</html>