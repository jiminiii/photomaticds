<?php

	
class tagDao{
	private $db;
	
	//db에 접속하고 pdo 객체를 $db에 저장
	
	public function __construct(){
		try{

            //////////////여기 알아서 바꾸기
            
            $this->db =new PDO("mysql:hos=localhost;dbname=photomatic","pm","20151055");
			$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}
	
	
	//
	public function getTag($tag){
		
		
		try{
			$query= $this->db->prepare("select hash_index from hashtag where tag='$tag'");
			$query->execute();	
			$result=$query->fetch();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
	}
    
    
    	public function getTagString($idx){
		
		
		try{
			$query= $this->db->prepare("select tag from hashtag where hash_index='$idx'");
			$query->execute();	
			$result=$query->fetch();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
	}
    //해당 사진의 해당 해쉬태그가있는지 알아보기위해.. 사진번호가 모두 달라서 굳이 이메일은 필요없음
    	public function getPhotoTag($num,$idx){
		
		
		try{
			$query= $this->db->prepare("select hash_index from photo_hash where hash_index='$idx' and photo_index='$num'");
			$query->execute();	
			$result=$query->fetch();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
	}
    
        public function getPhotoTagIdxList($num){
		
		
		try{
			$query= $this->db->prepare("select * from photo_hash where photo_index='$num'");
			$query->execute();	
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
	}
    
            public function getPhotoIdx($idx,$email){
		
		
		try{
			$query= $this->db->prepare("select * from photo_hash where hash_index='$idx' and email='$email'");
			$query->execute();	
			$result=$query->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
	}
    
    
    
    	public function getPhotoList($num){
		
		
		try{
			$query= $this->db->prepare("select * from photo where num='$num'");
			$query->execute();
			
			$result=$query->fetch();
		}catch(PDOException $e){
			exit($e->getMessage());
		}
		
		return $result;
	}
    	public function addTagInfo($tag){
            
		
		
		try{
			$sql="insert into hashtag(tag)values (:tag)";
			$query=$this->db->prepare($sql);
            $query->bindValue(":tag",$tag,PDO::PARAM_STR);
			$query->execute();
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}
    
    	public function  addPhototagInfo($pidx,$tidx,$email){
		
		
		try{
			$sql="insert into photo_hash(photo_index,hash_index,email)values (:pidx,:tidx,:email)";
			$query=$this->db->prepare($sql);
            
            $query->bindValue(":pidx",$pidx,PDO::PARAM_INT);
            $query->bindValue(":tidx",$tidx,PDO::PARAM_INT);
            $query->bindValue(":email",$email,PDO::PARAM_STR);
			$query->execute();
			
		}catch(PDOException $e){
			exit($e->getMessage());
		}
	}
    
 

	
}



?>