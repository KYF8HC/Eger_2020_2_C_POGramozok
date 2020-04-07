<?php
    class DBOperations{
        private $con;

        function __construct(){
           require_once dirname(__FILE__).'/DBConnect.php';
            $db = new DBConnecnt;
            $this->con = $db->connect();
        }

        public function createUser($email, $password, $name, $access){
           if(!$this->isEmailExists($email)){
                $stmt = $this->con->prepare("INSERT INTO users (email, password, name, access) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $email, $password, $name, $access);
                if($stmt->execute()){
                    return USER_CREATED;
                }else {
                    USER_FAILURE;
                }
           }
           return USER_EXISTS;
        }

        public function userLogin($email, $password){
            if($this->isEmailExists($email)){
                $hased_password = getUsersPasswordByEmail($email);
                if(password_verify($password, $hased_password)){
                    return USER_AUTHENTICATED;
                }
                else{
                    return USER_PASSWORD_DO_NOT_MATCH;
                }

            }else {
                return USER_NOT_FOUND;
            }
        }   

        private function getUsersPasswordByEmail($email){
            $stmt = $this->con->prepare("SELECT password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($password);
            $stmt-> fetch();
            return $password;
        }

         private function getUserByEmail($email){
            $stmt = $this->con->prepare("SELECT id, email, name, access FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id, $email, $name, $access);
            $stmt-> fetch();
            $user = array();
            $user['id'] = $id;
            $user['email'] = $email;
            $user['name'] = $name;
            $user['access'] = $acces;
            return $user;
        }

        private function isEmailExists($email){
            $stmt = $this->con->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }
    }