<?php


class BaseModel
{
    # null Database Connection
  
    protected $db = null;

    
     # Whenever model is created, open a database connection.
     
    
    public function __construct()
    {
        # 'try' and 'catch' is a safety precaution in programming which checks if there is a problem in the 'try' section and letting us know if there is a problem. we can then print a specific message telling us what the problem may be. 
        #anything that we suspect may cause a problem we can write a 'try' and 'catch' function to help us be aware of any problems that could arise. 
        try {
            $this->openDatabaseConnection();
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

   
     # Open the database connection with the credentials from application/config/config.php
   
    private function openDatabaseConnection()
    {
        # set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        # "objects", which means all results will be objects, like this: $result->user_name !
        # For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        # @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        # generate a database connection, using the PDO connector
        # @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }
}
