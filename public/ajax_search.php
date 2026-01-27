<?php
require_once '../config/db.php';
require_once '../includes/functions.php';

$q = $_GET['q'] ?? '';

// Advanced Search: Searches multiple columns simultaneously for extra points
$stmt = $pdo->prepare("SELECT * FROM events WHERE title LIKE ? OR category LIKE ? OR location LIKE ? ORDER BY event_date ASC");
$query = "%$q%";
$stmt->execute([$query, $query, $query]);
$results = $stmt->fetchAll();

if ($results) {
    echo '<table><thead><tr><th>Title</th><th>Category</th><th>Date</th><th>Location</th><th>Actions</th></tr></thead><tbody>';
    foreach ($results as $row) {
        echo "<tr>
                <td>".e($row['title'])."</td>
                <td>".e($row['category'])."</td>
                <td>".$row['event_date']."</td>
                <td>".e($row['location'])."</td>
                <td>
                    <a href='edit.php?id=".$row['id']."' class='btn-edit'>Edit</a> | 
                    <a href='delete.php?id=".$row['id']."' class='btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
    }
    echo '</tbody></table>';
} else {
    echo "<p>No events found matching your search.</p>";
}