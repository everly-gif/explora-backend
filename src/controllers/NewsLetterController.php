<?php

class NewsLetterController{
   
    private $news = null;
    public function __construct($gateway){
       $this->news = $gateway;
    }
    public function handleRequest($method, $id){

        if($id!==null){

            $this->processResourceRequest($method,$id);
        }
        else{
            $this->processRequest($method);
        }

    }

    public function processResourceRequest($method,$id){
       
    
        
        

    }
    
    public function processRequest($method){

       switch ($method){
          
          case 'POST':
            $input= (array)json_decode(file_get_contents('php://input'), true); //associate array
            $response = $this->news->create($input);
            if($response){
                echo json_encode(array("success"=>true,"message"=>"Subscription Successful"));
            }
            else{
                echo json_encode(array("success"=>false,"message"=>"Error"));
            }
            break;
          
       }

    }


}