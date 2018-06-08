<?php 
    require_once("tools.php");
?>



<!doctype html>
<html>
    <head>
       <meta charset="utf-8">
        <title>Welcome, PhotoMatic ! </title>
    <link rel="stylesheet" type="text/css" href="/pm_site/main.css">
    </head>
    <body>
        <div id="m-container">        
            <?php require("sidebar.php");?>
            
            <div id="m-content">
                
                <div class="head_box3">
                    폴더 선택<br><br><br>
                    
                </div>

                   
                    <div class="album_listBox"  >
                      
                    
                        
                            <div class="list_menu" style="background: #b1d8f5;
background: -moz-linear-gradient(top, hsla(206,77%,83%,1) 0%, hsla(201,80%,86%,1) 25%, hsla(195,86%,89%,1) 46%, hsla(193,85%,95%,1) 79%, hsla(180,100%,98%,1) 99%);
background: -webkit-linear-gradient(top, hsla(206,77%,83%,1) 0%,hsla(201,80%,86%,1) 25%,hsla(195,86%,89%,1) 46%,hsla(193,85%,95%,1) 79%,hsla(180,100%,98%,1) 99%);
background: linear-gradient(to bottom, hsla(206,77%,83%,1) 0%,hsla(201,80%,86%,1) 25%,hsla(195,86%,89%,1) 46%,hsla(193,85%,95%,1) 79%,hsla(180,100%,98%,1) 99%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b1d8f5', endColorstr='#f7ffff',GradientType=0 );" onclick="location.href='<?= ALBUM_PATH ?>/folder_main.php?cate=human'">
                                  <br>
                                   <img src="<?= IMG_PATH ?>/ic_profile_wh.png"
                      class="ic_profile_wh">
                              
                               
                                인물 <br> <img src="<?= IMG_PATH ?>/f_human_1.png" class="photo">
                            </div>
                           
                        
                          
                             <div class="list_menu" style="background: #e8b87d;
background: -moz-linear-gradient(top, hsla(33,70%,70%,1) 0%, hsla(45,78%,84%,1) 100%);
background: -webkit-linear-gradient(top, hsla(33,70%,70%,1) 0%,hsla(45,78%,84%,1) 100%);
background: linear-gradient(to bottom, hsla(33,70%,70%,1) 0%,hsla(45,78%,84%,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e8b87d', endColorstr='#f6e6b4',GradientType=0 );" onclick="location.href='<?= ALBUM_PATH ?>/folder_main.php?cate=animal'">
                                   <br>
                                   <img src="<?= IMG_PATH ?>/ic_animal_wh.png"
                      class="ic_profile_wh">
                              
                                동물  <br><img src="<?= IMG_PATH ?>/f_animal_1.png" class="photo">
                            </div>
                            
                                 
                           
                          
                          
                          
                           </div>
                           
                     <div class="album_listBox" >
                      
                        
                            <div class="list_menu" style="background: #cdeb8b;
background: -moz-linear-gradient(top, hsla(79,71%,73%,1) 0%, hsla(78,49%,84%,1) 100%);
background: -webkit-linear-gradient(top, hsla(79,71%,73%,1) 0%,hsla(78,49%,84%,1) 100%);
background: linear-gradient(to bottom, hsla(79,71%,73%,1) 0%,hsla(78,49%,84%,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cdeb8b', endColorstr='#deeac2',GradientType=0 );" onclick="location.href='<?= ALBUM_PATH ?>/folder_main.php?cate=landscape'">
                                   <br>
                                   <img src="<?= IMG_PATH ?>/ic_landscape_wh.png"
                      class="ic_profile_wh">
                                
                                풍경<br>
                                <img src="<?= IMG_PATH ?>/f_landscape_1.png" class="photo">
                            </div>
                           
                        
                        
                        
                        
                            <div class="list_menu" style="background: #ffac68;
background: -moz-linear-gradient(top, hsla(27,100%,70%,1) 1%, hsla(27,100%,84%,1) 52%, hsla(27,100%,91%,1) 100%);
background: -webkit-linear-gradient(top, hsla(27,100%,70%,1) 1%,hsla(27,100%,84%,1) 52%,hsla(27,100%,91%,1) 100%);
background: linear-gradient(to bottom, hsla(27,100%,70%,1) 1%,hsla(27,100%,84%,1) 52%,hsla(27,100%,91%,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffac68', endColorstr='#ffe7d3',GradientType=0 );" onclick="location.href='<?= ALBUM_PATH ?>/folder_main.php?cate=text'">
                                   <br>
                                   <img src="<?= IMG_PATH ?>/ic_word_wh.png"
                      class="ic_profile_wh">
                                
                                글자<br>
                                <img src="<?= IMG_PATH ?>/f_text_1.png" class="photo">
                            </div>
                            
                                 
                            
                        
                        
                        
                    </div>
                  
                     <div class="album_listBox">
                      
                    
                        
                            <div class="list_menu" style="background: #8393fc;
background: -moz-linear-gradient(top, hsla(232,95%,75%,1) 1%, hsla(215,100%,91%,1) 99%);
background: -webkit-linear-gradient(top, hsla(232,95%,75%,1) 1%,hsla(215,100%,91%,1) 99%);
background: linear-gradient(to bottom, hsla(232,95%,75%,1) 1%,hsla(215,100%,91%,1) 99%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8393fc', endColorstr='#d1e4ff',GradientType=0 );" onclick="location.href='<?= ALBUM_PATH ?>/folder_main.php?cate=food'">
                                  <br>
                                   <img src="<?= IMG_PATH ?>/ic_food_wh.png"
                      class="ic_profile_wh">
                                
                                음식<br>
                                <img src="<?= IMG_PATH ?>/f_food_1.png" class="photo">
                            </div>
                            
                                
                            
                        
                        
                        <div class="list_menu" style="background: #ff9999;
background: -moz-linear-gradient(top, hsla(0,100%,80%,1) 0%, hsla(0,81%,94%,1) 100%);
background: -webkit-linear-gradient(top, hsla(0,100%,80%,1) 0%,hsla(0,81%,94%,1) 100%);
background: linear-gradient(to bottom, hsla(0,100%,80%,1) 0%,hsla(0,81%,94%,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff9999', endColorstr='#fce3e3',GradientType=0 );" onclick="location.href='<?= ALBUM_PATH ?>/folder_main.php?cate=art'">
                                  <br>
                                   <img src="<?= IMG_PATH ?>/ic_art_wh.png"
                      class="ic_profile_wh">
                                
                                그림<br>
                                 <img src="<?= IMG_PATH ?>/f_art_1.png" class="photo">
                            </div>
                            
                               
                            
                        
                        
                    </div>
                   
                 
                
            </div>
        </div>
    </body>
</html>