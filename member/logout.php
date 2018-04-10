<?php 

	require_once("../tools.php");
	
	//세션변수에서 로그인 정보 삭제
	session_start_if_none();
	unset($_SESSION["uid"]);
	unset($_SEESION["uname"]);
	
	//메인페이지로 돌아감
	goNow(LOGIN_PAGE);

?>
