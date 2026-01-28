<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
protect_page();

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("INSERT IGNORE INTO registrations (event_id, user_id) VALUES (?, ?)");
    $stmt->execute([$_GET['id'], $_SESSION['user_id']]);
    header("Location: index.php?msg=joined");
}