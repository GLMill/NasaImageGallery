<?php

class UserModel extends BaseModel
{
   public $error = Array();

   public function checkEmailExists($email){
	   try {
			$stmt = $this->db->prepare("SELECT email FROM user WHERE email=:email");
			$stmt->execute(array(':email'=>$email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
							
						
			if($row['email']==$email) {
			return true;
			} else {
				return false;
			}

	   } catch(PDOException $e) {
			echo $e->getMessage();
		}

        
   }

public function registerUser($userName, $email, $password, $activation)
	{
		try
		{	
			
			$password = sha1($password);
			$stmt = $this->db->prepare("INSERT INTO user(user_name, email, password, active) 
													   VALUES(:userName, :email, :password, :active)");
													   							  
			$stmt->execute(array(':userName'=>$userName,':email'=>$email,':password'=>$password, ':active'=>$activation));							  
				
		} catch(PDOException $e) {
			echo $e->getMessage();
		}				
	}
	



	# modify to check for users marked as active
	
	public function doLogin($email,$password)
	{
		   $password = sha1($password);
			$stmt = $this->db->prepare("SELECT * FROM user WHERE email=:email AND password =:password AND active='active'");
			$stmt->execute(array(':email'=>$email, ':password'=>$password));
			
			$userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

			# how do we add the error message about the need to activate your account?
		
		try {	
						
			if($stmt->rowCount() == 1)
			{       
				return $userDetails;	
			} else {
				return false;
			}

		} catch(PDOException $e) {
				echo $e->getMessage();
			}
		
		
		
		}


	public function activation($email, $activation){
		#we prepare the statment and add through an array for better security
		$stmt = $this->db->prepare("UPDATE user SET active ='active' WHERE(email=:email AND active=:activation) LIMIT 1");
		$stmt ->execute(array(':email'=>$email, ':activation'=>$activation));

	}
		


	
}
