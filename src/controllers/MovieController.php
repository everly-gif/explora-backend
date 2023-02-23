<?php

class MovieController{
   
    private $movie = null;
    public function __construct($gateway){
       $this->movie = $gateway;
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
       
        switch($method){
            case 'GET':
                {
                   $response = $this->movie->show($id);
                   echo json_encode($response);
                   break;
                }
            case 'DELETE':{
                $response = $this->movie->delete($id);
                if($response){
                    echo json_encode(array("success"=>true,"message"=>"Movie Deleted"));
                }
                else{
                    echo json_encode(array("success"=>false,"message"=>"Error"));
                }
                break;
            }
            case 'PATCH':
            case 'PUT':{
                $movies = (array)json_decode(file_get_contents('php://input'), true);
                $response = $this->movie->update($movies,$id);
                if($response){
                    echo json_encode(array("success"=>true,"message"=>"Movie Updated"));
                }
                else{
                    echo json_encode(array("success"=>false,"message"=>"Error"));
                }
                break;
            }
          
        }
        
        

    }
    
    public function processRequest($method){

       switch ($method){
          case 'GET':
            $response = $this->movie->index();
            echo $response;
            break;
          case 'POST':
            $movies = (array)json_decode(file_get_contents('php://input'), true); //associate array
            $response = $this->movie->create($movies);
            if($response){
                echo json_encode(array("success"=>true,"message"=>"Movie Created"));
            }
            else{
                echo json_encode(array("success"=>false,"message"=>"Error"));
            }
            break;
          
       }

    }


}