<?php

class Connection{

    private $conn = null;

    public function __construct(){
       
        $this->conn = new mysqli("localhost","root","root","movies_api");

        if(!$this->conn){
            echo $this->conn->error;
        }

    }

    public function getConnection(){
        return $this->conn;
    }
}
  