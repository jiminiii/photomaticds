<?php 
	require_once("../tools.php");
	require_once("MemberDao.php");
	
	//로그인 폼에서 전달된 아이디, 비밀번호 읽기
	$email=requestValue("email");
	$pw=requestValue("pw");
	
	//로그인 폼에 입력된 아이디의 회원정보를 db에서 읽기
	$mdao=new MemberDao();
	$member=$mdao->getMember($email);
	
	//그런 아이디를 가진 레코드가 있고, 비밀번호가 맞으면 로그인
	
	if($member && $member["pw"]==$pw){
		
		session_start_if_none();
		
		$_SESSION["uid"]=$email;
		$_SESSION["uname"]=$member["name"];
		
		//메인페이지로 돌아감
		goNow(MAIN_PAGE);
		
	} else
		errorBack("아이디 또는 비밀번호가 잘못 입력되었습니다. ");



?>