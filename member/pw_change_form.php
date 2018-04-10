<?php 
    require_once("../tools.php");
//    require_once("MemberDao.php");
//    session_start_if_none();
//	$email=sessionVar("uid");
//	//$name=sessionVar("uname");
//    $dao=new MemberDao();
//    $inform=$dao->getMember($email);
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
                 <div style="font-family: NanumSquare;font-size: 24px;margin-bottom:50px;">
                    비밀번호 변경<br><br>
                 </div>
<!--                 <div class="txt2"></div>-->


                 <form action ="<?= MEMBER_PATH ?>/pw_change.php" method="post">
                
                       <div class="Rectangle">
                          <img src="<?= IMG_PATH ?>/ic_pass_gray.png"
                          class="ic_gray">&nbsp;&nbsp;&nbsp;
                          <input type="password" name="pw" class="name" placeholder="현재 비밀번호를 입력해주세요."  />

                       </div>
                        <div class="line"></div>
                       <div class="Rectangle">
                        <img src="<?= IMG_PATH ?>/ic_pass_gray.png"
                          class="ic_gray">&nbsp;&nbsp;&nbsp;
                           <input type="password" name="newpw" class="name" placeholder="새 비밀번호를 입력해주세요."  />

                      </div>
                      <div class="line"></div>
                                  <div class="Rectangle">
                        <img src="<?= IMG_PATH ?>/ic_pass_gray.png"
                          class="ic_gray">&nbsp;&nbsp;&nbsp;
                           <input type="password" name="newpw2" class="name" placeholder="새 비밀번호를 한 번 더 입력해주세요."  />

                      </div>
                      <div class="line"></div>
            <!--
                       <div class="err_pw">
                           비밀번호가 일치하지 않습니다
                       </div>
            -->
                        <input type="submit" value="변경하기" class="join">

                </form>
              
              
            </div>
        </div>




   
  
</body>
</html>