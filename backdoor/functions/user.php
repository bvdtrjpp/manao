<?php


    class User {
        private $id;
        private static $currentId = 0;
        private $login;
        private $name;
        private $email;
        private $password;
        private $salt;
     
        public function __construct($login = '', $name = '', $email = '', $password = '') {
         
            $this->salt = $this->generateSalt();
            $this->login = $login;
            $this->name = $name;
            $this->email = $email;
            $this->password = $this->hashPassword($password, $this->salt);

        }


     
         private function generateSalt() {
            return rand(10000, 20000);
         }
     
         private function hashPassword($password, $salt) {
            return md5($password . $salt);
         }
      
        public function getId() {
            return $this->id;
         }
      
         public function getLogin() {
            return $this->login;
         }
      
         public function getName() {
            return $this->name;
         }
     
         public function getEmail() {
            return $this->email;
         }

         public function getPassword(){
            return $this->password;
         }

         public function getSalt(){
            return $this->salt;
        }



}



