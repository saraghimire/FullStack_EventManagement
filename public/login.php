<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/template_helper.php';


// If already logged in, go to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}

include '../includes/header.php';
// IMPORTANT: The key below must be 'type' to match the template
echo render('auth_view', ['type' => 'Login', 'error' => $error]);
include '../includes/footer.php';