<?php
session_start();

// XSS Protection
function e($text) {
    return htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
}

// Auth Guard
function protect_page() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
}

// CSRF Protection
function get_token() {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function verify_token($token) {
    return isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}