<?php
session_start();

// 1. XSS Protection (Escaping output)
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// 2. CSRF Protection (Generate Token)
function get_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// 3. CSRF Protection (Verify Token)
function verify_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>