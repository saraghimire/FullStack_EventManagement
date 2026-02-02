<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Find a user by their username (for Login)
    public function findUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    // Create a new user (for Signup)
    public function createUser($username, $passwordHash) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt->execute([$username, $passwordHash, $role]);
         //   return $stmt->execute([$username, $passwordHash]);
        } catch (PDOException $e) {
            // Usually error 23000 means duplicate entry (username taken)
            return false;
        }
    }
    
    public function get_all_users() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
    
    public function delete_user($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    public function update_user_role($id, $role) {
        $stmt = $this->pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        return $stmt->execute([$role, $id]);
    }
}
?>