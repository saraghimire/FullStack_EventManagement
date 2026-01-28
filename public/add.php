<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/template_helper.php';
protect_page();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && verify_token($_POST['csrf'])) {
    if(!empty($_POST['title']) && !empty($_POST['event_date'])) {
        $stmt = $pdo->prepare("INSERT INTO events (title, category, event_date, location, description) VALUES (?,?,?,?,?)");
        $stmt->execute([$_POST['title'], $_POST['category'], $_POST['event_date'], $_POST['location'], $_POST['description']]);
        header("Location: index.php");
    }
}
include '../includes/header.php';
echo render('event_form', ['type' => 'Add']);
include '../includes/footer.php';