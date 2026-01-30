<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
protect_page();

$event_id = $_GET['id'] ?? null;
if ($event_id) {
    try {
        $stmt = $pdo->prepare("INSERT INTO registrations (event_id, user_id) VALUES (?, ?)");
        $stmt->execute([$event_id, $_SESSION['user_id']]);
        echo "<script>alert('Joined successfully!'); window.location='index.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('You are already registered.'); window.location='index.php';</script>";
    }
}