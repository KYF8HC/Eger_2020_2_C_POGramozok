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

        private function isEmailExists($email){
            $stmt = $this->con->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }
    }