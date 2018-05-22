<?php

    require_once("../tools.php");
    require("uploadDao.php");
    $dao=new uploadDao();
//	$sort=isset($_REQUEST["sort"]) ? $_REQUEST["sort"] : "num";
//	$dir=isset($_REQUEST["dir"]) ? $_REQUEST["dir"] : "desc";
	$errMsg="저장 실패!";
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $cate=requestValue("cate");
	$result = $dao->getTempFileList($email,$cate);
        
//        
//            if(!is_dir(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$cate/$fname")){
//                umask(0);
//                if(!mkdir(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$cate/$fname",0777,true)){
//                    print_r(error_get_last());
//                    return;
//                }
//            }

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
                    
                }
              
                $dao->deleteTempFileInfo($email);

                header("Location: photo.php?fname=$fname"."&cate=$cate");
                






//            if(copy(UPLOAD_PATH.ALBUM_PATH."/temp_photo/$save_name", UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$cate/$fname/$save_name")){
//			     unlink(UPLOAD_PATH.ALBUM_PATH."/temp_photo/$save_name");
//                require("uploadDao.php");
//                $dao=new uploadDao();
//                $dao->addFileInfo($cate,$fname,$email,$pname,$psize,date("Y-m-d H:i:s"));
//                $dao->updateFolderSize($cate,$fname,$email,1);
//                $dao->deleteTempFileInfo($cate,$email);
//
//                header("Location: photo.php?fname=$fname"."&cate=$cate");
//                exit();
//		  }

        
	
	




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