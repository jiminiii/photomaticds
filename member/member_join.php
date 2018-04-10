<?php 
	require_once("../tools.php");
	require_once("MemberDao.php");
	
	//회원가입 폼에 입력된 데이터 읽기
	$email=requestValue("email");
	$pw=requestValue("pw");
	$name=requestValue("name");
	$pw2=requestValue("pw2");
	//모든 입력란이 채워져있고, 사용 중이 아이디가 아니면 
	//회원정보추가
	$mdao= new MemberDao();
	if($email && $pw && $name){
		if($mdao->getMember($email))
			errorBack("이미 사용 중인 이메일 입니다.");
        
        else if($pw!=$pw2){
            errorBack("비밀번호가 일치하지 않습니다.");
        }
		else {
            
			$mdao->insertMember($name, $email, $pw);
			okGo("가입이 완료되었습니다.",LOGIN_PAGE);
			
		}
	}else
		errorBack("모든 입력란을 채워주세요.");

?>