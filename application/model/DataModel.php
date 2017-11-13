<?php

class DataModel extends BaseModel
{
   public $error = Array();


 /*
   public function getAllPosts() {

			$sql = "SELECT * FROM data";
			$stmt = $this->db->prepare($sql);
        	$stmt->execute();
			$posts = $stmt->fetchAll();
			

			if($stmt->rowCount() > 0){ # we could also use count($animals);
				return $posts;
			} else {
				return false;
			} 

	}

	public function getPost($id) {		

			$stmt = $this->db->prepare("SELECT * FROM data WHERE id=:id");
        	$stmt->execute(array(':id'=>$id));
			# Even though we set our PDO "fetch mode" as an object still we can access the record as an associative array.
			# So just for testing purpose this time I will fetch tem as an associative array. using  PDO::FETCH_ASSOC (PDO Statement)
        	$post = $stmt->fetch(PDO::FETCH_ASSOC);
		
			if($post['id'] == $id) {
				
				return $post;
			} else {
				return false;
			}
				
			 
	}


	public function addToPosts($title, $img, $date, $details){
		$sql = "INSERT INTO data(ImgDate,Title,Img,Details) SELECT $date, $title, $img, $details";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();*/

	
		public function checkImgExists($date, $title){
			try {
				 $stmt = $this->db->prepare("SELECT imgDate FROM img_liked WHERE imgDate =:imgDate");
				 $stmt->execute(array(':imgDate'=>$date));
				 $row = $stmt->fetch(PDO::FETCH_ASSOC);
								 
				
				 // wait i think this maybe reading the row 
				 if($row['imgDate']==$date) { // if does already exist then change likes
				 //return true;
				 // turning id into a variable to be passed
				 $imgID = $row['id'];
				 $this-> addSaves($imgID);
				 //need to add user id
				 $this-> pairToUser($imgID);
				 } else {
					 //return false;
					 $this->saveImg($date, $title);
					 $this->pairToUser($imgID);
				 }
				 
	 
			} catch(PDOException $e) {
				 echo $e->getMessage();
			 }
	 
			 
		}


		public function saveImg($date, $title){
			try{
			$likes =1;
			$stmt = $this->db->prepare("INSERT INTO img_liked(img_date, title, likes) VALUES (:img_date, :title, :likes)");
			$stmt->execute(array(':imgDate'=>$date, ':title'=>$title, ':likes'=>$likes));
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		// ok how are we getting the user ID here? when logging on.. hows it passed in MVC
		public function pairToUser($userID, $imgID){
			try{
				$stmt =$this->db->prepare("INSERT INTO user_img_liked(user_id,like_id) VALUES (:user_id, :img_id)");
				$stmt-> execute(array(':user_id'=>$userID, ':img_id'=>$imgID));
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function addSaves($imgID){

			try{
			$stmt = $this->db->prepare("SELECT likes FROM img_liked WHERE id =:imgID");
			$stmt->execute(array(':imgID'=>$imgID));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$likes = $row['likes'];
			$likes++;
			$stmt =$this->db->prepare("INSERT INTO img_liked(likes) VALUES (:likes) WHERE id = :img_id");
			$stmt-> execute(array(':likes'=>$likes, ':img_id'=>$imgID));
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

		}
	}




	
	
