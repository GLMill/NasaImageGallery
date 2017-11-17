<?php


/**
 * Class UserController
 *
 */

class UserController extends BaseController
{


public function __construct()
    {
			$this->loadModel('UserModel');

	}

public function index($status="")
    {
        $pageTitle = 'Login';

        if(isset($_POST['login'])){
               $errors = $this->validateLogin();        
        } 

		require APP . 'view/_templates/header.php';
		require APP . 'view/user/login.php';
		require APP . 'view/_templates/footer.php';

		# If user logged-in and user type the URL to login page then take them to profile (do this check after header file loaded, because of session_start)
		/*if($this->is_loggedin()){

			if($_SESSION['user_session']['role']=='Admin'){

				 	$this->redirect('admin');
				
			} else if(($_SESSION['user_session']['role']=='User')){
					
					 $this->redirect('profile');
			}

	  	}*/
			
    }

public function validateLogin(){

			$email =  $this->filterUserInput($_POST['email']);
			$password =  $this->filterUserInput($_POST['password']);


				if($email=="" )	{
					$errors[] = "Please enter email id!";

				} else if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
						$errors[] = 'Please enter a valid email address !';

					}
				if($password=="")	{
					$errors[] = "Please enter password !";

					} else if(!$this->model->doLogin($email,$password)){

						$errors[] = "Sorry invalid Login details !";

                    }

	if(isset($errors)){
		return $errors;
	} else {
		session_start();
		$_SESSION['user_session'] = $this->model->doLogin($email,$password);
		
		// lets check this works
		if($_SESSION['user_session']['active'] != 'active'){
			$this->redirect('user/index/confirm_inactive');
			unset($_SESSION['user_session']);
		};
		
		
	}



}

public function register()
    {
        $pageTitle = 'Register';

		 if(isset($_POST['register'])){
               $errors = $this->validateRegister();
		 } 
			 
		require APP . 'view/_templates/header.php';
		require APP . 'view/user/register.php';
		require APP . 'view/_templates/footer.php';


				
	}

public function validateRegister(){

			$userName = $this->filterUserInput($_POST['userName']);
			$email = $this->filterUserInput($_POST['email']);
			$password = $this->filterUserInput($_POST['password']);
			$retypePassword = $this->filterUserInput($_POST['retypePassword']);
			

			if($userName=="")	{
				$errors[]= "Please enter user name!!";
			}

			 if($email=="")	{
				$errors[] = "Please enter email !";
			}
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL))	{
				$errors[] = "Please enter a valid email address !";
			}

			 else if($this->model->checkEmailExists($email))
			{
				$errors[] = "Sorry email id already taken !";

			}

			if($password=="")	{
				$errors[] = "Please enter Password !";
			}
			else if(!preg_match('/\w{7}(\d+)/', $password)){
				$errors[] = "Password must contain letters, at least one number and 8 characters long!";
			}
			else if($password != $retypePassword){
				$errors[]='Passwords do not match!';
			}

			## Google captcha

			if(isset($_POST['g-recaptcha-response'])){
				$captcha = $_POST['g-recaptcha-response'];
			}
			if(!$captcha){
				$errors[]="invalid captcha";
			}

			$secretKey ="6LdCPjgUAAAAANdTShXHJLfuy_HTujo-YJqxduS5";
			$ip =$_SERVER['REMOTE_ADDR'];

			$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
			$responseKeys = json_decode($response, true);

			if(intval($responseKeys['success'])!== 1){
				$errors[]= "please complete captcha";
			}




			if(isset($errors)){
				return $errors;
			} else {

				## making activation variable that will be checked on activation
				$activation = sha1(uniqid(rand(),true));

				#need to edit model
				$this->model->registerUser($userName,$email,$password,$activation);
				$this->emailValidation($email,$activation);
				$this->redirect('user/index/confirm_inactive');
				
			}


}



	#email activation for account 

	public function emailValidation($email,$activation){
		$to = $email;
		$subject = "Activate Your Account";
		$headers = "MIME_Version: 1.0"."\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1"."\r\n";
		$headers .= "To: ".$email."\r\n";
		$headers .= "From: georgiamillardccm@gmail.com"."\r\n";

		$message = "<html><head></head><body>
				<h1> Hello users! </h1>
				<p> Thankyou for joining, to activate your accout please click the link below </p>";
		$message .= "<a href='https:".URL . "user/activate/" . urlencode($email)."/".$activation."'>"
					           ."https:".URL."user/activate/".urlencode($email)."/".$activation."</a>";
				
		mail($to, $subject, $message, $headers);
		echo $message;
	}


	public function activate($email,$activation){


       echo "<hr>";
	   echo $email."<br>";
	   echo $activation."<br>";


	  if($this->model->activation($email, $activation)){
		$this->redirect('user/index/confirm_activation');
	  }
	   




	}



	# Sanitising user input

	public function filterUserInput($data) {

		// trim() function will remove whitespace from the beginning and end of string.
		$data = trim($data);

		// Strip HTML and PHP tags from a string
		$data = strip_tags($data);

		/* The stripslashes() function removes backslashes added by the addslashes() function.
			Tip: This function can be used to clean up data retrieved from a database or from an HTML form.*/
		$data = stripslashes($data);

		// htmlspecialchars() function converts special characters to HTML entities. Say '&' (ampersand) becomes '&amp;'
		$data = htmlspecialchars($data);
		return $data;

	} # End of filter_user_input function



}
