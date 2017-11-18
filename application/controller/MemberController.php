<?php


//use Opeldo\Core\Controller;
/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

class MemberController extends BaseController
{
    
    public function __construct()
    {
        
        # the file AnimalModel.php connects to the database and via BaseModel.php and is called here in AnimalController so that the page executes. 
			$this->loadModel('MemberModel');

	}
    
    
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    
    public function index()
    {
        
        $pageTitle = 'member area';

        //this works :
        $this->save();
        


        // sql join user_image to image liked on image id and where user id = user id ?

        //THIS IS WHERE WE'D GET ALL THE POSTS

        /*
        $animals = $this->model->getAllAnimals();
        
        if($animals){
            $pageTitle = 'All Animals';

        } else {
            $pageTitle = "Unknown Animals";
            $error = "No Record Found";

        }*/
        

        require APP . 'view/_templates/header.php';
        require APP . 'view/member/index.php';
        require APP . 'view/_templates/footer.php';
    }


    public function ajaxUserUpdate()
    {
        $pageTitle = 'Edit User';

       
                $id = $_POST['user_id'];
                $firstName = $_POST['firstname'];
                $lastName = $_POST['lastname'];
                $email = $_POST['email'];
                $joining_date = date("Y-m-d",strtotime($_POST['joining_date']));
                $role = $_POST['role'];
                $status = $_POST['status'];


                 $this->model->updateUser($id, $firstName, $lastName,$email, $joining_date, $role, $status);
                 $userDetails = $this->model->getUserDetails($id);
                 $userDetails['joining_date'] = date("d/m/Y", strtotime($userDetails['joining_date']));
                 echo json_encode($userDetails);
           

    }




    public function save(){
        $pageTitle = 'saved Images';

        $title = 'bobby';
        $dateTitle = 'hey there'; //$_POST['dateTitle'];
        $explanation ='suesie stone';// $_POST['explanation'];


        //ok so this is inserting into the imageLiked database
        if(!$this->model->checkImageExists($dateTitle)){
            $this->model->insertImage($title, $dateTitle);
        }
        else{
            echo 'This already exists';
        }
    }
  
}
