<?php 
require_once '../config/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO events (title, description, event_date, category, location) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['description'], $_POST['event_date'], $_POST['category'], $_POST['location']]);
    echo "<p style='color:green;'>Event Created Successfully!</p>";
}
?>

<h2>Create New Event</h2>
<form method="POST">
    <input type="text" name="title" placeholder="Event Title" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="date" name="event_date" required><br>
    <input type="text" name="category" placeholder="Category (e.g. Tech, Music)"><br>
    <input type="text" name="location" placeholder="Location"><br>
    <button type="submit">Add Event</button>
</form>

<?php include '../includes/footer.php'; ?>