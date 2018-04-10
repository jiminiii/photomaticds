<?php 
    //회원관리와 로그인 모듈을 위한 상수
    define("MAIN_PAGE", "/pm_site/main.php");
    define("LOGIN_PAGE","/pm_site/index.php");
    define("MEMBER_PATH","/pm_site/member");
    define("IMG_PATH","/pm_site/img");  
    define("ALBUM_PATH","/pm_site/album");
    define("HOME_PATH","/pm_site");
    define("UPLOAD_PATH","/xampp/htdocs");
    define("API_AWS_SDK","/xampp/php/vendor/autoload.php");
    define("TEMP_PATH","/pm_site/album/temp_photo");


	//게시판 모듈의 URL을 반환하는 함수
	function bdUrl($file,$num,$page){
		$join="?";
		if($num){
			$file .=$join . "num=$num";
			$join = "&";
		}
		
		if($page)
			$file .=$join . "page=$page";
		
		return $file;
	}
	
	//세션이 시작되지 않았을 경우 세션을 시작하는 함수
	function session_start_if_none(){
		if(session_status()==PHP_SESSION_NONE)
			session_start();
	}
    function session_none(){
        if(sessionVar("uid")==null){
            errorBack("로그인을 해주십시오");
        }
            
    }

	
	//get/post로 전달된 값을 읽어 반환하는 함수
	function requestValue($name){
		return isset($_REQUEST[$name])?$_REQUEST[$name]:"";
	}
	
	//세션변수 값을 읽어 반환하는 함수
	function sessionVar($name){
		return isset($_SESSION[$name])?$_SESSION[$name]:"";
	}
	
	//지시된url로 이동하는 함수
	//이 함수 호출 뒤에 있는 코드는 실행되지 않음
	function goNow($url){
		header("Location:$url");
		exit();
	}
	
	//경고창에 오류 메시지를 출력하고 이전 페이지로 돌아가는 함수
	function errorBack($msg){
		
?>		

	<!doctype html>
	<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	<script>
		alert('<?= $msg ?>');
		history.back();
	</script>
	</body>
	</html>
<?php 

		exit();
	}


	//경고창에 지정된 메시지를 출력하고 지정된 페이지로 이동하는 함수
	
	function okGo($msg, $url){
?>
	<!doctype html>
	<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	<script>
		alert('<?= $msg ?>');
		location.href='<?= $url ?>';
	</script>
	</body>
	</html>

<?php
	exit();
	
	}
?>



