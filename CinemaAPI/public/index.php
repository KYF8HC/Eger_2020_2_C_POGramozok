<?php


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

require '../includes/DbOperations.php';

$app = new \Slim\App([
    'settings'=>[
        'displayErrorDetails'=>true
    ]
]);
$app->post('/createuser', function(Request $request, Response $response){
    if(!haveEmptyParameters(array('email', 'password', 'name', 'access'), $request, $response)){
        $request_data = $request->getParsedBody(); 

        $email = $request_data['email'];
        $password = $request_data['password'];
        $name = $request_data['name'];
        $school = $request_data['access']; 

        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        
        $db = new DbOperations; 
        $result = $db->createUser($email, $hash_password, $name, $school);      
        
        if($result == USER_CREATED){
            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'User created successfully';
            $response->write(json_encode($message));
            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(201);
        }else if($result == USER_FAILURE){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occurred';
            $response->write(json_encode($message));
            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(423);    
        }else if($result == USER_EXISTS){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'User Already Exists';
            $response->write(json_encode($message));
            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    
        }
    }
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});
$app->post('/createprojection', function(Request $request, Response $response){
    if(!haveEmptyParameters(array('projection_date', 'room_id', 'movie_id'), $request, $response)){
        $request_data = $request->getParsedBody(); 

        $projection_date = $request_data['projection_date'];
        $room_id = $request_data['room_id'];
        $movie_id = $request_data['movie_id'];
        
        $db = new DbOperations; 
        $result = $db->createProjection($projection_date, $room_id, $movie_id);      
        
        if($result == PROJECTION_CREATED){
            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'Projection created successfully';
            $response->write(json_encode($message));
            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(201);
        }else if($result == PROJECTION_FAILURE){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occurred';
            $response->write(json_encode($message));
            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(423);    
        }else if($result == PROJECTION_EXISTS){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Projection Already Exists';
            $response->write(json_encode($message));
            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    
        }
    }
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});
$app->post('/createmovie', function(Request $request, Response $response){

    if(!haveEmptyParameters(array('name', 'description'), $request, $response)){

        $request_data = $request->getParsedBody(); 

        $name = $request_data['name'];
        $description = $request_data['description'];

        $db = new DbOperations;

        $result = $db->createMovie($name, $description);
        
        if($result == MOVIE_CREATED){

            $message = array(); 
            $message['error'] = false; 
            $message['message'] = 'Movie created successfully';

            $response->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(401);

        }else if($result == MOVIE_FAILURE){

            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Some error occurred';

            $response->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(423);    

        }else if($result == MOVIE_EXISTS){
            $message = array(); 
            $message['error'] = true; 
            $message['message'] = 'Movie Already Exists';

            $response->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);    
        }
    }
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});
$app->post('/userlogin', function(Request $request, Response $response){

    if(!haveEmptyParameters(array('email', 'password'), $request, $response)){
        $request_data = $request->getParsedBody(); 

        $email = $request_data['email'];
        $password = $request_data['password'];
        
        $db = new DbOperations; 

        $result = $db->userLogin($email, $password);

        if($result == USER_AUTHENTICATED){
            
            $user = $db->getUserByEmail($email);
            $response_data = array();

            $response_data['error']=false; 
            $response_data['message'] = 'Login Successful';
            $response_data['user']=$user; 

            $response->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);    

        }else if($result == USER_NOT_FOUND){
            $response_data = array();

            $response_data['error']=true; 
            $response_data['message'] = 'User not exist';

            $response->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);    

        }else if($result == USER_PASSWORD_DO_NOT_MATCH){
            $response_data = array();

            $response_data['error']=true; 
            $response_data['message'] = 'Invalid credential';

            $response->write(json_encode($response_data));

            return $response
                ->withHeader('Content-type', 'application/json')
                ->withStatus(200);  
        }
    }

    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);    
});
$app->get('/allusers', function(Request $request, Response $response){
    $db = new DbOperations; 
    $users = $db->getAllUsers();
    $response_data = array();
    $response_data['error'] = false; 
    $response_data['users'] = $users; 
    $response->write(json_encode($response_data));
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  
});
$app->get('/allmovies', function(Request $request, Response $response){
    $db = new DbOperations; 
    $movies = $db->getAllMovies();
    $response_data = array();
    $response_data['error'] = false; 
    $response_data['movies'] = $movies; 
    $response->write(json_encode($response_data));
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  
});
$app->get('/allprojections', function(Request $request, Response $response){
    $db = new DbOperations; 
    $projection = $db->getAllProjections();
    $response_data = array();
    $response_data['error'] = false; 
    $response_data['projections'] = $projection; 
    $response->write(json_encode($response_data));
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  
});
$app->put('/updatemovie/{id}', function(Request $request, Response $response, array $args){

    $id = $args['id'];

    if(!haveEmptyParameters(array('name','description'), $request, $response)){

        $request_data = $request->getParsedBody();

        $name = $request_data['name'];
        $description = $request_data['description']; 
     

        $db = new DbOperations; 

        if($db->updateMovie($name, $description, $id)){
            $response_data = array(); 
            $response_data['error'] = false; 
            $response_data['message'] = 'Movie updated successfully';
            $movie = $db->getMovieById($id);
            $response_data['movie'] = $movie; 

            $response->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);  
        
        }else{
            $response_data = array(); 
            $response_data['error'] = true; 
            $response_data['message'] = 'Please try again later';
            $movie = $db->getMovieById($id);
            $response_data['movie'] = $movie; 

            $response->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);       
        }
    }
    
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});
$app->put('/updateuser/{id}', function(Request $request, Response $response, array $args){

    $id = $args['id'];

    if(!haveEmptyParameters(array('email','name','access'), $request, $response)){

        $request_data = $request->getParsedBody(); 
        $email = $request_data['email'];
        $name = $request_data['name'];
        $access = $request_data['access']; 
     

        $db = new DbOperations; 

        if($db->updateUser($email, $name, $access, $id)){
            $response_data = array(); 
            $response_data['error'] = false; 
            $response_data['message'] = 'User Updated Successfully';
            $user = $db->getUserByEmail($email);
            $response_data['user'] = $user; 

            $response->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);  
        
        }else{
            $response_data = array(); 
            $response_data['error'] = true; 
            $response_data['message'] = 'Please try again later';
            $user = $db->getUserByEmail($email);
            $response_data['user'] = $user; 

            $response->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);       
        }
    }
    
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  

});
$app->put('/updateprojection/{id}', function(Request $request, Response $response, array $args){

    $id = $args['id'];

    if(!haveEmptyParameters(array('projection_date','room_id','movie_id'), $request, $response)){

        $request_data = $request->getParsedBody(); 
        $projection_date = $request_data['projection_date'];
        $room_id = $request_data['room_id'];
        $movie_id = $request_data['movie_id']; 
     

        $db = new DbOperations; 

        if($db->updateProjection($projection_date, $room_id, $movie_id, $id)){
            $response_data = array(); 
            $response_data['error'] = false; 
            $response_data['message'] = 'Projection updated successfully';
            $projection = $db->getProjectionById($id);
            $response_data['projection'] = $projection; 

            $response->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);  
        
        }else{
            $response_data = array(); 
            $response_data['error'] = true; 
            $response_data['message'] = 'Please try again later';
            $projection = $db->getProjectionById($id);
            $response_data['projection'] = $projection; 

            $response->write(json_encode($response_data));

            return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);       
        }
    }
    
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);  
});
$app->put('/updatepassword', function(Request $request, Response $response){

    if(!haveEmptyParameters(array('currentpassword', 'newpassword', 'email'), $request, $response)){
        
        $request_data = $request->getParsedBody(); 

        $currentpassword = $request_data['currentpassword'];
        $newpassword = $request_data['newpassword'];
        $email = $request_data['email']; 

        $db = new DbOperations; 

        $result = $db->updatePassword($currentpassword, $newpassword, $email);

        if($result == PASSWORD_CHANGED){
            $response_data = array(); 
            $response_data['error'] = false;
            $response_data['message'] = 'Password Changed';
            $response->write(json_encode($response_data));
            return $response->withHeader('Content-type', 'application/json')
                            ->withStatus(200);

        }else if($result == PASSWORD_DO_NOT_MATCH){
            $response_data = array(); 
            $response_data['error'] = true;
            $response_data['message'] = 'You have given wrong password';
            $response->write(json_encode($response_data));
            return $response->withHeader('Content-type', 'application/json')
                            ->withStatus(200);
        }else if($result == PASSWORD_NOT_CHANGED){
            $response_data = array(); 
            $response_data['error'] = true;
            $response_data['message'] = 'Some error occurred';
            $response->write(json_encode($response_data));
            return $response->withHeader('Content-type', 'application/json')
                            ->withStatus(200);
        }
    }

    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);  
});
$app->delete('/deleteuser/{id}', function(Request $request, Response $response, array $args){
    $id = $args['id'];
    $db = new DbOperations; 
    $response_data = array();
    if($db->deleteUser($id)){
        $response_data['error'] = false; 
        $response_data['message'] = 'User has been deleted';    
    }else{
        $response_data['error'] = true; 
        $response_data['message'] = 'Plase try again later';
    }
    $response->write(json_encode($response_data));
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
$app->delete('/deleteprojection/{id}', function(Request $request, Response $response, array $args){
    $id = $args['id'];
    $db = new DbOperations; 
    $response_data = array();
    if($db->deleteProjection($id)){
        $response_data['error'] = false; 
        $response_data['message'] = 'Projection has been deleted';    
    }else{
        $response_data['error'] = true; 
        $response_data['message'] = 'Plase try again later';
    }
    $response->write(json_encode($response_data));
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
$app->delete('/deletemovie/{id}', function(Request $request, Response $response, array $args){
    $id = $args['id'];
    $db = new DbOperations; 
    $response_data = array();
    if($db->deleteMovie($id)){
        $response_data['error'] = false; 
        $response_data['message'] = 'Movie has been deleted';    
    }else{
        $response_data['error'] = true; 
        $response_data['message'] = 'Plase try again later';
    }
    $response->write(json_encode($response_data));
    return $response
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});
function haveEmptyParameters($required_params, $request, $response){
    $error = false; 
    $error_params = '';
    $request_params = $request->getParsedBody(); 

    foreach($required_params as $param){
        if(!isset($request_params[$param]) || strlen($request_params[$param])<=0){
            $error = true; 
            $error_params .= $param . ', ';
        }
    }

    if($error){
        $error_detail = array();
        $error_detail['error'] = true; 
        $error_detail['message'] = 'Required parameters ' . substr($error_params, 0, -2) . ' are missing or empty';
        $response->write(json_encode($error_detail));
    }
    return $error; 
}
$app->run();