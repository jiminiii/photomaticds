<?php
    require_once("../tools.php");
    require("uploadDao.php");
    $dao=new uploadDao();
require_once("../search/tagDao.php");
    $tdao=new tagDao();

	$errMsg="저장 실패!";
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $cate=requestValue("cate");
	$result = $dao->getTempFileList($email,$cate);


//           switch($cate){
//                    case 'human':
//                        $cate2="인물";
//                        break;
//                    case 'animal':
//                        $cate2="동물";
//                        break;
//                    case 'landscape':
//                        $cate2="풍경";
//                        break;
//                    case 'text':
//                        $cate2="글자";
//                        break;
//                    case 'food':
//                        $cate2="음식";
//                        break;
//                    case 'art':
//                        $cate2="그림";
//                        break;
//                            
//                }

                $directory=UPLOAD_PATH.ALBUM_PATH."/temp_photo/";
                $handle=opendir($directory); 
                while($file=readdir($handle)){
                 //   unlink($directory.$file);
                    copy($directory.$file,UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$cate/$fname/".$file);
                }
                closedir($handle);
//템프폴더에 있는 사진들 삭제
                $directory=UPLOAD_PATH.ALBUM_PATH."/temp_photo/";
                $handle=opendir($directory); 
                while($file=readdir($handle)){
                    unlink($directory.$file);
                }
                closedir($handle);
                          
                          
                foreach ($result as $row){
                     $dao->addFileInfo($cate,$fname,$email,$row["pname"],$row["psize"],date("Y-m-d H:i:s"));
                    $dao->updateFolderSize($cate,$fname,$email,1);
                    
//////////////태그  저장부분
                    
                    $exist =$tdao->getTag($cate);
                        if($exist[0]==null){
                            $tdao->addTagInfo($cate);
                            $exist=$tdao->getTag($cate);
                        }

                    $fileNum=$dao->getFileNum($row["pname"]);
                        $num=$fileNum[0];
                       $exist2=$tdao->getPhotoTag($num,$exist[0]);
                        if($exist2[0]==null){
                            $tdao->addPhototagInfo($num,$exist[0],$email);
                        }
                    
                }
              
                $dao->deleteTempFileInfo($email);
                header("Location: photo.php?fname=$fname"."&cate=$cate");

        
	
	
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