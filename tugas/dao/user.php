<?php
namespace DAO;

include_once 'models/user.php';
use Models\User;

class UserDAO {
    private $conn;

    public function __construct($conn = null) {
        $this->conn = $conn;
    }

    public function insert($username, $email, $password, $photo) {
        move_uploaded_file($_FILES['photo']['tmp_name'], 'assets/user_photo/'.$photo);
        $sql = "insert into users (username, email, password, photo) values(?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $password, $photo);
        
        $stmt->execute();
        
        $stmt->close();
    }

    public function getAll() {
        $users = [];
        
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $users[] = new User($row['id'], $row['username'], $row['photo']);
            }
        }

        return $users;
    }

    public function login($username, $password) {
        $user = null;
        
        $sql = "SELECT * FROM users where username = '$username' and password='$password'";
        $result = $this->conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $user = new User($row['id'], $row['username'], $row['photo']);
                break;
            }
        }

        return $user;
    }
}