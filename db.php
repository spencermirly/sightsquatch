<?php
    require_once('user.php');

    enum CreateUserResult {
        case Success;
        case ServerError;
        case EmailTaken;
        case PasswordMismatch;
    }

    class DB {
        private $host = "localhost";
        private $db = "sightsquatch";
        private $user = "sightsquatch";
        private $password = "L!d5_(i@ywVh3EMn";

        public function connection() {
            return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->password);
        }

        public function fetchUser($email) {
            $conn = $this->connection();
            $stmt = $conn->prepare("
                SELECT * FROM Users
                WHERE email = :email;
            ");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($res)){
                return null;
            }
            return new User($res['id'], $res['username'], $res['email'], $res['pwHash'], $res['signupDate'], $res['isAdmin']);
        }

        public function createUser($username, $email, $password, $pwRetype, $isAdmin) {
            if($password !== $pwRetype){
                return CreateUserResult::PasswordMismatch;
            }
            if($this->fetchUser($email) == null){
                $pwHash = password_hash($password, PASSWORD_DEFAULT);
                $conn = $this->connection();
                $stmt = $conn->prepare("
                    INSERT INTO Users (username, email, pwHash, isAdmin)
                    VALUES (:username, :email, :pwHash, :isAdmin)
                ");
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":pwHash", $pwHash);
                $stmt->bindParam(":isAdmin", $isAdmin);
                return ($stmt->execute() ? CreateUserResult::Success : CreateUserResult::ServerError);
            }
            return CreateUserResult::EmailTaken;
        }

    }


?>