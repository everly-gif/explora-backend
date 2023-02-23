<?php

class ErrorHandler{

    public static function handleException(Throwable $e){
       http_response_code(500);
       echo json_encode(array(

        "message" => $e->getMessage(),
        "file" => $e->getFile(),
        "line" => $e->getLine(),
        "code" => $e->getCode()
       ));
    }
}