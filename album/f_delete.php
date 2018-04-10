<?php

    require_once("../tools.php");


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