<?php
    require_once("../tools.php");
    require_once("MemberDao.php");
    session_start_if_none();
	$email=sessionVar("uid");
	//$name=sessionVar("uname");
    $dao=new MemberDao();
    $inform=$dao->getMember($email);
    $pw=requestValue("pw");
    $newpw=requestValue("newpw");
    $newpw2=requestValue("newpw2");
    //1. 모든 항목이 입력되어있고
    if($pw && $newpw && $newpw2){
        //2. 현재 비밀번호가 일치하고
        if($inform["pw"]==$pw){

            //3. 새비밀번호를 두번 맞게 썼으면 변경성공
            if($newpw==$newpw2){
                $dao->updateMember($newpw,$email);
                okGo("비밀번호 변경이 완료되었습니다.",MAIN_PAGE);
            }else{
                errorBack("새 비밀번호가 일치하지 않습니다.");
            }

        }else{
            errorBack("현재 비밀번호가 일치하지 않습니다.");
        }
       
    }else{
         errorBack("모든 항목을 입력해주세요.");
    }

    



?>
