<?php 
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/template_helper.php';

// Secure the page
protect_page();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// 1. Handle the Update (Logic)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // SECURITY: CSRF Token Verification
    if (!verify_token($_POST['csrf_token'])) {
        die("CSRF Token Validation Failed.");
    }

    try {
        $sql = "UPDATE events SET title=?, description=?, event_date=?, category=?, location=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['title'], 
            $_POST['description'], 
            $_POST['event_date'], 
            $_POST['category'], 
            $_POST['location'], 
            $id
        ]);
        
        header("Location: index.php?msg=updated");
        exit;
    } catch (PDOException $e) {
        $error = "Database Error: " . $e->getMessage();
    }
}

// 2. Fetch current data to pre-fill the form
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();

if (!$event) {
    die("Event not found.");
}

// 3. Render the UI using the Template Engine
include '../includes/header.php';
echo render('edit_view', ['event' => $event, 'id' => $id]);
include '../includes/footer.php';