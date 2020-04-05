<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require __DIR__ . '/../vendor/autoload.php';
require '../includes/DBConnect.php';

$app = new \Slim\App;

/*
    endpoint: createuser
    parameters: email, password, name, school
    method: POST
    */
$app->post('/createuser', function(Request $request, Response $response){

});

function haveEmptyParameters($required_params, $response){
    $error = false;
    $error_params = '';

    $request_params = $_REQUEST;

    foreach($request_params as $param){
        if(!isset($request_params[$param] || strlen($request_params[$param]) <= 0){

        }
    }
}
$app->run();