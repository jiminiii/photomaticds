<?php

    require_once("../tools.php");
require(API_AWS_SDK);



	$errMsg="업로드 실패!";
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

            
                 $result = $rekognition->searchFacesByImage([
    'CollectionId' => $collectionid,
    'FaceMatchThreshold' => 85,
    'Image' => [
       'Bytes' =>$image,
    ],
    'MaxFaces' => 5,
]);
            
    //임시폴더에 있는것들모두지우고
    $directory=UPLOAD_PATH.ALBUM_PATH."/temp_photo/";

    $handle=opendir($directory); 

    while($file=readdir($handle)){

        unlink($directory.$file);

    }

    closedir($handle);
    
    //업로드한 파일 임시 폴더로 옮기기
     if(move_uploaded_file($tname, UPLOAD_PATH.ALBUM_PATH."/temp_photo/$temp_name")){
     }
    
$dao->deleteResultFace();

     print '이것은 searchFaceByImage테스트' . PHP_EOL;
     for ($n=0;$n<sizeof($result['FaceMatches']); $n++){

//       print 'Height: '.$result['FaceMatches'][$n]['Face']['BoundingBox']['Height']
//       .  PHP_EOL
//       .'Left: '.$result['FaceMatches'][$n]['Face']['BoundingBox']['Left']
//       .  PHP_EOL
//       .'Top: '.$result['FaceMatches'][$n]['Face']['BoundingBox']['Top']
//       .  PHP_EOL
//       .'Width: '.$result['FaceMatches'][$n]['Face']['BoundingBox']['Width']
//       .  PHP_EOL
//       .'Confidence: '.$result['FaceMatches'][$n]['Face']['Confidence']
//       .  PHP_EOL
//       .'FaceId: '.$result['FaceMatches'][$n]['Face']['FaceId']
//       .  PHP_EOL
//       .'ImageId: '.$result['FaceMatches'][$n]['Face']['ImageId']
//       .  PHP_EOL
//       .'Similarity: '.$result['FaceMatches'][$n]['Similarity']
//       .  PHP_EOL
//       .'SearchedFaceConfidence: '.$result[$n]['SearchedFaceConfidence']
//
//       .  PHP_EOL.  PHP_EOL;
       $search=$dao->getFaceFileInfo($email,$result['FaceMatches'][$n]['Face']['FaceId']);
       $save_name=$search['pname'];
       $psize=$search['psize'];
       $fname=$search['fname'];
       $dao->addResultFaceInfo($result['FaceMatches'][$n]['Face']['FaceId'],$fname,$email,$save_name,$psize,date("Y-m-d H:i:s"));
     }
     

header("Location: search_result.php?photo=$temp_name");
                exit();
}
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