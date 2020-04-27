<?php 

    class DbOperations{

        private $con; 

        function __construct(){
            require_once dirname(__FILE__) . '/DbConnect.php';
            $db = new DbConnect; 
            $this->con = $db->connect(); 
        }

        public function createMovie($name, $description){
                $stmt = $this->con->prepare("INSERT INTO moovies (name, description) VALUES (?, ?)");
                $stmt->bind_param("ss", $name, $description);
                if($stmt->execute()){
                    return MOVIE_CREATED; 
                }else{
                    return MOVIE_FAILURE;
                }
        }
        public function createProjection($projection_date, $room_id, $movie_id){
            if(!$this->isProjectionExist($projection_date, $room_id)){
                 $stmt = $this->con->prepare("INSERT INTO projection (projection_date, room_id, movie_id) VALUES ( ?, ?, ?)");
                 $stmt->bind_param("sii", $projection_date, $room_id, $movie_id);
                 if($stmt->execute()){
                     return PROJECTION_CREATED; 
                 }else{
                     return PROJECTION_FAILURE;
                 }
            }
            return PROJECTION_EXISTS; 
        }
        public function createUser($email, $password, $name, $access){
            if(!$this->isEmailExist($email)){
                 $stmt = $this->con->prepare("INSERT INTO users (email, password, name, access) VALUES (?, ?, ?, ?)");
                 $stmt->bind_param("sssi", $email, $password, $name, $access);
                 if($stmt->execute()){
                     return USER_CREATED; 
                 }else{
                     return USER_FAILURE;
                 }
            }
            return USER_EXISTS; 
        }
        public function userLogin($email, $password){
            if($this->isEmailExist($email)){
                $hashed_password = $this->getUsersPasswordByEmail($email); 
                if(password_verify($password, $hashed_password)){
                    return USER_AUTHENTICATED;
                }else{
                    return USER_PASSWORD_DO_NOT_MATCH; 
                }
            }else{
                return USER_NOT_FOUND; 
            }
        }
        private function getUsersPasswordByEmail($email){
            $stmt = $this->con->prepare("SELECT password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute(); 
            $stmt->bind_result($password);
            $stmt->fetch(); 
            return $password; 
        }
        public function getAllMovies(){
            $stmt = $this->con->prepare("SELECT id, name, description FROM moovies;");
            $stmt->execute(); 
            $stmt->bind_result($id, $name, $description);
            $movies = array(); 
            while($stmt->fetch()){ 
                $movie = array(); 
                $movie['id'] = $id; 
                $movie['name'] = $name; 
                $movie['description'] = $description; 
                array_push($movies, $movie);
            }             
            return $movies; 
        }
        public function getAllUsers(){
            $stmt = $this->con->prepare("SELECT id, email, name, access FROM users;");
            $stmt->execute(); 
            $stmt->bind_result($id, $email, $name, $access);
            $users = array(); 
            while($stmt->fetch()){ 
                $user = array(); 
                $user['id'] = $id; 
                $user['email']=$email; 
                $user['name'] = $name; 
                $user['access'] = $access; 
                array_push($users, $user);
            }             
            return $users; 
        }
        public function getUserByEmail($email){
            $stmt = $this->con->prepare("SELECT id, email, name, access FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute(); 
            $stmt->bind_result($id, $email, $name, $access);
            $stmt->fetch(); 
            $user = array(); 
            $user['id'] = $id; 
            $user['email']=$email; 
            $user['name'] = $name; 
            $user['access'] = $access; 
            return $user; 
        }
        public function getMovieById($id){
            $stmt = $this->con->prepare("SELECT id, name, description FROM moovies WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute(); 
            $stmt->bind_result($id, $name, $description);
            $stmt->fetch(); 
            $movie = array(); 
            $movie['id'] = $id;
            $movie['name'] = $name; 
            $movie['description'] = $description; 
            return $movie; 
        }
        public function getProjectionById($id){
            $stmt = $this->con->prepare("SELECT id, projection_date, room_id, movie_id FROM projection WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute(); 
            $stmt->bind_result($id, $projection_date, $room_id, $movie_id);
            $stmt->fetch(); 
            $projection = array(); 
            $projection['id'] = $id;
            $projection['projection_date'] = $projection_date; 
            $projection['room_id'] = $room_id; 
            $projection['movie_id'] = $movie_id;
            return $projection; 
        }
        public function updateUser($email, $name, $access, $id){
            $stmt = $this->con->prepare("UPDATE users SET email = ?, name = ?, access = ? WHERE id = ?");
            $stmt->bind_param("ssii", $email, $name, $access, $id);
            if($stmt->execute())
                return true; 
            return false; 
        }
        public function updateMovie($name, $description, $id){
            $stmt = $this->con->prepare("UPDATE moovies SET name = ?, description = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $description, $id);
            if($stmt->execute())
                return true; 
            return false; 
        }
        public function updateProjection($projection_date, $room_id, $movie_id, $id){
            $stmt = $this->con->prepare("UPDATE projection SET projection_date = ?, room_id = ?, movie_id = ? WHERE id = ?");
            $stmt->bind_param("siii", $projection_date, $room_id, $movie_id, $id);
            if($stmt->execute())
                return true; 
            return false; 
        }
        public function updatePassword($currentpassword, $newpassword, $email){
            $hashed_password = $this->getUsersPasswordByEmail($email);           
            if(password_verify($currentpassword, $hashed_password)){            
                $hash_password = password_hash($newpassword, PASSWORD_DEFAULT);
                $stmt = $this->con->prepare("UPDATE users SET password = ? WHERE email = ?");
                $stmt->bind_param("ss",$hash_password, $email);
                if($stmt->execute())
                    return PASSWORD_CHANGED;
                return PASSWORD_NOT_CHANGED;
            }else{
                return PASSWORD_DO_NOT_MATCH; 
            }
        }
        public function deleteUser($id){
            $stmt = $this->con->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            if($stmt->execute())
                return true; 
            return false; 
        }
        public function deleteMovie($id){
            $stmt = $this->con->prepare("DELETE FROM moovies WHERE id = ?");
            $stmt->bind_param("i", $id);
            if($stmt->execute())
                return true; 
            return false; 
        }
        private function isProjectionExist($projection_date, $room_id){
            $stmt = $this->con->prepare("SELECT id FROM projection WHERE projection_date = ? AND room_id = ?");
            $stmt->bind_param("si", $projection_date, $room_id);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0;  
        }
        private function isEmailExist($email){
            $stmt = $this->con->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0;  
        }
    }