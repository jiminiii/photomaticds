<?php


	require_once("tools.php");
	
	//사용자 아이디와 이름을 담은 세션 변수 읽기
	
	session_start_if_none();
session_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");

?>
   

   <div id="m-sidebar">
    <img src="<?= IMG_PATH ?>/200-wh.png"
     srcset="<?= IMG_PATH ?>/200-wh@2x.png 2x,
             <?= IMG_PATH ?>/200-wh@3x.png 3x"
     class="_wh">
    <div class="userlogin">

       <?= $name ?> 님 <br>
      
        
        
          <a href="<?=MEMBER_PATH ?>/logout.php" style="color: #ffffff;
         text-decoration:none;" class="member_info" >로그아웃</a>&nbsp;&nbsp;<div style="font-size:13px;display:inline;">|</div>&nbsp;
         <a href="<?=MEMBER_PATH ?>/pw_change_form.php" style="color: #ffffff;
         text-decoration:none;" class="member_info" >비밀번호 변경</a>
        
    </div>
       <div class=menu_box >
          <div class=album_top>
               <a href="<?=MAIN_PAGE?>" style="color: #ffffff;
     text-decoration:none;" >앨범보기</a>
          </div>
          
       </div>
         
<!--
             <div class=menu_box>
          <div id=album_top>
               <a href="edit.php" style="color: #ffffff;
     text-decoration:none;" >편집하기</a>
          </div>
          
       </div>
-->
             <div class=menu_box>
          <div class=album_top>
               <a href="<?=HOME_PATH?>/upload.php" style="color: #ffffff;
     text-decoration:none;" >사진 분류하기</a>
          </div>
          
       </div>
       
       
                    <div class=menu_box style="background-color: rgba(0, 0, 0, 0.08);">
          <div class=album_top>
               <a href="<?= SEARCH_PATH ?>/search_tag_form.php" style="color: #ffffff;
     text-decoration:none;" >태그 검색</a>
          </div>
          
       </div>

</div>
              
               
               
                
