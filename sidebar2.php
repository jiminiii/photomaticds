<?php


	require_once("tools.php");
	
	//사용자 아이디와 이름을 담은 세션 변수 읽기
	
	session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");

?>
   

   <div id="m-sidebar">
    <img src="img/200-wh.png"
     srcset="img/200-wh@2x.png 2x,
             img/200-wh@3x.png 3x"
     class="_wh">
    <div class="userlogin">

        <form action="<?=MEMBER_PATH ?>/logout.php" method="post">
            <?= $name ?> 님 
            <br>
            <input type="submit" value="로그아웃" class="b_logout">
        </form>   
        
    </div>
       <div class=menu_box >
          <div id=album_top>
               <a href="<?=MAIN_PAGE?>" style="color: #ffffff;
     text-decoration:none;" >앨범보기</a>
          </div>
          
       </div>
         
             <div class=menu_box style="background-color: rgba(0, 0, 0, 0.08);">
          <div id=album_top>
               <a href="edit.php" style="color: #ffffff;
     text-decoration:none;" >편집하기</a>
          </div>
          
       </div>
             <div class=menu_box>
          <div id=album_top>
               <a href="<?=HOME_PATH?>/upload.php" style="color: #ffffff;
     text-decoration:none;" >사진 불러오기</a>
          </div>
          
       </div>

</div>
              
               
               
                
