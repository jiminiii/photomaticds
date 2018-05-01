     <script>
        
        function back(){
             history.go(-2);
         };

</script>

    <?php 

    require_once("../tools.php");
	require_once("tagDao.php");
	$dao=new tagDao();
	

    session_start_if_none();
	$email=sessionVar("uid");
	$name=sessionVar("uname");
    $fname=requestValue("fname");
    $cate=requestValue("cate");
    $num=requestValue("num");
    $pname=requestValue("pname");
    $tagString=requestValue("tagString");



    $tag = explode("#",$tagString); 


$count=0;
?>
<?php foreach ($tag as $t) : 

$t=trim($t);
if($count!=0){
    
    $exist =$dao->getTag($t);
    if($exist[0]==null){
        $dao->addTagInfo($t);
        $exist=$dao->getTag($t);
    }
   $exist2=$dao->getPhotoTag($num,$exist[0]);
    if($exist2[0]==null){
        $dao->addPhototagInfo($num,$exist[0]);
    }
    
}
$count++;

    ?>
       
        <?=$t?>.<br>
    
    
     <?php endforeach?>
     <!doctype html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>

<script>
	
	back();
</script>

</body>
</html>
