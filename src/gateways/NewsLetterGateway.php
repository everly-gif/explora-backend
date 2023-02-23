<?php 

class NewsLetterGateway{
    private $connection = null;

    public function __construct($connection){
        $this->connection= $connection->getConnection();
    }
 
    public function create($input){

        $email = $input['email'];

        $query = "INSERT INTO newsletter(email) values ('$email')";

        $result = $this->connection->query($query);

        if($result) return true;
        else return false;

       
    }

    
    
    

}