<?php 
require_once '../config/db.php';
include '../includes/header.php';

$event_id = $_GET['id'] ?? null;
if (!$event_id) { header("Location: index.php"); exit; }

// Get event details to show what they are registering for
$stmt = $pdo->prepare("SELECT title FROM events WHERE id = ?");
$stmt->execute([$event_id]);
$event = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO registrations (event_id, attendee_name, attendee_email) VALUES (?, ?, ?)");
    $stmt->execute([$event_id, $_POST['name'], $_POST['email']]);
    echo "<p style='color:green;'>Registration Successful for " . htmlspecialchars($event['title']) . "!</p>";
}
?>

<h2>Register for: <?= htmlspecialchars($event['title']) ?></h2>
<form method="POST">
    <input type="text" name="name" placeholder="Your Name" required><br><br>
    <input type="email" name="email" placeholder="Your Email" required><br><br>
    <button type="submit">Join Event</button>
</form>

<p><a href="index.php">Back to Events</a></p>

<?php include '../includes/footer.php'; ?>