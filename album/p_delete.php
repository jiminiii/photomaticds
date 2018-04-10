<?php

    require_once("../tools.php");


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