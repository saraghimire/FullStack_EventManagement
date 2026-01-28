<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/template_helper.php';
protect_page();

$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
$events = $stmt->fetchAll();

include '../includes/header.php';
echo render('index_view', ['events' => $events]);
include '../includes/footer.php';