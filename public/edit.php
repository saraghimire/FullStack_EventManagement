<?php 
// 1. Database Connection
require_once '../config/db.php';
include '../includes/header.php';

// 2. Get the ID from the URL (?id=...)
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    echo "<p style='color:red;'>Error: No event ID provided.</p>";
    include '../includes/footer.php';
    exit;
}

// 3. Handle the Form Submission (The "Update" part of CRUD)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Use Prepared Statements to prevent SQL Injection (Rubric Requirement)
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
        
        // Redirect back to home page after successful update
        header("Location: index.php?msg=updated");
        exit;
    } catch (PDOException $e) {
        echo "<p style='color:red;'>Database Error: " . $e->getMessage() . "</p>";
    }
}

// 4. Fetch the current data to pre-fill the form (The "Read" part of CRUD)
$stmt = $pdo->prepare("SELECT * FROM events WHERE id = ?");
$stmt->execute([$id]);
$event = $stmt->fetch();

if (!$event) {
    echo "<p style='color:red;'>Error: Event not found.</p>";
    include '../includes/footer.php';
    exit;
}
?>

<h2>Edit Event Details</h2>
<form method="POST" action="edit.php?id=<?= $id ?>">
    <label>Event Title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required>
    
    <label>Description:</label>
    <textarea name="description" rows="4"><?= htmlspecialchars($event['description']) ?></textarea>
    
    <label>Date:</label>
    <input type="date" name="event_date" value="<?= $event['event_date'] ?>" required>
    
    <label>Category:</label>
    <input type="text" name="category" value="<?= htmlspecialchars($event['category']) ?>">
    
    <label>Location:</label>
    <input type="text" name="location" value="<?= htmlspecialchars($event['location']) ?>">
    
    <br><br>
    <button type="submit" style="background-color: #007bff;">Save Changes</button>
    <a href="index.php" style="margin-left: 10px; color: #666;">Cancel</a>
</form>

<?php include '../includes/footer.php'; ?>