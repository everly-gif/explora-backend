<?php

// print_r(explode('/',$_SERVER['REQUEST_URI']));
// $response =array("name"=>'Everly',"age"=>20);
// echo json_encode($response);


// include('./src/Connection.php');

// include('./src/controllers/MovieController.php');

// include('./src/gateways/MovieGateway.php');

// include('./src/controllers/ReviewController.php');

// include('./src/gateways/ReviewGateway.php');


spl_autoload_register(function($class_name){

    $path = null;

    if(str_contains($class_name,"Controller")){
     $path = "src/controllers/".$class_name.".php";
    }
    else if(str_contains($class_name,"Gateway")){
        $path = "src/gateways/".$class_name.".php";
    }
    else{
        $path = "src/".$class_name.".php";
    }
    include $path;
});

set_exception_handler('ErrorHandler::handleException');
$urlParts = explode('/',$_SERVER['REQUEST_URI']);

$id = $urlParts[3] ?? null;

header('Content-type:application/json;charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: *");


if($urlParts[2]==='movies')
{

$conn = new Connection();

$gateway = new MovieGateway($conn);

$controller = new MovieController($gateway);

$controller->handleRequest($_SERVER['REQUEST_METHOD'],$id);
// echo $gateway->index();
}
else if($urlParts[2]==='reviews'){
$conn = new Connection();

$gateway = new ReviewGateway($conn);

$controller = new ReviewController($gateway);

$controller->handleRequest($_SERVER['REQUEST_METHOD'],$id);
}
else if ($urlParts[2]==='subscribe'){
    $conn = new Connection();

    $gateway = new NewsLetterGateway($conn);
    
    $controller = new NewsLetterController($gateway);
    
    $controller->handleRequest($_SERVER['REQUEST_METHOD'],$id);
}

?>