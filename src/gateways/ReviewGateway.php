<?php 

class ReviewGateway{
    private $connection = null;

    public function __construct($connection){
        $this->connection= $connection->getConnection();
    }
    public function index(){
    
        $query = "SELECT * FROM reviews";

        $result = $this->connection->query($query);
        
        $data = array();
        
        while($response = $result->fetch_assoc()){
          $data[] = $response;
        }

        return json_encode($data);
    }
    
    public function show($id){
      $query = "SELECT * FROM reviews where mid = $id ORDER BY created_at DESC";
      $result = $this->connection->query($query);
      while($response = $result->fetch_assoc()){
        $data[] = $response;
      }

      return $data;
    } 
   
    public function isEmailUnique($mid,$email){
        $query = "SELECT * FROM reviews where mid = $mid and email = '$email'";
        $result = $this->connection->query($query);
        if($result->num_rows==1){
            return false;
        }
        else{
            return true;
        }
     }
 
    public function create($review){

        $mid = $review['mid'];
        $review_content = $review['review'];
        $email = $review['email'];
        $rating = $review['rating'];
        if($this->isEmailUnique($mid,$email)){
        $query = "INSERT INTO reviews(mid,review,email,rating) VALUES ($mid,'$review_content','$email', $rating)";

        $result = $this->connection->query($query);

        if($result) return true;
        else return false;

        }
        else{
            return 'not unique';
        }
    }

    
    
     public function delete($id){
      $query = "DELETE FROM reviews where id = $id";
      $result = $this->connection->query($query);
      if($result) return true;
      else return false;
     }

     public function update($review,$id){
        $mid = $review['mid'];
        $review = $review['review'];
        $email = $review['email'];
        $rating = $review['rating'];
        $query="UPDATE movies SET mid = '$mid', review = '$review', email = $email, rating = $rating WHERE id =$id";
        $result = $this->connection->query($query);
        if($result) return true;
        else return false;
     }

}