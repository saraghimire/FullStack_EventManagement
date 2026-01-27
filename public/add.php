<?php 
require_once '../config/db.php';
require_once '../includes/functions.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verify CSRF Token for Security
    if (!verify_csrf_token($_POST['csrf_token'])) {
        die("CSRF token validation failed.");
    }

    // Prepared Statement to prevent SQL Injection
    $stmt = $pdo->prepare("INSERT INTO events (title, description, event_date, category, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $_POST['event_date'], $_POST['category'], $_POST['location']]);
    echo "<p class='success-msg'>Event Created Successfully!</p>";
}
?>

<h2>Create Event</h2>
<form method="POST">
    <input type="hidden" name="csrf_token" value="<?= get_csrf_token() ?>">
    <label>Title</label><input type="text" name="title" required>
    <label>Category</label><input type="text" name="category" placeholder="Wedding, Birthday, etc.">
    <label>Date</label><input type="date" name="event_date" required>
    <label>Location</label><input type="text" name="location">
    <label>Description</label><textarea name="description"></textarea>
    <button type="submit" class="btn-success">Save Event</button>
</form>

<?php include '../includes/footer.php'; ?>