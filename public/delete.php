<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
protect_page();

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM events WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}
header("Location: index.php");