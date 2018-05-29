<?php 
include "Sendmail.php";
	require_once("../tools.php");
	require_once("MemberDao.php");
	
	//회원가입 폼에 입력된 데이터 읽기
	$email=requestValue("email");

	//모든 입력란이 채워져있고, 사용 중이 아이디가 아니면 
	//회원정보추가
	$mdao= new MemberDao();
	if($email){
        
        
  
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          errorBack("유효하지 않은 이메일주소입니다."); 
        }    
		if($mdao->getMember($email)){
            $r_pw=generateRandomPassword();
            
            
                        $sendmail = new Sendmail();

/*
 + $to       : 받는사람 메일주소 ( ex. $to="hong <hgd@example.com>" 으로도 가능)
 + $from     : 보내는사람 이름
 + $subject  : 메일 제목
 + $body     : 메일 내용
 + $cc_mail  : Cc 메일 있을경우 (옵션값으로 생략가능)
 + $bcc_mail : Bcc 메일이 있을경우 (옵션값으로 생략가능)
*/
            
$to=$email;
$from="Photomatic";
$subject="임시 비밀번호를 알려드립니다.";
$body="임시비밀번호 :".$r_pw."\n 임시번호로 홈페이지에서 로그인 후 비밀번호를 변경하시길 바랍니다";
$cc_mail="";
$bcc_mail="";

/* 메일 보내기 */
$sendmail->send_mail($to, $from, $subject, $body,$cc_mail,$bcc_mail);
            $mdao->updateMember($r_pw,$email);
            
            okGo("임시비밀번호를 전송했습니다.",LOGIN_PAGE);
            
        }
		else {
            
            errorBack("가입하지 않은 이메일 입니다.");
  
		}
	}else
		errorBack("이메일을 입력해주세요.");


function generateRandomPassword($length=8, $strength=0) {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength & 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 2) {
        $vowels .= "AEUY";
    }
    if ($strength & 4) {
        $consonants .= '23456789';
    }
    if ($strength & 8) {
        $consonants .= '@#$%';
    }

    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}


?>