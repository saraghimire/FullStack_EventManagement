<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/template_helper.php';

$error = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    if (!empty($user) && !empty($pass)) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$user, $hash]);
            header("Location: login.php?msg=registered");
            exit;
        } catch (PDOException $e) {
            $error = "Username already exists.";
        }
    } else {
        $error = "All fields are required.";
    }
}

include '../includes/header.php';
// IMPORTANT: The key below must be 'type' to match the template
echo render('auth_view', ['type' => 'Signup', 'error' => $error]);
include '../includes/footer.php';