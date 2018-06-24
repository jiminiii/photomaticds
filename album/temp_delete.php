<?php
require_once("../tools.php");
    require_once("uploadDao.php");
	$dao=new uploadDao();
   
    $pname=requestValue("p");
    $email=requestValue("e");
   

        $dao->deleteTempPhotoInfo($pname,$email);
        
?>

        <script>history.go(-1);</script>
