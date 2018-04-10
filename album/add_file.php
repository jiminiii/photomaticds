<?php

    require_once("../tools.php");


	$errMsg="업로드 실패!";
    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $group=requestValue("cate");


if($_FILES["upload"]["error"][0] == UPLOAD_ERR_OK){
     require("uploadDao.php");
    $dao=new uploadDao();
for($i=0;$i<20;$i++){
    if($_FILES['upload']['size'][$i]==0){
       header("Location: photo.php?sort=$_REQUEST[sort]"."&dir=$_REQUEST[dir]"."&fname=$fname"."&cate=$group");
                exit();
    }



	if ($_FILES["upload"]["error"][$i]==UPLOAD_ERR_OK){
		
		$tname=$_FILES["upload"]["tmp_name"][$i];
		$pname=$_FILES["upload"]["name"][$i];
		$psize=$_FILES["upload"]["size"][$i];
        

		
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