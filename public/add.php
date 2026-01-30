<?php
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/template_helper.php';

// Secure the page
protect_page();

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // SECURITY: CSRF Token Verification
    if (!verify_token($_POST['csrf_token'])) {
        die("CSRF Token Validation Failed.");
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO events (title, category, event_date, location, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['title'], 
            $_POST['category'], 
            $_POST['event_date'], 
            $_POST['location'], 
            $_POST['description']
        ]);
        
        header("Location: index.php?msg=created");
        exit;
    } catch (PDOException $e) {
        $error = "Database Error: " . $e->getMessage();
    }
}

include '../includes/header.php';

// Pass the 'title' variable to fix the "Undefined variable" error
echo render('event_form_view', [
    'title' => 'Create New Event', 
    'error' => $error,
    'event' => null // We send null because this is a new event, not an edit
]);

include '../includes/footer.php';