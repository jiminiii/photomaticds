<?php

require_once("../tools.php");
require_once("../search/tagDao.php");
   
    $h_idx=requestValue("h");
    $p_idx=requestValue("p");
   
$tdao=new tagDao();

        $tdao->deletePhotoTagInfo($h_idx,$p_idx);
        
?>

        <script>history.go(-1);</script>
