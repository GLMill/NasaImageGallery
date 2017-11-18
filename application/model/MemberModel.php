<?php

class MemberModel extends BaseModel
{
   public $error = Array();

   // fetch and display saves


   // save to user_img

   public function insertImage($title, $dateTitle)
   {
       try
       {	
           
           $stmt = $this->db->prepare("INSERT INTO img_liked(imgDate, title) 
                                                      VALUES(:img_date, :title)");                                                                     
           $stmt->execute(array(':img_date'=>$dateTitle,':title'=>$title));							  
               
       } catch(PDOException $e) {
           echo $e->getMessage();
       }				
   }


   // save to img saved // need to get controller to check for this 
   public function checkImageExists($date){
    try {
         $stmt = $this->db->prepare("SELECT * FROM img_liked WHERE imgDate =:imgDate");
         $stmt->execute(array(':imgDate'=>$date));
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
                         
                     
         if($row['imgDate']==$date) {
         return true;
         } else {
             return false;
         }

    } catch(PDOException $e) {
         echo $e->getMessage();
     }

}

public function checkPairExists($user_id, $image_id){
    try {
        $stmt = $this->db->prepare("SELECT * FROM user_img_liked WHERE image_id =:image_id AND user_id = :user_id");
        $stmt->execute(array(':image_id'=>$image_id, ':user_id'=>$user_id));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                    
        if($row['user_id']==$user_id) {
        return true;
        } else {
            return false;
        }

   } catch(PDOException $e) {
        echo $e->getMessage();
    }

}

public function matchUserImg($user_id, $image_id){

       try
       {	
           
           $stmt = $this->db->prepare("INSERT INTO user_img_liked(user_id, image_id) 
                                                      VALUES(:user_id, :image_id)");                                                                     
           $stmt->execute(array(':user_id'=>$user_id,':image_id'=>$image_id));							  
               
       } catch(PDOException $e) {
           echo $e->getMessage();
       }	
}


	
}
