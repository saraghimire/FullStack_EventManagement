<?php
require_once '../app/Models/UserModel.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        // Initialize the User Model
        $this->userModel = new UserModel($pdo);
    }

    public function login() {
        // If already logged in, send to dashboard
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 1. Get Input
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // 2. Ask Model for User
            $user = $this->userModel->findUserByUsername($username);

            // 3. Verify Password
            if ($user && password_verify($password, $user['password'])) {
                // Set Session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate new token on login
                $_SESSION['role'] = $user['role'];
                header("Location: index.php");
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        }

        // Render View
        $this->render('auth_view', ['type' => 'Login', 'error' => $error]);
    }

    public function signup() {
        // If already logged in, send to dashboard
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            if (!empty($username) && !empty($password)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                // Ask Model to Create User
                if ($this->userModel->createUser($username, $hash)) {
                    header("Location: index.php?page=login&msg=registered");
                    exit;
                } else {
                    $error = "Username already exists.";
                }
            } else {
                $error = "All fields are required.";
            }
        }

        // Render View
        $this->render('auth_view', ['type' => 'Signup', 'error' => $error]);
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }

    // Helper to load views 
    private function render($view, $data = []) {
        extract($data); // Converts ['error' => 'text'] into $error = 'text';
        
        require '../app/Views/layout/header.php';
        require "../app/Views/$view.php";
        require '../app/Views/layout/footer.php';
    }
}
?>