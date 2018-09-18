<?php 
	require_once("../tools.php");
	require_once("MemberDao.php");
	require(API_AWS_SDK);
	//회원가입 폼에 입력된 데이터 읽기
	$email=requestValue("email");
	$pw=requestValue("pw");
	$name=requestValue("name");
	$pw2=requestValue("pw2");
	//모든 입력란이 채워져있고, 사용 중이 아이디가 아니면 
	//회원정보추가
	$mdao= new MemberDao();
	if($email && $pw && $name){
        
        
  
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          errorBack("유효하지 않은 이메일주소입니다."); 
        }    
		if($mdao->getMember($email)){
			errorBack("이미 사용 중인 이메일 입니다.");
        }else if($pw!=$pw2){
            errorBack("비밀번호가 일치하지 않습니다.");
        }
		else {
            
			$mdao->insertMember($name, $email, $pw);
            
              $options = [
                'region'            => 'ap-northeast-1',
                'version'           => '2016-06-27',
              ];
            $rekognition = new Aws\Rekognition\RekognitionClient($options);
            
            
            $cn = explode("@",$email); 
            $collectionid=$cn[0].$cn[1];
            $result2 = $rekognition->createCollection([
           'CollectionId' => $collectionid, // REQUIRED
            ]);
			okGo("가입이 완료되었습니다.",LOGIN_PAGE);
			
		}
	}else
		errorBack("모든 입력란을 채워주세요.");

?>