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
     require_once("../search/tagDao.php");
    $dao=new uploadDao();
    $tdao=new tagDao();

         $options = [
                'region'            => 'ap-northeast-1',
                'version'           => '2016-06-27',
              ];
        $rekognition = new Aws\Rekognition\RekognitionClient($options);




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
                           for ($n=0;$n<sizeof($resultIndex['FaceRecords']); $n++){


                       $dao->addFaceInfo($resultIndex['FaceRecords'][$n]['Face']['FaceId'],$fname,$email,$save_name,$psize,date("Y-m-d H:i:s"));
                     }



        }

          $resultLabel=$rekognition->detectLabels(array(
                   'Image' => array(
                      'Bytes' => $image,
                   ),
                   'Attributes' => array('ALL')
                   )
                );

                $tcount=0;
                for ($n=0;$n<sizeof($resultLabel['Labels']); $n++){
        
                    $tcount++;
                    if($tcount>6){
                        break;
                    }
                    //태그 자동생성 최대 6개로 제한
                    ///파파고로 번역//
                    
            
$client_id = "5DDQndZcOVYcps0dHZUj";
$client_secret = "cDQlxG0SJY";

//이부분은 보안상 숨김 실행시 값 입력 필요***********************************************************
//$client_id = "";
//$client_secret = "";
   //**************************************************************************************         
$encText = urlencode($resultLabel['Labels'][$n]['Name']);
 $postvars = "source=en&target=ko&text=".$encText;
$url = "https://openapi.naver.com/v1/papago/n2mt";
    //$url = "https://openapi.naver.com/v1/language/translate";s버전일때
$is_post = true;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, $is_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
$headers = array();
$headers[] = "X-Naver-Client-Id: ".$client_id;
$headers[] = "X-Naver-Client-Secret: ".$client_secret;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec ($ch);
$json_string=$response;
$data_array=json_decode($json_string,true);
$rr=$data_array['message']['result']['translatedText'];
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
echo "status_code:".$status_code."<br>";
curl_close ($ch);
//if($status_code == 200) {
//  echo $rr;
//  // echo $response;
//} else {
//  echo "Error 내용:".$response;
//}
//                    
                    ////번역완료///

                    
$exist =$tdao->getTag($rr);
    if($exist[0]==null){
        $tdao->addTagInfo($rr);
        $exist=$tdao->getTag($rr);
    }

$fileNum=$dao->getFileNum($save_name);
    $num=$fileNum[0];
   $exist2=$tdao->getPhotoTag($num,$exist[0]);
    if($exist2[0]==null){
        $tdao->addPhototagInfo($num,$exist[0],$email);
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
