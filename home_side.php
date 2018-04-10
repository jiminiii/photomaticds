<?php

	require_once("tools.php");
	
	//사용자 아이디와 이름을 담은 세션 변수 읽기
	
	session_start_if_none();
	$id=sessionVar("uid");
	$name=sessionVar("uname");

?>

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
                <div class="Rectangle"></div>
       
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
             <div class="extra-box">  
               
        <a href="pw.html" class="findpw" style="text-decoration:none;">비밀번호 찾기</a><div class="Line"></div>
<!--
        <div class="join">
            회원가입 하기
        </div>
-->
        <a href="<?=MEMBER_PATH?>/member_join_form.php" class="join" style="text-decoration:none;" >회원가입 하기</a>
        </div>
        </div>