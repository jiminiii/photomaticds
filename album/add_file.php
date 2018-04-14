<?php

    require_once("../tools.php");
require(API_AWS_SDK);



	$errMsg="업로드 실패!";
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $group=requestValue("cate");


if($_FILES["upload"]["error"][0] == UPLOAD_ERR_OK){
     require("uploadDao.php");
    $dao=new uploadDao();
    
    
    
    if($group=='human'){
         $options = [
                'region'            => 'ap-northeast-1',
                'version'           => '2016-06-27',
              ];
        $rekognition = new Aws\Rekognition\RekognitionClient($options);
    }
    
    
    
for($i=0;$i<20;$i++){
    if($_FILES['upload']['size'][$i]==0){
       header("Location: photo.php?sort=$_REQUEST[sort]"."&dir=$_REQUEST[dir]"."&fname=$fname"."&cate=$group");
                exit();
    }



	if ($_FILES["upload"]["error"][$i]==UPLOAD_ERR_OK){
		
		$tname=$_FILES["upload"]["tmp_name"][$i];
		$pname=$_FILES["upload"]["name"][$i];
		$psize=$_FILES["upload"]["size"][$i];
        ///
        
        
        $fp_image = fopen($_FILES['upload']['tmp_name'][$i], 'r');
        $image = fread($fp_image, filesize($_FILES['upload']['tmp_name'][$i]));
        fclose($fp_image);

		
		$save_name=$pname;//iconv("utf-8","cp949",$pname);
        $fn = explode(".",$save_name); 
        $save_name_ext = array_pop($fn); 
        $randomNum=mt_rand(0,1000);
		$save_name=date("YmdHis").$randomNum.".".$save_name_ext;
		if(file_exists(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$group/$fname/$save_name")){
//            $errMsg="이미 업로드한 파일입니다.";
             $original=$save_name;
            $save_name=date("YmdHis").$original;
        }
			
        
        
       
            if(!is_dir(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$group/$fname")){
                umask(0);
                if(!mkdir(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$group/$fname",0777,true)){
                    print_r(error_get_last());
                    return;
                }
            }
            
            if(move_uploaded_file($tname, UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$group/$fname/$save_name")){
			
              
                $dao->addFileInfo($group,$fname,$email,$save_name,$psize,date("Y-m-d H:i:s"));
                $dao->updateFolderSize($group,$fname,$email,1);

                
		  }
        
        
        //사진속 얼굴들 컬렉션에 집어넣기
        if($group=="human"){
            
           
            
            ///////사진 속 얼굴 index
            $cn = explode("@",$email); 
            $collectionid=$cn[0].$cn[1];
//            $image=UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$group/$fname/$save_name";
            
             $resultIndex = $rekognition->indexFaces([
                 'CollectionId' => $collectionid,// REQUIRED
                 'DetectionAttributes' => ["DEFAULT"
                                          ],

                 'Image' => [ // REQUIRED
                     'Bytes' =>$image,

                 ],
             ]);
            
            //////////////////////////////더수정하자
//             for ($n=0;$n<sizeof($resultIndex['FaceRecords']); $n++){
//                  $dao->addFaceInfo($resultIndex['FaceRecords'][$n]['Face']['FaceId'],$save_name,$collectionid,$psize,date("Y-m-d H:i:s"));
//             }
//            
            
            
            
            
            if(sizeof($resultIndex['FaceRecords'])>0){
                
                         
            
                 if(!is_dir(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/facelist")){
                   umask(0);
                    if(!mkdir(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/facelist",0777,true)){
                        print_r(error_get_last());
                        return;
                    }
                 }

//                 if(move_uploaded_file($tname,"/xampp/htdocs/amatest/email/facelist/$save_name")){
//
//
//
//                     for ($n=0;$n<sizeof($result['FaceRecords']); $n++){
//                       $dao->addFaceInfo($result['FaceRecords'][$n]['Face']['FaceId'],$save_name,"jeongjimin97@naver.com",$psize,date("Y-m-d H:i:s"));
//                     }
//
//
//
//                }
            //서버쪽 facelist폴더에 파일 복사하고 데이터베이스에 사진정보넣기
             if(copy(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$group/$fname/$save_name",UPLOAD_PATH.ALBUM_PATH."/user-album/$email/facelist/$save_name")){
                 
                     for ($n=0;$n<sizeof($resultIndex['FaceRecords']); $n++){
                       $dao->addFaceInfo($resultIndex['FaceRecords'][$n]['Face']['FaceId'],$fname,$email,$save_name,$psize,date("Y-m-d H:i:s"));
                     }
             }
            }
                        
        }
	
        //////     
	}

   
}
header("Location: photo.php?sort=$_REQUEST[sort]"."&dir=$_REQUEST[dir]"."&fname=$fname"."&cate=$group");
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