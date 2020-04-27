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


        private function isEmailExist($email){
            $stmt = $this->con->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute(); 
            $stmt->store_result(); 
            return $stmt->num_rows > 0;  
        }
    }