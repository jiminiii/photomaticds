<?php

    require_once("../tools.php");
require(API_AWS_SDK);

$sort=isset($_REQUEST["sort"]) ? $_REQUEST["sort"] : "num";
	$dir=isset($_REQUEST["dir"]) ? $_REQUEST["dir"] : "desc";
	$errMsg="지우기 실패!";
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $group=requestValue("cate");
    $pname=requestValue("pname");
    $num=requestValue("num");
	

        
        echo $num;
		
		
		$save_name=$pname;//iconv("utf-8","cp949",$pname);

        require("uploadDao.php");
        $dao=new uploadDao();
        $dao->deleteFileInfo($num);
        unlink(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$group/$fname/$save_name");  
        $dao->updateFolderSize($group,$fname,$email,-1);
//인물사진이라면 해당 인물사진에대한 컬렉션에있는 얼굴삭제
        if($group=='human'){
            
            
             $options = [
                'region'            => 'ap-northeast-1',
                'version'           => '2016-06-27',
              ];
        $rekognition = new Aws\Rekognition\RekognitionClient($options);
            
            
            
//            unlink(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/facelist/$save_name");  
            $cn = explode("@",$email); 
            $collectionid=$cn[0].$cn[1];
            $faceid=$dao->getFaceID($email,$fname,$save_name);
            foreach ($faceid as $row){
                $result = $rekognition->deleteFaces([
                'CollectionId' => $collectionid,
                'FaceIds' => [$row["faceID"],
                ],
            ]);
        }
       
            
            $dao->deleteFaceInfo($fname,$email,$save_name);
    }




        

         header("Location: photo.php?&fname=$fname"."&cate=$group");


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