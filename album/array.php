<?php
    $errMsg="업로드 실패!";
   require_once("../tools.php");
    session_start_if_none();
	$email=sessionVar("uid");
    $count=0;
 
    $myLabel=isset($_REQUEST['categroup']) ? $_REQUEST['categroup'] : "null";
    if($myLabel=="null"){
         errorBack("분류 기준을 선택해주세요");
    }else{
        
        
        
        
        if ($_FILES["upload"]["error"][0]==UPLOAD_ERR_OK){
                     
            require API_AWS_SDK;
    //        use Aws\Rekognition\RekognitionClient;
            $options = [
                'region'            => 'ap-northeast-1',
                'version'           => '2016-06-27',
            ];
            $rekognition = new Aws\Rekognition\RekognitionClient($options);
            require("uploadDao.php");
            $dao=new uploadDao();
                     $directory=UPLOAD_PATH.ALBUM_PATH."/temp_photo/";
                $handle=opendir($directory); 
                while($file=readdir($handle)){
                    unlink($directory.$file);
                }
                closedir($handle);
        $dao->deleteTempFileInfo($email);
            
            
            for($i=0;$i<20;$i++){
                $findLabel=false;
                
                    $tname=$_FILES["upload"]["tmp_name"][$i];
                    $pname=$_FILES["upload"]["name"][$i];
                    $psize=$_FILES["upload"]["size"][$i];
                    $save_name=$pname;
//                    $original=$save_name;
                   
                
                $fn = explode(".",$save_name); 
                $save_name_ext = array_pop($fn); 
                    $randomNum=mt_rand(0,1000);
                    $save_name=date("YmdHis").$randomNum.".".$save_name_ext;//.$original;
                
                if($_FILES['upload']['size'][$i]==0){
                    if($count==0){
                        errorBack("분류 기준에 맞는 사진이 존재하지 않습니다");
                    }
                    header("Location: array_result.php?"."&cate=$cate"."&pname=$save_name"."&psize=$psize"."&count=$i");
                    exit();
                }    
                
                if($_FILES["upload"]["error"][$i]==UPLOAD_ERR_OK){
                                    #Get local image
                $fp_image = fopen($_FILES['upload']['tmp_name'][$i], 'r');
                $image = fread($fp_image, filesize($_FILES['upload']['tmp_name'][$i]));
                fclose($fp_image);
                # Call DetectFaces
                $result = $rekognition->detectLabels(array(
                   'Image' => array(
                      'Bytes' => $image,
                   ),
                   'Attributes' => array('ALL')
                   )
                );
                # Display info for each detected person
                print '포토매틱 detectLabels' . PHP_EOL;
                    
                for ($n=0;$n<sizeof($result['Labels']); $n++){
//                  print 'Confidence: '.$result['Labels'][$n]['Confidence']
//                  .  PHP_EOL
//                  . 'Name: ' . $result['Labels'][$n]['Name']
//                  .  PHP_EOL . PHP_EOL;
                    
                    
                    if($myLabel=="Nature"){
                        if($myLabel==$result['Labels'][$n]['Name']||'City'==$result['Labels'][$n]['Name']){
                            $findLabel=true;
                        }
                    }else{
                        if($myLabel==$result['Labels'][$n]['Name']){
                            $findLabel=true;
                        }
                    }
                    
                }
//                echo $myLabel;
//                echo $findLabel;
                if(!$findLabel){
                    
                    //errorBack("분류 기준에 맞는 사진이 존재하지 않습니다");
                }else{
                    
                    $count++;
                    switch($myLabel){
                    case 'Human':
                        $cate="human";
                        break;
                    case 'Animal':
                        $cate="animal";
                        break;
                    case 'Nature':
                        $cate="landscape";
                        break;
                    case 'Text':
                        $cate="text";
                        break;
                    case 'Food':
                        $cate="food";
                        break;
                    case 'Art':
                        $cate="art";
                        break;
                            
                }
                    if(move_uploaded_file($tname, UPLOAD_PATH.ALBUM_PATH."/temp_photo/$save_name")){
                        $dao->addTempFileInfo($cate,$email,$save_name,$psize,date("Y-m-d H:i:s"));
                    }
                }
                    
                    
                    
            }//errori
                
        }//for
            if($count==0){
                errorBack("분류 기준에 맞는 사진이 존재하지 않습니다");
            }
            
             header("Location: array_result.php?"."&cate=$cate"."&pname=$save_name"."&psize=$psize");
                    exit();
    }//error0
        
         
}//null
    
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

<script>
	alert('<?=$errMsg ?>');
	history.back();
</script>

</body>
</html>