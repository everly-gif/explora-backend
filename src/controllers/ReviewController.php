<?php

class ReviewController{
   
    private $review= null;
    public function __construct($gateway){
       $this->review = $gateway;
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
                   $response = $this->review->show($id);
                   echo json_encode($response);
                   break;
                }
            case 'DELETE':{
                $response = $this->review->delete($id);
                if($response){
                    echo json_encode(array("success"=>true,"message"=>"Review Deleted"));
                }
                else{
                    echo json_encode(array("success"=>false,"message"=>"Error"));
                }
                break;
            }
            case 'PATCH':
            case 'PUT':{
                $movies = (array)json_decode(file_get_contents('php://input'), true);
                $response = $this->review->update($movies,$id);
                if($response){
                    echo json_encode(array("success"=>true,"message"=>"Review Updated"));
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
            $response = $this->review->index();
            echo $response;
            break;
          case 'POST':
            $reviews = (array)json_decode(file_get_contents('php://input'), true); //associate array
            $response = $this->review->create($reviews);
            if($response === 'not unique'){
                echo json_encode(array("success"=>false,"message"=>"You have already posted an review for this movie"));
            }
            else if($response){
                echo json_encode(array("success"=>true,"message"=>"Review Posted"));
            }
            else{
                echo json_encode(array("success"=>false,"message"=>"Error"));
            }
            break;
          
       }

    }


}