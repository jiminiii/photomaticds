<?php 
class MemberDao{
	private $db;
	
	public function __construct(){
		
		try{
            //("mysql:host=서버주소;dbname=사용할 DB","사용자ID","비밀번호")
			$this->db = new PDO("mysql:host=localhost;dbname=photomatic","pm","20151055");
			$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}


	
	public function getMember($email){
		try{
			$query=$this->db->prepare("select * from member where email= :email");
			$query->bindValue(":email",$email,PDO::PARAM_STR);
			$query->execute();
			
			$result=$query->fetch(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			exit($e->getMessage());
			
		}
		
		return $result;
	}
	
	//회원 정보 추가
	
	public function insertMember($name,$email,$pw){
		try{
			$query=$this->db->prepare("insert into member values(:name,:email,:pw)");
			
			$query->bindValue(":name",$name,PDO::PARAM_STR);
			$query->bindValue(":email",$email,PDO::PARAM_STR);
			$query->bindValue(":pw",$pw,PDO::PARAM_STR);
			
			$query->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}
	
	public function updateMember($pw,$email){
		
		try{
			$query =$this->db->prepare("update member set pw=:pw where email=:email");
//			$query->bindValue(":name",$name,PDO::PARAM_STR);
			$query->bindValue(":email",$email,PDO::PARAM_STR);
			$query->bindValue(":pw",$pw,PDO::PARAM_STR);
			$query->execute();
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
	}
}
?>