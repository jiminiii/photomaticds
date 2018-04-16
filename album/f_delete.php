<?php

    require_once("../tools.php");
require(API_AWS_SDK);

	$errMsg="지우기 실패!";
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $cate=requestValue("cate");

       
		
		//$save_name=$pname;//iconv("utf-8","cp949",$pname);

        require("uploadDao.php");
        $dao=new uploadDao();
        $dao->deleteFolderInfo($email,$fname,$cate);



            $directory=UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$cate/$fname/";

            $handle=opendir($directory); 

            while($file=readdir($handle)){

                unlink($directory.$file);

            }

            closedir($handle);

         rmdir(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$cate/$fname");  
        
//                    $cn = explode("@",$email); 
//            $collectionid=$cn[0].$cn[1];
//            $faceid=$dao->getFaceID($email,$fname,$save_name);
//
//
//
//
//            foreach ($faceid as $row){
//                $result = $rekognition->deleteFaces([
//                'CollectionId' => $collectionid,
//                'FaceIds' => [$row["faceID"],
//                ],
//            ]);
//                
//                $dao->deleteFaceInfo($fname,$email,$save_name);
//        }
//
//









//인물사진이라면 해당 인물사진에대한 컬렉션에있는 얼굴삭제
        if($cate=='human'){
            
            
             $options = [
                'region'            => 'ap-northeast-1',
                'version'           => '2016-06-27',
              ];
        $rekognition = new Aws\Rekognition\RekognitionClient($options);
            
            

            $cn = explode("@",$email); 
            $collectionid=$cn[0].$cn[1];
            $facelist=$dao->getFacelist($email,$fname);
            foreach ($facelist as $row){
                $result = $rekognition->deleteFaces([
                'CollectionId' => $collectionid,
                'FaceIds' => [$row["faceID"],
                ],
            ]);
            $dao->deleteFaceInfo($fname,$email,$row["pname"]);
        }///////////현재 폴더삭제했을때 그 폴더속 사진에 관한 얼굴정보가 데이터베이스에서 삭제가안됨
    }








  header("Location: folder_edit.php?cate=$cate");
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