<?php

?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<style>
        table{height:700px; text-align: center;}
        .b_group{
            font-size: 24px;
            background-color: #ffffff;
            border-style: dotted;
            border-color: darkgrey;
        }
        


	</style>
</head>
<body>

<form action="./album/array.php" enctype="multipart/form-data" method="post" onsubmit="return loading(this);">
분류할 사진들을 선택하세요.<br>
<input type="file" id="file1" name="upload[]" multiple><br>

<br><br>
사진들을 분류 할 기준을 골라주세요!<br>




<table >
    <tr>
        <td> <img src="<?= IMG_PATH ?>/f_human_1.png" style="width:200px; height:200px;"><br>
        <input type="radio" name=categroup value="Human">인물</td>
        <td><img src="<?= IMG_PATH ?>/f_animal_1.png" style="width:200px; height:200px;"><br>
        <input type="radio" name=categroup value="Animal">동물</td>
         <td><img src="<?= IMG_PATH ?>/f_landscape_1.png" style="width:200px; height:200px;"><br>
        <input type="radio" name=categroup value="Nature">풍경</td>
    </tr>
    
    <tr>
       
        <td><img src="<?= IMG_PATH ?>/f_text_1.png" style="width:200px; height:200px;"><br>
        <input type="radio" name=categroup value="Text">글자</td>
        <td><img src="<?= IMG_PATH ?>/f_food_1.png" style="width:200px; height:200px;"><br>
        <input type="radio" name=categroup value="Food">음식</td>
        <td><img src="<?= IMG_PATH ?>/f_art_1.png" style="width:200px; height:200px;"><br>
        <input type="radio" name=categroup value="Art">그림</td>
    </tr>
</table>
<input type="submit" class="b_group" value="분류하기">
</form>
<br><img src="/pm_site/img/blank.jpg" id="loading">

         <script type="text/javascript">
            function loading(f){
                
              
                document.querySelector("#loading").setAttribute('src',"/pm_site/img/bigload.gif");
              return true;
            }
          
        </script>

</body>

</html>