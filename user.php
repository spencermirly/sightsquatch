<?php
    class User {
        public $id;
        public $username;
        public $email;
        public $pwHash;
        public $signupDate;
        public $isAdmin;

        public function __construct($id, $username, $email, $pwHash, $signupDate, $isAdmin) {
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
            $this->pwHash = $pwHash;
            $this->signupDate = $signupDate;
            $this->isAdmin = $isAdmin;
        }

        public function authenticate($email, $password) {
            return ($this->email === $email && password_verify($password, $this->pwHash));
        }


    }
?>