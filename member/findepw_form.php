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
                     비밀번호를 잊어버리셨나요?
                 </div><br>
                 <div class="txt2">이메일을 입력해주세요! <br><br> 임시비밀번호를 발급해드립니다</div>
<br><br>

                <img src="/pm_site/img/blank.jpg" id="loading">
                 <form action ="<?= MEMBER_PATH ?>/findepw.php" method="post" onsubmit="return loading(this);">
                  <div class="Rectangle">
                      <img src="<?= IMG_PATH ?>/ic_email_gray.png"
                      class="ic_gray">&nbsp;&nbsp;&nbsp;

                      <input type="text" name="email" class="name" placeholder="이메일을 입력해주세요."  />

                  </div>
                     <div class="line"></div>

 
                        <input type="submit" value="전송" class="join">

                </form>
              
              
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