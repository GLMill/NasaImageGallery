<?php
class ActiveController extends UserController{

    public function __construct(){

        // already loads from user $this->loadModel('UserModel');

        if(!isset($_GET['email']) && !isset($_GET['key'])){
            $this->redirect('user/index');
        }

        if(isset($_GET['key']) && (strlen($_GET['key']==40))){
            $key =$_GET['key'];
        }

        if(isset($_GET['email'])&& filter_var(rawurldecode($_GET['email']), FILTER_VALIDATE_EMAIL)){
            $email=$_GET['email'];
        }

        $this->model->activation($email,$key);
        $this->redirect('user/index/confirm_registration');

    }




}?>