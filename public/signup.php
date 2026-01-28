<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/template_helper.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hash]);
            header("Location: login.php?msg=success");
            exit;
        } catch (PDOException $e) {
            // This checks if the error is actually a "Duplicate Entry" (Code 23000)
            if ($e->getCode() == 23000) {
                $error = "Username '$username' is already taken.";
            } else {
                // If it's another error (like a missing table), it will show the real message
                $error = "Database Error: " . $e->getMessage();
            }
        }
    } else {
        $error = "Please fill in both fields.";
    }
}

include '../includes/header.php';
echo render('auth_view', ['type' => 'Signup', 'error' => $error]);
include '../includes/footer.php';