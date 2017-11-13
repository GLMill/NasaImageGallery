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

class DataController extends BaseController
{
    
    public function __construct()
    {
        
        # the file AnimalModel.php connects to the database and via BaseModel.php and is called here in AnimalController so that the page executes. 
			$this->loadModel('DataModel');

	}
    
    
    
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    
    public function index()
    {
        
        $pageTitle = 'gallery';

        /*
        $animals = $this->model->getAllAnimals();
        
        if($animals){
            $pageTitle = 'All Animals';

        } else {
            $pageTitle = "Unknown Animals";
            $error = "No Record Found";

        }*/
        

        require APP . 'view/_templates/header.php';
        require APP . 'view/gallery/index.php';
        require APP . 'view/_templates/footer.php';
    }



    /*public function id($id){

         $animal = $this->model->getAnimal($id);

         if($animal){
             $pageTitle = $animal['name']; 
         } else {
             $pageTitle = "Unknown Animal Page";
             $error = "No Record Found";
         }
         


        require APP . 'view/_templates/header.php';
        require APP . 'view/animal/animal.php';
        require APP . 'view/_templates/footer.php';

    }*/

    


    
}
