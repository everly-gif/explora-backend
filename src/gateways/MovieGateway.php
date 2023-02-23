<?php

class MovieGateway{
    
    private $connection = null;

    public function __construct($connection){
        $this->connection= $connection->getConnection();
    }
    public function index(){
    
        $query = "SELECT * FROM movies";

        $result = $this->connection->query($query);
        
        $data = array();
        
        while($response = $result->fetch_assoc()){
          $data[] = $response;
        }

        return json_encode($data);
    }
    
    public function show($id){
      $query = "SELECT * FROM movies where id = $id";
      $result = $this->connection->query($query);
      $data = $result->fetch_assoc();
      return $data;
    } 

    public function create($movie){

        $name = $movie['name'];
        $release_date =$movie['release_date'];
        $rating = $movie['rating'];
        $description = $movie['description'];
        $genre = $movie['genre'];
        $cast = $movie['cast'];
        $runtime=$movie['runtime'];
        $query = "INSERT INTO movies(name,release_date,rating,description,genre,cast,runtime) VALUES ('$name','$release_date',$rating,'$description','$genre','$cast',$runtime)";

        $result = $this->connection->query($query);

        if($result) return true;
        else return false;
    }
    
     public function delete($id){
      $query = "DELETE FROM movies where id = $id";
      $result = $this->connection->query($query);
      if($result) return true;
      else return false;
     }

     public function update($movie,$id){
        $name = $movie['name'];
        $release_date =$movie['release_date'];
        $rating = $movie['rating'];
        $description = $movie['description'];
        $genre = $movie['genre'];
        $cast = $movie['cast'];
        $runtime=$movie['runtime'];
        $query="UPDATE movies SET name = '$name', release_date = '$release_date', rating = $rating, description = '$description', genre = '$genre',cast = '$cast', runtime = $runtime WHERE id =$id";
        $result = $this->connection->query($query);
        if($result) return true;
        else return false;
     }




}