<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/template_helper.php';

protect_page(); // Secure the dashboard

$events = $pdo->query("SELECT * FROM events ORDER BY event_date ASC")->fetchAll();

include '../includes/header.php';
echo render('index_view', ['events' => $events]);
include '../includes/footer.php';