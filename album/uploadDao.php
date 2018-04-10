<?php

	
class uploadDao{
	private $db;
	
	//db에 접속하고 pdo 객체를 $db에 저장
	
	public function __construct(){
		try{
//			$this->db =new PDO("mysql:hos=localhost;dbname=phpdb1","php"," ");
            $this->db =new PDO("mysql:hos=localhost;dbname=photomatic","pm","20151055");
			$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}
	//파일 수 반환
    public function getSize(){
        try{
			$query= $this->db->prepare("select * from list order by $sort $dir");
			$query->execute();
			
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
    }
	
	//모든 파일정보 반환(2차원 배열)
	public function getFileList($sort,$dir,$email,$fname,$cate){
		
		
		try{
			$query= $this->db->prepare("select * from photo where email='$email' and fname='$fname' and cate='$cate' order by $sort $dir");
			$query->execute();
			
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
	}
    
    
    	public function getFolderList($email,$cate){
		
		
		try{
			$query= $this->db->prepare("select * from folder where email='$email' and cate='$cate'");
			$query->execute();
			
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
	}

   
        public function getTempFileList($email,$cate){
		
		
		try{
			$query= $this->db->prepare("select * from extraphoto where email='$email' and cate='$cate'");
			$query->execute();
			
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
	}
	
	//새 파일 정보를 db에 추가
	public function addFileInfo($cate,$fname,$email,$pname, $psize, $ptime){
		
		
		try{
			$sql="insert into photo(cate,fname,email,pname,psize,ptime)values  (:cate,:fname,:email,:pname,:psize,:ptime)";
			$query=$this->db->prepare($sql);
            
            $query->bindValue(":cate",$cate,PDO::PARAM_STR);
            $query->bindValue(":fname",$fname,PDO::PARAM_STR);
            $query->bindValue(":email",$email,PDO::PARAM_STR);
            $query->bindValue(":pname",$pname,PDO::PARAM_STR);
            $query->bindValue(":psize",$psize,PDO::PARAM_INT);
            $query->bindValue(":ptime",$ptime,PDO::PARAM_STR);
            
//			
//			$query->bindValue(":fname",$fname,PDO::PARAM_STR);
//			$query->bindValue(":ftime",$ftime,PDO::PARAM_STR);
//			$query->bindValue(":fsize",$fsize,PDO::PARAM_INT);
			
			$query->execute();
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}
		public function addFolderInfo($cate,$fname,$email,$fsize, $ftime){
		
		
		try{
			$sql="insert into folder(cate,fname,email,fsize,ftime)values  (:cate,:fname,:email,:fsize,:ftime)";
			$query=$this->db->prepare($sql);
            
            $query->bindValue(":cate",$cate,PDO::PARAM_STR);
            $query->bindValue(":fname",$fname,PDO::PARAM_STR);
            $query->bindValue(":email",$email,PDO::PARAM_STR);
            $query->bindValue(":fsize",$fsize,PDO::PARAM_INT);
            $query->bindValue(":ftime",$ftime,PDO::PARAM_STR);
            
//			
//			$query->bindValue(":fname",$fname,PDO::PARAM_STR);
//			$query->bindValue(":ftime",$ftime,PDO::PARAM_STR);
//			$query->bindValue(":fsize",$fsize,PDO::PARAM_INT);
			
			$query->execute();
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}

        	
	public function  addTempFileInfo($cate,$email,$pname,$psize,$ptime){
		
		
		try{
			$sql="insert into extraphoto(cate,email,pname,psize,ptime)values  (:cate,:email,:pname,:psize,:ptime)";
			$query=$this->db->prepare($sql);
            
            $query->bindValue(":cate",$cate,PDO::PARAM_STR);
            $query->bindValue(":email",$email,PDO::PARAM_STR);
            $query->bindValue(":pname",$pname,PDO::PARAM_STR);
            $query->bindValue(":psize",$psize,PDO::PARAM_INT);
            $query->bindValue(":ptime",$ptime,PDO::PARAM_STR);

			
			$query->execute();
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}
	
	//$num번 파일 정보를 db에서 삭제하고 그 파일명을 반환
	
	public function deleteFileInfo($num){
		
		try{
			
			
			//삭제할 파일명을 $result에 담아 둠
			
//			$query = $this->db->prepare("select fname from photo where num=:num");
//			$query->bindValue(":num",$num,PDO::PARAM_INT);
//			$query->execute();
//			
//			$result=$query->fetchColumn();
			
			//지정된 레코드 삭제
			
			$query = $this->db->prepare("delete from photo where num='$num'");
			
			//$query->bindValue("':num'",$num,PDO::PARAM_INT);
			$query->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
			
		}
		
	//	return $result;
		
		
	}
    
    	public function deleteTempFileInfo($email){
		
		try{
			
			
			//삭제할 파일명을 $result에 담아 둠
			
//			$query = $this->db->prepare("select fname from photo where num=:num");
//			$query->bindValue(":num",$num,PDO::PARAM_INT);
//			$query->execute();
//			
//			$result=$query->fetchColumn();
			
			//지정된 레코드 삭제
			
			$query = $this->db->prepare("delete from extraphoto where email='$email'");
			
			//$query->bindValue("':num'",$num,PDO::PARAM_INT);
			$query->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
			
		}
		
	//	return $result;
		
		
	}
    
    
    public function updateFolderSize($cate,$fname, $email,$size){
		
		
		try{
			//$sql="insert into photo(fname,email,pname,psize,ptime)values  (:fname,:email,:pname,:psize,:ptime)";
            $sql="update folder set fsize=fsize+'$size' where cate=:cate and fname=:fname and email=:email";
			$query=$this->db->prepare($sql);
  
            $query->bindValue(":cate",$cate,PDO::PARAM_STR);
            $query->bindValue(":fname",$fname,PDO::PARAM_STR);
            $query->bindValue(":email",$email,PDO::PARAM_STR);
			
			$query->execute();
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}
    
    public function deleteFolderInfo($email,$fname,$cate){
        try{
			
			
			//삭제할 파일명을 $result에 담아 둠
			
//			$query = $this->db->prepare("select fname from photo where num=:num");
//			$query->bindValue(":num",$num,PDO::PARAM_INT);
//			$query->execute();
//			
//			$result=$query->fetchColumn();
			
			//지정된 레코드 삭제
			
			$query = $this->db->prepare("delete from folder where email='$email' and fname='$fname' and cate='$cate'");
			
			//$query->bindValue("':num'",$num,PDO::PARAM_INT);
			$query->execute();
            
            $query = $this->db->prepare("delete from photo where email='$email' and fname='$fname' and cate='$cate'");
            $query->execute();
		}catch(PDOException $e){
			exit($e->getMessage());
			
		}
		
	//	return $result;
    }
	
	
	
}


?>