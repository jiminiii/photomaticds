<?php
    require_once("../tools.php");
require(API_AWS_SDK);
	$errMsg="인물을 찾을 수 없습니다!";
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
if($_FILES["upload"]["error"] == UPLOAD_ERR_OK){
     require("uploadDao.php");
    $dao=new uploadDao();
    
         $options = [
                'region'            => 'ap-northeast-1',
                'version'           => '2016-06-27',
              ];
        $rekognition = new Aws\Rekognition\RekognitionClient($options);
   
		$tname=$_FILES["upload"]["tmp_name"];
		$pname=$_FILES["upload"]["name"];
		$psize=$_FILES["upload"]["size"];
        ///
        
        
        $fp_image = fopen($_FILES['upload']['tmp_name'], 'r');
        $image = fread($fp_image, filesize($_FILES['upload']['tmp_name']));
        fclose($fp_image);
		
		$temp_name=$pname;//iconv("utf-8","cp949",$pname);
        $fn = explode(".",$temp_name); 
        $temp_name_ext = array_pop($fn); 
        $randomNum=mt_rand(0,1000);
		$temp_name=date("YmdHis").$randomNum.".".$temp_name_ext;
        
//컬렉션에서 방금 업로드한 얼굴과 같은 얼굴찾기
            $cn = explode("@",$email); 
            $collectionid=$cn[0].$cn[1];
            try{
                 $result = $rekognition->searchFacesByImage([
    'CollectionId' => $collectionid,
    'FaceMatchThreshold' => 85,
    'Image' => [
       'Bytes' =>$image,
    ],
    'MaxFaces' => 5,
]);
            
                    //템프포토 내에 계정폴더 생성하는부분
              if(!is_dir(UPLOAD_PATH.ALBUM_PATH."/temp_photo/$email")){
                umask(0);
                if(!mkdir(UPLOAD_PATH.ALBUM_PATH."/temp_photo/$email",0777,true)){
                    print_r(error_get_last());
                    return;
                }
            }
                
                
    //임시폴더에 있는것들모두지우고
    $directory=UPLOAD_PATH.ALBUM_PATH."/temp_photo/$email/";
    $handle=opendir($directory); 
    while($file=readdir($handle)){
        unlink($directory.$file);
    }
    closedir($handle);
    $dao->deleteResultFace();
    
    
    
    
    //업로드한 파일 임시 폴더로 옮기기
     if(move_uploaded_file($tname, UPLOAD_PATH.ALBUM_PATH."/temp_photo/$email/$temp_name")){
     }
    

     print '이것은 searchFaceByImage테스트' . PHP_EOL;
     for ($n=0;$n<sizeof($result['FaceMatches']); $n++){

       $search=$dao->getFaceFileInfo($email,$result['FaceMatches'][$n]['Face']['FaceId']);
       $save_name=$search['pname'];
       $psize=$search['psize'];
       $fname=$search['fname'];
       $dao->addResultFaceInfo($result['FaceMatches'][$n]['Face']['FaceId'],$fname,$email,$save_name,$psize,date("Y-m-d H:i:s"));
     }
                
                     
header("Location: search_result.php?photo=$temp_name");
                exit();
                
                }catch(Exception $e){
                
                
                ?>
                <script>
	alert('<?=$errMsg ?>');
	history.back();
</script>
                <?php
                
            }

}
?>
