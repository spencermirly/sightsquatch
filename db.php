<?php
    require_once('user.php');

    enum CreateUserResult {
        case Success;
        case ServerError;
        case EmailTaken;
        case PasswordMismatch;
        case InvalidEmail;
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
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return CreateUserResult::InvalidEmail;
            }
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

        public function fetchPosts($num, $skip = 0, $orderBy = "postDate") {
            $conn = $this->connection();
            $stmt = $conn->prepare("
                SELECT p.*, u.username, COUNT(c.id) AS comments FROM Posts p
                JOIN Users u ON p.posterID = u.id
                LEFT JOIN Comments c ON c.postID = p.id
                GROUP BY p.id
                ORDER BY :orderBy
                LIMIT :num OFFSET :skip
            ");
            $stmt->bindParam(":orderBy", $orderBy);
            $stmt->bindParam(":num", $num, PDO::PARAM_INT);
            $stmt->bindParam(":skip", $skip, PDO::PARAM_INT);
            return ($stmt->execute() ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array());
        }

        public function fetchPost($id) {
            $conn = $this->connection();
            $stmt = $conn->prepare("
                SELECT p.*, u.username, COUNT(c.id) AS comments FROM Posts p
                JOIN Users u ON p.posterID = u.id
                LEFT JOIN Comments c ON c.postID = p.id
                WHERE p.id = :id
                GROUP BY p.id

            ");
            $stmt->bindParam(":id", $id);
            return ($stmt->execute() ? $stmt->fetch(PDO::FETCH_ASSOC) : null);
        }

        public function createPost($title, $body, $date, $location, $posterID) {
            $conn = $this->connection();
            $stmt = $conn->prepare("
                INSERT INTO Posts (title, body, sightingDate, sightingLoc, posterID)
                VALUES (:title, :body, :date, :location, :posterID)
            ");
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":body", $body);
            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":location", $location);
            $stmt->bindParam(":posterID", $posterID);
            return ($stmt->execute() ? $conn->lastInsertId() : -1);
        }

        public function fetchComments($postID) {
            $conn = $this->connection();
            $stmt = $conn->prepare("
                SELECT c.*, u.username FROM Comments c
                JOIN Users u ON c.posterID = u.id
                WHERE postID = :postID
                ORDER BY commentDate DESC
            ");
            $stmt->bindParam(":postID", $postID);
            return ($stmt->execute() ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array());
        }

        public function createComment($postID, $posterID, $body) {
            $conn = $this->connection();
            $stmt = $conn->prepare("
                INSERT INTO Comments (body, postID, posterID)
                VALUES (:body, :postID, :posterID)
            ");
            $stmt->bindParam(":body", $body);
            $stmt->bindParam(":postID", $postID);
            $stmt->bindParam(":posterID", $posterID);
            return $stmt->execute();
        }

        public function addImageToPost($id, $path) {
            $conn = $this->connection();
            $stmt = $conn->prepare("
                INSERT INTO PostImages (postID, imgPath)
                VALUES (:postID, :imgPath)
            ");
            $stmt->bindParam(":postID", $id);
            $stmt->bindParam(":imgPath", $path);
            return $stmt->execute();
        }

        public function fetchImages($id) {
            $conn = $this->connection();
            $stmt = $conn->prepare("
                SELECT imgPath FROM PostImages
                WHERE postID = :postID
            ");
            $stmt->bindParam(":postID", $id);
            return ($stmt->execute() ? $stmt->fetchAll(PDO::FETCH_ASSOC) : array());
        }
    }
?>