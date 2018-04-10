<?php

    require_once("../tools.php");


	$errMsg="추가 실패!";
    session_start_if_none();    
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $cate=requestValue("group");
    $ver=isset($_REQUEST["ver"]) ? $_REQUEST["ver"] : "one";
    $pname=isset($_REQUEST["pname"]) ? $_REQUEST["pname"] : NULL;
    $psize=isset($_REQUEST["psize"]) ? $_REQUEST["psize"] : NULL;

        
		
		
	
		
		if(file_exists(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$cate/$fname"))
			$errMsg="폴더명이 중복됩니다.";
        
        
        else {
            if(!is_dir(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$cate/$fname")){
                umask(0);
                if(!mkdir(UPLOAD_PATH.ALBUM_PATH."/user-album/$email/$cate/$fname",0777,true)){
                    print_r(error_get_last());
                    return;
                }
                
                require("uploadDao.php");
                $dao=new uploadDao();
                $dao->addFolderInfo($cate,$fname,$email,0,date("Y-m-d H:i:s"));

                if($ver=="two"){
                    header("Location: array_result.php?cate=$cate&pname=$pname&psize=$psize");
                }else{
                    header("Location: folder_main.php?cate=$cate");
                }
                
                exit();
            }
         
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